<?php
function get_fb_option($key, $default) {
	$value = stripslashes(get_option($key));
	if ($value == '') {
		$value = $default;
	}	
	return $value;
}

$fb_action = '';
$fb_keys = '';
if(isset($_GET['fb_action'])) {
	$fb_action = $_GET['fb_action'];
}
if (isset($_GET['fb_query'])) {
	$fb_keys = $_GET['fb_query'];
}
if ($fb_action == 'query') {
	global $wpdb;
	require_once ('../../../../wp-config.php');	
	$fb_keys = str_replace(' ','%',$fb_keys);
	$pageposts = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE (post_title LIKE '%$fb_keys%') AND post_type = 'post' AND post_status = 'publish' limit 5");
	if ($pageposts ==! '') {
		echo '<ul>';
		foreach ($pageposts as $post) {
			setup_postdata($post);			
			$shopname = get_the_title($ID);
			$permalink = get_permalink();
			
			echo '<li><a href="' . $permalink . '">'; 
			get_logo($shopname); 
			echo '<b>' . $shopname . '</b>';
			echo '</a></li>';		
		}
echo '</ul>';
}
die();
}
?>