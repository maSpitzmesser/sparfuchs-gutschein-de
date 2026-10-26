<?php
/**
 * Template Name: Kategorien auswahl Template
 *
 * Übersicht aller Kategorien mit Bild und Gutscheinen aus drei Hauptkategorien.
 */

defined('ABSPATH') || exit;

/* Hervorgehobene Kategorien: ID => [Anker, Titel, Link] */
$featured = [
    210 => ['mode', 'Mode &amp; Accessoires', '/mode-accessoires/'],
    203 => ['elek', 'Elektronik &amp; Zubehör', '/elektronik-zubehoer/'],
    209 => ['kind', 'Kinder &amp; Spielzeug', '/kinder-spielzeug/'],
];

get_header();
?>
  <div class="col-first span_3_of_4">
    <article class="col-first span_4_of_4 style-a1">
      <h1 class="headline-a1">Alle <?php the_title(); ?></h1>
      <h2>Online-Shops und Gutscheine nach Kategorien</h2>
      <ul class="cat_img">
        <?php foreach (get_categories(['orderby' => 'name', 'order' => 'ASC']) as $category) : $image = 'images/kategorien/' . absint($category->term_id) . '.jpg'; ?>
          <li><a href="<?php echo esc_url(get_category_link($category)); ?>" title="<?php echo esc_attr('Alle Shops der Kategorie ' . $category->name); ?>">
            <?php if (is_file(ABSPATH . $image)) : ?><img src="<?php echo esc_url(home_url('/' . $image)); ?>" alt="<?php echo esc_attr($category->name); ?>" loading="lazy"><?php endif; ?>
            <?php echo esc_html($category->name); ?></a></li>
        <?php endforeach; ?>
      </ul>
    </article>

    <?php $first = true; foreach ($featured as $category_id => [$anchor, $title, $link]) : ?>
      <div class="<?php echo $first ? 'col-first' : 'col'; ?> span_1_of_3 sb<?php echo $first ? '' : ' pin'; ?> style-a1">
        <h3 id="<?php echo esc_attr($anchor); ?>"><?php echo $title; // feste Texte mit Entities ?></h3>
        <ul class="g"><?php sg_render_offers(sg_get_category_offers($category_id, 5), 'sidebar'); ?></ul>
        <a href="<?php echo esc_url(home_url($link)); ?>">Zu <?php echo $title; ?> Gutscheinen »</a>
      </div>
    <?php $first = false; endforeach; ?>
  </div>

  <aside class="col span_1_of_4" role="complementary">
    <?php dynamic_sidebar('sidebar_page'); ?>
  </aside>

  <?php while (have_posts()) : the_post(); ?>
    <article class="col-first span_3_of_4 speek-right style-a1">
      <?php the_content(); ?>
    </article>
  <?php endwhile; ?>

  <span class="col span_1_of_5">
    <img class="logo2" src="<?php echo esc_url(SG_THEME_URI . '/images/logo/Sparfuchs-Gutschein.webp'); ?>" alt="Sparfuchs Gutschein Schnäppchen" title="Sparfuchs Gutschein" loading="lazy">
  </span>
<?php
get_footer();
