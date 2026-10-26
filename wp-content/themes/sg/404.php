<?php
/**
 * Seite nicht gefunden: Hinweis und die beliebtesten Gutscheine.
 */

defined('ABSPATH') || exit;

add_filter('wp_robots', 'wp_robots_no_robots');

get_header();
?>
<div class="start">
  <div class="hello">
    <h1>Fehler 404: Seite nicht gefunden.</h1>
    <p>Leider wurde hier nichts gefunden. Kennen Sie schon unsere Top Gutscheine?</p>
  </div>
</div>

<div id="content">
  <section class="content-box">
    <ul class="c"><?php sg_render_offers(sg_get_popular_vouchers(), 'awin'); ?></ul>
  </section>
</div>

<aside class="sidebar">
  <?php dynamic_sidebar('sidebar_page'); ?>
</aside>
<?php
get_footer();
