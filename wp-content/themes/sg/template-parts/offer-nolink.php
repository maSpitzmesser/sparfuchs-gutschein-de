<?php
/**
 * Angebot in den Listenseiten "Neue Gutscheine" und "Last Minute".
 *
 * @var array $args ['offer' => object mit shop_id]
 */

defined('ABSPATH') || exit;

$offer = $args['offer'];
?>
<li data-offer-id="<?php echo (int) $offer->PromotionID; ?>" data-publisher="aw">
  <a href="<?php echo esc_url(get_permalink((int) $offer->shop_id)); ?>">
    <?php echo sg_shop_logo($offer->Shopname, '', ['loading' => null]); ?>
  </a>
  <div class="mc">
    <p><?php echo sg_format_offer_title($offer->Title); ?></p>
    <?php if ($offer->Description) : ?>
      <?php echo sg_offer_text($offer->Description); ?>
    <?php endif; ?>
    <?php if ($offer->Terms) : ?>
      <br>Bedingungen:<br> <?php echo sg_offer_text($offer->Terms); ?>
    <?php endif; ?>
  </div>
  <div class="rc">
    <?php sg_countdown($offer->Ends); ?>
    <?php sg_offer_usage((int) $offer->PromotionID); ?>
    <span class="button-offer b"><?php echo esc_html(sg_offer_button_label($offer->Type)); ?> ▸</span>
  </div>
</li>
