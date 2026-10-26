<?php
/**
 * Kategorie: Top-Shops, neueste Gutscheine der Kategorie und alle Shops (als Liste oder Logos).
 */

defined('ABSPATH') || exit;

$category = get_queried_object();
$name     = $category->name;
$image    = 'images/kategorien/' . absint($category->term_id) . '.jpg';
$top      = get_posts(['category' => $category->term_id, 'posts_per_page' => 6, 'offset' => 1, 'orderby' => 'date', 'order' => 'ASC']);
$all      = get_posts(['category' => $category->term_id, 'posts_per_page' => -1, 'offset' => 1, 'orderby' => 'title', 'order' => 'ASC']);

get_header();
?>
  <article class="col-first span_3_of_4 category-page">
    <div class="category-header style-a1">
      <h1 class="headline-a1"><?php echo esc_html($name); ?> Gutscheine</h1>
      <?php if (is_file(ABSPATH . $image)) : ?>
        <figure><img src="<?php echo esc_url(home_url('/' . $image)); ?>" alt="<?php echo esc_attr($name); ?>"></figure>
      <?php endif; ?>
      <p>Hier findest du alle Online-Shops, Gutscheine &amp; Gutscheincodes zu <?php echo esc_html($name); ?> nach alphabet und folgender Aufteilung:</p>
      <p class="category-jump">
        <a class="pfeil" href="#top-shops">Beliebteste Online-Shops <?php echo esc_html($name); ?></a><br>
        <a class="pfeil" href="#topcodes">Neue <?php echo esc_html($name); ?> Gutscheincodes </a><br>
        <a class="pfeil" href="#alleshops">Liste aller Online-Shops zu <?php echo esc_html($name); ?></a><br>
      </p>
    </div>

    <div class="logos style-a1">
      <h3 class="headline-a2" id="top-shops">Top Shops der Kategorie <?php echo esc_html($name); ?></h3>
      <?php foreach ($top as $shop) : $title = get_the_title($shop); ?>
        <a href="<?php echo esc_url(get_permalink($shop)); ?>"><?php echo sg_shop_logo($title, sg_shop_slug($title) . ' Gutscheincode', ['title' => sg_shop_slug($title), 'itemprop' => 'image', 'loading' => null]); ?></a>
      <?php endforeach; ?>
    </div>

    <div class="style-a1">
      <h2 class="headline-a2" id="topcodes">Die Neusten Gutscheine zu <?php echo esc_html($name); ?></h2>
      <ul class="c"><?php sg_render_offers(sg_get_category_offers($category->term_id), 'awin'); ?></ul>
    </div>
  </article>

  <aside class="col span_1_of_4 sidebar" role="complementary">
    <?php dynamic_sidebar('sidebar_page'); ?>
  </aside>

  <section class="col-first span_4_of_4 shop-list style-a1">
    <h3 class="headline-a2" id="alleshops">Alle Shops der Kategorie <?php echo esc_html($name); ?></h3>

    <div class="select-box">
      <label class="hidden" for="shop-view">Ansicht</label>
      <select class="dropdown" id="shop-view" data-view-switch=".select-content">
        <option value="0" selected>Liste</option>
        <option value="1">Logos</option>
      </select>
    </div>

    <div class="select-container">
      <div class="select-content">
        <?php foreach ($all as $shop) : ?>
          <a href="<?php echo esc_url(get_permalink($shop)); ?>"><?php echo esc_html(get_the_title($shop)); ?></a>
        <?php endforeach; ?>
      </div>
      <div class="select-content hidden">
        <span class="logos">
          <?php foreach ($all as $shop) : $title = get_the_title($shop); ?>
            <a href="<?php echo esc_url(get_permalink($shop)); ?>"><?php echo sg_shop_logo($title, sg_shop_slug($title) . ' Gutscheine', ['class' => 'i', 'title' => sg_shop_slug($title), 'itemprop' => 'image']); ?></a>
          <?php endforeach; ?>
        </span>
      </div>
    </div>
  </section>
<?php
get_footer();
