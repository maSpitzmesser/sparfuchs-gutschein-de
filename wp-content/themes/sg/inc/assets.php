<?php
/**
 * Styles und Scripts. Alles läuft über wp_enqueue_*; die Versionsnummer ist das Änderungsdatum
 * der Datei, damit Browser nach jeder Änderung neu laden.
 */

defined('ABSPATH') || exit;

/** Änderungszeit einer Theme-Datei als Versionsnummer (Pfad relativ zum Theme, mit führendem /). */
function sg_asset_version(string $path): string
{
    $time = @filemtime(SG_THEME_DIR . $path);
    return $time ? (string) $time : wp_get_theme()->get('Version');
}

/** Basis-Stylesheets in der Reihenfolge, in der sie aufeinander aufbauen. */
function sg_base_styles(): array
{
    return [
        'fonts', '1html5reset', '2cols', '3cols', '4cols', '5cols', 'breadcrumb', 'col', 'cookie-banner',
        'coupon', 'dropdowns', 'footer', 'fuchs', 'google-ads', 'header', 'lightbox', 'main-menu',
        'searchform-autocomplet', 'side-nav', 'slick-carousel', 'social-networks', 'tabs',
        'components',
    ];
}

add_action('wp_enqueue_scripts', static function (): void {
    $previous = [];
    foreach (sg_base_styles() as $name) {
        $path = "/styles/css/{$name}.css";
        wp_enqueue_style("sg-{$name}", SG_THEME_URI . $path, $previous, sg_asset_version($path), 'print, screen');
        $previous = ["sg-{$name}"];
    }

    // Gewähltes Design zuletzt, damit es die Basis überschreibt
    $design = sg_current_design();
    wp_enqueue_style('sg-design', SG_THEME_URI . "/styles/{$design}/theme.css", $previous, (string) sg_designs_version(), 'screen');

    if (sg_is_form_page()) {
        wp_enqueue_style('sg-forms', SG_THEME_URI . '/templates/forms/css/form.css', ['sg-design'], sg_asset_version('/templates/forms/css/form.css'));
    }

    wp_enqueue_script('sg-site', SG_THEME_URI . '/assets/js/site.js', [], sg_asset_version('/assets/js/site.js'), ['in_footer' => true, 'strategy' => 'defer']);
    wp_add_inline_script('sg-site', 'window.sgConfig = ' . wp_json_encode([
        'designs'     => array_keys(sg_designs()),
        'designCookie' => SG_DESIGN_COOKIE,
        'searchUrl'   => rest_url('sg/v1/shops'),
        'goUrl'       => home_url('/go/'),
    ]) . ';', 'before');

    // Partnerprogramm-Script von Awin (Provisionszuordnung)
    wp_enqueue_script('awin-publisher', 'https://www.dwin2.com/pub.587077.min.js', [], null, ['in_footer' => true, 'strategy' => 'defer']);
});

/* Der Design-Wechsler sucht das Stylesheet über id="active-theme" und kennt Design und Version. */
add_filter('style_loader_tag', static function (string $tag, string $handle): string {
    if ($handle !== 'sg-design') {
        return $tag;
    }
    $attributes = sprintf(
        'id="active-theme" data-active-design="%s" data-version="%s"',
        esc_attr(sg_current_design()),
        esc_attr((string) sg_designs_version())
    );
    return preg_replace('/\sid=([\'"])sg-design-css\1/', ' ' . $attributes, $tag, 1);
}, 10, 2);

/* Schriften früh anfordern, damit Text und Symbole ohne Springen erscheinen. */
add_action('wp_head', static function (): void {
    foreach (['/styles/fonts/open-sans.woff2' => 'font/woff2', '/styles/fonts/icomoon.woff' => 'font/woff'] as $path => $type) {
        printf('<link rel="preload" href="%s" as="font" type="%s" crossorigin>' . "\n", esc_url(SG_THEME_URI . $path), esc_attr($type));
    }
    echo '<meta name="theme-color" content="#ff5800">' . "\n";
}, 2);

add_action('wp_head', static function (): void {
    printf('<link rel="icon" href="%s" sizes="any">' . "\n", esc_url(home_url('/favicon.ico')));
    printf('<link rel="apple-touch-icon" href="%s">' . "\n", esc_url(SG_THEME_URI . '/images/logo/apple-touch-icon_152x152.png'));
}, 3);

/** Seiten mit Formular (Kontakt, Feedback, Gutschein melden). */
function sg_is_form_page(): bool
{
    return is_page(['kontakt', 'feedback', 'gutschein-melden']);
}
