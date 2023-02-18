<?php function coupon_api(){
    global $wpdb;
    global $api_offers_affilinet;
    global $xml_offers_zanox;
?>


<div class="wrap">
  <!--<div id="message" class="updated success fade"></div>-->



  <div class="wrap-header">
    <h1><span class="dashicons dashicons-cloud"></span> Webservice</h1>
    <p class="description">Diese Gutscheine/Angebote wurden gerade per Service abgerufen und können von der aktuellen Datenbank abweichen!</p>

    <form method="POST" action="" >
      <input name="import_affilinet_offers_in_db" class="button-primary" value="Daten in DB importieren" type="submit"/>
    </form>
  </div>

  <div id="nav">

    <span class="nav-tab nav-tab-active" >Affilinet (<span style="color:#689D00;"><?php echo count($api_offers_affilinet); ?></span>)</span>
    <a class="nav-tab" href="?page=coupon_api_zanox&amp;tab=zanox">Zanox (<span style="color:#689D00;"><?php echo count($xml_offers_zanox); ?></span>)</a>
  </div>

  <table class="wp-list-table widefat striped gutscheine">
    <thead>
      <tr>
        <th>Shop ID (AF)</th>
        <th>Shop ID (SG)</th>
        <th>Shopname</th>
        <th>Titel</th>
        <th>Beschreibung</th>
        <th>Art</th>
        <th>MB</th>
        <th>gültig von</th>
        <th>gültig bis</th>
        <th>Kunden</th>
        <th>Code</th>
        <th>Link</th>
      </tr>
    </thead>

    <tbody>
<?php



foreach ($api_offers_affilinet as $offer) {

    $href = $offer->IntegrationCode;

    // get link without html
    preg_match_all('/href=[\'"]?([^\s\>\'"]*)[\'"\>]/', $href, $matches);
    $offer->IntegrationCode = ($matches[1] ? $matches[1] : false);
    $offer->IntegrationCode  = $offer->IntegrationCode[0];

    require 'prepare_the_coupon_title.php';

    // get current Sparfuchs shops
    $shops = $wpdb->get_results("SELECT * FROM af_shops WHERE ProgramId = '$offer->ProgramId' ");
?>
        <tr>
            <td><?php echo $offer->ProgramId; ?></td>
            <td><?php
                foreach ($shops as $shop) {
                    echo $shop->ID;
                }
                    ?>
            </td>
            <td><?php
                foreach ($shops as $shop) {
                    echo $shop->ProgramTitle;
                }
                    ?>
            </td>
            <td><?php  echo $offer->Title; ?></td>
            <td><?php  echo $offer->Description; ?></td>

            <?php
                if ( $offer->Code == '' ) { echo '<td>offer</td>'; }
                else { echo '<td>coupon</td>'; }
            ?>

            <?php
                if ( $offer->MinimumOrderValue == '' ) { echo '<td>Kein Mindestbestellwert</td>'; }
                else { echo '<td>'. $offer->MinimumOrderValue .',â€“ â‚¬</td>'; }
            ?>
            <td><?php echo date ("d.m.Y", strtotime($offer->StartDate) );  ?></td>
            <td><?php echo date ("d.m.Y", strtotime($offer->EndDate) ); ?></td>
            <?php
                if ( $offer->CustomerRestriction == 'OnlyNewCustomers' ) { echo '<td>Nur für Neukunden</td>'; }
                else { echo '<td>Neu- & Bestandskunden</td>'; }
            ?>
            <td><?php echo $offer->Code; ?></td>
            <td><?php echo $offer->IntegrationCode; ?></td>
        </tr>
        <?php
        }
        ?>
    </tbody>
</table>

<!--
<div class="float-box">
<h3>array</h3>
<?php //echo print_r($req2); ?>
</div>-->
</div><!-- wrap ende -->



<?php
// save copouns in DB
if ( isset( $_POST["import_affilinet_offers_in_db"]) ) {
	import_affilinet_offers();
}


} //function coupon_api() END

