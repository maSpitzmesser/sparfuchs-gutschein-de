<?php
/**
 * Slide der Startseite mit einem Zooplus-Gutschein (Motiv und Logo sind fest auf Zooplus ausgelegt).
 *
 * @var array $args ['offer' => object]
 */

defined('ABSPATH') || exit;

$offer   = $args['offer'];
$shop_id = sg_offer_shop_id($offer);
$shop    = $shop_id ? get_the_title($shop_id) : $offer->Advertiser;
?>
<div class="slider-coupon <?php echo esc_attr(sg_shop_slug($shop)); ?>" data-offer-id="<?php echo (int) $offer->PromotionID; ?>" data-publisher="aw">
  <img alt="<?php echo esc_attr($shop . ' Gutscheincode'); ?>" src="<?php echo esc_url(SG_THEME_URI . '/images/slider/slider-coupon-background/background-slider-zooplus.jpg'); ?>" title="<?php echo esc_attr($shop); ?>">
  <div class="slider-logo"><?php echo sg_shop_logo($shop, '', ['loading' => null]); ?></div>
  <p class="slider-headline"><?php echo sg_format_offer_title($offer->Title); ?></p>
  <span class="slider-list"><?php sg_countdown($offer->Ends); ?></span>
  <a href="<?php echo esc_url($shop_id ? get_permalink($shop_id) : home_url('/')); ?>" class="slider-button button-offer b"> Weiter Angebote von <?php echo esc_html($shop); ?> ▸</a>
</div>
