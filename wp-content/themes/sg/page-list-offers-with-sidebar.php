<?php
/**
 * Template Name: Gutscheinliste mit Sidebar
 *
 * Listen-Seiten: Top-Gutscheincodes, Neue Gutscheine, Last Minute. Darunter der Seiteninhalt.
 */

defined('ABSPATH') || exit;

get_header();

while (have_posts()) :
    the_post();
    $slug = get_post_field('post_name');
    ?>
    <article class="col-first span_3_of_4 style-a1">
      <?php if ($slug === 'top-gutscheincodes') : ?>
        <h1 class="headline-a1">Beliebteste Gutscheincodes</h1>
        <ul class="c"><?php sg_render_offers(sg_get_popular_vouchers(), 'awin'); ?></ul>
      <?php elseif ($slug === 'neue-gutscheine') : ?>
        <h1 class="headline-a1"><?php the_title(); ?></h1>
        <h2>Die neusten Gutscheine im <?php echo esc_html(wp_date('F Y')); ?></h2>
        <ul class="c"><?php sg_render_offers(sg_get_vouchers('newest', 40), 'nolink'); ?></ul>
      <?php elseif ($slug === 'last-minute') : ?>
        <h1 class="headline-a1">Last Minute Sparvorteile</h1>
        <ul class="c"><?php sg_render_offers(sg_get_vouchers('ending', 100), 'nolink'); ?></ul>
      <?php else : ?>
        <h1 class="headline-a1"><?php the_title(); ?></h1>
      <?php endif; ?>
      <a href="<?php echo esc_url(home_url('/kategorien/')); ?>">Zu den Kategorien...</a>
    </article>

    <aside class="col span_1_of_4" role="complementary">
      <?php dynamic_sidebar('sidebar_page'); ?>
    </aside>

    <?php if (trim(get_the_content()) !== '') : ?>
      <article class="col-first span_4_of_5 speek-right style-a1">
        <?php the_content(); ?>
      </article>
      <span class="col span_1_of_5">
        <img class="logo2" src="<?php echo esc_url(SG_THEME_URI . '/images/logo/Sparfuchs-Gutschein.webp'); ?>" alt="Sparfuchs Gutschein Schnäppchen" title="Sparfuchs Gutschein" loading="lazy">
      </span>
    <?php endif; ?>
<?php
endwhile;

get_footer();
