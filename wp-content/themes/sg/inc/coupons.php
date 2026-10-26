<?php
/**
 * Gutscheine und Aktionen aus dem Awin-Import (Tabelle awin_vouchers).
 * Abfragen liefern Objekte, die Ausgabe übernehmen die Template-Teile in template-parts/offer-*.php.
 */

defined('ABSPATH') || exit;

const SG_OFFER_TABLE  = 'awin_vouchers';
const SG_CLICKS_TABLE = 'awin_vouchers_used';

/* ---------- Abfragen ---------- */

/** Angebote eines Shops; $type ist "voucher" (Gutscheincode) oder "promotion" (Aktion). */
function sg_get_shop_offers(int $post_id, string $type, int $limit = 40): array
{
    global $wpdb;
    $title = get_the_title($post_id);
    return $wpdb->get_results($wpdb->prepare(
        'SELECT * FROM ' . SG_OFFER_TABLE . ' WHERE Type = %s AND (post_id = %d OR Advertiser LIKE %s) ORDER BY Starts DESC LIMIT %d',
        $type, $post_id, '%' . $wpdb->esc_like(html_entity_decode($title, ENT_QUOTES, 'UTF-8')) . '%', $limit
    ));
}

/**
 * Gutscheincodes veröffentlichter Shops, sortiert nach $order ("newest" oder "ending").
 * Liefert zusätzlich shop_id und shop_title.
 */
function sg_get_vouchers(string $order, int $limit = 40): array
{
    global $wpdb;
    $order_by = $order === 'ending' ? 'c.Ends ASC' : 'c.Starts DESC';
    return $wpdb->get_results($wpdb->prepare(
        'SELECT c.*, p.ID AS shop_id, p.post_title AS shop_title
         FROM ' . SG_OFFER_TABLE . " c
         JOIN {$wpdb->posts} p ON p.post_title = c.Advertiser AND p.post_type = 'post' AND p.post_status = 'publish'
         WHERE c.Type = 'voucher'
         ORDER BY {$order_by}
         LIMIT %d",
        $limit
    ));
}

/** Am häufigsten angeklickte Gutscheincodes. */
function sg_get_popular_vouchers(int $limit = 50): array
{
    global $wpdb;
    return $wpdb->get_results($wpdb->prepare(
        'SELECT v.*, u.Clicks FROM ' . SG_OFFER_TABLE . ' v
         JOIN ' . SG_CLICKS_TABLE . " u ON u.PromotionID = v.PromotionID
         WHERE v.Type = 'voucher'
         ORDER BY u.Clicks DESC
         LIMIT %d",
        $limit
    ));
}

/** Angebote aller Shops einer Kategorie (Zuordnung über den Beitrags-Slug = Shopname). */
function sg_get_category_offers(int $category_id, int $limit = 100): array
{
    global $wpdb;
    $slugs = get_posts([
        'category'       => $category_id,
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'fields'         => 'ids',
    ]);
    $slugs = array_map(static fn(int $id): string => get_post_field('post_name', $id), $slugs);
    if (!$slugs) {
        return [];
    }
    $placeholders = implode(',', array_fill(0, count($slugs), '%s'));
    return $wpdb->get_results($wpdb->prepare(
        'SELECT * FROM ' . SG_OFFER_TABLE . " WHERE Shopname IN ({$placeholders}) ORDER BY Ends DESC LIMIT %d",
        ...array_merge($slugs, [$limit])
    ));
}

/** Neueste Zooplus-Angebote (Gutscheine und Aktionen) für die Slideshow der Startseite (Zooplus-Motiv). */
function sg_get_slider_offers(int $limit = 5): array
{
    global $wpdb;
    return $wpdb->get_results($wpdb->prepare(
        'SELECT * FROM ' . SG_OFFER_TABLE . ' WHERE Advertiser = %s ORDER BY Starts DESC LIMIT %d',
        'Zooplus', $limit
    ));
}

/** Aktive eigene Slides (Tabelle wp_slider), gepflegt im Admin unter "Slider". */
function sg_get_custom_slides(int $limit = 4): array
{
    global $wpdb;
    return $wpdb->get_results($wpdb->prepare(
        "SELECT * FROM {$wpdb->prefix}slider WHERE active = 1 ORDER BY RAND() LIMIT %d",
        $limit
    ));
}

function sg_get_offer_clicks(int $promotion_id): int
{
    global $wpdb;
    return (int) $wpdb->get_var($wpdb->prepare('SELECT Clicks FROM ' . SG_CLICKS_TABLE . ' WHERE PromotionID = %d', $promotion_id));
}

function sg_count_offers(bool $only_today = false): int
{
    global $wpdb;
    $where = $only_today ? ' WHERE DATE(Starts) = CURDATE()' : '';
    return (int) $wpdb->get_var('SELECT COUNT(*) FROM ' . SG_OFFER_TABLE . $where);
}

