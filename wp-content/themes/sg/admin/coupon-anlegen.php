<?php
function coupon_settings(){

	// Gutschein speichern
	if ( isset( $_POST['publish_coupon'] ) ) {
		if ( !empty( $_POST['title'] ) ) {
			if ( !empty( $_POST['aff_link'] ) ) {
			
			global $wpdb;
			
				$shopid = $_POST["shopid"];
			
				$title = $_POST["Exklusiv"] . $_POST["title"];
				$type = $_POST["type"];
				
				$worth = $_POST["worth"];
				$unit = $_POST["unit"];
				
				$valid_from = $_POST["valid_from"];
				$valid_to = $_POST["valid_to"];
				
				$minimum_order_value = $_POST["minimum_order_value"];
				
				$existing_customers = $_POST["existing_customers"];
				$new_customers = $_POST["new_customers"];
				
				$description = $_POST["description"];
				$guide = $_POST["guide"];
				
				$forwardlink = $_POST["aff_link"];				
				$frame = $_POST["frame"];
				
				$code = $_POST["code"];
				
			$public = $_POST["public"];
				
				if ( $_POST['valid_to'] === '' ) {
					$adcoupon = "INSERT INTO wp_coupons (id, shopid, title, type, worth, unit, valid_from, valid_to, minimum_order_value, existing_customers, new_customers, description, guide, forwardlink, frame, code, public) VALUES (NULL, '$shopid', '$title', '$type', '$worth', '$unit', '$valid_from', NULL, '$minimum_order_value', '$existing_customers', '$new_customers', '$description', '$guide', '$forwardlink', '$frame', '$code', '$public')";
					$wpdb->query($adcoupon);
					

				}
				else {				
					$valid_to = date("Y-m-d", strtotime($valid_to) );
					$adcoupon = "INSERT INTO wp_coupons (id, shopid, title, type, worth, unit, valid_from, valid_to, minimum_order_value, existing_customers, new_customers, description, guide, forwardlink, frame, code,public) VALUES (NULL, '$shopid', '$title', '$type', '$worth', '$unit', '$valid_from', '$valid_to', '$minimum_order_value', '$existing_customers', '$new_customers', '$description', '$guide', '$forwardlink', '$frame', '$code' , '$public')";
					$wpdb->query($adcoupon);
					

					
				}			

			}
		}
	}


 ?>
 

<style>
.hide {
    display: none
}
.form-table tr {
border-bottom: 1px solid #DBDBDB;
box-shadow: 0px 1px 0px #FFF
}
.form-table th {
    text-align: right;
}
</style>

<div class="wrap">
<div id="icon-options-general" class="icon32"><br/></div>

    
		
		<?php 	
		
if ( isset( $_POST['publish_coupon'] ) ) {	
	if ( (empty($_POST['title'])) || (empty($_POST['aff_link'])) ) {
		
		echo '<div id="message" class="updated error fade below-h2">';
		if ( empty( $_POST['title'] ) ) {
			echo '<p style="color:red">✖ Titel vergessen, Bro!!!!!!!!!</p>';
		}
		if ( empty( $_POST['aff_link'] ) ) {
			echo '<p style="color:red">✖ Provisionslink vergessen, Bro!!!!!!!!!</p>';	
		}
		echo '</div>';
	}
}


if ( isset( $_POST['publish_coupon'] ) ) {	
	if ( !empty( $_POST['title'] ) ) {
		if ( !empty( $_POST['aff_link'] ) ) {		
			echo '<div id="message" class="updated success fade below-h2"><p style="color:green"><strong>✔ Neuer Gutschein gespeichert.</strong></p>
									<p>Weiter so, bald ist die Hütte voll!!!</p>
							</div>
								<script>document.getElementById(" '.$offer->id.' ").style.display="none";</script>
								<style>.success {display:none;}</style>
								<script>
								jQuery(".success").fadeIn().delay(2000).fadeOut("slow");
								</script>
								';
								
			

		}
	}
}
else { 
	echo '<div id="message" class="updated fade below-h2">
							<p>Hier kannst du neue Gutscheine anlegen!<br/>
										 Einfach <strong>LEGEN...</strong> warte es kommt gleich <strong>...DAAAARRYYY!!!</strong><br/>
								Neue Gutscheine findest du <a target="_blank" href="http://publisher.affili.net/VoucherCodes/Overview.aspx?pt=0&nr=1&pnp=10">HIER</a></p>
						</div>'; 
	}
	
	?>
	<form method="POST" action="" id="settings"/>
	<table class="form-table">
		<tbody>
		
			<tr>
				<th scope="row"><label for="type">Was soll angelegt werden?</label></th>
				<td>
					<select name="type" id="type">
						<option value="offer">Rabatt</option>
						<option value="coupon">Gutscheincode</option>
						<option value="free product">Gratis Artikel</option>
						<option value="gift">Geschenkgutschein</option>
					</select>
				</td>
			</tr>
			
			
			<tr>
				<th scope="row"><label for="shop">Shop:</label></th>
				<td>
					<select name="shopid">
						<?php
						global $post;
						$args = array( 'numberposts' => -1,	'post_type' => 'post', 'post_status'  => 'publish', 'orderby'  => 'title',	'order' => 'ASC');
						$posts = get_posts($args);
						foreach( $posts as $post ) : setup_postdata($post); ?>
						<option value="<? echo $post->ID; ?>"><?php the_title(); ?></option>
						<?php endforeach; ?>
					</select>
					<p class="description">Selektieren und auf der Tastertur den Anfangsbuchstaben drücken für schnelleres Finden.</p>
				</td>
			</tr>
			
			<tr>
				<th scope="row">Exklusiv</th>
				<td><select name="Exklusiv">
						<option selected="selected" value="">Nein</option>
						<option value="EXKLUSIV ">Ja</option>
					</select>				
				<p class="description">Wenn ja wird Exklusiv automatisch davor geschrieben. Bsp.: EXKLUSIV 50% Rabatt + gratis versand</p></label>
				</td>
			</tr>
		
			<tr>
				<th scope="row"><label for="title" <?php 	if ( (isset($_POST['publish_coupon'])) && ($done === 0) ) {	if (empty( $_POST['title'])) {echo 'style="color: red"';} }	?>>Gutschein Titel</label></th>
				<td>
				
				<input name="title" value="<?php if ( isset( $_POST['publish_coupon'] ) ) {	echo $_POST['title'];	}	?>" class="regular-text" type="text" <?php 	if ( isset( $_POST['publish_coupon'] ) ) {	if ( empty( $_POST['title'] ) ) {	echo 'style="border:1px solid red"';	}}	?>	/> 
					<p class="description">Bsp.: Bis zu 50% Rabatt im Sale</p>
					<p class="description">Bsp.: 5€ Rabatt für Newsletteranmeldung</p>
				</td>
			</tr>
			
			<tr>
				<th scope="row"><label for="worth">Wert</label></th>
				<td><input name="worth" value="<?php if ( isset( $_POST['publish_coupon'] ) ) {	echo $_POST['worth'];	}	?>" class="text" type="text">
					<select name="unit">
						<option selected="selected" value="€">€</option>
						<option value="%">%</option>
					</select>
				</td>
			</tr>
			
			<tr>
				<th scope="row"><label for="minimum_order_value">Mindestbestellwert:</label></th>
				<td>
					<input name="minimum_order_value" value="<?php if ( isset( $_POST['publish_coupon'] ) ) {	echo $_POST['minimum_order_value'];	}	?>" class="text" type="text">
					<p class="description">Ohne € Zeichen bitte. Bei keinem Mindestestbellwert leer lassen!</p>
				</td>
			</tr>		
			
			<tr>
				<th scope="row"><label for="new_customers">Für Neukunden?</label></th>
				<td>
					<select name="new_customers">
						<option value="NO">Nein</option>
						<option selected="selected" value="YES">Ja</option>
					</select>				
				</td>
			</tr>
			
			<tr>
				<th scope="row"><label for="existing_customers">Für Bestandskunden?</label></th>
				<td>
					<select name="existing_customers">
						<option selected="selected" value="NO">Nein</option>
						<option value="YES">Ja</option>
					</select>				
				</td>
			</tr>		
			
			<tr style="display:none">
				<th scope="row"><label for="valid_from">Datum von Heute</label></th>
				<td><input name="valid_from" value="<?php $heute = date("Y-m-d"); echo $heute; ?>" class="regular-text" type="text"></td>
			</tr>			
			
			<tr>
				<th scope="row"><label for="valid_to">Gülig bis:</label></th>
				<td><input id="datepicker" autocomplete="off" name="valid_to" value="<?php if ( isset( $_POST['publish_coupon'] ) ) {	echo $_POST['valid_to'];	}	?>" class="regular-text" type="text">
				</td>
			</tr>			
			
			<tr>
				<th scope="row"><label for="aff_link" <?php 	if ( isset( $_POST['publish_coupon'] ) ) {	if ( empty( $_POST['aff_link'] ) ) {	echo 'style="color: red"';	}}	?>>Provisions Link</label></th>
				<td><input name="aff_link" value="<?php if ( isset( $_POST['publish_coupon'] ) ) {	echo $_POST['aff_link'];	}	?>" class="regular-text" type="text" <?php 	if ( isset( $_POST['publish_coupon'] ) ) {	if ( empty( $_POST['aff_link'] ) ) {	echo 'style="border:1px solid red"';	}}	?> />
					<p class="description">Affiliat Link <a target="_blank" href="http://publisher.affili.net/VoucherCodes/Overview.aspx?pt=0&nr=1&pnp=10">HIER</a></p>
				</td>
			</tr>			
			
			<tr>
				<th scope="row"><label for="code">Gutscheincode:</label></th>
				<td><input name="code" class="regular-text" type="text" value="<?php if ( isset( $_POST['publish_coupon'] ) ) {	echo $_POST['code'];	}	?>"/>
				</td>
			</tr>			
			
			<tr>
				<th scope="row"><label for="description">Beschreibung:</label></th>
				<td><textarea rows="3" name="description" cols="30"><?php if ( isset( $_POST['publish_coupon'] ) ) {	echo $_POST['description'];	}	?></textarea>					
					<p class="description">z.B.: Die Versandkosten werden automatisch abgezogen.</p>
					<p class="description">z.B.: Melde dich für den Newsletter an und erhalte einen 5% Gutscheincode per E-Mail.</p>
				</td>
			</tr>
			
			<tr>
				<th scope="row"><label for="guide">Anleitung:</label></th>
				<td><textarea rows="3" name="guide" cols="30"><?php if ( isset( $_POST['publish_coupon'] ) ) {	echo $_POST['guide'];	}	?></textarea>
				<?php $data = '&lt;li>Gutscheincode kopieren&lt;/li>
&lt;li>Gutscheincode im Warenkorb in das Coupon-Code Feld eintragen&lt;/li>
&lt;li>Auf <strong>Ok</strong> klicken&lt;/li>'; ?>
					<pre lang="html"><?php print_r($data); ?></pre>
					<p class="description">Wichtig &lt;UL> tag wird automatisch schon um die &lt;li> gesetzt!!</p>

				</td>
			</tr>
			<!--
			<tr>
				<th scope="row"><label for="frame">Gutschein Leiste über dem Shop:</label></th>
				<td>
					<select name="frame">
						<option selected="selected" value="0">Nein</option>
						<option value="1">Ja</option>
					</select>
				</td>
			</tr>		
			-->
			<tr>
				<th scope="row"><label for="public">Bearbeitet?</label></th>
				<td>
					<select name="public">
						<option value="0">Nein</option>
						<option selected="selected" value="1">Ja</option>
					</select>				
				</td>
			</tr>			
			
			<tr>
				<th scope="row"><label> </label></th>
				<td><input name="publish_coupon" class="button-primary button-large" value="Gutschein speichern" type="submit"/>
				</td>
			</tr>
			
</tbody>
</table>
</form>
	
</div><!-- wrap ende -->				
<?php
}
?>