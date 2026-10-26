<?php
/**
 * Schlagwort: alle Shops zu einem Thema als Logos.
 */

defined('ABSPATH') || exit;

get_header();
?>
<section id="primary" class="site-content">
  <div id="content">
    <?php if (have_posts()) : ?>
      <header class="archive-header">
        <h1 class="archive-title">Schlagwort-Archiv: <span><?php single_tag_title(); ?></span></h1>
        <?php if (tag_description()) : ?>
          <div class="archive-meta"><?php echo wp_kses_post(tag_description()); ?></div>
        <?php endif; ?>
      </header>
      <ul class="tag-shops">
        <?php while (have_posts()) : the_post(); ?>
          <li>
            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
              <?php echo sg_shop_logo(get_the_title(), sg_shop_slug(get_the_title()) . ' Gutscheincode', ['title' => sg_shop_slug(get_the_title()), 'itemprop' => 'image']); ?>
            </a>
          </li>
        <?php endwhile; ?>
      </ul>
    <?php endif; ?>
  </div>
</section>
<?php
get_sidebar();
get_footer();