/** Datum des neuesten Angebots eines Shops (für "aktualisiert"), sonst letzte Änderung des Beitrags. */
function sg_shop_updated_timestamp(int $post_id): ?int
{
    global $wpdb;
    $latest = $wpdb->get_var($wpdb->prepare(
        'SELECT MAX(Starts) FROM ' . SG_OFFER_TABLE . ' WHERE post_id = %d OR Advertiser = %s',
        $post_id, html_entity_decode(get_the_title($post_id), ENT_QUOTES, 'UTF-8')
    ));
    return sg_timestamp($latest) ?? (get_post_modified_time('U', false, $post_id) ?: null);
}

/* ---------- Ausgabe ---------- */

/** Liste von Angeboten mit einem Template-Teil aus template-parts/offer-*.php. */
function sg_render_offers(array $offers, string $template, array $args = []): void
{
    foreach ($offers as $offer) {
        get_template_part('template-parts/offer', $template, ['offer' => $offer] + $args);
    }
}

/** Gültigkeit eines Angebots: Restlaufzeit, Ablaufdatum oder "abgelaufen". */
function sg_countdown(?string $ends): void
{
    $end = sg_timestamp($ends);
    if (!$end) {
        echo '<span class="vato">Aktuell noch gültig!</span>';
        return;
    }

    printf('<meta itemprop="endDate" content="%s">', esc_attr(wp_date('Y-m-d', $end)));

    $today    = (new DateTimeImmutable('today', wp_timezone()))->getTimestamp();
    $end_day  = (new DateTimeImmutable('@' . $end))->setTimezone(wp_timezone())->setTime(0, 0)->getTimestamp();
    $days     = (int) round(($end_day - $today) / DAY_IN_SECONDS);
    $title    = esc_attr('Gültig bis: ' . sg_date($end, 'd.F.Y'));

    if ($days < 0) {
        echo '<span class="vato expired">Abgelaufen am ' . esc_html(sg_date($end)) . '</span>';
    } elseif ($days === 0) {
        echo '<span class="count" title="' . $title . '">Nur noch Heute!</span>';
    } elseif ($days === 1) {
        echo '<span class="count" title="' . $title . '">Nur noch 2 Tage!</span>';
    } elseif (wp_date('Ym', $end) === wp_date('Ym')) {
        echo '<span class="vato">Nur noch bis ' . esc_html(sg_date($end)) . ' gültig!</span>';
    } else {
        echo '<span class="vato">Gültig bis: ' . esc_html(sg_date($end)) . '</span>';
    }
}

/** "NEU"-Hinweis für Angebote, die heute starten. */
function sg_new_offer_ribbon(?string $starts): void
{
    $start = sg_timestamp($starts);
    if ($start && wp_date('Ymd', $start) === wp_date('Ymd')) {
        echo '<span class="new-offer">NEU</span>';
    }
}

/** "Nx mal genutzt", wenn das Angebot schon angeklickt wurde. */
function sg_offer_usage(int $promotion_id): void
{
    $clicks = sg_get_offer_clicks($promotion_id);
    if ($clicks > 0) {
        printf('<span class="used">%dx mal genutzt</span>', $clicks);
    }
}

/** Beschriftung des Angebots-Buttons je nach Angebotsart. */
function sg_offer_button_label(string $type): string
{
    return match ($type) {
        'voucher'      => 'Gutscheincode & Shop öffnen',
        'gift'         => 'zum Geschenkgutschein',
        'free product' => 'Gratisartikel & Shop öffnen',
        default        => 'Aktion & Shop anzeigen',
    };
}

/** Gutscheincodes oder Aktionen eines Shops als Kasten auf der Shop-Seite. */
function sg_shop_offer_section(int $post_id, string $type): void
{
    $offers = sg_get_shop_offers($post_id, $type);
    if (!$offers) {
        return;
    }
    $shop = get_the_title($post_id);
    if ($type === 'voucher') {
        printf('<h2 class="headline-a2 article-title">%s Gutscheincodes %s</h2>', esc_html($shop), esc_html(wp_date('F Y')));
        echo '<ul class="c" id="Gutscheine">';
    } else {
        echo '<ul class="c" id="Rabatte">';
        printf('<h2 class="headline-a2 article-title">Aktuelle Rabatte bei %s </h2>', esc_html($shop));
    }
    sg_render_offers($offers, 'awin', ['shop_id' => $post_id]);
    echo '</ul>';
}

/** Startseite: eigene Slides, sonst die neuesten Zooplus-Gutscheine. */
function sg_home_slides(): void
{
    $slides = sg_get_custom_slides();
    if ($slides) {
        foreach ($slides as $slide) {
            printf('<a href="%s"><img alt="%s" src="%s"></a>', esc_url($slide->url), esc_attr($slide->img_alt), esc_url($slide->img_link));
        }
        return;
    }
    sg_render_offers(sg_get_slider_offers(), 'slider');
}
