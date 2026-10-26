<?php
/**
 * Template Name: Content Full-width, Ohne Sidebar
 */

defined('ABSPATH') || exit;

get_header();

while (have_posts()) :
    the_post();
    ?>
    <article class="col-first col span_3_of_3 style-a1 full-width-content">
      <h1 class="headline-a1"><?php the_title(); ?></h1>
      <?php the_content(); ?>
    </article>
<?php
endwhile;

get_footer();
