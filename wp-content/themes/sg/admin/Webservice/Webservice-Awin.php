<?php


  $AwinCSVDownloadLink = 'https://ui.awin.com/export-promotions/587077/f7185a3afff8216153861131827669d1?downloadType=csv&promotionType=&categoryIds=&regionIds=6&advertiserIds=&membershipStatus=joined&promotionStatus=active';
  //$AwinCSVDownloadLink = 'https://ui.awin.com/export-promotions/587077/f7185a3afff8216153861131827669d1?downloadType=csv&regionIds=6,7,16';

  function csv_to_array($file_name) {
    $data =  $header = array();
    $i = 0;
    $file = fopen($file_name, 'r');
    while (($line = fgetcsv($file)) !== FALSE) {
      if( $i==0 ) {
        $header = $line;
      } else {
        $data[] = $line;
      }
      $i++;
    }
    fclose($file);
    foreach ($data as $key => $_value) {
      $new_item = array();
      foreach ($_value as $key => $value) {
        $new_item[ $header[$key] ] =$value;
      }
      $_data[] = $new_item;
    }
    return $_data;
  }

  $api_offers_awin = csv_to_array($AwinCSVDownloadLink);



  function import_awin_offers_in_db($api_offers_awin) {
    global $wpdb;



    //check_table_offers_awin();

    $delet_table_aw_offers             = $wpdb->query("TRUNCATE TABLE `awin_vouchers`");
    $check_if_table_aw_offers_is_empty = $wpdb->get_var("SELECT count(ID) FROM awin_vouchers");

    if ($delet_table_aw_offers || $check_if_table_aw_offers_is_empty == '') {

      foreach ($api_offers_awin as $offer) {

        $PromotionID        = $offer['Promotion ID'];
        $ProgramName         = $offer['Advertiser'];
        $AdvertiserID       = $offer['Advertiser ID'];
        $type                = $offer['Type'];
        $code                = $offer['Code'];
        $description         = htmlspecialchars($offer['Description'], ENT_QUOTES);
        $starts              = preg_replace('#(\d{2})/(\d{2})/(\d{4})\s(.*)#', '$3-$2-$1 $4',  $offer['Starts']);
        $ends                = preg_replace('#(\d{2})/(\d{2})/(\d{4})\s(.*)#', '$3-$2-$1 $4',  $offer['Ends']);
        $categories          = htmlspecialchars($offer['Categories'], ENT_QUOTES);
        $regions             = htmlspecialchars($offer['Regions'], ENT_QUOTES);
        $terms               = htmlspecialchars($offer['Terms'], ENT_QUOTES);
        $DeeplinkTracking   = $offer['Deeplink Tracking'];
        $deeplink            = $offer['Deeplink'];
        $CommissionGroups   = $offer['Commission Groups'];
        $commission          = $offer['Commission'];
        $exclusive           = $offer['Exclusive'];
        $DateAdded          = preg_replace('#(\d{2})/(\d{2})/(\d{4})\s(.*)#', '$3-$2-$1 $4', $offer['Date Added']);
        //$guide = '<ol><li>Gutscheincode kopieren</li><li>Code im Warenkorb in das Gutscheincode Feld eintragen</li><li>Auf Ok klicken</li></ol>';

        $OfferTitle   = htmlspecialchars($offer['Title'], ENT_QUOTES);
        $searchTitle  = array("Euro", " ", ".", "&#038;", "EXKLUSIV");
        $replaceTitle = array("€", " ", ".", "&", "<span class=\"ex\">EXKLUSIV</span>");

        $OfferTitle = str_replace($searchTitle, $replaceTitle, $OfferTitle);
        require get_template_directory() . '/admin/prepare_the_coupon_title.php';
        $title = $OfferTitle;


        require get_template_directory() . '/admin/prepare_the_shopnames.php';
        //$advertiser = $ProgramName;
        $searchName =  array("&#8209;"," ", ".", "`", "'");
        $replaceName = array("-"      ,"-", "-", "-", "-");
        $advertiser = str_replace($searchName, $replaceName, $ProgramName);



        $searchForLogo  = array("&"    ,"&#8209;"," ", ".", "`", "'",  "ö",  "ü",  "ä");
        $replaceForLogo = array("-und-","-"      ,"-", "-", "-", "-", "oe", "ue", "ae");
        $shopname = urldecode(strtolower(str_replace($searchForLogo, $replaceForLogo, $ProgramName)));



        $import_awin_vouchers_in_db_done = $wpdb->query("
            INSERT INTO awin_vouchers
            (`PromotionID`, `Advertiser`, `Shopname`, `AdvertiserID`, `Type`, `Code`, `Description`, `Starts`, `Ends`, `Categories`, `Regions`, `Terms`, `DeeplinkTracking`, `Deeplink`, `CommissionGroups`, `Commission`, `Exclusive`, `DateAdded`, `Title`)
            VALUES
            ('$PromotionID', '$advertiser', '$shopname', '$AdvertiserID', '$type', '$code', '$description', '$starts', '$ends', '$categories', '$regions', '$terms', '$DeeplinkTracking', '$deeplink', '$CommissionGroups', '$commission', '$exclusive', '$DateAdded', '$title')");

        if ($import_awin_vouchers_in_db_done){
          $successful = true;
        } else {
          echo '<br/><b>ERROR:</b> <br/>' . $wpdb->show_errors()
            . '<br/>$PromotionID: ' . $PromotionID
            . '<br/>$advertiser: ' . $advertiser
            . '<br/>$shopname: ' . $shopname
            . '<br/>$AdvertiserID: ' . $AdvertiserID
            . '<br/>$type: ' . $type
            . '<br/>$code: ' . $code
            . '<br/>$description: ' . $description
            . '<br/>$starts: ' . $starts
            . '<br/>$ends: ' . $ends
            . '<br/>$categories: ' . $categories
            . '<br/>$regions: ' . $regions
            . '<br/>$terms: ' . $terms
            . '<br/>$DeeplinkTracking: ' . $DeeplinkTracking
            . '<br/>$deeplink: ' . $deeplink
            . '<br/>$CommissionGroups: ' . $CommissionGroups
            . '<br/>$commission: ' . $commission
            . '<br/>$exclusive: ' . $exclusive
            . '<br/>$DateAdded: ' . $DateAdded
            . '<br/>$title: ' . $title;
        }
      }
      if ($successful) {
        echo '
          <div class="notice notice-success is-dismissible">
            <p>' . $wpdb->get_var("SELECT count(ID) FROM awin_vouchers") . ' Angebote importiert!</p>
          </div>';
      }
    }
  }

  import_awin_offers_in_db($api_offers_awin);
?>
