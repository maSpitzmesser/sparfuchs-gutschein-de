<?php
/**
 * Template Name: Alle Shops Template
 *
 * Alle Shops von A bis Z. Dient auch als Ansicht für sonstige Archive (Datum, Autor).
 */

defined('ABSPATH') || exit;

$shops = get_posts([
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'orderby'        => 'title',
    'order'          => 'ASC',
]);

/* Shops nach Anfangszeichen gruppieren (A–Z, 0–9) */
$groups = [];
foreach ($shops as $shop) {
    $title = get_the_title($shop);
    $first = mb_strtoupper(mb_substr(html_entity_decode($title, ENT_QUOTES, 'UTF-8'), 0, 1));
    $first = strtr($first, ['Ä' => 'A', 'Ö' => 'O', 'Ü' => 'U']);
    $groups[$first][] = $shop;
}
$letters = array_merge(range('A', 'Z'), array_map('strval', range(0, 9)));

get_header();
?>
<section class="navigation-abc style-a1">
  <h1 class="headline-a1"><?php echo (int) count(array_unique(wp_list_pluck($shops, 'post_title'))); ?> Online Shops mit Gutscheinen, Rabatten und Schnäppchen von A-Z</h1>
  <nav class="ABC" aria-label="Shops nach Anfangsbuchstabe">
    <?php foreach (range('A', 'Z') as $letter) : ?>
      <a href="#<?php echo esc_attr($letter); ?>" title="<?php echo esc_attr('Alle Online-Shops die mit ' . $letter . ' beginnen'); ?>"<?php echo empty($groups[$letter]) ? ' aria-disabled="true"' : ''; ?>><?php echo esc_html($letter); ?></a>
    <?php endforeach; ?>
    <a href="#1" title="Alle Online-Shops beginnend von 0-4">0-4</a>
    <a href="#5" title="Alle Online-Shops beginnend von  0-9">5-9</a>
  </nav>
  <a href="#logo" class="oben" title="hier klicken um wieder nach oben zu kommen"><span>NACH</span><span>OBEN</span></a>
</section>

<?php foreach ($letters as $letter) : ?>
  <?php if (!empty($groups[$letter])) : ?>
    <section class="col-first span_3_of_3 shop-list style-a1">
      <h3><?php echo esc_html($letter); ?> <a id="<?php echo esc_attr($letter); ?>"></a></h3>
      <?php foreach ($groups[$letter] as $shop) : $title = get_the_title($shop); ?>
        <a href="<?php echo esc_url(get_permalink($shop)); ?>" rel="bookmark" title="<?php echo esc_attr('Zu den ' . $title . ' Produkten'); ?>"><?php echo esc_html($title); ?></a>
      <?php endforeach; ?>
    </section>
  <?php endif; ?>
<?php endforeach; ?>
<?php
get_footer();
