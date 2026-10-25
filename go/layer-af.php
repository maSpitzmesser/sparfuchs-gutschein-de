<?php
include('../wp-load.php');
global $wpdb;

header("Cache-Control: no-cache, must-revalidate");
header("Content-Type: text/html; charset=utf-8");

if ( isset( $_GET["id"] ) ) {

	$id = $_GET["id"];


	$offer = $wpdb->get_row("SELECT * FROM af_coupons WHERE id = $id LIMIT 1");

	$shopid = $offer->shopid;


	$post = $wpdb->get_row("SELECT * FROM wp_posts WHERE ID = $shopid LIMIT 1");


	$shopname = $post->post_title;

	$forwardlink = $offer->forwardlink;
	$code = $offer->code;
	$title = $offer->title;

	$guide = $offer->guide;
	$description = $offer->description;

	$valid_to = $offer->valid_to;

	$time = htmlentities( strftime(' %d.%m.%Y', strtotime( date('d F Y', strtotime($valid_to)))));

	$new_customers = $offer->new_customers;
    $existing_customers = $offer->existing_customers;

	$minimum_order_value = $offer->minimum_order_value;
}
?>
<!doctype html>
<html lang="de">
<head>
	<meta charset="UTF-8"/>
	<title><?php echo $title; ?> bei <?php echo $post->post_title; ?></title>
	<meta name="robots" content="noindex,nofollow,noodp,noydir"/>

	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">


	<link rel="stylesheet" href="https://sparfuchs-gutschein.de/wp-content/themes/sg/styles/fuchs.css" type="text/css" media="screen, projection"/>

	<link rel="stylesheet" id="active-theme" href="/wp-content/themes/sg/styles/flat/theme.css" type="text/css"/>
	<link rel="stylesheet" id="active-theme" href="/wp-content/themes/sg/styles/flat/layer.css" type="text/css"/>



	<script type="text/javascript" src="//code.jquery.com/jquery-2.1.1.min.js"></script>


</head>

<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {  var js, fjs = d.getElementsByTagName(s)[0];  if (d.getElementById(id)) return;  js = d.createElement(s); js.id = id;  js.src = "//connect.facebook.net/de_DE/sdk.js#xfbml=1&version=v2.0";  fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'facebook-jssdk'));</script>


<div class="layer">
<?php
	$searchlogo = array("&", " ", ".", "&#038;", "ö", "ü", "ä");
	$replacelogo = array("-und-", "-", "-", "-und-", "oe", "ue", "ae");
	$shopnamelogo = strtolower(str_replace($searchlogo, $replacelogo, $shopname));
	?>
<img alt="<?php echo $shopname ?>" src="http://i.sparfuchs-gutschein.de/<?php echo strtolower($shopnamelogo); ?>-logo.png"/>


<h2 class="redirect-head-h1"><?php echo $title; ?></h2>


<div class="socialbar">



				<div class="fb-like" data-href="<?php echo $_SERVER["HTTP_REFERER"]; ?>" data-send="false" data-layout="button_count" data-width="55" data-show-faces="false" data-font="arial"></div>

				<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo $_SERVER["HTTP_REFERER"]; ?>" data-text="<?php echo $title; ?> bei <?php echo $shopname ?> | " data-lang="de">Twittern</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>

<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
<div class="g-plusone" data-size="medium" data-href="<?php echo $_SERVER["HTTP_REFERER"]; ?>"></div>

</div>

<br/>



