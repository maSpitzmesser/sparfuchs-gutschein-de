<?php get_header(); 
$SearchValue = get_query_var('s');




if (empty($SearchValue)) {
	header("Location: http://sparfuchs-gutschein.de/shops/");
	die();
}





global $post;
$args = array( 'numberposts' => 5, 'offset'=> 1 );
$myposts = get_posts( $args );
foreach( $myposts as $post ) :	setup_postdata($post); 


if ($SearchValue == $post->post_name) {
	header("Location: http://sparfuchs-gutschein.de/".$post->post_name);
	die();
}





?>

<?php  endforeach;







?>
<meta name="robots" content="noindex,nofollow,noodp,noydir"/>

<div class="col-first span_3_of_4 style-a1">

<?php if (have_posts()) : ?>
    <h3 class="headline-a2">Dein Sucheregebniss für "<strong><?php printf(__('%s'), trim(get_search_query())); ?></strong>"</h3>
			 <?php endif; ?>
             
       <?php if (!have_posts()) : ?>
    <h3 class="headline-a2">Keine Treffer für "<strong><?php printf(__('%s'), trim(get_search_query())); ?></strong>"</h3>
			 <?php endif; ?>      
             
    <!-- wenn Treffer dann -->
	<?php if (have_posts()) : ?>	
        <ul>
            <?php while (have_posts()) : the_post(); ?>
            <li>
				  
				  <?php //echo esc_url( get_permalink( get_page_by_title( $SearchValue) ) ); ?>
				  
				  
            <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                <?php get_logo($shopname); ?>
             </a>
            </li>
            <?php endwhile; ?>	     
	    </ul>
	<?php endif; ?>
    
		
    <!-- wenn kein Treffer dann -->
	<?php if (!have_posts()) : ?>
	   <p>Leider ist dieser Shop nicht bei uns gelistet und es sind keine Sparvorteile bei uns verfügbar.</p>
	<?php endif; ?>
       
</div>
	
    <!-- wenn kein Treffer dann -->
    <?php if (!have_posts()) : ?>
    <section  class="col-first span_3_of_4 style-a1">
		  <h2 class="headline-a2 article-title">Kennen Sie schon unsere Top Gutscheine?</h2>
	   	<ul class="c"><?php top_vouchers_site(); ?></ul>	  
	</section>
    <?php endif; ?>


    <aside class="col span_1_of_4" id="sidebar">
        <?php if ( !function_exists('dynamic_sidebar') || dynamic_sidebar('Page Sidebar') ) {	} ?>
    </aside>

<?php get_footer(); ?>