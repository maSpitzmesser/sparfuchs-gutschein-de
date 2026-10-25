<?php
session_start();
$redirect = $_SESSION["r"];

include('../wp-load.php');
global $wpdb;

header("Cache-Control: no-cache, must-revalidate");
header("Content-Type: text/html; charset=utf-8");

if ( isset( $_GET["id"] ) ) {
	$id = $_GET["id"];

	$sql = $wpdb->get_results("SELECT * FROM sg_used WHERE ID = $id LIMIT 1");
	$counter = count($sql);
	$counter = $counter->clicks;

	$offer = $wpdb->get_row("SELECT * FROM af_coupons WHERE id = $id LIMIT 1");

	$shopid = $offer->shopid;
	$shopname = $offer->shopname;

	$shopid = $offer->shopid;
	$forwardlink = $offer->forwardlink;
	$code = $offer->code;
	$title = $offer->title;
	$oframe = $offer->frame;

	$shop = $wpdb->get_row("SELECT * FROM wp_posts WHERE ID = $shopid LIMIT 1");

	$sframe = $shop->frame;
	$oframe = 0;
}
?>
<!doctype html>
<html lang="de">
<head>
	<meta charset="UTF-8"/>
	<meta name="robots" content="noindex,nofollow,noodp,noydir"/>
	<meta HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"/>

	<title><?php echo $title; ?> bei <?php echo $shop->post_title; ?></title>

	<link rel="shortcut icon" href="https://sparfuchs-gutschein.de/favicon.ico" type="image/x-icon"/>

	<link rel="stylesheet" href="https://sparfuchs-gutschein.de/wp-content/themes/sg/styles/fuchs.css" type="text/css" media="screen, projection"/>
	<link rel="stylesheet" href="https://sparfuchs-gutschein.de/wp-content/themes/sg/styles/frame.css" type="text/css" media="screen, projection"/>

	<link rel="stylesheet" id="active-theme" href="/wp-content/themes/sg/styles/flat/theme.css" type="text/css"/>
	<link rel="stylesheet" id="active-theme-frame" href="/wp-content/themes/sg/styles/flat/frame.css" type="text/css"/>

	<script type="text/javascript" src="//code.jquery.com/jquery-2.1.1.min.js"></script>

<?php
    if (empty($id)) {
    } else if ($oframe == '0' ){
        $redirect = '1';
				echo '<meta http-equiv="refresh" content="5; url='.$forwardlink.'">';
    } else if (empty($redirect) && $oframe == '1' ){
        $redirect = '1';
        echo '<meta http-equiv="refresh" content="5; url=https://sparfuchs-gutschein.de/af_link.php?id='.$id.'">';
    }
?>


</head>
<?php

if ($oframe == '0') {
	require('redirect.php');
}

if ($oframe == '1' ){
	if (empty($redirect)) {
	require('redirect.php');
	}
}
if ($oframe == '1' && $redirect == '1') {

?>
<frameset rows="90,*" frameborder="NO" border="0" framespacing="0">
	<frame src="frame.php?id=<?php echo $id; ?>" scrolling="NO" noresize/>
	<frame src="<?php echo $forwardlink; ?>" name="shop"/>
</frameset>
<?php
session_destroy();
}


?>
</html>
