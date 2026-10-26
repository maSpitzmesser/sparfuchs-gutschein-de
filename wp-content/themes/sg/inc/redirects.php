<?php
/**
 * Weiterleitungen zu den Shops:
 *   /go/aw?id=<PromotionID>        Zwischenseite mit Gutscheincode, zählt den Klick und leitet zum Shop weiter
 *   /go/layer-aw?id=<PromotionID>  Detailansicht eines Gutscheins (wird im Dialog auf der Shop-Seite geladen)
 * Die Adressen entsprechen den früheren /go/*.php-Skripten, damit bestehende Links weiter funktionieren.
 */

defined('ABSPATH') || exit;

const SG_REWRITE_VERSION = '2026-10-go-routes';

add_action('init', static function (): void {
    add_rewrite_rule('^go/(aw|layer-aw)/?$', 'index.php?sg_go=$matches[1]', 'top');

    if (get_option('sg_rewrite_version') !== SG_REWRITE_VERSION) {
        flush_rewrite_rules(false);
        update_option('sg_rewrite_version', SG_REWRITE_VERSION, false);
    }
});

add_filter('query_vars', static function (array $vars): array {
    $vars[] = 'sg_go';
    return $vars;
});

/** Adresse der Weiterleitung zu einem Angebot. */
function sg_go_url(int $promotion_id, string $route = 'aw'): string
{
    return add_query_arg('id', $promotion_id, home_url("/go/{$route}"));
}

/** Angebot aus der Datenbank oder null. */
function sg_get_offer(int $promotion_id): ?object
{
    global $wpdb;
    return $wpdb->get_row($wpdb->prepare('SELECT * FROM ' . SG_OFFER_TABLE . ' WHERE PromotionID = %d LIMIT 1', $promotion_id)) ?: null;
}

/** Ziel-Link eines Angebots (Tracking-Link bevorzugt), nur http(s). */
function sg_offer_target(object $offer): string
{
    $url = $offer->DeeplinkTracking ?: $offer->Deeplink;
    return wp_http_validate_url($url) ? $url : '';
}

function sg_count_offer_click(int $promotion_id): void
{
    global $wpdb;
    $wpdb->query($wpdb->prepare(
        'INSERT INTO ' . SG_CLICKS_TABLE . ' (PromotionID, Clicks) VALUES (%d, 1) ON DUPLICATE KEY UPDATE Clicks = Clicks + 1',
        $promotion_id
    ));
}

add_action('template_redirect', static function (): void {
    $route = get_query_var('sg_go');
    if (!$route) {
        return;
    }

    nocache_headers();
    header('X-Robots-Tag: noindex, nofollow');

    $offer = sg_get_offer(absint($_GET['id'] ?? 0));
    if (!$offer) {
        status_header(404);
        $offer = null;
    }

    if ($route === 'aw' && $offer) {
        sg_count_offer_click((int) $offer->PromotionID);
    }

    $template = $route === 'aw' ? 'redirect' : 'layer';
    require SG_THEME_DIR . "/templates/go/{$template}.php";
    exit;
}, 1);
