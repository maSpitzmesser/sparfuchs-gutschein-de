<li data-offer-id="<?php echo $offer->id; ?>" data-publisher="za">
	<?php 
		if (is_single()) : 
        get_logo_lazy_offer($shopname, $offer->title);
            else :
        get_logo_by_coupon($shopname);	
        endif; ?>
	<div class="mc">
		<p><?php new_offers_ribbon($offer->valid_from); echo $offer->title;  ?></p>
		<?php
			if ( ($offer->existing_customers == 'YES') && ($offer->new_customers == 'YES') ) { echo '<span class="bk">Neu- &amp; Bestandskunden</span>'; }
			else if ( ($offer->existing_customers == 'NO') && ($offer->new_customers == 'YES') ) { echo '<span class="nk">Nur für Neukunden</span>';}
            else if ( ($offer->existing_customers == 'YES') && ($offer->new_customers == 'NO') ) { echo '<span class="nk">Nur für Bestandskunden</span>';}
            else { }

			if (!empty($offer->minimum_order_value)): echo '<span class="mb">Mindestkaufbetrag:' . $offer->minimum_order_value . ',&#8211; €</span>'; 
			elseif (isset($offer->minimum_order_value)) : echo '<span class="kmb">Kein Mindestkaufbetrag</span>'; 
			endif; ?>
	</div>
	<div class="rc">
		<?php countdown($offer->valid_to); ?>
		<?php get_clicks_used($offer->id); ?>
		<button class="button-offer b">
			<?php 
			if ($offer->type == 'coupon'): echo 'Gutscheincode &amp; Shop öffnen';

			elseif ($offer->type == 'free product'): echo 'Gratisartikel &amp; Shop öffnen';
			else : echo 'Aktion &amp; Shop anzeigen';
			endif;
		?> ▸
		</button>
	</div>
</li>