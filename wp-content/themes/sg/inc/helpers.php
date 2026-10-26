<?php
/**
 * Kleine Helfer für Templates: Shop-Logos, Zuordnung Angebot → Shop, Datumsangaben.
 */

defined('ABSPATH') || exit;

/** Dateiname-Teil eines Shop-Logos aus dem Shopnamen, z. B. "Tom Tailor" → "tom-tailor". */
function sg_shop_slug(string $name): string
{
    $name = str_replace(
        [' ', '.', '&', '`', "'", 'ö', 'ü', 'ä', 'Ö', 'Ü', 'Ä'],
        ['-', '-', '-und-', '-', '-', 'oe', 'ue', 'ae', 'oe', 'ue', 'ae'],
        html_entity_decode($name, ENT_QUOTES, 'UTF-8')
    );
    return sanitize_file_name(strtolower(urldecode($name)));
}

/** URL des Shop-Logos; fehlt die Datei, ein leeres Platzhalterbild. */
function sg_shop_logo_url(string $name): string
{
    static $cache = [];
    if (!isset($cache[$name])) {
        $path = '/images/shop_logos/' . sg_shop_slug($name) . '-logo.png';
        if (!is_file(SG_THEME_DIR . $path)) {
            $path = '/images/shop_logos/blank.png';
        }
        $cache[$name] = SG_THEME_URI . $path;
    }
    return $cache[$name];
}

/**
 * Logo als <img>. $alt und $title sind Anzeigetexte; weitere Attribute wie class oder loading per $attrs.
 */
function sg_shop_logo(string $name, string $alt = '', array $attrs = []): string
{
    $attrs = array_merge([
        'src'      => sg_shop_logo_url($name),
        'alt'      => $alt !== '' ? $alt : $name . ' Gutscheincode',
        'title'    => $name,
        'loading'  => 'lazy',
        'decoding' => 'async',
    ], $attrs);

    $html = '<img';
    foreach ($attrs as $key => $value) {
        if ($value === null || $value === false) {
            continue;
        }
        $html .= ' ' . $key . '="' . ($key === 'src' ? esc_url($value) : esc_attr($value)) . '"';
    }
    return $html . '>';
}

/**
 * Shop-Beitrag (ID) zu einem Awin-Angebot. Das Feld post_id ist nicht bei allen Angeboten gesetzt,
 * dann über den Shopnamen (Beitrags-Slug) oder den Werbetreibenden (Beitragstitel) suchen.
 */
function sg_offer_shop_id(object $offer): int
{
    static $cache = [];
    if (!empty($offer->post_id)) {
        return (int) $offer->post_id;
    }
    $key = ($offer->Shopname ?? '') . '|' . ($offer->Advertiser ?? '');
    if (!array_key_exists($key, $cache)) {
        global $wpdb;
        $cache[$key] = (int) $wpdb->get_var($wpdb->prepare(
            "SELECT ID FROM {$wpdb->posts}
             WHERE post_type = 'post' AND post_status = 'publish' AND (post_name = %s OR post_title = %s)
             ORDER BY post_name = %s DESC LIMIT 1",
            $offer->Shopname ?? '', $offer->Advertiser ?? '', $offer->Shopname ?? ''
        ));
    }
    return $cache[$key];
}

/** Titel des Shops (Beitrag) auf Shop-Seiten bzw. in Schleifen: übergeordneter Beitrag, sonst der aktuelle. */
function sg_current_shop_title(): string
{
    $post = get_post();
    if (!$post) {
        return '';
    }
    return get_the_title($post->post_parent ?: $post);
}

/** Datum aus der Datenbank (Y-m-d H:i:s) als Zeitstempel, oder null. */
function sg_timestamp(?string $datetime): ?int
{
    if (empty($datetime) || str_starts_with($datetime, '0000')) {
        return null;
    }
    $date = date_create_immutable($datetime, wp_timezone());
    return $date ? $date->getTimestamp() : null;
}

/** Datum in deutscher Schreibweise, z. B. "15.April 2024". */
function sg_date(?int $timestamp, string $format = 'd.F Y'): string
{
    return $timestamp ? wp_date($format, $timestamp) : '';
}

/**
 * Angebotstitel: Der Import speichert sie HTML-kodiert und teils schon mit <span class="ex">.
 * Daher erst auf reinen Text zurückführen, dann sicher ausgeben und EXKLUSIV hervorheben.
 */
function sg_format_offer_title(?string $title): string
{
    $text = wp_strip_all_tags(html_entity_decode((string) $title, ENT_QUOTES, 'UTF-8'));
    return str_replace(
        ['Euro', 'Exklusiver', 'EXKLUSIV'],
        ['€', '<span class="ex">EXKLUSIV</span>', '<span class="ex">EXKLUSIV</span>'],
        esc_html($text)
    );
}

/** Shopnamen in kurzen Listen: geschützter Bindestrich, damit Namen nicht umbrechen. */
function sg_format_shop_name(string $name): string
{
    return str_replace('-', '&#8209;', esc_html(html_entity_decode($name, ENT_QUOTES, 'UTF-8')));
}

/** Text aus der Awin-Datenbank, der dort bereits HTML-kodiert gespeichert ist, sicher ausgeben. */
function sg_offer_text(?string $text): string
{
    return esc_html(html_entity_decode((string) $text, ENT_QUOTES, 'UTF-8'));
}

/** Brotkrumen-Navigation für Seiten und Shops (mit strukturierten Daten). */
function sg_breadcrumb(): void
{
    $items = [['url' => home_url('/'), 'name' => 'Startseite', 'title' => 'zur Startseite']];

    if (is_page() && !is_front_page()) {
        foreach (array_reverse(get_post_ancestors(get_the_ID())) as $ancestor) {
            $items[] = ['url' => get_permalink($ancestor), 'name' => get_the_title($ancestor)];
        }
    } elseif (is_single()) {
        $category = get_the_category()[0] ?? null;
        if ($category) {
            $items[] = ['url' => get_category_link($category), 'name' => $category->name, 'title' => $category->name . ' Codes'];
        }
    }
    $items[] = ['url' => get_permalink(), 'name' => get_the_title()];

    echo '<ol class="breadcrumbs" itemscope itemtype="https://schema.org/BreadcrumbList">';
    echo '<li>Sie befinden sich hier:</li>';
    foreach ($items as $position => $item) {
        printf(
            '<li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="%s" title="%s"><span itemprop="name">%s</span></a><meta itemprop="position" content="%d"></li>',
            esc_url($item['url']),
            esc_attr(wp_strip_all_tags($item['title'] ?? $item['name'])),
            esc_html(wp_strip_all_tags($item['name'])),
            $position + 1
        );
    }
    echo '</ol>';
}
