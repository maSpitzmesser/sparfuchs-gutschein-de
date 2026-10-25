<?php
session_start();
$timestamp = getdate();
$datum = $timestamp[mday].".".$timestamp[mon].".".$timestamp[year]." um ".$timestamp[hours].":".$timestamp[minutes]." Uhr";
$an =  "info@sparfuchs-gutschein.de"; // Hier die Empfängeremail eintragen
$name = $_POST['name'];
$email = $_POST['email'];
$betreff = $_POST['betreff'];
$nachricht = $_POST['nachricht'];
if (isset($_POST["submit"]))
{
  if($_POST['s3capcha'] == $_SESSION['s3capcha'] && $_POST['s3capcha'] != '') {
          unset($_SESSION['s3capcha']);
                $mail_header = 'From:' . $email . "\n";
                $mail_header .= 'Content-type: text/plain; charset=UTF-8' . "\r\n";

$header =
"Nachricht via Sparfuchs-Gutschein von:
".$email."\nam ".$datum."\n-----------------------------------------------------";
$message = "
$header\n
Name: $name\n
Email: $email\n
Nachricht:
-----------------------------------------------------
$nachricht\n
";
                // Verschicken der Mail
                $send_check = mail($an, $betreff, $message, $mail_header );
         if (!$send_check)
                {
                $fehler = "<div class='error'>Unbekannter Fehler beim Senden!</div><br clear='all' />";
                } else {
                        $name = "";
                        $email = "";
                        $betreff = "";
                        $nachricht = "";
                        $ok = "<div class='ok'>Nachricht erfolgreich gesendet!</div><br clear='all' />";
                }
  }
  else {
        $fehler = "<div class='error'>Bitte SpamCheck korrigieren!</div><br clear='all' />";
  }
};
?>






<h2>Gutscheincode an uns schicken.</h2>
<p>Wir werden diesen Rabatt erst prüfen, bevor wir diesen auf unser Webseite listen.</p>

<?php echo $ok; ?>
<?php echo $fehler; ?>
<form action="" method="post" id="form">



<div class="field">
<label for="shop">Shop: <span class="required">*</span></label>
<select name="shopid" class="cs-select cs-skin-elastic grid-25">
<option disabled selected>-- Bitte wählen --</option>
						<?php
						global $post;
						$args = array( 'numberposts' => -1,	'post_type' => 'post', 'post_status'  => 'publish', 'orderby'  => 'title',	'order' => 'ASC');
						$posts = get_posts($args);
						foreach( $posts as $post ) : setup_postdata($post); ?>
						<option value="<? echo $post->ID; ?>"><?php the_title(); ?></option>
						<?php endforeach; ?>
					</select>
</div>
					

		<div class="field">			
				<label for="wert">Wert:</label>
			<input name="wert" value="" class="text" type="text">
					<select name="unit" class="cs-select cs-skin-elastic grid-06">
						<option selected="selected" value="€">€</option>
						<option value="%">%</option>
					</select>	
		</div>			

	<div class="field">
<label for="code">Code: <span class="required">*</span></label>
<input type="text" size="25" name="code" id="code" class="validate[required] itext" value="<?php if(!empty($code)){echo $code;}?>" />
</div>


<div class="field">
<label for="date">Gültig bis: <span class="required">*</span></label>
<input type="text" size="25" name="date" id="date" class="validate[required] itext" value="<?php if(!empty($date)){echo $date;}?>" />
</div>

<div class="field">
<label for="link">Link: <span class="required">*</span></label>
<input type="text" size="25" name="link" id="name" class="validate[required] itext" value="<?php if(!empty($link)){echo $link;}?>" />
</div>

<div class="field">
</div>


<div class="field">
<label for="name">Name: <span class="required">*</span></label>
<input type="text" size="25" name="name" id="name" class="validate[required] itext" value="<?php if(!empty($name)){echo $name;}?>" />
</div>

<div class="field">
<label for="email">Email: <span class="required">*</span></label>
<input class="validate[required,custom[email]] itext" type="text" size="25" name="email" id="email" value="<?php if(!empty($email)){echo $email;}?>" />
</div>




	<p class="required">* Pflichtfelder</p>

<div id="capcha">
<?php include("lib/s3Capcha.php"); ?>
</div>

<div class="field">
	<input class="button"  type="submit" name="submit" id="submit" value="Anfrage absenden" />
</div>

</form>
