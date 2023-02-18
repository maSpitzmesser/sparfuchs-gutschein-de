<?php
	// Gutscheine
	function get_vouchers($postid) {
		global $wpdb;

		$post = get_post( $postid );
		$postName = $post->post_title;

		$headline          = '<h2 class="headline-a2 article-title">' . get_the_title($postid) .' Gutscheincodes ' . strftime("%B %Y") . '</h2>';
		$ul_before_coupons = '<ul class="c" id="Gutscheine">';
		$ul_after          = '</ul>';

		$sql = "SELECT * FROM awin_vouchers
						WHERE Advertiser LIKE '%{$postName}%'
						AND type = 'voucher'
						LIMIT 40";
		$awin_vouchers = $wpdb->get_results($sql);

		if ( count($awin_vouchers) )  {
			echo $headline;
			echo $ul_before_coupons;

			foreach ($awin_vouchers as $offer){
				$offer->title = str_replace($ist, $soll, $offer->title);
				include dirname(__FILE__).'/../templates/offers/offer-awin.php';
			};

			echo $ul_after;
		}
	}


	// Rabatte
	function get_shop_offers($postid) {
		global $wpdb;

		$post = get_post( $postid );
		$postName = $post->post_title;

		$ul_before_offers = '<ul class="c" id="Rabatte">';
		$ul_after_offers  = '</ul>';

		$sql = "SELECT * FROM awin_vouchers
						WHERE Advertiser LIKE '%{$postName}%'
						AND type = 'promotion'
						LIMIT 40";
		$awin_vouchers = $wpdb->get_results($sql);

    if ( count($awin_vouchers) )  {
      echo $ul_before_offers;
      echo '<h2 class="headline-a2 article-title">Aktuelle Rabatte bei ' . $post->post_title . ' </h2>';

      foreach ($awin_vouchers as $offer){
        $offer->title = str_replace($ist, $soll, $offer->title);
        include dirname(__FILE__).'/../templates/offers/offer-awin.php';
      };

      echo $ul_after_offers;
    }

    else {
      //echo'<br/><p class="noc">Leider gibt es im Moment keine besonderen Rabatte :-(</p><br/>';
    }

	}



	function cat_vouchers_widget($category){
		global $wpdb;

		$query = "SELECT post_name FROM $wpdb->posts
            LEFT JOIN $wpdb->term_relationships ON ($wpdb->posts.ID = $wpdb->term_relationships.object_id)
            LEFT JOIN $wpdb->term_taxonomy ON ($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
            WHERE $wpdb->posts.post_status = 'publish'
            AND $wpdb->term_taxonomy.taxonomy = 'category'
            AND $wpdb->term_taxonomy.term_id = $category";
		$results = $wpdb->get_col($query);
		$implodeshops = implode("','", $results);

		$sql = "SELECT * FROM awin_vouchers
            WHERE Shopname in ('$implodeshops')
            ORDER BY Ends DESC
            LIMIT 5";

		$offers = $wpdb->get_results($sql);

		echo '<ul class="g">';
		foreach ($offers as $offer) {
			include dirname(__FILE__).'/../templates/offers/offer-sidebar.php';
		}
		echo '</ul>';
	}




	function top_vouchers_site(){
		global $wpdb;

		$sql = "SELECT * FROM awin_vouchers v
            JOIN awin_vouchers_used u ON (v.PromotionID = u.PromotionID)
            WHERE v.Type = 'voucher'
            ORDER BY Clicks DESC
            LIMIT 50";

		$offers = $wpdb->get_results($sql);

		foreach ($offers as $offer) {
			include dirname(__FILE__).'/../templates/offers/offer-awin.php';
		}
	}

	function top_vouchers_widget(){
		global $wpdb;

		$sql = "SELECT * FROM awin_vouchers v
            JOIN awin_vouchers_used u ON (v.PromotionID = u.PromotionID)
            WHERE v.Type = 'voucher'
            ORDER BY Clicks DESC
            LIMIT 50";

		$offers = $wpdb->get_results($sql);

		foreach ($offers as $offer) {
			include dirname(__FILE__).'/../templates/offers/offer-sidebar.php';
		}
	}


	function top_shops_widget(){
		global $wpdb;

		$sql = "SELECT p.ID
                FROM $wpdb->postmeta pm
                JOIN $wpdb->posts p ON (p.ID = pm.post_id)
                WHERE pm.meta_key = 'gf_top_shop'
                AND pm.meta_value = 1
                AND p.post_type = 'post'
                AND p.post_status = 'publish'";

		$post_name = $wpdb->get_col($sql);
		$post_name = implode(',', $post_name);

		$sql = "SELECT *
			FROM $wpdb->posts
			WHERE post_name IN ($post_name)
			LIMIT 5";

		$top_shops = $wpdb->get_col($sql);



		$offers = array();
		foreach ($top_shops as $top_shop) {

			$sql = "SELECT *
						FROM awin_vouchers
						WHERE Shopname = '$top_shop'
						AND Title NOT LIKE '%Newsletteranmeldung%'
						ORDER BY Ends DESC";


			$sql .= " LIMIT 1";

			$offers[] = $wpdb->get_row($sql);
		}

		foreach ($offers as $offer) {
			$shopname = $offer->post_title;
			include dirname(__FILE__).'/../templates/offers/offer-sidebar.php';
		}

	}



	function new_vouchers_site(){
		global $wpdb;

		$sql = "SELECT DISTINCT * FROM awin_vouchers c
                JOIN wp_posts p
                WHERE c.Advertiser = p.post_title
								AND c.Type = 'voucher'
								AND p.post_status = 'publish'
                ORDER BY c.Starts DESC
                LIMIT 40";
		$coupons = $wpdb->get_results($sql);

		foreach ($coupons as $offer) {
			$shopname = $offer->post_title;
			include dirname(__FILE__).'/../templates/offers/offer-nolink.php';
		};
	}



	function new_vouchers_sidebar(){
		global $wpdb;

		$sql = "SELECT DISTINCT * FROM awin_vouchers c
                JOIN wp_posts p
                WHERE c.Advertiser = p.post_title
								AND c.Type = 'voucher'
								AND p.post_status = 'publish'
                ORDER BY c.Starts DESC
                LIMIT 5";
		$coupons = $wpdb->get_results($sql);

		foreach ($coupons as $offer) {
			$shopname = $offer->post_title;
			include dirname(__FILE__).'/../templates/offers/offer-sidebar.php';
		};
	}

	function new_vouchers_widget(){
		global $wpdb;

		$sql = "SELECT DISTINCT * FROM awin_vouchers c
                JOIN wp_posts p
                WHERE c.Advertiser = p.post_title
								AND c.Type = 'voucher'
								AND p.post_status = 'publish'
                ORDER BY c.Starts DESC
                LIMIT 5";
		$coupons = $wpdb->get_results($sql);

		foreach ($coupons as $offer) {
			$ist = array('-', 'Euro', 'EXKLUSIV', 'Exklusiver');
			$soll = array('&#8209;', '&euro;', '<span class="ex">EXKLUSIV</span>', '<span class="ex">EXKLUSIV</span>');
			$offer->post_title = str_replace($ist, $soll, $offer->post_title);
			$shopname = $offer->post_title;
			include dirname(__FILE__).'/../templates/offers/offer-small.php';
		};
	}



	function gesch_vouchers() {
		global $wpdb;
		$sql = "SELECT * FROM wp_coupons c
							JOIN wp_posts p ON (p.ID = c.shopid)
							WHERE type = 'gift'
							AND public = 1
							ORDER BY RAND()
							LIMIT 40";
		$coupons = $wpdb->get_results($sql);
		foreach ($coupons as $offer) {
			$shopname = $offer->post_title;
			include dirname(__FILE__).'/../templates/offers/offer-gift-big.php';
		};
	}


	function free_gifts_site() {
		global $wpdb;
		$sql = "SELECT * FROM wp_coupons2 c
							JOIN wp_posts p ON (p.ID = c.shopid)
							WHERE type = 'free product'
							AND p.post_status = 'publish'
							AND public = 1";


		$sql .= " LIMIT 11";


		$coupons = $wpdb->get_results($sql);

		foreach ($coupons as $offer) {
			$shopname = $offer->post_title;
			if (is_front_page() ) {
				$ist = array('-', 'Euro', 'EXKLUSIV');
				$soll = array('&#8209;', '&euro;', '<span class="ex">EXKLUSIV</span>');
				$offer->title = str_replace($ist, $soll, $offer->title);

				$search = array("ü","´", "Euro", ".");
				$replace = array("ue","'", "&euro;", ".");
				$offer->shopname = str_replace($search, $replace, $offer->post_title);

				$search =      array(" ", ".", "&#038;", "`", "'", "ö", "ü", "ä");
				$replacelogo = array("-", "-", "-und-" , "-", "-", "oe", "ue", "ae");
				$shopnamelogo = strtolower(str_replace($search, $replacelogo, $shopname));
			}

			include dirname(__FILE__).'/../templates/offers/offer-nolink.php';


		};
	}
	function free_gifts_sidebar() {
		global $wpdb;
		$sql = "SELECT * FROM wp_coupons2 c
							JOIN wp_posts p ON (p.ID = c.shopid)
							WHERE type = 'free product'
							AND p.post_status = 'publish'
							AND public = 1 LIMIT 5";

		$coupons = $wpdb->get_results($sql);

		foreach ($coupons as $offer) {
			$shopname = $offer->post_title;
			if (is_front_page() ) {
				$ist = array('-', 'Euro', 'EXKLUSIV');
				$soll = array('&#8209;', '&euro;', '<span class="ex">EXKLUSIV</span>');
				$offer->title = str_replace($ist, $soll, $offer->title);

				$search = array("ü","´", "Euro", ".");
				$replace = array("ue","'", "&euro;", ".");
				$offer->shopname = str_replace($search, $replace, $offer->post_title);

				$search =      array(" ", ".", "&#038;", "`", "'", "ö", "ü", "ä");
				$replacelogo = array("-", "-", "-und-" , "-", "-", "oe", "ue", "ae");
				$shopnamelogo = strtolower(str_replace($search, $replacelogo, $shopname));
			}
			include dirname(__FILE__).'/../templates/offers/offer-sidebar.php';
		};
	}


	function free_gifts_widget() {
		global $wpdb;
		$sql = "SELECT * FROM wp_coupons2 c
							JOIN wp_posts p ON (p.ID = c.shopid)
							WHERE type = 'free product'
							AND p.post_status = 'publish'
							AND public = 1 LIMIT 5";

		$coupons = $wpdb->get_results($sql);

		foreach ($coupons as $offer) {
			$shopname = $offer->post_title;
			if (is_front_page() ) {
				$ist = array('-', 'Euro', 'EXKLUSIV');
				$soll = array('&#8209;', '&euro;', '<span class="ex">EXKLUSIV</span>');
				$offer->title = str_replace($ist, $soll, $offer->title);

				$search = array("ü","´", "Euro", ".");
				$replace = array("ue","'", "&euro;", ".");
				$offer->shopname = str_replace($search, $replace, $offer->post_title);

				$search =      array(" ", ".", "&#038;", "`", "'", "ö", "ü", "ä");
				$replacelogo = array("-", "-", "-und-" , "-", "-", "oe", "ue", "ae");
				$shopnamelogo = strtolower(str_replace($search, $replacelogo, $shopname));
			}
			include dirname(__FILE__).'/../templates/offers/offer-small.php';
		};
	}


	function expire_vouchers_site() {
		global $wpdb;
		$sql = "SELECT * FROM awin_vouchers c
						JOIN wp_posts p
						WHERE c.Advertiser = p.post_title
						AND c.Type = 'voucher'
						AND p.post_status = 'publish'
						ORDER BY c.Ends ASC";

		$coupons = $wpdb->get_results($sql);

		foreach ($coupons as $offer) {
			$shopname = $offer->post_title;
			$offer->title = str_replace($ist, $soll, $offer->title);
			include dirname(__FILE__).'/../templates/offers/offer-nolink.php';
		};
	}

	function expire_vouchers_widget() {
		global $wpdb;
		$sql = "SELECT * FROM awin_vouchers c
                JOIN wp_posts p
                WHERE c.Advertiser = p.post_title
								AND c.Type = 'voucher'
								AND p.post_status = 'publish'
                ORDER BY c.Ends ASC LIMIT 5";

		$coupons = $wpdb->get_results($sql);

		foreach ($coupons as $offer) {
			$shopname = $offer->post_title;
			include dirname(__FILE__).'/../templates/offers/offer-small.php';
		};
	}



	function get_logo_by_coupon($shopname) {
		echo '<img data-funk="get_logo_by_coupon" alt="' . $shopname . ' Gutscheincode" src="https://sparfuchs-gutschein.de/wp-content/themes/sg/images/shop_logos/' . $shopname . '-logo.png" title="' . $shopname . '"/>';
	}
	function get_logo($shopname) {
		$parent_title = get_the_title($post->post_parent);
		$search = array(" ", ".", "&#038;", "`", "'", "ö", "ü", "ä");
		$replacelogo = array("-", "-", "-und-" , "-", "-", "oe", "ue", "ae");
		$shopname = urldecode(strtolower(str_replace($search, $replacelogo, $parent_title)));
		echo '<img data-funk="get_logo" alt="' . $shopname . ' Gutscheincode" src="https://sparfuchs-gutschein.de/wp-content/themes/sg/images/shop_logos/' . $shopname . '-logo.png" title="' . $shopname . '" itemprop="image"/>';
	}

	function get_logo_lazy_offer($shopname, $offerTitle) {
		$parent_title = get_the_title($post->post_parent);
		$search = array(" ", ".", "&#038;", "`", "'", "ö", "ü", "ä");
		$replacelogo = array("-", "-", "-und-" , "-", "-", "oe", "ue", "ae");
		$shopname = urldecode(strtolower(str_replace($search, $replacelogo, $parent_title)));

		echo '<img loading="lazy" data-funk="get_logo_lazy_offer" class="i" alt="' . strip_tags($offerTitle) . '" src="https://sparfuchs-gutschein.de/wp-content/themes/sg/images/shop_logos/' . $shopname . '-logo.png" title="' . $shopname . '" itemprop="image"/>';
		//echo '<noscript><img src="https://sparfuchs-gutschein.de/wp-content/themes/sg/images/shop_logos/' . $shopname . '-logo.png" alt="' . strip_tags($offerTitle) . '" /></noscript>';
	}
	function get_logo_lazy($shopname) {
		$parent_title = get_the_title($post->post_parent);
		$search = array(" ", ".", "&#038;", "`", "'", "ö", "ü", "ä");
		$replacelogo = array("-", "-", "-und-" , "-", "-", "oe", "ue", "ae");
		$shopname = urldecode(strtolower(str_replace($search, $replacelogo, $parent_title)));

		echo '<img loading="lazy" data-funk="get_logo_lazy" class="i" alt="' . $shopname . ' Gutscheine" src="https://sparfuchs-gutschein.de/wp-content/themes/sg/images/shop_logos/' . $shopname . '-logo.png" title="' . $shopname . '" itemprop="image"/>';
		//echo '<noscript><img src="https://sparfuchs-gutschein.de/wp-content/themes/sg/images/shop_logos/' . $shopname . '-logo.png" alt="' . strip_tags($offerTitle) . '" /></noscript>';
	}


	function _get_screenshot($shopname) {
		echo '<img itemprop="image" src="/wp-content/themes/sg/images/shop_logos/screenshots/' . $shopname . '.jpg" alt="' . $shopname . '" title="' . $shopname . ' durchstöbern"/>';
	}


	function get_screenshot($shopname) {
		global $wpdb;
		$domain = get_post_meta(get_the_ID(), 'gf_shopdomain',  true);

		if (empty($domain)) {
			$domain = $shopname .  '.de';
		}

		$mshot = 'https://s0.wordpress.com/mshots/v1/' . $domain . '?w=300';
		$ch = curl_init('https://sparfuchs-gutschein.de/wp-content/themes/sg/images/shop_logos/screenshots/' . $shopname . '.jpg');

		curl_setopt($ch, CURLOPT_NOBODY, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
		curl_exec($ch);
		$retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

		if($retcode==200) {
			echo '<img loading="lazy" itemprop="image" src="/wp-content/themes/sg/images/shop_logos/screenshots/' . $shopname . '.jpg" alt="' . $shopname . '" title="' . $shopname . ' durchstöbern"/>';
		} else {
			echo '<img loading="lazy" id="screenshot" itemprop="image" alt="' . $shopname . ' Webseite" src="' . $mshot . '" title="' . $shopname . ' durchstöbern"/>';
		}
	}





	function countdown($valid_to) {
		setlocale(LC_TIME, "de_DE.utf8");
		$text                           = 'Gültig bis: ';
		$html_before_count = '<span class="count" title="Gültig bis:' . htmlentities( strftime(' %d.%B.%Y', strtotime( date('d F Y', strtotime($valid_to))))) . '">';
		$html_before_date   = '<span class="vato">';
		$html_after               = '</span>';

		if ( !empty($valid_to) ) {

			echo '<meta itemprop="endDate" content="' . htmlentities( strftime('%Y-%m-%d', strtotime( date('d.F.Y', strtotime($valid_to))))) . '" />';

			$offerEnds = new DateTime($valid_to);
			$now = new DateTime();
			$diff = $offerEnds->diff($now);
			$days = $diff->days + 1;

			$hours = date("h") + 2;


			if ( ($days == 0) && ( $hours < 10 )   ){
				echo $html_before_count . 'Noch wenige Stunden!' . $html_after;
			}
			elseif ($days == 1) {
				//echo $html_before_count . 'Nur noch 1 Tag!' . $html_after;
				echo $html_before_count . 'Nur noch Heute!' . $html_after;
			}
			elseif ($days == 2) {
				echo $html_before_count . 'Nur noch 2 Tage!' . $html_after;
			}
			else {
				if ( date('F', strtotime($valid_to)) == date('F') ) {
					$valid_to = htmlentities( strftime(' %d.%B %Y', strtotime( date('d F Y', strtotime($valid_to)))));
					echo $html_before_date . 'Nur noch bis ' . $valid_to . ' gültig!' . $html_after;
				} else {
					$valid_to = htmlentities( strftime(' %d.%B %Y', strtotime( date('d F Y', strtotime($valid_to)))));
					echo $html_before_date . $text . $valid_to . $html_after;
				}
			}
		} else {
			echo $html_before_date . 'Aktuell noch gültig!' . $html_after;
		}
	}


	function new_offers_ribbon($valid_from) {

		$valid_from = date("Ymd", strtotime($valid_from));
		$today  = date("Ymd");
		if ( ($valid_from == $today) || ($valid_from == 1) || ($valid_from == 2 ) ){
			echo '<span class="new-offer">NEU</span>';
		}
	}










	function get_vouchers_update($postid) {
		global $wpdb;
		$sql = "SELECT * FROM awin_vouchers c
							JOIN wp_posts p
							WHERE p.ID = c.shopid
                            AND type = 'coupon'
							AND public = '1'
									 ORDER BY Starts DESC LIMIT 1";
		$updates = $wpdb->get_results($sql);
		foreach ($updates as $update) {
			echo  '<time class="updated entry-date" datetime="' . htmlentities( strftime('%Y-%m-%d', strtotime( date('d.F.Y', strtotime($update->valid_from))))) . '">' . htmlentities( strftime(' %d. %B %Y', strtotime( date('d.F.Y', strtotime($update->valid_from))))) . '</time>';
		}
	}


	function get_clicks_used($promotionID) {
		global $wpdb;
		$sql   = "SELECT Clicks FROM awin_vouchers_used WHERE PromotionID = $promotionID LIMIT 1";
		$count = $wpdb->get_var($sql);
		if ($count) {
			echo '<span class="used">'. $count .'x mal genutzt</span>';
		}
	}


	// COUNTS
	function count_new_coupons() {
		global $wpdb;
		$new_af_offers  = $wpdb->get_var("SELECT count(id) FROM awin_vouchers WHERE Starts = CURDATE()");
		$gesamt = $new_af_offers;
		echo $gesamt;
	}


	function count_all_coupons() {
		global $wpdb;
		$all_af_offers  = $wpdb->get_var("SELECT count(id) FROM awin_vouchers");
		$gesamt = $all_af_offers;
		echo $gesamt;
	}



?>
