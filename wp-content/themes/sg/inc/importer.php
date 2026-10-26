<?php
/**
 * Import der Gutscheine aus dem Awin-Promotions-Export (CSV) in die Tabelle awin_vouchers.
 *
 * Der Export-Link enthält einen persönlichen Zugangsschlüssel und wird deshalb nicht im Code,
 * sondern in den WordPress-Einstellungen gespeichert (Admin: Gutscheine › Einstellungen).
 * Ablauf: herunterladen, prüfen, dann in einer Transaktion ersetzen. Schlägt etwas fehl,
 * bleiben die bisherigen Gutscheine erhalten.
 */

defined('ABSPATH') || exit;

const SG_AWIN_URL_OPTION    = 'sg_awin_export_url';
const SG_AWIN_STATUS_OPTION = 'sg_awin_last_import';
const SG_AWIN_CRON_HOOK     = 'sg_awin_import';

/* Spalten im Awin-Export, die für den Import vorhanden sein müssen */
const SG_AWIN_REQUIRED_COLUMNS = ['Promotion ID', 'Advertiser', 'Advertiser ID', 'Type', 'Title', 'Starts', 'Ends'];

/* ---------- Zeitplan ---------- */

add_filter('cron_schedules', static function (array $schedules): array {
    $schedules['sg_three_hours'] = ['interval' => 3 * HOUR_IN_SECONDS, 'display' => 'Alle 3 Stunden'];
    return $schedules;
});

add_action('init', static function (): void {
    $configured = (bool) get_option(SG_AWIN_URL_OPTION);
    $scheduled  = wp_next_scheduled(SG_AWIN_CRON_HOOK);
    if ($configured && !$scheduled) {
        wp_schedule_event(time() + MINUTE_IN_SECONDS, 'sg_three_hours', SG_AWIN_CRON_HOOK);
    } elseif (!$configured && $scheduled) {
        wp_clear_scheduled_hook(SG_AWIN_CRON_HOOK);
    }
});

add_action(SG_AWIN_CRON_HOOK, 'sg_awin_import');

/* ---------- Import ---------- */

/**
 * Führt den Import aus und speichert das Ergebnis (Zeit, Erfolg, Meldung) für die Admin-Übersicht.
 *
 * @return array{ok: bool, count: int, message: string, time: int}
 */
function sg_awin_import(): array
{
    $result = sg_awin_run_import();
    $result['time'] = time();
    update_option(SG_AWIN_STATUS_OPTION, $result, false);

    if (!$result['ok']) {
        // Wiederholte Fehler nur einmal am Tag per Mail melden
        if (!get_transient('sg_awin_failure_mail')) {
            wp_mail(get_option('admin_email'), '[Sparfuchs-Gutschein] Awin-Import fehlgeschlagen', $result['message']);
            set_transient('sg_awin_failure_mail', 1, DAY_IN_SECONDS);
        }
    }
    return $result;
}

/** @return array{ok: bool, count: int, message: string} */
function sg_awin_run_import(): array
{
    $url = (string) get_option(SG_AWIN_URL_OPTION);
    if (!wp_http_validate_url($url)) {
        return ['ok' => false, 'count' => 0, 'message' => 'Kein gültiger Awin-Export-Link hinterlegt.'];
    }

    $response = wp_remote_get($url, ['timeout' => 60]);
    if (is_wp_error($response)) {
        return ['ok' => false, 'count' => 0, 'message' => 'Download fehlgeschlagen: ' . $response->get_error_message()];
    }
    $status = wp_remote_retrieve_response_code($response);
    if ($status !== 200) {
        return ['ok' => false, 'count' => 0, 'message' => "Awin antwortet mit HTTP {$status}. Ist der Export-Link noch gültig?"];
    }

    $rows = sg_awin_parse_csv(wp_remote_retrieve_body($response));
    if (is_string($rows)) {
        return ['ok' => false, 'count' => 0, 'message' => $rows];
    }
    if (!$rows) {
        return ['ok' => false, 'count' => 0, 'message' => 'Der Export enthält keine Angebote. Die bisherigen Gutscheine bleiben erhalten.'];
    }

    $offers = array_map('sg_awin_map_row', $rows);
    return sg_awin_replace_offers($offers);
}

/**
 * CSV in Zeilen mit Spaltennamen zerlegen.
 *
 * @return array<int, array<string, string>>|string Zeilen oder Fehlermeldung
 */
