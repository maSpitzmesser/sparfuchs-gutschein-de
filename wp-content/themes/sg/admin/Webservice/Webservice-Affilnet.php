<?php
    $Username = '610469';                                // the publisher ID
    $Password  = '22NsIgsJQiypfqbDC9pu';    // the publisher web service password

    define ("WSDL_LOGON", "https://api.affili.net/V2.0/Logon.svc?wsdl");
    $SOAP_LOGON = new SoapClient(WSDL_LOGON);
    $Token = $SOAP_LOGON->Logon(array(
        'Username'  => $Username,
        'Password'  => $Password,
        'WebServiceType' => 'Publisher',
        'DeveloperSettings' => $DeveloperSettings
    ));

    define ("WSDL_WS",  "https://api.affili.net/V2.0/PublisherInbox.svc?wsdl");
    $SOAP_REQUEST = new SoapClient(WSDL_WS);
    $params = array(
        'ProgramPartnershipStatus' => 'Accepted'
    );

    $DisplaySettings = array (
        'PageSize' => 1000,
        'CurrentPage' => 1
    );

    $affilinet = $SOAP_REQUEST->SearchVoucherCodes(array(
        'CredentialToken' => $Token,
        'SearchVoucherCodesRequestMessage' => $params,
        'DisplaySettings' => $DisplaySettings
    ));

    $affilinet_offers = $affilinet->VoucherCodeCollection->VoucherCodeItem;
    $api_offers_affilinet = $affilinet->VoucherCodeCollection->VoucherCodeItem;


  // save Affilinet offers in DB
    function import_affilinet_offers() {
        global $wpdb;
        global $api_offers_affilinet;

        $delet_table_af_coupons = $wpdb->query("TRUNCATE af_coupons");
        usleep(500);

        if ($delet_table_af_coupons) {

        foreach ($api_offers_affilinet as $offer) {


            $OfferTitle = $offer->Title;

            if ( ($offer->ProgramId == '8040') || ($offer->ProgramId == '9190') ) {
                $offer->Title = $offer->Description;
            } else {
               $OfferTitle = $offer->Title;
            }



            require '/homepages/40/d393556749/htdocs/Sparfuchs-Gutschein/wp-content/themes/sg/admin/prepare_the_coupon_title.php';

            $title = $OfferTitle;

            $code = $offer->Code;

            if ( empty ($code) ) {
                $type = 'offer';
            } else {
                $type = 'coupon';
            }

            $worth = '0';
            $unit = '%';

            $valid_from = date ("Y-m-d", strtotime($offer->StartDate) );
            $valid_to      = date ("Y-m-d", strtotime($offer->EndDate) );

            if ( $valid_to === '' ) {
                $valid_to = NULL;
             }


            $minimum_order_value = $offer->MinimumOrderValue;

            if ( $offer->CustomerRestriction == 'AllCustomers' ) {
                $new_customers = 'YES';
                $existing_customers = 'YES';
            }
            else if ( $offer->CustomerRestriction == 'OnlyNewCustomers' ) {
                $new_customers = 'YES';
                $existing_customers = 'NO';
            }
            else if ( $offer->CustomerRestriction == 'OnlyExistCustomers' ) {
                $new_customers = 'NO';
                $existing_customers = 'YES';
            } else {
                $new_customers = 'YES';
                $existing_customers = 'NO';
            }

            $description = '';

            $guide = '';

            $IntegrationCode = $offer->IntegrationCode;
            // get link without html
            preg_match_all('/href=[\'"]?([^\s\>\'"]*)[\'"\>]/',  $IntegrationCode, $matches);
            $IntegrationCode = ($matches[1] ? $matches[1] : false);
            $IntegrationCode  = $IntegrationCode[0];

            $frame = '0';
            $public = '1';

            $af_shops = $wpdb->get_results("SELECT ID FROM af_shops WHERE ProgramId = '$offer->ProgramId' LIMIT 1");

            foreach ($af_shops as $af_shop) {
                $af_shop_ID = $af_shop->ID;
                $wpdb->query("INSERT INTO af_coupons
                (id, shopid, title, type, worth, unit, valid_from, valid_to, minimum_order_value, existing_customers, new_customers, description, guide, forwardlink, frame, code,public)
                VALUES (NULL, '$af_shop_ID', '$title', '$type', '$worth', '$unit', '$valid_from', '$valid_to', '$minimum_order_value', '$existing_customers', '$new_customers', '$description', '$guide', '$IntegrationCode', '$frame', '$code' , '$public')");
            }

        }
    }





} ?>
