<?php /* Template Name: Kategorien auswahl Template */
get_header();
$args=array('orderby' => 'name','order' => 'ASC');
$categories=get_categories($args);
?>
  <div class="col-first span_3_of_4">
    <article class="col-first span_4_of_4 style-a1">
      <h1 class="headline-a1">Alle <?php the_title(); ?></h1>
      <h2>Online-Shops und Gutscheine nach Kategorien</h2>
      <ul class="cat_img">
        <?php foreach($categories as $category) {
          echo '<li><a href="' . get_category_link( $category->term_id ) . '" title="Alle Shops der Kategorie ' . $category->name . '">
                                        <img src="http://sg.sparfuchs-gutschein.de/images/kategorien/' . $category->cat_ID . '.jpg" alt="' . $category->cat_name . '" />' . $category->name.'</a></li>';
        } ?>
      </ul>
    </article>


    <div class="col-first span_1_of_3 sb style-a1">
      <h3 id="mode">Mode &amp; Accessoires</h3>
      <?php cat_vouchers_widget('210'); ?>
      <a href="/mode-accessoires/">Zu Mode &amp; Accessoires Gutscheinen »</a>
    </div>
    <div class="col span_1_of_3 sb pin style-a1">
      <h3 id="elek">Elektronik &amp; Zubehör</h3>
      <?php cat_vouchers_widget('203'); ?>
      <a href="/elektronik-zubehoer/">Zu Elektronik &amp; Zubehör Gutscheinen »</a>
    </div>
    <div class="col span_1_of_3 sb pin style-a1">
      <h3 id="kind">Kinder &amp; Spielzeug</h3>
      <?php cat_vouchers_widget('209'); ?>
      <a href="/kinder-spielzeug/">Zu Kinder &amp; Spielzeug Gutscheinen »</a>
    </div>
  </div>

  <aside class="col span_1_of_4" role="complementary">
    <?php if(!function_exists('dynamic_sidebar') || dynamic_sidebar('Page Sidebar') ) {} ?>
  </aside>

<?php //include_once 'inc/adsense.php'; ?>

  <article class="col-first span_3_of_4 speek-right style-a1">
    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); the_content(); endwhile; ?>
  </article>

  <span class="col span_1_of_5">
    <img class="logo2" src="https://sparfuchs-gutschein.de/wp-content/themes/sg/images/logo/Sparfuchs-Gutschein.webp" alt="Sparfuchs Gutschein Schnäppchen" title="Sparfuchs Gutschein"/>
</span>


<?php get_footer(); ?>
