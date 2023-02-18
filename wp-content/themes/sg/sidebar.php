<aside class="col span_1_of_4 sidebar" role="complementary">
<?php
if ( is_single () ) {
	if ( !function_exists('dynamic_sidebar') || dynamic_sidebar('Shop Sidebar') ) {}
}

if ( is_page () ) {
	if ( !function_exists('dynamic_sidebar') || dynamic_sidebar('Page Sidebar') ) {}
}

if ( is_category () ) {
	if ( !function_exists('dynamic_sidebar') || dynamic_sidebar('Page Sidebar') ) {}
}
?>
</aside>
<?php
if ( is_single () ) {	 ?>
    <section class="logos style-a1">
		<h3 class="headline-a2">Ähnliche Shops mit Gutscheinen und Rabattcodes:</h3>
		<?php $categories = get_the_category(); 
        $args = array( 'category' => $categories[0]->cat_ID, 'posts_per_page' => 6, 'order'=>'ASC', 'post__not_in' => array( $post->ID ), 'orderby' => 'rand' ); 
        $myposts = get_posts( $args ); 
        foreach( $myposts as $post ) : setup_postdata($post); ?>
        <a href="<?php the_permalink();?>" title="<?php echo get_the_title( $post_id ); ?> Rabatte"><?php get_logo_lazy($shopname); ?></a>
        <?php endforeach; wp_reset_query(); ?>
	</section>
<?php } ?>