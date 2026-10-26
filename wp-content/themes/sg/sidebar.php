<?php
/**
 * Seitenleiste; auf Shop-Seiten zusätzlich ähnliche Shops aus derselben Kategorie.
 */

defined('ABSPATH') || exit;

// Shops: Shop-Leiste; Seiten und Kategorien: Seiten-Leiste; sonst (z. B. Schlagwörter) leer wie bisher
$sidebar = is_single() ? 'sidebar_shop' : (is_page() || is_category() ? 'sidebar_page' : '');
?>
<aside class="col span_1_of_4 sidebar" role="complementary">
  <?php if ($sidebar) { dynamic_sidebar($sidebar); } ?>
</aside>
<?php
if (!is_single()) {
    return;
}

$category = get_the_category()[0] ?? null;
$similar  = $category ? get_posts([
    'category'       => $category->term_id,
    'posts_per_page' => 6,
    'post__not_in'   => [get_the_ID()],
    'orderby'        => 'rand',
]) : [];

if ($similar) : ?>
  <section class="logos style-a1">
    <h3 class="headline-a2">Ähnliche Shops mit Gutscheinen und Rabattcodes:</h3>
    <?php foreach ($similar as $shop) : $title = get_the_title($shop); ?>
      <a href="<?php echo esc_url(get_permalink($shop)); ?>" title="<?php echo esc_attr($title . ' Rabatte'); ?>"><?php echo sg_shop_logo($title, sg_shop_slug($title) . ' Gutscheine', ['class' => 'i', 'title' => sg_shop_slug($title), 'itemprop' => 'image']); ?></a>
    <?php endforeach; ?>
  </section>
<?php endif;
