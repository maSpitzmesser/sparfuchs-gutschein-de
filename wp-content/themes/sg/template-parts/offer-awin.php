<?php
/**
 * Ein Angebot als Abreiß-Karte in einer Liste ul.c (Shop-Seite, Kategorie, Top-Gutscheine).
 * Ein Klick auf die Karte öffnet die Weiterleitung zum Shop (site.js).
 *
 * @var array $args ['offer' => object, 'shop_id' => int (optional)]
 */

defined('ABSPATH') || exit;

$offer     = $args['offer'];
$shop_id   = (int) ($args['shop_id'] ?? 0) ?: sg_offer_shop_id($offer);
$shop_name = $shop_id ? get_the_title($shop_id) : $offer->Advertiser;
$start     = sg_timestamp($offer->Starts);
?>
<li data-offer-id="<?php echo (int) $offer->PromotionID; ?>" data-publisher="aw" itemscope itemtype="https://schema.org/SaleEvent">
  <span class="hidden" itemprop="location" itemscope itemtype="https://schema.org/Place">
    <meta itemprop="name" content="<?php echo esc_attr($shop_name); ?>">
    <meta itemprop="address" content="<?php echo esc_attr($shop_name); ?>">
  </span>
  <meta itemprop="offers" content="<?php echo esc_attr($offer->Type === 'voucher' ? 'Gutscheincode' : ($offer->Type === 'free product' ? 'Gratisartikel' : 'Rabatt')); ?>">
  <?php
  echo is_single()
      ? sg_shop_logo($shop_name, $offer->Shopname, ['class' => 'i', 'title' => sg_shop_slug($shop_name), 'itemprop' => 'image'])
      : sg_shop_logo($offer->Shopname, $offer->Shopname . ' Gutscheincode', ['loading' => null]);
  ?>
  <div class="mc">
    <p itemprop="name"><?php sg_new_offer_ribbon($offer->Starts); echo sg_format_offer_title($offer->Title); ?></p>
    <?php if ($offer->Description) : ?>
      <?php echo sg_offer_text($offer->Description); ?>
    <?php endif; ?>
    <?php if ($offer->Terms) : ?>
      <br>Bedingungen:<br> <?php echo sg_offer_text($offer->Terms); ?>
    <?php endif; ?>
  </div>
  <div class="rc">
    <?php if ($start) : ?>
      <meta itemprop="startDate" content="<?php echo esc_attr(wp_date('Y-m-d', $start)); ?>">
    <?php endif; ?>
    <?php sg_countdown($offer->Ends); ?>
    <?php sg_offer_usage((int) $offer->PromotionID); ?>
    <button type="button" class="button-offer b"><?php echo esc_html(sg_offer_button_label($offer->Type)); ?> ▸<span class="folded-corner"></span></button>
    <?php if (is_single() && $shop_id) : ?>
      <meta itemprop="url" content="<?php echo esc_url(get_permalink($shop_id) . '#aw!' . (int) $offer->PromotionID); ?>">
    <?php endif; ?>
  </div>
</li>
