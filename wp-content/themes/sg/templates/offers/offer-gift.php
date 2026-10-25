<a data-id="<?php echo $offer->id; ?>" href="/go/<?php if ($is_active) { echo 'gp'; } else {echo 'sg'; };  ?>?id=<?php echo $offer->id; ?>" target="_blank" title="<?php echo $parent_title ?> Geschenkgutschein">
  <?php get_logo($shopname);
	$ist = array(" ", $parent_title, "Geschenkgutschein", "Geschenkkarte", "ab", "Euro", "€", "&euro;");
	$soll = array("", "", "", "", "",  "", "", "");
	?>
	<span class="worth">ab <span class="big"><?php echo str_replace($ist, $soll ,$offer->title); ?></span><span class="comma-zero">,&#8211;</span> &euro;</span>
	<span class="button-offer b">Zum Geschenkgutschein ▸</span>
</a>