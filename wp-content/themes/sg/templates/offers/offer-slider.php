<?php $shopnameSlider = get_the_title( 3819 ); ?>
<div class="slider-coupon <?php echo $shopnameSlider; ?>" data-offer-id="<?php echo $offer->ID; ?>" data-publisher="aw">
<img alt="<?php echo $shopnameSlider; ?> Gutscheincode" src="https://sparfuchs-gutschein.de/wp-content/themes/sg/images/slider/slider-coupon-background/background-slider-zooplus.jpg" title="<?php echo $shopnameSlider; ?>" />
	<div class="slider-logo"><?php get_logo_by_coupon($shopnameSlider); ?></div>
    <p class="slider-headline"><?php echo $offer->Title;  ?></p>
    <span class="slider-list">
  		<?php
  			if ( ($offer->existing_customers == 'YES') && ($offer->new_customers == 'YES') ) { echo '<span class="bk">Neu- &amp; Bestandskunden</span>'; }
  			else if ( ($offer->existing_customers == 'NO') && ($offer->new_customers == 'YES') ) { echo '<span class="nk">Nur für Neukunden</span>';}
        else if ( ($offer->existing_customers == 'YES') && ($offer->new_customers == 'NO') ) { echo '<span class="nk">Nur für Bestandskunden</span>';}

  			if (!empty($offer->minimum_order_value)) { echo '<span class="mb">Mindestkaufbetrag:' . $offer->minimum_order_value . ',&#8211; €</span>';}
  			else if (isset($offer->minimum_order_value)) { echo '<span class="kmb">Kein Mindestkaufbetrag</span>';}
  		  countdown($offer->Ends); ?>
  	</span>
		<a href="<?php echo get_permalink( 3819 ) ?>" class="slider-button button-offer b"> Weiter Angebote von <?php echo $shopnameSlider; ?> ▸</a>
</div>
