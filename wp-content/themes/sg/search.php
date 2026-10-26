<?php
/**
 * Suchergebnisse (nur Shops). Leere Suche und exakte Treffer leitet inc/search.php vorher weiter.
 */

defined('ABSPATH') || exit;

add_filter('wp_robots', 'wp_robots_no_robots');

get_header();
$term = trim(get_search_query());
?>
<div class="col-first span_3_of_4 style-a1">
  <?php if (have_posts()) : ?>
    <h3 class="headline-a2">Dein Sucheregebniss für "<strong><?php echo esc_html($term); ?></strong>"</h3>
    <ul>
      <?php while (have_posts()) : the_post(); ?>
        <li>
          <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
            <?php echo sg_shop_logo(get_the_title(), sg_shop_slug(get_the_title()) . ' Gutscheincode', ['title' => sg_shop_slug(get_the_title()), 'itemprop' => 'image', 'loading' => null]); ?>
          </a>
        </li>
      <?php endwhile; ?>
    </ul>
  <?php else : ?>
    <h3 class="headline-a2">Keine Treffer für "<strong><?php echo esc_html($term); ?></strong>"</h3>
    <p>Leider ist dieser Shop nicht bei uns gelistet und es sind keine Sparvorteile bei uns verfügbar.</p>
  <?php endif; ?>
</div>

<?php if (!have_posts()) : ?>
  <section class="col-first span_3_of_4 style-a1">
    <h2 class="headline-a2 article-title">Kennen Sie schon unsere Top Gutscheine?</h2>
    <ul class="c"><?php sg_render_offers(sg_get_popular_vouchers(), 'awin'); ?></ul>
  </section>
<?php endif; ?>

<aside class="col span_1_of_4" id="sidebar">
  <?php dynamic_sidebar('sidebar_page'); ?>
</aside>
<?php
get_footer();
