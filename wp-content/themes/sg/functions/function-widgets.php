<?php
  class Widget_Shop_info extends WP_Widget {
    
    function Widget_Shop_info() {
      $widget_ops = array('description' => 'Shop Info' );
      $this->WP_Widget('shop_info', 'Shop Info', $widget_ops);
    }
    
    function widget($args, $instance) {
      extract( $args );
      
      global $wpdb;
      global $post;
      
      $parent_title = get_the_title($post->post_parent);
      $permalink = get_permalink($post->ID);
      
      $shopname = str_replace('&#038;', 'und', $parent_title);
      
      echo '<div class="shop-meta style-a1" id="makescreenshot">';
      
      
      
      $sql = "SELECT * FROM awin_vouchers
                WHERE Advertiser LIKE '%{$shopname}%'
                AND type = 'voucher'
                LIMIT 1";
      $awinVouchers = $wpdb->get_row($sql);
      $LinkID = $awinVouchers->PromotionID;
      
      if (!empty($LinkID)) {
        echo '<a href="/go/aw?id=' . $awinVouchers->PromotionID . '" title="Direkt zu ' . $parent_title . '"  target="_blank">';
      }
      
      get_screenshot($post->post_name);
      
      if (!empty($LinkID)) {
        echo '</a>';
      }
      
      echo '</div>';
    }
  }
  
  
  
  class Widget_more_Shop_infos extends WP_Widget {
    
    function Widget_more_Shop_infos() {
      $widget_ops = array('description' => 'more Shop Infos' );
      $this->WP_Widget('more_Shop_Infos', 'more Shop Infos', $widget_ops);
    }
    
    function widget($args, $instance) {
      extract( $args );
      
      global $wpdb;
      
      $adresse = get_field( "adresse" );
      $kundendienst = get_field( "kundendienst" );
      $versand = get_field( "versand" );
      
      if( $adresse ) {
        echo '<div class="shop-meta style-a1">';
        echo '<p>Infos zum Shop</p>';
        echo '<ol>';
        echo '<li class="adresse">Anschrift:<address>' . $adresse . '</address></li>';
        if( $kundendienst ) { echo '<li class="service">' . $kundendienst . '</li>';}
        if( $versand ) { echo '<li class="versand">' . $versand . '</li>';}
        echo '</ol>';
        echo '<p>Alle Angaben ohne Gewähr!</p>';
        echo '</div>';
      }
    }
  }
  
  
  
  // Anleitung So funktionierts
  class Widget_Anleitung extends WP_Widget {
    
    function Widget_Anleitung() {
      $widget_ops = array('description' => 'So funktioniert es', 'classname' => 'video' );
      $this->WP_Widget('info', 'Anleitung', $widget_ops);
    }
    
    function widget($args, $instance) {
      extract( $args );
      $title = apply_filters('widget_title', empty($instance['title']) ? 'So funktioniert es' : $instance['title']);
      
      echo '<aside class="video style-a1">';
      echo $before_title . $title . $after_title;
      echo '<ol><li>1. Gutschein aussuchen</li><li>2. Gutscheincode einlösen</li><li>3. Geld sparen</li></ol><a class="an btn" href="/anleitung/">Anleitung</a>';
      echo '</aside>';
    }
  }
  
  
  // Anleitung im Shop
  class Widget_Guide extends WP_Widget {
    
    function Widget_Guide() {
      $widget_ops = array('guide' => 'Anleitung im Shop', 'classname' => 'text' );
      $this->WP_Widget('guide', 'Anleitung im Shop', $widget_ops);
    }
    
    function widget($args, $instance) {
      extract( $args );
      $title = apply_filters('widget_title', empty($instance['title']) ? 'Anleitung im Shop' : $instance['title']);
      $parent_title = get_the_title($post->post_parent);
      echo '<div class="text style-a1">';
      echo $before_title . $parent_title . ' Gutschein einlösen'. $after_title;
      echo '<ol><li>Trage den vorhandenen Gutscheincode im Bestellprozess in das entsprechende Feld.</li><li>Bestätige deine Eingabe.</li><li>Der Rabatt wird vom Gesamtbetrag abgezogen oder auf der Rechnung ausgewiesen.</li></ol>';
      echo '</div>';
    }
  }
  
  
  // Neuste Gutscheine Widget
  class Widget_Neuste_Gutscheine extends WP_Widget {
    
    function Widget_Neuste_Gutscheine() {
      $widget_ops = array('description' => 'Neuste Gutscheine in der Sidebar', 'classname' => 'g' );
      $this->WP_Widget('new-coupons', 'Neuste Gutscheine', $widget_ops);
    }
    
    function widget($args, $instance) {
      extract( $args );
      $title = apply_filters('widget_title', empty($instance['title']) ? 'Neuste Gutscheine' : $instance['title']);
      
      echo '<div class="new style-a1">';
      echo $before_title . $title . $after_title;
      
      echo '<ul class="g">';
      
      new_vouchers_sidebar();
      
      echo '</ul>';
      echo $after_widget;
    }
  }
  
  // Top Gutscheine Widget
  class Widget_Popular_Coupons extends WP_Widget {
    
    function Widget_Popular_Coupons() {
      $widget_ops = array('description' => 'Beliebteste Gutscheine in der Sidebar', 'classname' => 'g');
      $this->WP_Widget('pop-coupons', 'Beliebteste Gutscheine', $widget_ops);
    }
    
    function widget($args, $instance) {
      extract( $args );
      $title = apply_filters('widget_title', empty($instance['title']) ? 'Beliebteste Gutscheine' : $instance['title']);
      
      echo '<div class="pop style-a1">';
      echo $before_title . $title . $after_title;
      echo '<ul class="g">';
      top_vouchers_widget();
      echo '</ul>';
      echo '</div>';
    }
  }
  
  
  // Ähnliche Gutscheine Widget
  class Widget_Similar_Gutscheine extends WP_Widget {
    
    function Widget_Similar_Gutscheine() {
      $widget_ops = array('description' => 'Alternative Gutscheine in der Sidebar', 'classname' => 'g' );
      $this->WP_Widget('similar-coupons', 'Alternative Gutscheine', $widget_ops);
    }
    
    function widget($args, $instance) {
      extract( $args );
      $title = apply_filters('widget_title', empty($instance['title']) ? 'Alternative Gutscheine' : $instance['title']);
      
      echo '<div class="similar style-a1">';
      echo $before_title . $title . $after_title;
      
      global $wpdb;
      
      
      
      $table_name_shops  = $wpdb->prefix . "gutschein_feed_shops";
      $table_name_offers = $wpdb->prefix . "gutschein_feed_offers";
      
      $gf_listed = (get_option('gf_listed') != '') ? get_option('gf_listed') : 2;
      
      global $post;
      $cID = get_the_category($post->ID);
      $cID = $cID[0]->term_id;
      $ID = get_the_ID();
      
      
      $sql = "SELECT post_title FROM $wpdb->posts
						LEFT JOIN $wpdb->term_relationships ON
						($wpdb->posts.ID = $wpdb->term_relationships.object_id)
						LEFT JOIN $wpdb->term_taxonomy ON
						($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
						WHERE NOT $wpdb->posts.ID = $ID
						AND $wpdb->posts.post_status = 'publish'
						AND $wpdb->term_taxonomy.taxonomy = 'category'
						AND $wpdb->term_taxonomy.term_id = $cID
						ORDER BY post_date ASC LIMIT 8";
      
      $results = $wpdb->get_col($sql);
      $results = implode("','", $results);
      
      $sql = "SELECT DISTINCT pm.meta_value
FROM $wpdb->postmeta pm
JOIN $wpdb->posts p ON (p.ID = pm.post_id)
WHERE pm.meta_key = 'gf_shopdomain'
AND p.post_type = 'post'
AND p.post_title in ('$results')
AND p.post_status = 'publish'";
      
      $domains = $wpdb->get_col($sql);
      $domains = implode("','", $domains);
      
      $sql = "SELECT o.*, s.*
FROM $table_name_offers o
LEFT JOIN $table_name_shops s ON (s.id = o.shopid)
WHERE s.shopdomain in ('$domains')
  AND o.type = 'voucher'
ORDER BY o.valid_from DESC LIMIT 8";
      
      $offers = $wpdb->get_results($sql);
      
      echo '<ul class="g">';
      
      foreach ($offers as $offer) {
        $post_url = get_permalink(gf_get_post_for_shop($offer->shopdomain));
        $name = str_replace('&', '&amp;', $offer->shopname);
        
        $searchlogo = array("&", " ", ".", "&#038;");
        $replacelogo = array("-und-", "-", "-", "-und-");
        
        $shopnamelogo = strtolower(str_replace($searchlogo, $replacelogo, $offer->shopname));
        
        
        echo '<li><a href="' . $post_url . '" title="Alle ' . $name . ' Gutscheincodes">';?>
          <img alt="<?php echo $name ?> Gutscheincode" src="http://i.sparfuchs-gutschein.de/<?php echo $shopnamelogo; ?>-logo.png" title="<?php echo $name ?> Codes"/>
        <?php
        echo '</a> ' . $name . '<span>' . $offer->title . '</span></li>';
      }
      
      echo '</ul>';
      echo $after_widget;
      
    }
  }
  
  
  // Geschenkgutschein
  class Widget_Geschenkgutschein extends WP_Widget {
    
    function Widget_Geschenkgutschein() {
      $widget_ops = array('description' => 'Geschenkgutschein' );
      $this->WP_Widget('Geschenkgutschein', 'Geschenkgutschein', $widget_ops);
    }
    
    function widget($args, $instance) {
      extract( $args );
      $title = apply_filters('widget_title', empty($instance['title']) ? 'Geschenkgutschein' : $instance['title']);
      
      global $wpdb;
      $parent_title = get_the_title($post->post_parent);
      
      $ID = get_the_ID();
      $sql = "SELECT * FROM wp_coupons WHERE shopid = $ID AND public = 1 AND type = 'gift' LIMIT 1";
      $coupons = $wpdb->get_results($sql);
      
      if (count($coupons)) {
        echo '<div class="similar gift style-a1">';
        echo $before_title . $parent_title . ' '. $title . $after_title;
        foreach ($coupons as $offer):
          //$offer->title = ereg_replace("[^0-9]", "", $offer->title);
          include dirname(__FILE__).'/../templates/offers/offer-gift.php';
        endforeach;
        echo $after_widget;
      }
    }
  }
  
  
  
  
  // Amazon Top Selller
  class Widget_Amazon_Top_Seller extends WP_Widget {
    
    function Widget_Amazon_Top_Seller() {
      $widget_ops = array('description' => 'Amazon Top Seller' );
      $this->WP_Widget('Amazon_Top_Seller', 'Amazon Top Seller', $widget_ops);
    }
    
    function widget($args, $instance) {
      extract( $args );
      $title = apply_filters('widget_title', empty($instance['title']) ? 'Amazon Top Selller' : $instance['title']);
      
      global $wpdb;
      $parent_title = get_the_title($post->post_parent);
      
      if ($parent_title == 'Amazon') { ?>
          <div class="text">
              <SCRIPT charset="utf-8" type="text/javascript" src="http://ws-eu.amazon-adsystem.com/widgets/q?ServiceVersion=20070822&MarketPlace=DE&ID=V20070822%2FDE%2Fesurf01-21%2F8009%2F8ff20623-23d5-4964-9b62-3d5794dded1f&Operation=GetScriptTemplate"> </SCRIPT> <NOSCRIPT><A HREF="http://ws-eu.amazon-adsystem.com/widgets/q?ServiceVersion=20070822&MarketPlace=DE&ID=V20070822%2FDE%2Fesurf01-21%2F8009%2F8ff20623-23d5-4964-9b62-3d5794dded1f&Operation=NoScript">Amazon.de Widgets</A></NOSCRIPT>
              <SCRIPT charset="utf-8" type="text/javascript" src="http://ws-eu.amazon-adsystem.com/widgets/q?ServiceVersion=20070822&MarketPlace=DE&ID=V20070822%2FDE%2Fesurf01-21%2F8009%2F3a8617e0-9931-49c8-8b4c-76f018540cf6&Operation=GetScriptTemplate"> </SCRIPT> <NOSCRIPT><A HREF="http://ws-eu.amazon-adsystem.com/widgets/q?ServiceVersion=20070822&MarketPlace=DE&ID=V20070822%2FDE%2Fesurf01-21%2F8009%2F3a8617e0-9931-49c8-8b4c-76f018540cf6&Operation=NoScript">Amazon.de Widgets</A></NOSCRIPT>
              <SCRIPT charset="utf-8" type="text/javascript" src="http://ws-eu.amazon-adsystem.com/widgets/q?ServiceVersion=20070822&MarketPlace=DE&ID=V20070822%2FDE%2Fesurf01-21%2F8009%2F148ebced-bfe5-4780-8a07-6798d465763a&Operation=GetScriptTemplate"> </SCRIPT> <NOSCRIPT><A HREF="http://ws-eu.amazon-adsystem.com/widgets/q?ServiceVersion=20070822&MarketPlace=DE&ID=V20070822%2FDE%2Fesurf01-21%2F8009%2F148ebced-bfe5-4780-8a07-6798d465763a&Operation=NoScript">Amazon.de Widgets</A></NOSCRIPT>
          </div>
        <?php
      }
      
      
    }
  }
  
  
  
  // facebook like box sidebar widget
  class Widget_Facebook extends WP_Widget {
    
    function Widget_Facebook() {
      $widget_ops = array( 'description' => 'This places a Facebook page Like Box in your sidebar to attract and gain Likes from visitors.');
      $this->WP_Widget(false, 'Facebook Like Box', $widget_ops);
    }
    
    function widget( $args, $instance ) {
      
      extract($args);
      
      $title = apply_filters('widget_title', empty($instance['title']) ? 'Echte Sparfüchse' : $instance['title']);
      
      
      echo '<div class="social style-a1">';
      
      echo $before_title . $title . $after_title;
      
      //echo '<div id="social-active">
      
      //<label class="switch">
      //<input class="switch-input" id="an" name="social" value="an" type="checkbox">
      //<span id="switch-del" class="switch-label" data-on="An" data-off="Aus"></span>
      //<span id="switch-delete" class="switch-handle"></span>
      //</label>
      
      //<span>Soziale Netzwerke</span>

//</div>';
      //echo '<div id="lk"></div>';
      //echo '<div id="fb-root"></div>
//<script>(function(d, s, id) {
      //var js, fjs = d.getElementsByTagName(s)[0];
      //if (d.getElementById(id)) return;
      //js = d.createElement(s); js.id = id;
      //js.src = "//connect.facebook.net/de_DE/sdk.js#xfbml=1&version=v2.8";
      //fjs.parentNode.insertBefore(js, fjs);
//}(document, "script", "facebook-jssdk"));</script>';
      
      echo '<div id="fb-root"></div>
            <script
                async
                defer
                crossorigin="anonymous"
                src="https://connect.facebook.net/de_DE/sdk.js#xfbml=1&version=v8.0&appId=513651062023934"
                nonce="MEGXHkXG">
            </script>';
      
      echo '<div class="fb-page" data-href="https://www.facebook.com/SparfuchsGutschein/" data-tabs="" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/SparfuchsGutschein/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/SparfuchsGutschein/">Sparfuchs-Gutschein.de</a></blockquote></div>';
      
      
      echo '</div>';
    }
    
    function form($instance) {
      $defaults = array( 'title' => 'Echts Sparfüchse');
      $instance = wp_parse_args( (array) $instance, $defaults );
    }
  }
  
  
  
  // Werbung Affiliate
  class Widget_Werbung_Affiliate extends WP_Widget {
    
    function Widget_Werbung_Affiliate() {
      $widget_ops = array('description' => 'Werbung Affiliate' );
      $this->WP_Widget('Affiliate', 'Werbung Affiliate', $widget_ops);
    }
    
    function widget($args, $instance) {
      extract( $args );
      $title = apply_filters('widget_title', empty($instance['title']) ? 'sheego Aktion' : $instance['title']);
      
      echo '<div class="aktion style-a1">';
      
      $aff_link = '<a href="http://partners.webmasterplan.com/click.asp?ref=610469&site=5860&type=b120&bnb=120" target="_blank"><img class="i" src="http://i.sparfuchs-gutschein.de/blank.png" data-src="http://banners.webmasterplan.com/view.asp?ref=610469&site=5860&b=120" alt="sheego.de"/></a>';
      echo str_replace('&', '&amp;', $aff_link);
      echo '</div>';
    }
  }
  
  
  // register the custom sidebar widgets
  function widgets_init() {
    register_widget('Widget_Anleitung');
    register_widget('Widget_Guide');
    register_widget('Widget_Facebook');
    register_widget('Widget_Shop_Info');
    register_widget('Widget_more_Shop_Infos');
    register_widget('Widget_Neuste_Gutscheine');
    register_widget('Widget_Popular_Coupons');
    register_widget('Widget_Similar_Gutscheine');
    //register_widget('Widget_Geschenkgutschein');
    register_widget('Widget_Werbung_Affiliate');
    //register_widget('Widget_Amazon_Top_Seller');
    
    do_action('widgets_init');
  }
  add_action('init', 'widgets_init', 1);
  
  
  
  function unregister_widgets() {
    unregister_widget('WP_Widget_Pages');
    unregister_widget('WP_Widget_Calendar');
    unregister_widget('WP_Widget_Archives');
    unregister_widget('WP_Widget_Links');
    unregister_widget('WP_Widget_Categories');
    unregister_widget('WP_Widget_Recent_Posts');
    unregister_widget('WP_Widget_Search');
    unregister_widget('WP_Widget_Tag_Cloud');
  }
  add_action('widgets_init', 'unregister_widgets');
?>
