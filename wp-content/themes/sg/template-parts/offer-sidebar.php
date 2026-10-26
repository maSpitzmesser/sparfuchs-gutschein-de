<?php
/**
 * Angebot in der Seitenleiste (Beliebteste / Neuste Gutscheine). Ganze Zeile ist klickbar (site.js).
 *
 * @var array $args ['offer' => object]
 */

defined('ABSPATH') || exit;

$offer   = $args['offer'];
$shop_id = isset($offer->shop_id) ? (int) $offer->shop_id : sg_offer_shop_id($offer);
$link    = $shop_id ? get_permalink($shop_id) : home_url('/' . $offer->Shopname . '/');
?>
<li>
  <a title="<?php echo esc_attr('Alle ' . $offer->Shopname . ' Rabatte'); ?>" href="<?php echo esc_url($link); ?>">
    <?php echo sg_shop_logo($offer->Shopname, '', ['loading' => null]); ?>
    <?php echo esc_html(trim($offer->Shopname)); ?>
  </a>
  <span><?php echo sg_format_offer_title($offer->Title); ?></span>
</li>
