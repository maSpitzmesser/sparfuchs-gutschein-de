<?php /* Template Name: Gutscheinliste mit Sidebar*/
get_header();
?>

<article class="col-first span_3_of_4 style-a1">
	<?php
		if ( is_page( 'top-gutscheincodes' ) ) {
			include dirname(__FILE__).'/templates/pages/page-top-offers.php';
		}
		elseif ( is_page( 'neue-gutscheine' ) ) {
			include dirname(__FILE__).'/templates/pages/page-new-offers.php';
		}
		elseif ( is_page( 'gratis-produkte' ) ) {
            include dirname(__FILE__).'/templates/pages/tlp-gratis-artikel.php';
		}
		elseif ( is_page( 'geschenkgutscheine' ) ) {
			include dirname(__FILE__).'/templates/pages/page-gift-offers.php';
		}
		elseif ( is_page( 'last-minute' ) ) {
			include dirname(__FILE__).'/templates/pages/page-last-minute-offers.php';
		}
		else {
			get_template_part('content');
		}
	?>
    <a href="/kategorien/">Zu den Kategorien...</a>
</article>

<aside class="col span_1_of_4" role="complementary">
	<?php if(!function_exists('dynamic_sidebar') || dynamic_sidebar('Page Sidebar') ) {} ?>
</aside>

<article class="col-first span_4_of_5 speek-right style-a1">
    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); the_content(); endwhile; ?>
</article>
<span class="col span_1_of_5">
    <img class="logo2" src="/wp-content/themes/sg/images/logo/Sparfuchs-Gutschein.webp" alt="Sparfuchs Gutschein Schnäppchen" title="Sparfuchs Gutschein"/>		  
</span>


<?php get_footer(); ?>