function coupon_api_zanox(){
  global $wpdb;
  global $xml_offers_zanox;
  global $api_programs_zanox;
  global $api_offers_affilinet;
    
?>

<div class="wrap">
  <!--<div id="message" class="updated success fade"></div>-->

  <div class="wrap-header">
    <h1><span class="dashicons dashicons-cloud"></span> Webservice</h1>
    <p class="description">Diese Gutscheine/Angebote wurden gerade per Service abgerufen und können von der aktuellen Datenbank abweichen!</p>


    <!--<p><a href="'.$href.'" target="_blank">Zanox XML feed Test</a></p>-->
  </div>

  <div id="nav">

    <a class="nav-tab" href="?page=coupon_api&amp;tab=afillinet">Affilinet (<span style="color:#689D00;"><?php echo count($api_offers_affilinet); ?></span>)</a>
    <span class="nav-tab nav-tab-active" >Zanox (<span style="color:#689D00;"><?php echo count($xml_offers_zanox); ?></span>)</span>

        <form method="POST" action="" >
      <input name="import_zanox_offers_in_db" class="button-primary" value="Daten in DB importieren" type="submit"/>
    </form>
  </div>

  <div>

  <?php



       // save Affilinet offers in DB
  if ( isset( $_POST["import_zanox_offers_in_db"]) ) {
         import_zanox_offers();
    }













  //foreach ($api_programs_zanox as $program) {
    //echo $program->programItem['id'];
    //echo $program->programItem->children( 'ns2', true )->name;
    //echo $program->programItem->children( 'ns2', true )->url;
    //echo $program->programItem->children( 'ns2', true )->status;
  //}
  ?>

    <?php
    //echo '<h3>### debug ###</h3>';
   // echo '<pre>'; print_r($xml_offers_zanox); echo '</pre>'; ?>

    </div>

        <?php //debug
        //
        //
        //if (import_zanox_offers) {

    //echo 'shopid ' . $offer->program['id'] . '<br/>'
    //   . 'title' . $title. '<br/>'
    //   . 'type'     . $type. '<br/>'
    //    . 'worth'    . $worth. '<br/>'
    //   . 'unit'     . $unit. '<br/>'
    //   . 'valid_from'     . $valid_from. '<br/>'
    //   . 'valid_to'     . $valid_to. '<br/>'
    //   . 'minimum_order_value'     . $minimum_order_value. '<br/>'
    //   . 'existing_customers'     . $existing_customers. '<br/>'
    //   . 'new_customers'     . $new_customers. '<br/>'
    //   . 'description'     . $description. '<br/>'
    //   . 'guide'     . $guide. '<br/>'
    //    . 'frame'    . $frame. '<br/>'
    //  . 'code'      . $code. '<br/>'
    //  . 'public'      . $public. '<br/><br/><br/><br/><br/>';


  //}
    ?>

<?php //echo '<pre>' ; print_r($xml_offers_zanox); echo '</pre>' ; ?>

  <table class="wp-list-table widefat striped gutscheine">
    <thead>
      <tr>
        <th>Shop ID (Zanox)</th>
        <th>Shop ID (SG)</th>

        <th>Shopname Sparfuchs</th>
        <th>Shopname</th>
        <th>Titel</th>
        <th>Beschreibung</th>
        <th>Art</th>
        <th>MB</th>
        <th>gültig von</th>
        <th>gültig bis</th>
        <th>Kunden</th>
        <th>Code</th>
        <th>Link</th>
      </tr>
    </thead>

    <tbody>
<?php
foreach ($xml_offers_zanox as $offer) {

    require 'prepare_the_coupon_title.php';

    $ProgramName = $offer->program;
    require '/homepages/40/d393556749/htdocs/Sparfuchs-Gutschein/wp-content/themes/sg/admin/prepare_the_shopnames.php';


    $zanox_program = $wpdb->get_results("SELECT ID FROM wp_posts
                                                                                WHERE post_title = '$ProgramName'
                                                                                AND post_type = 'post'
                                                                                AND post_status = 'publish'
                                                                                LIMIT 1");

    //if ( $offer->admedia->admediumItem->trackingLinks->trackingLink->ppc != ''  ){


      foreach ($zanox_program as $shop) {


?>

      <tr>
            <td><?php echo $offer->program['id']; ?></td>
            <td><?php echo $shop->ID;  ?></td>
            <td><?php echo $ProgramName; ?></td>
            <td><?php echo $offer->program; ?></td>
            <td><?php echo $offer->name; ?></td>
            <td><?php echo $offer->info4customer; ?></td>

            <?php
            if ($offer->couponCode == '') {
              echo '<td>offer</td>';
            } else {
              echo '<td>coupon</td>';
            }
            ?>

            <?php
            $offer->minimumBasketValue = str_replace(".0", "", $offer->minimumBasketValue);
            if ($offer->minimumBasketValue == '') {
              echo '<td>Kein Mindestbestellwert</td>';
            } else {
              echo '<td>' . $offer->minimumBasketValue . ',â€“ â‚¬</td>';
            }
            ?>
            <td><?php echo date("d.m.Y", strtotime($offer->startDate)); ?></td>
            <td><?php echo date("d.m.Y", strtotime($offer->endDate)); ?></td>
          <?php
          if ($offer->newCustomerOnly == 'true') {
            echo '<td>Nur für Neukunden</td>';
          } else {
            echo '<td>Neu- & Bestandskunden</td>';
          }
          ?>
            <td><?php echo $offer->couponCode; ?></td>
            <td><?php

                    $IntegrationCode = $offer->admedia->admediumItem->trackingLinks->trackingLink->ppc;

            if (empty($IntegrationCode)) {
                $static_url  = str_replace(" DE", "", $offer->program);
                $static_url  = strtolower($static_url);
                $IntegrationCode = "http://www." . $static_url . ".de";
                echo $IntegrationCode;
            } else {
                echo $IntegrationCode;
            }








            //echo $offer->admedia->admediumItem->trackingLinks->trackingLink->ppc; ?></td>
          </tr>
    <?php
    }
  }

  //   }
  ?>
      </tbody>
    </table>



    <?php //echo '<h3>### debug ###</h3>';
    //print_r($offers_zanox); ?>


</div><!-- wrap ende -->







<?php } //function coupon_api() END ?>
