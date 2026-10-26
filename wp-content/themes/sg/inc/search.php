<?php
/**
 * Shop-Suche: Vorschläge für das Suchfeld (REST) und Verhalten der Suchseite.
 */

defined('ABSPATH') || exit;

/* GET /wp-json/sg/v1/shops?search=zoo → bis zu 5 Shops mit Titel, Link und Logo */
add_action('rest_api_init', static function (): void {
    register_rest_route('sg/v1', '/shops', [
        'methods'             => WP_REST_Server::READABLE,
        'permission_callback' => '__return_true',
        'args'                => [
            'search' => [
                'type'              => 'string',
                'required'          => true,
                'sanitize_callback' => 'sanitize_text_field',
                'validate_callback' => static fn($value): bool => is_string($value) && mb_strlen(trim($value)) >= 1 && mb_strlen($value) <= 60,
            ],
        ],
        'callback'            => static function (WP_REST_Request $request): WP_REST_Response {
            global $wpdb;
            $term  = '%' . $wpdb->esc_like(trim($request['search'])) . '%';
            $shops = $wpdb->get_results($wpdb->prepare(
                "SELECT ID, post_title FROM {$wpdb->posts}
                 WHERE post_type = 'post' AND post_status = 'publish' AND post_title LIKE %s
                 ORDER BY post_title LIKE %s DESC, post_title ASC
                 LIMIT 5",
                $term, $wpdb->esc_like(trim($request['search'])) . '%'
            ));
            $data = array_map(static fn(object $shop): array => [
                'title' => html_entity_decode($shop->post_title, ENT_QUOTES, 'UTF-8'),
                'url'   => get_permalink((int) $shop->ID),
                'logo'  => sg_shop_logo_url($shop->post_title),
            ], $shops);

            $response = new WP_REST_Response($data);
            $response->header('Cache-Control', 'public, max-age=300');
            return $response;
        },
    ]);
});

/* Suchseite: leere Suche führt zur Shop-Liste, ein exakter Treffer direkt zum Shop. */
add_action('template_redirect', static function (): void {
    if (!is_search()) {
        return;
    }
    $term = trim(get_search_query(false));
    if ($term === '') {
        wp_safe_redirect(home_url('/shops/'));
        exit;
    }
    $shop = get_posts([
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'name'           => sanitize_title($term),
        'posts_per_page' => 1,
        'fields'         => 'ids',
    ]);
    if ($shop) {
        wp_safe_redirect(get_permalink($shop[0]));
        exit;
    }
});

/* Suchergebnisse: nur Shops (Beiträge), keine Seiten. */
add_action('pre_get_posts', static function (WP_Query $query): void {
    if (!is_admin() && $query->is_main_query() && $query->is_search()) {
        $query->set('post_type', 'post');
        $query->set('posts_per_page', 50);
    }
});
