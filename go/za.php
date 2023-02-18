<?php
session_start();
$r = $_SESSION["r"];

include('../wp-load.php');
global $wpdb;

header("Cache-Control: no-cache, must-revalidate");
header("Content-Type: text/html; charset=utf-8");

if ( isset( $_GET["id"] ) ) {

	$id = $_GET["id"];


	$counter = $wpdb->get_row("SELECT * FROM sg_used WHERE ID = $id LIMIT 1");

	$counter = $counter->clicks;



	$offer = $wpdb->get_row("SELECT * FROM offers_zanox WHERE id = $id LIMIT 1");



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
	<title><?php echo $title; ?> bei <?php echo $shop->post_title; ?></title>
	<meta name="robots" content="noindex,nofollow,noodp,noydir"/>
    <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

	<link rel="shortcut icon" href="http://sparfuchs-gutschein.de/favicon.ico" type="image/x-icon"/>

	<link rel="stylesheet" href="https://sparfuchs-gutschein.de/wp-content/themes/sg/styles/fuchs.css" type="text/css" media="screen, projection"/>
	<link rel="stylesheet" href="https://sparfuchs-gutschein.de/wp-content/themes/sg/styles/frame.css" type="text/css" media="screen, projection"/>

	<link rel="stylesheet" id="active-theme" href="/wp-content/themes/sg/styles/flat/theme.css" type="text/css"/>
	<link rel="stylesheet" id="active-theme-frame" href="/wp-content/themes/sg/styles/flat/frame.css" type="text/css"/>

	<script type="text/javascript" src="//code.jquery.com/jquery-2.1.1.min.js"></script>
<?php

	if ($oframe == '0' ){
        $_SESSION["r"] = '1';
		echo '<meta http-equiv="refresh" content="5; url='.$forwardlink.'">';
    }

    if (empty($r) && $oframe == '1' ){
        $_SESSION["r"] = '1';
        echo '<meta http-equiv="refresh" content="5; url=http://sparfuchs-gutschein.de/za_link.php?id='.$id.'">';
    }
?>
</head>
<?php

if ($oframe == '0') {
	include 'redirect.php';
}

if ($oframe == '1' ){
	if (empty($r)) {
		include 'redirect.php';
	}
}
if ($oframe == '1' && $r == '1') {

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
