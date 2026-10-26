<?php
/**
 * Kopf der Seite: Logo, Shop-Suche und Hauptmenü.
 * Mit ?lightbox=true wird die Seite im Dialog angezeigt (ohne Kopf und Fuß, siehe lightbox.css).
 */

defined('ABSPATH') || exit;

$in_lightbox = !empty($_GET['lightbox']);
?>
<!doctype html>
<html <?php language_attributes(); ?><?php echo $in_lightbox ? ' class="lightbox"' : ''; ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class('hfeed'); ?>>
<?php wp_body_open(); ?>

<header role="banner">
  <a id="logo" href="<?php echo esc_url(home_url('/')); ?>" title="Sparfuchs-Gutschein.de" rel="home">
    <img src="<?php echo esc_url(SG_THEME_URI . '/images/logo/sparfuchs-gutschein-logo.min.png'); ?>" alt="Sparfuchs-Gutschein" width="371" height="100">
  </a>

  <form class="style-a1" method="get" action="<?php echo esc_url(home_url('/')); ?>" role="search">
    <label class="hidden" for="s">Sparvorteil für Online-Shop suchen</label>
    <input id="s" name="s" type="search" value="<?php echo esc_attr(get_search_query()); ?>" placeholder="Shopname hier eingeben, z.B.: Zalando..." autocomplete="off" aria-autocomplete="list" aria-controls="ac_s">
    <input id="submit" type="submit" value="" aria-label="Suchen">
  </form>

  <nav class="main-menu style-a1" aria-label="Hauptmenü">
    <button type="button" class="mobile-menu-button" aria-expanded="false" aria-controls="main-menu-list">
      <span class="mobile-menu-icon"></span>
      <span class="mobile-menu-text">Menü</span>
    </button>
    <?php // Ohne zugewiesene Menü-Position nimmt WordPress das erste vorhandene Menü (wie bisher) ?>
    <ul id="main-menu-list"><?php wp_nav_menu(['theme_location' => has_nav_menu('primary') ? 'primary' : '', 'container' => '', 'items_wrap' => '%3$s', 'fallback_cb' => false]); ?></ul>
  </nav>
</header>

<div id="main" class="main" role="main">
<?php if (is_page() || is_single()) {
    sg_breadcrumb();
}
