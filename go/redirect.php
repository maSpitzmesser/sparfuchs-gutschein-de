<body>
<?php // Klick tracking
	include('../wp-load.php');
	global $wpdb;
  
  if ( isset( $_GET["id"] ) ) {
    $id = $_GET["id"];
    
    $offer = $wpdb->get_row("SELECT * FROM awin_vouchers WHERE PromotionID = $id LIMIT 1");

    $offerAdvertiser = $offer->Advertiser;
    $shopid      = $offer->shopid;
    $forwardlink = $offer->DeeplinkTracking;
    
    if( $forwardlink === '' ) {
      $forwardlink = $offer->Deeplink;
    }
    
    $code        = $offer->Code;
    $title       = $offer->Title;
    $oframe      = $offer->frame;
  
  
    // Count Clicks
    //$sql_old = $wpdb->get_results("SELECT * FROM sg_used WHERE ID = $id LIMIT 1");
    $clicks = $wpdb->get_var("SELECT Clicks FROM awin_vouchers_used WHERE PromotionID = $id LIMIT 1");
    $newClicks = intval($clicks+1);

    echo '0=' . $clicks, PHP_EOL;
    if (empty($clicks)) {
        echo 'if=' . $clicks;
      $wpdb->insert("awin_vouchers_used",
        array(
            "PromotionID" => $id,
            "Clicks" => "1"
          ));
    } else {
      echo 'else=' . $clicks, PHP_EOL;

      
      $update = $wpdb->query($wpdb->prepare("UPDATE awin_vouchers_used SET Clicks = $newClicks WHERE PromotionID = $id "));
      
      echo 'done=' . $newClicks, PHP_EOL;
    }
    
    
  } // if id
?>

<progress id="progressbar" value="0" max="100"></progress>

<div class="redirect-container">
    <img src="http://sg.sparfuchs-gutschein.de/images/logo/sparfuchs-gutschein-logo.min" alt=""/>
    
    <div class="redirect-container-inner">
        <h2 class="headline-a2">
          <?php if (!empty($id)) {
              echo $title;
          } else {
              echo 'This is the offer Name';
          } ?>
        </h2>
      
        <?php echo !empty($code) ? '<h3 class="headline-a3">Dein Gutscheincode</h3>' : '';  ?>

        <div class="redirect-showCode">
            <span onclick="select()" class="redirect-code" <?php echo empty($code) ? '' : 'style="border-color:green;color:green;"';  ?>><?php echo !empty($code) ? '' : 'Kein Code notwendig!';  ?><?php echo $code; ?></span>
        </div>

    </div>


    <div class="redirect-loading">
        <img src="http://sg.sparfuchs-gutschein.de/images/frame-loading.gif" alt=""/>
        <span class="redirect-progress-value"></span>
    </div>
    
    <br/>
    <br/>

    <span class="redirect-text">Du wirst jetzt zu
        <a href="<?php echo $forwardlink; ?>">
        <?php echo $offer->Shopname; ?>
        </a> weitergeleitet.
    </span>

</div>

<script>
// get this crazy style by M. Spitzmesser
!function(e){"function"==typeof define&&define.amd?define(["jquery"],e):e("object"==typeof exports?require("jquery"):jQuery)}(function(e){function n(e){return u.raw?e:encodeURIComponent(e)}function o(e){return u.raw?e:decodeURIComponent(e)}function i(e){return n(u.json?JSON.stringify(e):String(e))}function r(e){0===e.indexOf('"')&&(e=e.slice(1,-1).replace(/\\"/g,'"').replace(/\\\\/g,"\\"));try{return e=decodeURIComponent(e.replace(c," ")),u.json?JSON.parse(e):e}catch(n){}}function t(n,o){var i=u.raw?n:r(n);return e.isFunction(o)?o(i):i}var c=/\+/g,u=e.cookie=function(r,c,f){if(void 0!==c&&!e.isFunction(c)){if(f=e.extend({},u.defaults,f),"number"==typeof f.expires){var a=f.expires,d=f.expires=new Date;d.setTime(+d+864e5*a)}return document.cookie=[n(r),"=",i(c),f.expires?"; expires="+f.expires.toUTCString():"",f.path?"; path="+f.path:"",f.domain?"; domain="+f.domain:"",f.secure?"; secure":""].join("")}for(var p=r?void 0:{},s=document.cookie?document.cookie.split("; "):[],m=0,x=s.length;x>m;m++){var v=s[m].split("="),k=o(v.shift()),l=v.join("=");if(r&&r===k){p=t(l,c);break}r||void 0===(l=t(l))||(p[k]=l)}return p};u.defaults={},e.removeCookie=function(n,o){return void 0===e.cookie(n)?!1:(e.cookie(n,"",e.extend({},o,{expires:-1})),!e.cookie(n))}});
var cookie_name="selected_theme",get_cookie=jQuery.cookie(cookie_name);null!=get_cookie&&jQuery("#active-theme-frame").attr({href:"http://sparfuchs-gutschein.de/wp-content/themes/sg/styles/"+get_cookie+"/frame.css"});

// loading
jQuery(document).ready(function(){var e=jQuery("#progressbar"),r=e.attr("max"),a=1e3/r*4.2,t=e.val(),n=function(){t+=1,addValue=e.val(t),jQuery(".redirect-progress-value").html(t+"%"),t==r&&clearInterval(u)},u=setInterval(function(){n()},a)});

// Google Analytics
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o), m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','//www.google-analytics.com/analytics.js','ga'); ga('create', 'UA-33703391-1', 'sparfuchs-gutschein.de'); ga('send', 'pageview');
</script>

</body>
