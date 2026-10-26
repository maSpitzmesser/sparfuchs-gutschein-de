<?php
/**
 * Theme-Grundlagen: Unterstützte Funktionen, Menüs, Seitenleisten, Aufräumen von wp_head.
 */

defined('ABSPATH') || exit;

add_action('after_setup_theme', static function (): void {
    add_theme_support('title-tag');
    add_theme_support('automatic-feed-links');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'gallery', 'caption', 'style', 'script', 'navigation-widgets']);
    add_theme_support('responsive-embeds');

    register_nav_menu('primary', 'Hauptmenü');

    set_post_thumbnail_size(350, 262, true);
    add_image_size('thumb-small', 30, 30, true);
    add_image_size('thumb-med', 75, 75, true);
    add_image_size('thumb-large', 230, 172, true);
});

add_action('widgets_init', static function (): void {
    $shared = [
        'before_widget' => '<div>',
        'after_widget'  => '</div>',
        'before_title'  => '<span>',
        'after_title'   => '</span>',
    ];
    register_sidebar(['name' => 'Shop Sidebar', 'id' => 'sidebar_shop'] + $shared);
    register_sidebar(['name' => 'Page Sidebar', 'id' => 'sidebar_page'] + $shared);
    register_sidebar(['name' => 'Kategorien Sidebar', 'id' => 'sidebar_cats'] + $shared);

    // Nicht genutzte Standard-Widgets ausblenden
    foreach (['WP_Widget_Pages', 'WP_Widget_Calendar', 'WP_Widget_Archives', 'WP_Widget_Links', 'WP_Widget_Categories', 'WP_Widget_Recent_Posts', 'WP_Widget_Search', 'WP_Widget_Tag_Cloud'] as $widget) {
        unregister_widget($widget);
    }
});

/* ---------- wp_head und Ausgaben aufräumen ---------- */

add_filter('xmlrpc_enabled', '__return_false');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('wp_head', 'wp_oembed_add_discovery_links');

add_action('wp_enqueue_scripts', static function (): void {
    // Das Theme nutzt keine Blöcke im Frontend
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('classic-theme-styles');
    wp_dequeue_style('global-styles');
    wp_deregister_script('wp-embed');
}, 100);

/* ---------- Menü: schlanke Klassen, aktive Einträge als "active" ---------- */

add_filter('nav_menu_css_class', static function (array $classes, $item): array {
    $active = array_intersect($classes, ['current-menu-item', 'current-menu-parent', 'current-menu-ancestor']) ? ['active'] : [];
    $custom = array_filter((array) get_post_meta($item->ID, '_menu_item_classes', true));
    return array_merge($active, $custom);
}, 10, 2);

add_filter('nav_menu_item_id', '__return_empty_string');

/* ---------- Seitentitel: "» Seite" wie bisher ---------- */

add_filter('document_title_separator', static fn(): string => '»');

/* ---------- Anmeldeseite ---------- */

add_action('login_enqueue_scripts', static function (): void {
    wp_enqueue_style('sg-login', SG_THEME_URI . '/styles/login-style.css', [], sg_asset_version('/styles/login-style.css'));
});
add_filter('login_headerurl', static fn(): string => home_url('/'));
add_filter('login_headertext', static fn(): string => get_bloginfo('name'));
