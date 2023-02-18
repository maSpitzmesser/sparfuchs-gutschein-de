#!/usr/local/bin/php
<?php

  // PFAD:
  // https://sparfuchs-gutschein.de/wp-content/themes/sg/admin/cronjobs?key=mFzYr6BvD5iwwef4h

  // cronjob
  //#m      h       dom     mon     dow     command
  //0          */3     *          *           *           /usr/bin/wget -q https://sparfuchs-gutschein.de/wp-content/themes/sg/admin/cronjobs?key=mFzYr6BvD5iwwef4h
  //0          */3     *          *           *           /usr/bin/php /homepages/40/d393556749/Sparfuchs-Gutschein/wp-content/themes/sg/admin/cronjobs?key=mFzYr6BvD5iwwef4h
  //*/30    *         *          *           *           /usr/bin/php5 /homepages/40/d393556749/Sparfuchs-Gutschein/wp-cron.php > /dev/null



  //0          */3     *          *           *           /usr/bin/wget -q http://www.esurflinks.de/ESurflinks/inc/cronjob



  //usr/bin/wget -q -O /dev/null https://sparfuchs-gutschein.de/wp-content/themes/sg/admin/cronjobs?key=mFzYr6BvD5iwwef4h
  //curl -q https://sparfuchs-gutschein.de/wp-content/themes/sg/admin/cronjobs?key=mFzYr6BvD5iwwef4h > /dev/null


  $key     = $_GET['key'];
  //$email = $_GET['email'];
  $email = 'false';



  function send_email_to_Admin($message1,$message2,$message3,$message4) {

    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // More headers
    $headers .= 'From: <info@sparfuchs-gutschein.de>' . "\r\n";
    //$headers .= 'Cc: myboss@example.com' . "\r\n";

    //$to = "info@sparfuchs-gutschein.de";
    $to = "markusspitzmesser@yahoo.de";
    $subject = "Cronjob Warning ";

    $html = '
<html>
<head>
<style>
@font-face {
  font-family: "Open Sans";
  font-style: normal;
  font-weight: 400;
  src: local("Open Sans"), local("OpenSans"), url("https://fonts.gstatic.com/s/opensans/v13/uYKcPVoh6c5R0NpdEY5A-Q.woff") format("woff");
}
* {
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  margin:0;
  padding:0
}
body {
	font-family: "Open Sans";
	font-size: 90%;
	color: #333;
  line-height:20px;
	padding:3px 10px;
}
h2 {
	color: #CF000F;
	height:40px;
	line-height:33px;
	text-align: left;
	width:100%;
	display:inline-block;
	text-shadow: 1px 1px rgb(242, 242, 242), 2px 2px rgb(242, 242, 242), 3px 3px rgb(242, 242, 242), 4px 4px rgb(242, 242, 242), 5px 5px rgb(242, 242, 242), 6px 6px rgb(242, 242, 242), 7px 7px rgb(242, 242, 242), 8px 8px rgb(242, 242, 242), 9px 9px rgb(242, 242, 242), 10px 10px rgb(242, 242, 242), 11px 11px rgb(242, 242, 242), 12px 12px rgb(242, 242, 242), 13px 13px rgb(242, 242, 242), 14px 14px rgb(242, 242, 242), 15px 15px rgb(242, 242, 242), 16px 16px rgb(242, 242, 242), 17px 17px rgb(242, 242, 242), 18px 18px rgb(242, 242, 242), 19px 19px rgb(242, 242, 242), 20px 20px rgb(242, 242, 242), 21px 21px rgb(243, 243, 243), 22px 22px rgb(243, 243, 243), 23px 23px rgb(244, 244, 244), 24px 24px rgb(244, 244, 244), 25px 25px rgb(245, 245, 245), 26px 26px rgb(245, 245, 245), 27px 27px rgb(246, 246, 246), 28px 28px rgb(246, 246, 246), 29px 29px rgb(247, 247, 247), 30px 30px rgb(247, 247, 247), 31px 31px rgb(248, 248, 248), 32px 32px rgb(248, 248, 248), 33px 33px rgb(249, 249, 249), 34px 34px rgb(249, 249, 249), 35px 35px rgb(250, 250, 250), 36px 36px rgb(250, 250, 250), 37px 37px rgb(251, 251, 251), 38px 38px rgb(251, 251, 251), 39px 39px rgb(252, 252, 252), 40px 40px rgb(252, 252, 252), 41px 41px rgb(253, 253, 253), 42px 42px rgb(253, 253, 253), 43px 43px rgb(254, 254, 254), 44px 44px rgb(254, 254, 254), 45px 45px rgb(255, 255, 255);
	margin-bottom: 0.7em;
	border-bottom: 2px solid #E6E7E7;
	overflow: hidden;
}
h3 {
	margin-bottom: 0.5em;
}
p {
	margin-bottom: 1.0em;
}
ol, ol li {
	list-style: none;
}
ol li {
	margin-bottom: 0.8em;
	border-bottom: 1px solid #E6E7E7;
	padding: 2px 0px 0.8em 13px;
	position: relative;
}
ol li:before {
	content: "❗";
	position: absolute;
	left: -5px;
	top: 2px;
	width: 10px;
	height: 10px;
}

.content {
	padding:5px 6px;
}
</style>
<title>Cronjob Warning</title>
</head>
<body>
<div class="content">
<p>Automatischer Check der Webseite alle 3 Stunden.</p>
<h2>Fehler:</h2>
<ol>
'.$message1
      .$message2
      .$message3
      .$message4
      .$message5.'
</ol>
<br/>
<p>Grüße Markus ✌</p>
</div>
</body>
</html>
';

    mail($to,$subject,$html,$headers);

  }





  //returns true, if domain is availible, false if not
  function isDomainAvailible($domain) {
    //check, if a valid url is provided
    if(!filter_var($domain, FILTER_VALIDATE_URL)) {
      return false;
    }
    //initialize curl
    $curlInit = curl_init($domain);
    curl_setopt($curlInit,CURLOPT_CONNECTTIMEOUT,10);
    curl_setopt($curlInit,CURLOPT_HEADER,true);
    curl_setopt($curlInit,CURLOPT_NOBODY,true);
    curl_setopt($curlInit,CURLOPT_RETURNTRANSFER,true);
    //get answer
    $response = curl_exec($curlInit);
    curl_close($curlInit);
    if ($response) return true;
    return false;
  }



  if (!empty($key) && $key === 'mFzYr6BvD5iwwef4h') {
    require_once( dirname(__FILE__) . '../../../../../wp-load.php' );
    global $wpdb;


    // lösche abgelaufene Gutscheine
    $count = $wpdb->get_results( "SELECT * FROM wp_coupons WHERE valid_to < CURDATE()");
    if ($count ==! '0') {
      $del_manuell_coupons = $wpdb->query( 'DELETE FROM wp_coupons WHERE valid_to < CURDATE()' );
      echo 'Gutscheine gelöscht: ' . $count($del_manuell_coupons);
    }

    $count = $wpdb->get_results( "SELECT * FROM offers_zanox WHERE valid_to < CURDATE()");
    if ($count ==! '0') {
      $del_manuell_coupons = $wpdb->query( 'DELETE FROM offers_zanox WHERE valid_to < CURDATE()' );
      //echo 'Gutscheine gelöscht: ' . $count($del_manuell_coupons);
    }

    // lösche abgelaufene mit datum angelegte Slider images
    $count = $wpdb->get_results( 'SELECT * FROM wp_slider WHERE valid_to < CURDATE()' );
    if ($count ==! '0') {
      echo '<br/>Slider gelöscht: ' . $count;
      $wpdb->query( 'DELETE FROM wp_slider WHERE valid_to < CURDATE()' );
    }

    // Test db check if works markus
    //echo '<select name="shop">';
    //// $args = array('numberposts' => -1, 'post_type' => 'post', 'post_status' => 'publish', 'orderby' => 'title', 'order' => 'ASC');
    // $posts = get_posts($args);
    // foreach ($posts as $post) : setup_postdata($post);
    //	echo '<option value="' . $post->ID . '">' . get_the_title( $ID ) . '</option>';
    //endforeach;
    //echo '</select>';

    //include 'shop_api.php';
    //update_active_programms_from_af();
    usleep(500);

    include 'Webservice/Webservice-Awin.php';


    //include 'Webservice/Webservice-Zanox.php';
    //import_zanox_offers();
    //usleep(500);



    //include 'Webservice/Webservice-Affilnet.php';
    //import_affilinet_offers();
    //usleep(300);


    $location = get_template_directory() . '/includes/google-analytics.js';
    $analytics = file_get_contents('https://www.google-analytics.com/analytics.js');
    file_put_contents($location, $analytics);

    // warning email
    $wp_coupons = $wpdb->get_results( "SELECT * FROM wp_coupons");
    $awin_vouchers = $wpdb->get_results( "SELECT * FROM awin_vouchers");

    if ( empty($wp_coupons) || empty($awin_vouchers) || isDomainAvailible('https://sparfuchs-gutschein.de') !== true ) {
      if (isDomainAvailible('https://sparfuchs-gutschein.de') !== true) {
        $message1 = '<li><strong  style="color: #CF000F;font-size: 110%;">WEBSEITE OFFLINE ☠</strong></li>';
      };


      if ( empty($wp_coupons) ) {
        $message2 = '<li>Keine Gutscheine in der Datenbank (wp_coupons) gefunden!</li>';
      };
      if ( empty($affilinet_offers) ) {
        $message3 = '<li>Affilinet Webservice nicht erreichbar!</li>';
      };
      if (empty($awin_vouchers)) {
        $message4 = '<li>Probleme beim Importieren der Gutscheine (awin_vouchers) über den Webservice von Afillinet!</li>';
      };
      echo "email send";
      send_email_to_Admin($message1,$message2,$message3,$message4,$message5);
    } else {


      echo '<p>Cronjob Done<p/>';

    };
    wp_cache_clear_cache();
  } else {
    echo 'Zur Missbrauchserkennung werden Informationen (wie z.B. IP-Adresse, Datum und Uhrzeit) temporär gespeichert.';
  }
?>

<iframe class="hidden" src="https://sparfuchs-gutschein.de"></iframe>
<iframe class="hidden" src="https://sparfuchs-gutschein.de/fressnapf/"></iframe>
<iframe class="hidden" src="https://sparfuchs-gutschein.de/zooroyal/"></iframe>
<iframe class="hidden" src="https://sparfuchs-gutschein.de/zooplus/"></iframe>
<iframe class="hidden" src="https://sparfuchs-gutschein.de/douglas/"></iframe>
<iframe class="hidden" src="https://sparfuchs-gutschein.de/point-rouge/"></iframe>
<iframe class="hidden" src="https://sparfuchs-gutschein.de/orion/"></iframe>
