<?php /* Template Name: Exclusive Gutscheincodes */ 
get_header(); ?>
<article>
	<h1 class="headline-a1"><?php the_title(); ?></h1>
	<h2>Die besten Sparvorteile</h2>
	<ul class="c"><?php exklusiv_vouchers_site(); ?></ul>
	<a href="/Kategorien/">In den Kategorien stöbern</a>	
 </article>
<aside class="sidebar" role="complementary">
	<?php if(!function_exists('dynamic_sidebar') || dynamic_sidebar('Page Sidebar') ) {} ?>
</aside>
<article class="sk mo"><?php if ( have_posts() ) while ( have_posts() ) : the_post(); the_content(); endwhile; ?></article>
<img class="logo2" src="http://sg.sparfuchs-gutschein.de/images/logo/Sparfuchs-Gutschein.png" alt="Sparfuchs Gutschein Schn&auml;ppchen" title="Sparfuchs Gutschein"/>
<?php get_footer(); ?>