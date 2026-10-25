<?php
header("Cache-Control: no-cache, must-revalidate");
header("Content-Type: text/html; charset=utf-8");

if ( isset( $_GET["id"] ) ) {

	$id = $_GET["id"];

	$server = "db443562499.db.1and1.com";
	$user = "dbo443562499";
	$pass = "spitzmesser901369";
	$datenbank = "db443562499";
 
	$verbindung = mysql_connect($server,$user,$pass);
	mysql_select_db($datenbank);
	
	mysql_query("SET NAMES 'utf8'");
 
	$offer = mysql_query("SELECT * FROM wp_coupons WHERE id = $id LIMIT 1");
	$offer = mysql_fetch_array($offer);

	$shopid = $offer['shopid'];

	$shop = mysql_query("SELECT * FROM wp_posts WHERE ID = $shopid AND post_type = 'post' LIMIT 1");
	$shop = mysql_fetch_array($shop);

	$shopname = $shop['post_title'];

	$forwardlink = $offer['forwardlink'];
	$code = $offer['code'];
	$title = $offer['title'];
	
	$guide = $offer['guide'];
	$description = $offer['description'];
	
	$valid_to = $offer['valid_to'];
	
	$time = htmlentities( strftime(' %d %B %Y', strtotime( date('d F Y', strtotime($valid_to)))));
	
	$new_customers = $offer['new_customers'];
	$existing_customers = $offer['existing_customers'];
	
	$minimum_order_value = $offer['minimum_order_value'];
}
?>
<!doctype html>
<html lang="de">
<head>
	<meta charset="UTF-8"/>
	<title><?php echo $title; ?> bei <?php echo $shopname; ?></title>
	<meta name="robots" content="noindex,nofollow,noodp,noydir"/>

	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<link rel="shortcut icon" href="http://sparfuchs-gutschein.de/favicon.ico" type="image/x-icon"/>

	<link rel="stylesheet" href="https://sparfuchs-gutschein.de/wp-content/themes/sg/styles/fuchs.css" type="text/css" media="screen, projection"/>
	<link rel="stylesheet" href="https://sparfuchs-gutschein.de/wp-content/themes/sg/styles/frame.css" type="text/css" media="screen, projection"/>
	
	<link rel="stylesheet" id="active-theme" href="/wp-content/themes/sg/styles/flat/theme.css" type="text/css"/>
	<link rel="stylesheet" id="active-theme-frame" href="/wp-content/themes/sg/styles/flat/frame.css" type="text/css"/>
	
	<script type="text/javascript" src="//code.jquery.com/jquery-2.1.1.min.js"></script>


</head>

<body class="<?php echo $_COOKIE["selected_theme"];  ?>">

<div class="gutscheinleiste" id="bar">

	<a class="frame-logo" href="https://sparfuchs-gutschein.de" target="_top">
		<img src="http://sg.sparfuchs-gutschein.de/images/logo/logo-bar-klein.png" alt=""/>
	</a>

	<div class="infobox">
	
		<div class="container_left"> 
			<div class="text">
			
				<span class="redirect-head-h1"><?php echo $title; ?> bei <?php echo $shopname; ?></span>

				<span class="vato">Gültig bis:  <span><?php echo !empty($valid_to) ? $time : 'Dauer';  ?></span></span>

				<?php if ($new_customers == 'YES' && $existing_customers == 'YES'): echo '<span class="bk">Neu- &amp; Bestandskunden</span>'; 
							elseif ($new_customers == 'YES'): echo '<span class="nk">Nur für Neukunden</span>'; 
							elseif ($existing_customers == 'YES'): echo '<span class="bk">Nur für Bestandskunden</span>'; 
							endif;
				?>

				<?php if (!empty($minimum_order_value)): echo '<span class="mb">Mindestbestellwert:' . $minimum_order_value . ' €</span>'; 
							elseif (isset($minimum_order_value)) : echo '<span class="kmb">Kein Mindestbestellwert</span>'; 
							endif;
				?>

				<?php if (!empty($guide)): echo '<br/><strong>So funktionierts:</strong><ol>' .$guide . '</ol>'; endif; ?>

				<?php if (!empty($description)): echo '<p class="desc">' .$description . '</p>'; endif; ?>

			</div><!-- .text -->
		</div><!-- .container_left -->

		<div class="container_right">
		
			<span class="redirect-head-h2"><?php echo !empty($code) ? 'Dein Gutscheincode' : '<br/>';  ?></span>
			<span onclick="select()" class="redirect-code"><?php echo !empty($code) ? '' : 'Kein Code notwendig!';  ?><?php echo $code; ?></span>
			
		</div><!-- .container_right -->

	</div><!-- .infobox -->
	
	<img class="close" src="http://sg.sparfuchs-gutschein.de/images/close2.png" alt=""/>
	
</div><!-- .gutscheinleiste -->



<script>


// get this crazy style by M. Spitzmesser
!function(e){"function"==typeof define&&define.amd?define(["jquery"],e):e("object"==typeof exports?require("jquery"):jQuery)}(function(e){function n(e){return u.raw?e:encodeURIComponent(e)}function o(e){return u.raw?e:decodeURIComponent(e)}function i(e){return n(u.json?JSON.stringify(e):String(e))}function r(e){0===e.indexOf('"')&&(e=e.slice(1,-1).replace(/\\"/g,'"').replace(/\\\\/g,"\\"));try{return e=decodeURIComponent(e.replace(c," ")),u.json?JSON.parse(e):e}catch(n){}}function t(n,o){var i=u.raw?n:r(n);return e.isFunction(o)?o(i):i}var c=/\+/g,u=e.cookie=function(r,c,f){if(void 0!==c&&!e.isFunction(c)){if(f=e.extend({},u.defaults,f),"number"==typeof f.expires){var a=f.expires,d=f.expires=new Date;d.setTime(+d+864e5*a)}return document.cookie=[n(r),"=",i(c),f.expires?"; expires="+f.expires.toUTCString():"",f.path?"; path="+f.path:"",f.domain?"; domain="+f.domain:"",f.secure?"; secure":""].join("")}for(var p=r?void 0:{},s=document.cookie?document.cookie.split("; "):[],m=0,x=s.length;x>m;m++){var v=s[m].split("="),k=o(v.shift()),l=v.join("=");if(r&&r===k){p=t(l,c);break}r||void 0===(l=t(l))||(p[k]=l)}return p};u.defaults={},e.removeCookie=function(n,o){return void 0===e.cookie(n)?!1:(e.cookie(n,"",e.extend({},o,{expires:-1})),!e.cookie(n))}});
var cookie_name="selected_theme",get_cookie=jQuery.cookie(cookie_name);null!=get_cookie&&jQuery("#active-theme-frame").attr({href:"http://sparfuchs-gutschein.de/wp-content/themes/sg/styles/"+get_cookie+"/frame.css"});

// Google Analytics
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o), m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','//www.google-analytics.com/analytics.js','ga'); ga('create', 'UA-33703391-1', 'sparfuchs-gutschein.de'); ga('send', 'pageview');
</script>

</body>
</html>