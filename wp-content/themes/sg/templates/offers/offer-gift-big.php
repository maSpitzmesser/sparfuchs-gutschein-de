<li data-offer-id="<?php echo $offer->id; ?>" data-publisher="sg">
		<?php get_logo_by_coupon($shopname); ?>
	<div class="mc">
		<p><?php 
			$ist  = array(' Geschenkgutschein' );
			$soll = array(' <br/>Geschenkgutschein',);
			echo str_replace($ist, $soll, $offer->title); ?></p>
		<?php
			if (!empty($offer->minimum_order_value)): echo '<span class="mb">Mindestkaufbetrag: ' . $offer->minimum_order_value . ' €</span>'; 
			elseif (isset($offer->minimum_order_value)) : echo '<span class="kmb">Kein Mindestkaufbetrag</span>'; 
			endif; ?>
	</div>
	<div class="rc">
	<?php countdown($offer->valid_to); ?>
    <?php get_clicks_used($offer->id); ?>
		<button class="button-offer b">Zum Geschenkgutschein ▸</button>
	</div>
</li>