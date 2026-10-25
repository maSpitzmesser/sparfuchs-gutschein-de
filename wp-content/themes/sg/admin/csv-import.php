<?php 		
			mysql_query("TRUNCATE wp_affiliat");	
			
			sleep(1);



	function w1250_to_utf8($csv_array ) {

    $map = array(
        chr(0x8A) => chr(0xA9),
        chr(0x8C) => chr(0xA6),
        chr(0x8D) => chr(0xAB),
        chr(0x8E) => chr(0xAE),
        chr(0x8F) => chr(0xAC),
        chr(0x9C) => chr(0xB6),
        chr(0x9D) => chr(0xBB),
        chr(0xA1) => chr(0xB7),
        chr(0xA5) => chr(0xA1),
        chr(0xBC) => chr(0xA5),
        chr(0x9F) => chr(0xBC),
        chr(0xB9) => chr(0xB1),
        chr(0x9A) => chr(0xB9),
        chr(0xBE) => chr(0xB5),
        chr(0x9E) => chr(0xBE),
        chr(0x80) => '&euro;',
        chr(0x82) => '&sbquo;',
        chr(0x84) => '&bdquo;',
        chr(0x85) => '&hellip;',
        chr(0x86) => '&dagger;',
        chr(0x87) => '&Dagger;',
        chr(0x89) => '&permil;',
        chr(0x8B) => '&lsaquo;',
        chr(0x91) => '&lsquo;',
        chr(0x92) => '&rsquo;',
        chr(0x93) => '&ldquo;',
        chr(0x94) => '&rdquo;',
        chr(0x95) => '&bull;',
        chr(0x96) => '&ndash;',
        chr(0x97) => '&mdash;',
        chr(0x99) => '&trade;',
        chr(0x9B) => '&rsquo;',
        chr(0xA6) => '&brvbar;',
        chr(0xA9) => '&copy;',
        chr(0xAB) => '&laquo;',
        chr(0xAE) => '&reg;',
        chr(0xB1) => '&plusmn;',
        chr(0xB5) => '&micro;',
        chr(0xB6) => '&para;',
        chr(0xB7) => '&middot;',
        chr(0xBB) => '&raquo;',
    );
    return html_entity_decode(mb_convert_encoding(strtr($csv_array , $map), 'UTF-8', 'ISO-8859-2'), ENT_QUOTES, 'UTF-8');
}


    while (!feof($csvfile)) {			
			
			  $csv_data[] = w1250_to_utf8(fgets($csvfile, 2024));
	
        $csv_array = explode(";", $csv_data[$i]);
				$csv_array = str_replace('"', '', $csv_array);
				$csv_array = str_replace("'s ", "&rsquo;s ", $csv_array);
				
				//arrays
        $insert_csv = array();

        $insert_csv['aff_ID'] = $csv_array[0];
        $insert_csv['ProgrammID'] = $csv_array[1];
				$insert_csv['shopname'] = $csv_array[2];
        $insert_csv['title'] = $csv_array[3];
				$insert_csv['code'] = $csv_array[4];
        $insert_csv['description'] = $csv_array[5];
				$insert_csv['valid_from'] = $csv_array[6];
        $insert_csv['valid_to'] = $csv_array[7];
				$insert_csv['geändert am'] = $csv_array[8];
        $insert_csv['Gutschein-/Aktionsart 1'] = $csv_array[9];
				$insert_csv['Gutschein-/Aktionsart 2'] = $csv_array[10];
        $insert_csv['Gutschein-/Aktionsart 3'] = $csv_array[11];
				$insert_csv['minimum_order_value'] = $csv_array[12];
        $insert_csv['new_customers'] = $csv_array[13];
        $insert_csv['Exklusiv'] = $csv_array[14];
				$insert_csv['public'] = $csv_array[15];
        $insert_csv['forwardlink'] = $csv_array[16];

				$insert_csv['minimum_order_value'] = trim(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9 ]/', ' ', urldecode(html_entity_decode(strip_tags($insert_csv['minimum_order_value']))))));
				$insert_csv['minimum_order_value'] = str_replace(' ', ",", $insert_csv['minimum_order_value']);
				

				
				$insert_csv['valid_from'] = date ("Y-m-d H:i:s", strtotime($insert_csv['valid_from']) );
				$insert_csv['valid_to'] = date ("Y-m-d H:i:s", strtotime($insert_csv['valid_to']) );

				
				
				require 'prepare_the_fucking_CSV.php';
				
				

				
				
				
				//get the url from array with html
				$href = $insert_csv['forwardlink'];
				preg_match_all('/href=[\'"]?([^\s\>\'"]*)[\'"\>]/', $href, $matches);
				$insert_csv['forwardlink'] = ($matches[1] ? $matches[1] : false);
				$insert_csv['forwardlink']  = $insert_csv['forwardlink'][0];
				


				
				mysql_query("SET NAMES 'utf8' COLLATE 'utf8_unicode_ci'");
				

				$query = "INSERT INTO wp_affiliat	( 
				`ID`,
				`aff_ID`,
				`ProgrammID`,
				`shopname`,
				`title`,
				`code`,
				`description`,
				`valid_from`,
				`valid_to`,
				`Gutschein-/Aktionsart 1`,
				`Gutschein-/Aktionsart 2`,
				`Gutschein-/Aktionsart 3`,
				`minimum_order_value`,
				`new_customers`,
				`Exklusiv`,
				`public`,
				`forwardlink`
				) VALUES	(
				NULL, 
				'".$insert_csv['aff_ID']."', 
				'".$insert_csv['ProgrammID']."',
				'".$insert_csv['shopname']."',
				'".$insert_csv['title']."',
				'".$insert_csv['code']."',
				'".$insert_csv['description']."',
				'".$insert_csv['valid_from']."',
				'".$insert_csv['valid_to']."',
				'".$insert_csv['Gutschein-/Aktionsart 1']."',
				'".$insert_csv['Gutschein-/Aktionsart 2']."',
				'".$insert_csv['Gutschein-/Aktionsart 3']."',
				'".$insert_csv['minimum_order_value']."',
				'".$insert_csv['new_customers']."',
				'".$insert_csv['Exklusiv']."',
				'".$insert_csv['public']."',
				'".$insert_csv['forwardlink']."'
				)";
				
			$import_coupons = mysql_query($query, $connect ) OR die("Error: $import_coupons <br/>".mysql_error());
			 
				//echo '<pre>'; 
				//echo $insert_csv['Mindestbestellwert']; 
				//echo '</pre>';
				
				
        $i++;
    }
    fclose($csvfile);
		
		
		sleep(1);
		$del_affiliate_coupons = $wpdb->get_results( "DELETE FROM wp_affiliat WHERE valid_to < NOW()+INTERVAL 1 DAY");
		sleep(1);
		$del_affiliate_coupons = $wpdb->get_results( "DELETE FROM wp_affiliat WHERE title LIKE '%CH: %'");
		sleep(1);
		$del_affiliate_coupons = $wpdb->get_results( "DELETE FROM wp_affiliat WHERE title LIKE '%AT: %'");
		//sleep(1);
		//$del_affiliate_coupons = $wpdb->get_results( "DELETE FROM wp_affiliat first WHERE EXISTS (SELECT title FROM wp_affiliat Dup WHERE first.title = Dup.title AND first.Telefon = Dup.Telefon AND testdat.Id < Dup.Id)");
?>