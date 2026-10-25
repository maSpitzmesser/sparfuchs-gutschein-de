<?php
header('Content-Encoding: UTF-8');
header('Content-Type: text/html; charset="utf-8"', true);

function sg_admin_style() {
	global $wp_scripts;
	//wp_register_style( 'admin-style', get_bloginfo('template_directory').'/admin/css/admin.css', true, '1.0.2');
	//wp_enqueue_style( 'admin-style' );
	wp_deregister_style( 'jquery-ui-style' );
}
add_action('init', 'sg_admin_style');

function sg_admin_script() {
	global $wp_scripts;
	wp_register_script('jquery-flot', '//cdnjs.cloudflare.com/ajax/libs/flot/0.8.2/jquery.flot.min.js', true, '1.8.5');
	wp_enqueue_script('jquery-flot');
	wp_register_script('jquery-excanvas', get_bloginfo('template_directory').'/admin/js/excanvas.min.js', true, '1.8.5');
	wp_enqueue_script('jquery-excanvas');
	//wp_register_script('jquery.nicescroll-js', get_bloginfo('template_directory').'/inc/admin/js/jquery.nicescroll.js', true, '3.5.0');
	//wp_enqueue_script('jquery.nicescroll-js');
	wp_register_script('admin-js', get_bloginfo('template_directory').'/admin/js/admin.sg.js', true, '1.0.2');
	wp_enqueue_script('admin-js');
}
add_action('admin_footer', 'sg_admin_script');


//add_action('admin_menu','admin_menu_separator');



function sg_slider(){
    add_menu_page      ( 'Slider', 'Slider', 'manage_options', 'slider-options', 'slider_db', 'dashicons-slides', 7);
    add_submenu_page( 'slider-options', 'Hinzufügen', 'Hinzufügen', 'manage_options', 'slider-db', 'slider_options');
}
add_action('admin_menu', 'sg_slider');


function coupon_options(){
    add_menu_page      ( 'Gutscheine', 'Gutscheine', 'manage_options', 'coupon-options', 'coupon_func', 'dashicons-tag', 10);
    add_submenu_page( 'coupon-options', 'Neuer Gutschein anlegen', 'Neuer Gutschein anlegen', 'manage_options', 'coupon-op-settings', 'coupon_settings');
    add_submenu_page( 'coupon-options', 'Gutscheine in Warteschlange', 'Gutscheine in Warteschlange', 'manage_options', 'coupon_publish', 'coupon_publish');
    //add_submenu_page( 'coupon-options', 'Afillinet Webservice', 'Afillinet Webservice', 'manage_options', 'coupon_api', 'coupon_api');
    //add_submenu_page( 'coupon-options', 'Zanox Webservice', 'Zanox Webservice', 'manage_options', 'coupon_api_zanox', 'coupon_api_zanox');
    add_submenu_page( 'coupon-options', 'Gutscheine über CSV importieren', 'Gutscheine über CSV importieren', 'manage_options', 'coupon-import', 'coupon_import');
    //add_submenu_page( 'coupon-options', 'CSV DB', 'CSV DB', 'manage_options', 'coupon-import', 'CSV_DB');
}
add_action('admin_menu', 'coupon_options');


function shop_options(){
    add_menu_page      ( 'Alle Shops', 'Shops', 'manage_options', 'shops-options', 'shop_api', 'dashicons-cart', 11);
    add_submenu_page( 'post-new.php', 'Neuer Shop', 'shops-options', 'manage_options', '');
    add_submenu_page( 'shops-options', 'Shops Übersicht', 'Shops Übersicht', 'manage_options', 'shop_api', 'shop_api');
    add_submenu_page( 'shops-options', 'Kategorien', 'Kategorien', 'manage_options', 'coupon-op-settings', 'coupon_settings');
    add_submenu_page( 'shops-options', 'Schlagwörter', 'Schlagwörter', 'manage_options', 'edit-tags', 'edit-tags');
}
add_action('admin_menu', 'shop_options');


function webservice_menu(){
    add_menu_page      ( 'Webservice', 'Webservice', 'manage_options', 'webservice_options', 'page_webservice', 'dashicons-cloud', 12);
    add_submenu_page( 'webservice_options', 'Afillinet', 'Afillinet', 'manage_options', 'coupon_api', 'coupon_api');
    add_submenu_page( 'webservice_options', 'Zanox', 'Zanox', 'manage_options', 'coupon_api_zanox', 'coupon_api_zanox');
}
add_action('admin_menu', 'webservice_menu');


function feedback_resultat(){
  add_menu_page      ( 'Feedback', 'Feedback', 'manage_options', 'feedback_options', 'feedback_options', 'dashicons-groups', 26);
}
add_action('admin_menu', 'feedback_resultat');


function page_cacher(){
  //add_menu_page      ( 'Cacher', 'Cacher', 'manage_options', 'cacher_site', 'cacher_site', 'dashicons-dashboard', 27);
}
add_action('admin_menu', 'page_cacher');

function sg_MySQL_Datenbank(){
  //add_menu_page      ( 'MySQL Datenbank', 'MySQL Datenbank', 'manage_options', 'sg_mysql-options', 'sg_mysql_db', 'dashicons-networking', 28);
}
add_action('admin_menu', 'sg_MySQL_Datenbank');




//include 'Webservice/Webservice-Zanox.php';
//include 'Webservice/Webservice-Affilnet.php';
//include 'Webservice/page-webservice.php';
include 'coupon_api.php';
//include 'shop_api.php';




include 'coupon-anlegen.php';

include 'coupon-publish.php';

include 'coupon-table.php';

include 'coupon-csv-import.php';



//include 'test.php';

include 'compressor.php';

include 'slider.php';

include 'admin-feedbacks.php';

//include 'admin-cacher.php';


function sg_mysql_db(  ){
	?>

	<?php
}


?>
