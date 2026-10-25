<li data-offer-id="<?php echo $offer->PromotionID; ?>" data-publisher="aw" itemscope="" itemtype="http://schema.org/SaleEvent">
  <span class="hidden" itemprop="location" itemscope itemtype="http://schema.org/Place">
    <meta itemprop="name" content="<?php echo get_the_title( $id ); ?> " />
    <meta itemprop="url" content="www.<?php echo urlencode(get_the_title( $id )); ?>.de" />
    <meta itemprop="address" content="<?php echo get_the_title( $id ); ?> " />
  </span>
  <?php
    if ($offer->Type == 'voucher'): echo '<meta itemprop="offers" content="Gutscheincode" />';
    elseif ($offer->Type == 'free product'): echo '<meta itemprop="offers" content="Gratisartikel" />';
    else : echo '<meta itemprop="offers" content="Rabatt" />';
    endif;
    
    if (is_single()) :
      get_logo_lazy_offer($shopname, $offer->Shopname);
    else :
      get_logo_by_coupon($offer->Shopname);
    endif; ?>
  <div class="mc">
    <p itemprop="name"><?php new_offers_ribbon($offer->Starts); echo $offer->Title;  ?></p>
    <?php if (is_single()) {
    }  if ( $offer->Description) { echo $offer->Description; }
      if ( $offer->Terms) { echo '<br/>Bedingungen:<br/> ' . $offer->Terms; } ?>
  </div>
  <div class="rc"><meta itemprop="startDate" content="<?php echo htmlentities( strftime('%Y-%m-%d', strtotime( date('d.F.Y', strtotime($offer->Starts))))); ?> " />
    <?php countdown($offer->Ends); ?>
    <?php get_clicks_used($offer->PromotionID); ?>
    <button class="button-offer b"><?php
        if ($offer->Type == 'voucher'): echo 'Gutscheincode &amp; Shop öffnen';
        elseif ($offer->Type == 'free product'): echo 'Gratisartikel &amp; Shop öffnen';
        else : echo 'Aktion &amp; Shop anzeigen';
        endif;
      ?> ▸<span class="folded-corner"></span></button>
    <?php if (is_single()) { ?><meta itemprop="url" content="<?php echo get_permalink( $offer->shopid ) ?>#aw!<?php echo $offer->PromotionID; ?>" /><?php } ?>
  </div>
</li>