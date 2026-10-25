<?php



//$xml_programs_zanox = $api->GetProgramApplicationsResponse($region);
//$xml_programs_zanox = simplexml_load_string($xml_programs_zanox) or die("Error: Cannot create object");
//$xml_programs_zanox = $xml_programs_zanox->programItems;

$xml_programs_zanox = 'http://api.zanox.com/xml/2011-03-01/programs?connectid=D4315D54CC9A5A549783&region=DE';
$xml_programs_zanox = simplexml_load_file($xml_programs_zanox) or die("Error: Cannot create object");
$xml_programs_zanox = $xml_programs_zanox->programItems;





// Nur aktzeptierte Programme Zanox Gutscheine &adspace=1690954
    $xml_offers_zanox = 'http://api.zanox.com/xml/2011-03-01/incentives/?connectid=D4315D54CC9A5A549783&region=DE';
$xml_offers_zanox = simplexml_load_file($xml_offers_zanox) or die("Error: Cannot create object");
$xml_offers_zanox = $xml_offers_zanox->incentiveItems->incentiveItem;




// save zanox offers in DB
function import_zanox_offers() {
  global $wpdb;
  global $xml_offers_zanox;

  $delet_table_af_coupons = $wpdb->query("TRUNCATE offers_zanox");

  if ($delet_table_af_coupons) {

        foreach ($xml_offers_zanox as $offer) {

            $OfferTitle = $offer->name;
            require '/homepages/40/d393556749/htdocs/Sparfuchs-Gutschein/wp-content/themes/sg/admin/prepare_the_coupon_title.php';
            $title = $OfferTitle;

            usleep(100);
            $ProgramName = $offer->program;
            require '/homepages/40/d393556749/htdocs/Sparfuchs-Gutschein/wp-content/themes/sg/admin/prepare_the_shopnames.php';
            usleep(100);

            $code = $offer->couponCode;

            if ( $offer->incentiveType == 'freeProducts' ) {
                $type = 'free product';
            }  else if ( $offer->incentiveType == 'coupons' ) {
                $type = 'coupon';
            } else  {
                $type = 'offer';
            }

            $worth = '0';
            $unit = '%';

            $valid_from = date ("Y-m-d", strtotime($offer->startDate) );
            $valid_to   = date ("Y-m-d", strtotime($offer->endDate) );

            if ( $valid_to == '' || $offer->endDate == '0000-00-00' ) {
                $valid_to = NULL;
            }

            $minimum_order_value =  str_replace(".0", "", $offer->minimumBasketValue);

            if ( $offer->newCustomerOnly == 'false' ) {
                $new_customers = 'YES';
                $existing_customers = 'YES';
            } else if ( $offer->newCustomerOnly == 'true' ) {
                $new_customers = 'YES';
                $existing_customers = 'NO';
            }  else {
               $new_customers = 'YES';
                $existing_customers = 'NO';
            }

            $description = $offer->info4customer;
            $guide = '';
            $IntegrationCode = $offer->admedia->admediumItem->trackingLinks->trackingLink->ppc;

            if (empty($IntegrationCode)) {
                $static_url  = str_replace(" DE", "", $ProgramName);
                $static_url  = str_replace(" ", "-", $ProgramName);
                $static_url  = str_replace("zur-rose", "zurrose", $ProgramName);
                $static_url  = strtolower($static_url);
                $IntegrationCode = "http://www." . $static_url . ".de";
                if ($ProgramName == 'Sammydress' || $ProgramName == 'GearBest') {
                    $IntegrationCode = "http://www." . $static_url . ".com";
                } else if (($ProgramName == 'Hotels.com') || ($ProgramName == 'TUIfly.com')) {
                    $IntegrationCode = "http://www." . $static_url;
                }
            }
            $ProgramName  = str_replace(" DE", "", $ProgramName);

            $frame = '0';
            $public = '1';

            $zanox_program = $wpdb->get_results("SELECT ID FROM wp_posts
                                    WHERE (post_title LIKE '%$ProgramName%')
                                    AND post_type = 'post'
                                    AND post_status = 'publish'
                                    LIMIT 1");
                                    // WHERE post_title = '$ProgramName'

            foreach ($zanox_program as $shop) {
                $shopID = $shop->ID;
                $import_done = $wpdb->query("INSERT INTO offers_zanox
                (id, shopid, title, type, worth, unit, valid_from, valid_to, minimum_order_value, existing_customers, new_customers, description, guide, forwardlink, frame, code,public)
                VALUES (NULL, '$shopID', '$title', '$type', '$worth', '$unit', '$valid_from', '$valid_to', '$minimum_order_value', '$existing_customers', '$new_customers', '$description', '$guide', '$IntegrationCode', '$frame', '$code' , '$public')");
            }

            if(!$import_done) {
              echo 'Error: Zanox offer import fail!';
              echo '<details>';
              echo $offer->Program;
              echo 'id=NULL<br/>' . 'shopid ' .$shopID . '<br/>title ' . $title . '<br/>type ' . $type . '<br/>worth ' . $worth . '<br/>unit ' . $unit . '<br/>valid_from ' . $valid_from . '<br/>valid_to ' . $valid_to . '<br/>minimum ' . $minimum_order_value . '<br/>existing_customers ' . $existing_customers . '<br/>new_customers ' . $new_customers . '<br/>description ' . $description . '<br/>guide ' . $guide . '<br/>IntegrationCode ' . $IntegrationCode . '<br/>frame ' . $frame . '<br/>code ' . $code . '<br/>public ' . $public;
              echo '</details>';
            }
        }
      }
        $all_zanox_offers  = $wpdb->get_var("SELECT count(id) FROM offers_zanox");
        echo $all_zanox_offers . ' Offers from Zanox importiert!';
    }








?>
