<li>
	<a href="<?php echo get_permalink( $offer->ID ); ?>" title="Alle <?php echo $offer->post_title; ?> Rabatte">
	<?php 	
	if (is_single()) : 
						get_logo_lazy($shopname);
							else :
						get_logo_by_coupon($offer->Shopname);
						endif; ?>
	</a>
	<div class="mc">
		<b><?php echo $offer->post_title; ?></b>
		<p><?php echo $offer->Title; ?></p>
		<?php countdown($offer->Ends);
								//if (!empty($offer->minimum_order_value)): 
								//elseif (isset($offer->minimum_order_value)) : echo '<span class="kmb">Kein '; 
								//if ($postid == '4122') : echo 'Mindestkaufbetrag</span>';
								//else : echo 'Mindestbestellwert</span>'; endif; endif; 
		?>
	</div>
</li>