function sg_awin_parse_csv(string $csv)
{
    $stream = fopen('php://temp', 'r+');
    fwrite($stream, $csv);
    rewind($stream);

    $header = fgetcsv($stream, null, ',', '"', '');
    if (!$header) {
        return 'Der Export ist leer.';
    }
    $header = array_map(static fn($column): string => trim((string) $column, "\u{FEFF} \t"), $header);
    $missing = array_diff(SG_AWIN_REQUIRED_COLUMNS, $header);
    if ($missing) {
        return 'Unerwartetes Format, es fehlen die Spalten: ' . implode(', ', $missing);
    }

    $rows = [];
    while (($line = fgetcsv($stream, null, ',', '"', '')) !== false) {
        if (count($line) === count($header)) {
            $rows[] = array_combine($header, $line);
        }
    }
    fclose($stream);
    return $rows;
}

/** Eine CSV-Zeile in einen Datensatz der Tabelle awin_vouchers umwandeln. */
function sg_awin_map_row(array $row): array
{
    static $corrections = null;
    $corrections ??= require SG_THEME_DIR . '/inc/awin-corrections.php';

    $advertiser = $row['Advertiser'];
    foreach ($corrections['shopnames'] as [$search, $replace]) {
        $advertiser = str_replace($search, $replace, $advertiser);
    }
    $title = preg_replace('/\*+/', '', $row['Title']);
    foreach ($corrections['titles'] as [$search, $replace]) {
        $title = str_replace($search, $replace, $title);
    }
    $title = str_replace('Euro', '€', $title);

    return [
        'PromotionID'      => (int) $row['Promotion ID'],
        'Advertiser'       => str_replace(['&#8209;', ' ', '.', '`', "'"], '-', $advertiser),
        'Shopname'         => sg_shop_slug($advertiser),
        'AdvertiserID'     => (int) $row['Advertiser ID'],
        'post_id'          => sg_awin_shop_post_id($advertiser),
        'Type'             => $row['Type'],
        'Code'             => $row['Code'] ?? '',
        'Description'      => $row['Description'] ?? '',
        'Starts'           => sg_awin_date($row['Starts']),
        'Ends'             => sg_awin_date($row['Ends']),
        'Categories'       => $row['Categories'] ?? '',
        'Regions'          => $row['Regions'] ?? '',
        'Terms'            => $row['Terms'] ?? '',
        'DeeplinkTracking' => $row['Deeplink Tracking'] ?? '',
        'Deeplink'         => $row['Deeplink'] ?? '',
        'CommissionGroups' => $row['Commission Groups'] ?? '',
        'Commission'       => $row['Commission'] ?? '',
        'Exclusive'        => $row['Exclusive'] ?? 'no',
        'DateAdded'        => sg_awin_date($row['Date Added'] ?? ''),
        'Title'            => $title,
    ];
}

/** Awin liefert Datumsangaben als "TT/MM/JJJJ HH:MM"; leer bleibt NULL. */
function sg_awin_date(string $value): ?string
{
    $date = DateTimeImmutable::createFromFormat('d/m/Y H:i', trim($value), wp_timezone())
        ?: DateTimeImmutable::createFromFormat('d/m/Y H:i:s', trim($value), wp_timezone());
    return $date ? $date->format('Y-m-d H:i:s') : null;
}

/** Shop-Beitrag zum Namen des Werbetreibenden (0, wenn es den Shop auf der Seite nicht gibt). */
function sg_awin_shop_post_id(string $advertiser): int
{
    static $shops = null;
    if ($shops === null) {
        global $wpdb;
        $shops = [];
        foreach ($wpdb->get_results("SELECT ID, post_title FROM {$wpdb->posts} WHERE post_type = 'post' AND post_status IN ('publish', 'private')") as $post) {
            $shops[mb_strtolower(html_entity_decode($post->post_title, ENT_QUOTES, 'UTF-8'))] = (int) $post->ID;
        }
    }
    return $shops[mb_strtolower($advertiser)] ?? 0;
}

/** Alle Angebote in einer Transaktion ersetzen. */
function sg_awin_replace_offers(array $offers): array
{
    global $wpdb;
    $wpdb->query('START TRANSACTION');
    $wpdb->query('DELETE FROM ' . SG_OFFER_TABLE);

    foreach ($offers as $offer) {
        if ($wpdb->insert(SG_OFFER_TABLE, $offer) === false) {
            $error = $wpdb->last_error;
            $wpdb->query('ROLLBACK');
            return ['ok' => false, 'count' => 0, 'message' => "Speichern fehlgeschlagen bei Angebot {$offer['PromotionID']}: {$error}. Die bisherigen Gutscheine bleiben erhalten."];
        }
    }

    $wpdb->query('COMMIT');
    return ['ok' => true, 'count' => count($offers), 'message' => count($offers) . ' Angebote importiert.'];
}
