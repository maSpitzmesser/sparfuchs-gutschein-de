<?php
/**
 * Widgets der Seitenleisten. Die IDs (erster Konstruktor-Parameter) bleiben wie bisher,
 * damit die in WordPress gespeicherte Widget-Belegung weiter passt.
 */

defined('ABSPATH') || exit;

/** Gemeinsame Grundlage: Titel-Feld speichern, sonst nichts. */
abstract class SG_Widget extends WP_Widget
{
    public function update($new_instance, $old_instance): array
    {
        return ['title' => sanitize_text_field($new_instance['title'] ?? '')];
    }

    protected function title(array $instance, string $default): string
    {
        return apply_filters('widget_title', empty($instance['title']) ? $default : $instance['title']);
    }
}

/** Screenshot des Shops, verlinkt auf den ersten Gutschein. */
class SG_Widget_Shop_Info extends SG_Widget
{
    public function __construct()
    {
        parent::__construct('Widget_Shop_info', 'Shop Info', ['description' => 'Screenshot des Shops mit Link zum Gutschein']);
    }

    public function widget($args, $instance): void
    {
        $post = get_post();
        if (!$post) {
            return;
        }
        $shop   = sg_current_shop_title();
        $offers = sg_get_shop_offers($post->ID, 'voucher', 1);

        echo '<div class="shop-meta style-a1" id="makescreenshot">';
        if ($offers) {
            printf('<a href="%s" title="%s" target="_blank" rel="sponsored noopener">', esc_url(sg_go_url((int) $offers[0]->PromotionID)), esc_attr('Direkt zu ' . $shop));
        }
        echo sg_shop_screenshot($post->post_name, $shop);
        echo $offers ? '</a>' : '';
        echo '</div>';
    }
}

/** Anschrift, Kundendienst und Versand aus den ACF-Feldern des Shops. */
class SG_Widget_More_Shop_Infos extends SG_Widget
{
    public function __construct()
    {
        parent::__construct('Widget_more_Shop_infos', 'more Shop Infos', ['description' => 'Anschrift, Kundendienst und Versand des Shops']);
    }

    public function widget($args, $instance): void
    {
        if (!function_exists('get_field') || !($address = get_field('adresse'))) {
            return;
        }
        $service  = get_field('kundendienst');
        $shipping = get_field('versand');

        echo '<div class="shop-meta style-a1"><p>Infos zum Shop</p><ol>';
        echo '<li class="adresse">Anschrift:<address>' . wp_kses_post($address) . '</address></li>';
        if ($service) {
            echo '<li class="service">' . wp_kses_post($service) . '</li>';
        }
        if ($shipping) {
            echo '<li class="versand">' . wp_kses_post($shipping) . '</li>';
        }
        echo '</ol><p>Alle Angaben ohne Gewähr!</p></div>';
    }
}

/** Kurzanleitung zum Einlösen auf Shop-Seiten. */
class SG_Widget_Guide extends SG_Widget
{
    public function __construct()
    {
        parent::__construct('Widget_Guide', 'Anleitung im Shop', ['description' => 'Anleitung zum Einlösen im Shop']);
    }

    public function widget($args, $instance): void
    {
        echo '<div class="text style-a1">';
        echo $args['before_title'] . esc_html(sg_current_shop_title() . ' Gutschein einlösen') . $args['after_title'];
        echo '<ol><li>Trage den vorhandenen Gutscheincode im Bestellprozess in das entsprechende Feld.</li>'
            . '<li>Bestätige deine Eingabe.</li>'
            . '<li>Der Rabatt wird vom Gesamtbetrag abgezogen oder auf der Rechnung ausgewiesen.</li></ol>';
        echo '</div>';
    }
}

class SG_Widget_Newest_Vouchers extends SG_Widget
{
    public function __construct()
    {
        parent::__construct('Widget_Neuste_Gutscheine', 'Neuste Gutscheine', ['description' => 'Neuste Gutscheine in der Sidebar', 'classname' => 'g']);
    }

    public function widget($args, $instance): void
    {
        echo '<div class="new style-a1">';
        echo $args['before_title'] . esc_html($this->title($instance, 'Neuste Gutscheine')) . $args['after_title'];
        echo '<ul class="g">';
        sg_render_offers(sg_get_vouchers('newest', 5), 'sidebar');
        echo '</ul></div>';
    }
}

class SG_Widget_Popular_Vouchers extends SG_Widget
{
    public function __construct()
    {
        parent::__construct('Widget_Popular_Coupons', 'Beliebteste Gutscheine', ['description' => 'Beliebteste Gutscheine in der Sidebar', 'classname' => 'g']);
    }

    public function widget($args, $instance): void
    {
        echo '<div class="pop style-a1">';
        echo $args['before_title'] . esc_html($this->title($instance, 'Beliebteste Gutscheine')) . $args['after_title'];
        echo '<ul class="g">';
        sg_render_offers(sg_get_popular_vouchers(), 'sidebar');
        echo '</ul></div>';
    }
}

add_action('widgets_init', static function (): void {
    register_widget('SG_Widget_Shop_Info');
    register_widget('SG_Widget_More_Shop_Infos');
    register_widget('SG_Widget_Guide');
    register_widget('SG_Widget_Newest_Vouchers');
    register_widget('SG_Widget_Popular_Vouchers');
});

/**
 * Screenshot eines Shops: eigenes Bild aus images/shop_logos/screenshots, sonst der
 * Vorschaudienst von WordPress.com mit der hinterlegten Shop-Domain.
 */
function sg_shop_screenshot(string $slug, string $shop): string
{
    $file = '/images/shop_logos/screenshots/' . sanitize_file_name($slug) . '.jpg';
    if (is_file(SG_THEME_DIR . $file)) {
        $src = SG_THEME_URI . $file;
    } else {
        $domain = get_post_meta(get_the_ID(), 'gf_shopdomain', true) ?: $slug . '.de';
        $src    = 'https://s0.wordpress.com/mshots/v1/' . rawurlencode($domain) . '?w=300';
    }
    return sprintf(
        '<img loading="lazy" id="screenshot" itemprop="image" alt="%s" src="%s" title="%s" width="300" height="225">',
        esc_attr($shop . ' Webseite'),
        esc_url($src),
        esc_attr($shop . ' durchstöbern')
    );
}