<?php echo !empty($code) ? '<h3 class="redirect-head-h2">Dein Gutscheincode:</h3><br/>' : '';  ?>
<input onclick="select()" class="redirect-code" <?php echo empty($code) ? '' : 'style="border-color:green;color:green;"';  ?> value="<?php echo !empty($code) ? '' : 'Kein Code notwendig!';  ?><?php echo $code; ?>" readonly />


 <table style="width:100%;position:relative;" cellpadding="2">
   <tr>
    <td>Gültig bis:</td>
    <td><span class="vato"><span><?php echo !empty($valid_to) ? $time : 'Dauer';  ?></span></span></td>
  </tr>

  <tr>
    <td>Mindestbestellwert:</td>
    <td><?php if (!empty($minimum_order_value)): echo '<span class="mb">' . $minimum_order_value . ',00 €</span>';
							elseif (isset($minimum_order_value)) : echo '<span class="kmb">Kein Mindestbestellwert</span>';
							endif;
				?></td>

  </tr>
  <tr>
    <td>Gültig für:</td>
    <td><?php if ($existing_customers == 'YES' || $new_customers == 'YES'): echo '<span class="bk">Neu- &amp; Bestandskunden</span>';
							else : echo '<span class="nk">Nur für Neukunden</span>';

							endif;
				?></td>
  </tr>




	  <tr>
    <?php if (!empty($description)):
		echo '<td><strong>Info:</strong></td>';
		echo '<td><p>' .$description . '</p></td>';
		endif; ?>
  </tr>

		  <tr>
<?php if (empty($guide)) {
    if (!empty($code)) {
           echo '<td><strong>So gehts:</strong></td>';
        echo '<td><ol><li>Gutscheincode kopieren</li>
<li>Gutscheincode im Warenkorb in das Coupon-Code Feld eintragen</li>
<li>Auf Ok klicken</li></ol></td>';
    }
    } else {
        echo '<td><strong>Info:</strong></td>';
		echo '<td><ol>' .$guide . '</ol></td>';
	} ?>
  </tr>

</table>

<div class="rc">
	<a class="b" href="<?php echo $forwardlink; ?>" target="_blank">Link zum Shop</a>
</div>

<div class="clr"></div>

</div><!-- layer -->


<script>
// get this crazy style by M. Spitzmesser
!function(e){"function"==typeof define&&define.amd?define(["jquery"],e):e("object"==typeof exports?require("jquery"):jQuery)}(function(e){function n(e){return u.raw?e:encodeURIComponent(e)}function o(e){return u.raw?e:decodeURIComponent(e)}function i(e){return n(u.json?JSON.stringify(e):String(e))}function r(e){0===e.indexOf('"')&&(e=e.slice(1,-1).replace(/\\"/g,'"').replace(/\\\\/g,"\\"));try{return e=decodeURIComponent(e.replace(c," ")),u.json?JSON.parse(e):e}catch(n){}}function t(n,o){var i=u.raw?n:r(n);return e.isFunction(o)?o(i):i}var c=/\+/g,u=e.cookie=function(r,c,f){if(void 0!==c&&!e.isFunction(c)){if(f=e.extend({},u.defaults,f),"number"==typeof f.expires){var a=f.expires,d=f.expires=new Date;d.setTime(+d+864e5*a)}return document.cookie=[n(r),"=",i(c),f.expires?"; expires="+f.expires.toUTCString():"",f.path?"; path="+f.path:"",f.domain?"; domain="+f.domain:"",f.secure?"; secure":""].join("")}for(var p=r?void 0:{},s=document.cookie?document.cookie.split("; "):[],m=0,x=s.length;x>m;m++){var v=s[m].split("="),k=o(v.shift()),l=v.join("=");if(r&&r===k){p=t(l,c);break}r||void 0===(l=t(l))||(p[k]=l)}return p};u.defaults={},e.removeCookie=function(n,o){return void 0===e.cookie(n)?!1:(e.cookie(n,"",e.extend({},o,{expires:-1})),!e.cookie(n))}});
var cookie_name="selected_theme",get_cookie=jQuery.cookie(cookie_name);null!=get_cookie&&jQuery("#active-theme-frame").attr({href:"http://sparfuchs-gutschein.de/wp-content/themes/sg/styles/"+get_cookie+"/frame.css"});
</script>

</body>
</html>
