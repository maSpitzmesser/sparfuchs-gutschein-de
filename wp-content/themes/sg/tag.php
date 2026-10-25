<?php
/**
 * The template for displaying Tag pages
 *
 * Used to display archive-type pages for posts in a tag.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<section id="primary" class="site-content">
		<div id="content" role="main">

		<?php if ( have_posts() ) : ?>
			<header class="archive-header">
				<h1 class="archive-title"><?php printf( __( 'Tag Archives: %s', 'twentytwelve' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?></h1>

			<?php if ( tag_description() ) : // Show an optional tag description ?>
				<div class="archive-meta"><?php echo tag_description(); ?></div>
			<?php endif; ?>
			</header><!-- .archive-header -->

			
			<ul>
	  <?php  while ( have_posts() ) : the_post(); ?>
	  <li style="float:left;border:1px solid #ccc;border-radius: 5px 5px 5px 5px;margin:0 10px 10px 0;">
	  <a style="padding:5px;display:block" href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
     <?php 
global $wpdb; 
$domain = get_post_meta(get_the_ID(), 'gf_shopdomain',  true);
                    $sql = "SELECT shopname
                            FROM wp_gutschein_feed_shops
                            WHERE shopdomain = '$domain'
                           ";
                    $shopname = $wpdb->get_row($sql);
                    $shopname = $shopname->shopname;
get_logo($shoplogo_large, $shopname);
										?>"
          </a>
	  </li>
	  <?php endwhile; ?>      
	  </ul>


		<?php else : ?>
		
		<?php endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>