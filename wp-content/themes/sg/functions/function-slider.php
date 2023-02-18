<?php // Slider für Startseite
    function get_slides() {
        global $wpdb;

        $slides = $wpdb->get_results("SELECT * FROM wp_slider WHERE active = '1' ORDER BY RAND() LIMIT 4");
        
        if (count($slides)) {
            foreach($slides as $slide) {
                echo '<a href="'.$slide->url.'"><img alt="'.$slide->img_alt.'" src="'.$slide->img_link.'"></a>';
            }
        } else {
            
            $ist  =  array('EXKLUSIV'                                               	, 'Rabatt '	        , '<span class="new-offer">NEU</span>'                          );
            $soll = array('<span class="ex">EXKLUSIV</span>', 'Rabatt </p><p class="slider-paragraph">', '');
            
            $sql = "SELECT * FROM awin_vouchers c
                JOIN wp_posts p
                WHERE c.Advertiser = 'Zooplus'
                OR c.Advertiser = 'Fressnapf'
								AND c.Type = 'voucher'
                ORDER BY c.Starts DESC
                LIMIT 5";
            $af_coupons = $wpdb->get_results($sql);
            
            if (count($af_coupons)) {
                foreach ($af_coupons as $offer){
                    $offer->title = str_replace($ist, $soll, $offer->Title);
                    include dirname(__FILE__).'/../templates/offers/offer-slider.php';
                };
            }
        }
        
    }
?>
