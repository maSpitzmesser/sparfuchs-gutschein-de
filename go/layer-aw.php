<?php
  include('../wp-load.php');
  global $wpdb;
  
  header("Cache-Control: no-cache, must-revalidate");
  header("Content-Type: text/html; charset=utf-8");
  
  if ( isset( $_GET["id"] ) ) {
    
    $id = $_GET["id"];
    
    
    $offer = $wpdb->get_row("SELECT * FROM awin_vouchers WHERE PromotionID = $id LIMIT 1");
    
    $shopid = $offer->shopid;
    
    
    $post = $wpdb->get_row("SELECT * FROM wp_posts WHERE ID = $shopid LIMIT 1");
    
    
    $shopname = $offer->Advertiser;
    //$shopname = preg_replace('/[\x00-\x1F\x80-\xFF]/', '-', $offer->Advertiser);
    
    $forwardlink = $offer->DeeplinkTracking;
    
    if( $forwardlink === '' ) {
      $forwardlink = $offer->Deeplink;
    }
    
    
    $code = $offer->Code;
    $title = $offer->Title;
    $terms = $offer->Terms;
    
    $guide = $offer->guide;
    $description = $offer->Description;
    
    $valid_to = $offer->Starts;
    
    $time = htmlentities( strftime(' %d.%m.%Y', strtotime( date('d F Y', strtotime($valid_to)))));
    
  }
?>
<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8"/>
    <title><?php echo $title; ?> bei <?php echo $shopname; ?></title>
    <meta name="robots" content="noindex,nofollow,noodp,noydir"/>

    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">


    <link rel="stylesheet" href="/wp-content/themes/sg/styles/fuchs.css" type="text/css" media="screen, projection"/>

    <link rel="stylesheet" id="active-theme" href="/wp-content/themes/sg/styles/flat/theme.css" type="text/css"/>
    <link rel="stylesheet" id="active-theme" href="/wp-content/themes/sg/styles/flat/layer.css" type="text/css"/>
</head>

<body>

<div id="fb-root"></div>
<script>(function(d, s, id) {  var js, fjs = d.getElementsByTagName(s)[0];  if (d.getElementById(id)) return;  js = d.createElement(s); js.id = id;  js.src = "//connect.facebook.net/de_DE/sdk.js#xfbml=1&version=v8.0";  fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'facebook-jssdk'));</script>


<div class="layer">
  <?php
    $searchlogo = array("&", " ", ".", "&#038;", "ö", "ü", "ä");
    $replacelogo = array("-und-", "-", "-", "-und-", "oe", "ue", "ae");
    $shopnamelogo = strtolower(str_replace($searchlogo, $replacelogo, $shopname));
  ?>
    <img alt="<?php echo $shopname ?>" src="https://sparfuchs-gutschein.de/wp-content/themes/sg/images/shop_logos/<?php echo $shopnamelogo; ?>-logo.png"/>


    <h2 class="redirect-head-h1"><?php echo $title; ?></h2>


    <div class="socialbar">



        <div class="fb-like" data-href="<?php echo $_SERVER["HTTP_REFERER"]; ?>" data-send="false" data-layout="button_count" data-width="55" data-show-faces="false" data-font="arial"></div>


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
          <?php if (!empty($description)):
            echo '<td><strong>Info:</strong></td>';
            echo '<td><p>' .$description . '</p></td>';
          endif; ?>
        </tr>

        <tr>
          <?php if (!empty($terms)):
            echo '<td><strong>Bedingungen:</strong></td>';
            echo '<td><p>' .$terms . '</p></td>';
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
        <a class="b" href="<?php echo $forwardlink; ?>" target="_blank">Gleich einlösen ></a>
    </div>

    <div class="clr"></div>

</div><!-- layer -->




</body>
</html>
