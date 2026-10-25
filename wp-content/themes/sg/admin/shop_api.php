<?php

function get_programms_from_af(){
	global $wpdb;

	define ("WSDL_LOGON", "https://api.affili.net/V2.0/Logon.svc?wsdl");
	define("WSDL_PROGRAM", "https://api.affili.net/V2.0/PublisherProgram.svc?wsdl");

	$Username = '610469'; // the publisher ID
	$Password  = '22NsIgsJQiypfqbDC9pu'; // the publisher web service password

	$SOAP_LOGON = new SoapClient(WSDL_LOGON);
	$Token	= $SOAP_LOGON->Logon(
		array(
		 'Username'  => $Username,
		 'Password'  => $Password,
		 'WebServiceType' => 'Publisher',
		'DeveloperSettings' => $DeveloperSettings
		)
	);

	$DisplaySettings = array (
		'PageSize' => 100,
		'CurrentPage' => 1
	);

	$GetProgramsQuery = array(
		'PartnershipStatus' => array('Active')
	);

	$SOAP_REQUEST = new SoapClient(WSDL_PROGRAM);
	$GetShopList = $SOAP_REQUEST->GetPrograms(
		array(
			'CredentialToken' => $Token,
			'DisplaySettings' => $DisplaySettings,
			'GetProgramsQuery' => $GetProgramsQuery
		)
	);

	$GetShopList = $GetShopList->ProgramCollection->Program;
	return $GetShopList;
}

function shop_api(){
	global $wpdb;
	$GetShopList = get_programms_from_af();

 // show shops from DB
	$af_shops = $wpdb->get_results("SELECT af_shops.ProgramTitle, wp_posts.post_title, af_shops.ProgramId, wp_posts.ID
																	FROM af_shops
																	LEFT JOIN wp_posts
																	ON  BINARY af_shops.ProgramTitle = wp_posts.post_title
																	WHERE wp_posts.post_status = 'publish'
																	ORDER BY af_shops.ProgramTitle ASC");

	//$af_shops = $wpdb->get_results("SELECT * FROM af_shops ORDER BY ProgramTitle ASC");
?>
<div class="wrap">
	<!--
	<div id="message" class="updated success fade below-h2">
	</div>
	-->
	<h2 style="float:left;"><span class="dashicons dashicons-store"></span> Online-Shops mit Partnerschaft</h2>
<?php
	$sql = "SELECT * FROM af_shops ORDER BY ProgramTitle ASC";
	$sg_post_shops = $wpdb->get_results($sql);

		if (count ($GetShopList) !== count ($sg_post_shops) ) {
			?>		<form method="POST" action="" id="save_shops_in_db" style="float: left;"  />
			<input name="save_shops_in_db" class="button-primary button-large" value="Shops aktuallisieren" type="submit" style="margin:10px 0px -10px 10px"/>
		</form>
		<?php
			echo '<br/><span style="float: left;color:#689D00;font-size:90%; margin:-8px 0 0px 0;line-height: 13px;">';
			echo (count ($GetShopList) - count ($sg_post_shops));
			?> neue Partnerschaften<br/> bei Affili.net.</span>
<?php } else { ?>
		  <span style="color:#689D00;font-size:90%;margin:20px 0px 0px 10px">Datenbank ist aktuell!<form method="POST" action="" id="save_shops_in_db" style="float: left;"  />
			<input name="save_shops_in_db" class="button-primary button-large" value="Shops aktuallisieren" type="submit" style="margin:10px 0px -10px 10px"/>
		</form></span><br/>
		<?php }
        ?>
	<br/>
		<br/>

<table class="wp-list-table widefat striped shops">
	<thead>
		<tr>
			<th>Check</th>
			<th>Shopname<br/> Sparfuchs</th>
			<th>Program Name<br/> Affilinet</th>
			<th>Shop ID<br/> Sparfuchs</th>
			<th>Program ID<br/> Affilinet (<span style="color:#689D00;"><?php	echo count ($GetShopList); ?></span>)</th>
		</tr>
	</thead>
	<tbody>

<?php	foreach ($sg_post_shops as $sg_post_shop) { ?>
			<tr>
        <td><?php if (!empty($sg_post_shop->ID)) { echo '<span style="color: #26A65B;">✓</span>'; } else {  echo '<span style="color: #CF000F;text-shadow: 1px 0px 0px rgb(207, 0, 15), -1px 0px 0px rgb(207, 0, 15);">✕</span>'; }; ?></td>
        <td><?php echo get_the_title( $sg_post_shop->ID ); ?></td>
        <td><?php echo $sg_post_shop->ProgramTitle; ?></td>
        <td><?php if (!empty($sg_post_shop->ID)) { echo $sg_post_shop->ID; } else {  echo '<span style="	color: #CF000F">Keine Übereinstimmung des Shopnamens!</span>'; }; ?></td>
        <td><?php echo $sg_post_shop->ProgramId; ?></td>
			</tr>
<?php } ?>

	</tbody>
</table>
</div><!-- wrap ende -->
<?php
}

if ( isset( $_POST["save_shops_in_db"]) ) {
	update_active_programms_from_af();
}

function update_active_programms_from_af() {
	global $wpdb;
	$GetShopList = get_programms_from_af();


	$wpdb->query("TRUNCATE af_shops");
	sleep (1);

	foreach ($GetShopList as $shop) {
		$ProgramName = $shop->ProgramTitle;
		require 'prepare_the_shopnames.php';

		$sql = "INSERT INTO af_shops	( `ID`,`ProgramId`,	`ProgramTitle` ) ";
		//$sql.= "WHERE NOT EXISTS (SELECT * FROM af_shops WHERE `ProgramId` = '".$sg_shops[`ProgramId`]."' ) ";
		$sql.= "VALUES( '".$sg_shop->ID."', '".$shop->ProgramId."',  '".$ProgramName."' ) ";

		$import_af_shops_done = $wpdb->query($sql);
	}

	sleep (1);

	 $sg_shops = $wpdb->get_results("SELECT af_shops.ProgramTitle, wp_posts.post_title, wp_posts.ID
																	FROM af_shops
																	LEFT JOIN wp_posts
																	ON  BINARY af_shops.ProgramTitle = wp_posts.post_title
																	WHERE wp_posts.post_status = 'publish'
																	ORDER BY af_shops.ProgramTitle ASC");

		foreach ($sg_shops as $sg_shop) {
			$sql = "UPDATE af_shops SET ID='".$sg_shop->ID."' WHERE ProgramTitle='".$sg_shop->post_title."'";
			$update_af_shops_done = $wpdb->query($sql);
		}
}
?>
