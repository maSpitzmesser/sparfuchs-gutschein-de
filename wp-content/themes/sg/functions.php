<?php
/**
 * Sparfuchs-Gutschein Theme.
 *
 * Lädt die Module aus inc/. Jedes Modul ist für einen Bereich zuständig;
 * Templates rufen nur die dort definierten sg_*-Funktionen auf.
 */

defined('ABSPATH') || exit;

define('SG_THEME_DIR', get_template_directory());
define('SG_THEME_URI', get_template_directory_uri());

require_once SG_THEME_DIR . '/inc/setup.php';
require_once SG_THEME_DIR . '/inc/designs.php';
require_once SG_THEME_DIR . '/inc/assets.php';
require_once SG_THEME_DIR . '/inc/helpers.php';
require_once SG_THEME_DIR . '/inc/coupons.php';
require_once SG_THEME_DIR . '/inc/widgets.php';
require_once SG_THEME_DIR . '/inc/redirects.php';
require_once SG_THEME_DIR . '/inc/search.php';
require_once SG_THEME_DIR . '/inc/forms.php';
require_once SG_THEME_DIR . '/inc/importer.php';

if (is_admin()) {
    require_once SG_THEME_DIR . '/inc/admin.php';
}
