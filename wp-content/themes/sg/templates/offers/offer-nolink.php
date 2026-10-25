<li data-offer-id="<?php echo $offer->PromotionID; ?>" data-publisher="aw" data-template="nolink">
    <a href="<?php echo get_permalink( $offer->ID ) ; ?>" target="_self">
      <?php
        if (is_single()) :
          get_logo_lazy($offer->Shopname);
        else :
          get_logo_by_coupon($offer->Shopname);
        endif; ?>
    </a>

    <div class="mc">
        <p><?php echo $offer->Title; ?></p>
      <?php if ( $offer->Description) { echo $offer->Description; } ?>
      <?php if ( $offer->Terms) { echo '<br/>Bedingungen:<br/> ' . $offer->Terms; } ?>
    </div>
    <div class="rc">
      <?php countdown($offer->Ends);
        get_clicks_used($offer->ID); ?>
        <span class="button-offer b">
			<?php
              if ($offer->Type == 'voucher'): echo 'Gutscheincode &amp; Shop öffnen';
              elseif ($offer->Type == 'gift'): echo 'zum Geschenkgutschein';
              elseif ($offer->Type == 'free product'): echo 'Gratisartikel &amp; Shop öffnen';
              else : echo 'Aktion &amp; Shop anzeigen';
              endif;
            ?> ▸
		</span>
    </div>
</li>