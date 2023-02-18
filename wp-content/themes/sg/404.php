<?php get_header(); ?>
<meta name="robots" content="noindex,nofollow,noodp,noydir"/> 

<div class="start">
	<div class="hello">	  
		<h1>Fehler 404: Seite nicht gefunden.</h1>
	   <p>Leider wurde hier nichts gefunden. Kennen Sie schon unsere Top Gutscheine?</p>	   
	</div>
</div>

<div id="content">
   <section class="content-box">
	   	<ul class="c"><?php top_vouchers_site(); ?></ul>  
	</section>
</div>

<aside class="sidebar">
<?php if ( !function_exists('dynamic_sidebar') || dynamic_sidebar('Page Sidebar') ) {	} ?>
</aside>

<?php get_footer(); ?>