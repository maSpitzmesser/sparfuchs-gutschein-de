<?php
/**
 * Kurzer Listeneintrag (Startseite: Neue Gutscheincodes, Bald endend). Ganze Zeile ist klickbar (site.js).
 *
 * @var array $args ['offer' => object mit shop_id und shop_title]
 */

defined('ABSPATH') || exit;

$offer = $args['offer'];
$link  = get_permalink((int) $offer->shop_id);
?>
<li>
  <a href="<?php echo esc_url($link); ?>" title="<?php echo esc_attr('Alle ' . $offer->shop_title . ' Rabatte'); ?>">
    <?php echo sg_shop_logo($offer->Shopname, '', ['loading' => null]); ?>
  </a>
  <div class="mc">
    <b><?php echo sg_format_shop_name($offer->shop_title); ?></b>
    <p><?php echo sg_format_offer_title($offer->Title); ?></p>
    <?php sg_countdown($offer->Ends); ?>
  </div>
</li>
