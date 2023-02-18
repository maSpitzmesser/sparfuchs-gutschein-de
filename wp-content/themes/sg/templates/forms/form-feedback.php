<?php
session_start();
$timestamp = getdate();
$datum = $timestamp[mday].".".$timestamp[mon].".".$timestamp[year]." um ".$timestamp[hours].":".$timestamp[minutes]." Uhr";
$an =  "info@sparfuchs-gutschein.de"; // Hier die Empfängeremail eintragen
$name = $_POST['name'];
$email = $_POST['email'];
$betreff = $_POST['betreff'];
$nachricht = $_POST['nachricht'];


if (isset($_POST["submit"])) {
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

<h2>Deine Meinung ist uns wichtig!</h2>

<?php echo $ok; ?>
<?php echo $fehler; ?>

<form action="" method="post">



	<div class="field">
		<label for="erfahren_durch" class="full-width">Wie bist du auf diese Seite aufmerksam geworden?</label>

		<select name="erfahren_durch" class="cs-select cs-skin-elastic grid-50">
			 <option disabled selected>-- Bitte wählen --</option>
			 <optgroup label="Allgemein">
					<option>Zufall</option>
					<option>Freunde/Bekannte</option>
			 </optgroup>
			 <optgroup label="Internet-Angebote">
					<option>Newsletter anderer Seiten</option>
					<option>Suchmaschine</option>
					<option>Linkliste</option>
					<option>Forum/Gästebuch-Eintrag</option>
			 </optgroup>
			 <optgroup label="Medien">
					<option>Zeitung</option>
					<option>Zeitschrift</option>
					<option>Radio</option>
					<option>Fernsehen</option>
			 </optgroup>
		</select>
	</div>
			
	<div class="field">
		<label for="note" class="full-width">Welche Note würdest du allgemein dem Inhalt geben?</label>
		
		
		<input id="inhalt1"  type="radio" value="1" name="inhalt"/>
		<label for="inhalt1" class="circled">1</label>		
		
		<input id="inhalt2"  type="radio" value="1" name="inhalt"/>
		<label for="inhalt2" class="circled">2</label>		
		
		<input id="inhalt3"  type="radio" value="1" name="inhalt"/>
		<label for="inhalt3" class="circled">3</label>		

		<input id="inhalt4"  type="radio" value="1" name="inhalt"/>
		<label for="inhalt4" class="circled">4</label>		

		<input id="inhalt5" type="radio" value="1" name="inhalt"/>
		<label for="inhalt5" class="circled">5</label>		

		<input id="inhalt6" type="radio" value="1" name="inhalt"/>
		<label for="inhalt6" class="circled">6</label>
		
		<p class="description">(1 = sehr gut, 6 = ungenügend)</p>
	</div>
			
	<div class="field">
		<label for="note" class="full-width">Welche Note würdest du allgemein dem Aussehen geben?</label>
		
		
		<input id="design1"  type="radio" value="1" name="design"/>
		<label for="design1" class="circled">1</label>		
		
		<input id="design2"  type="radio" value="1" name="design"/>
		<label for="design2" class="circled">2</label>		
		
		<input id="design3"  type="radio" value="1" name="design"/>
		<label for="design3" class="circled">3</label>		
		
		<input id="design4"  type="radio" value="1" name="design"/>
		<label for="design4" class="circled">4</label>		
		
		<input id="design5" type="radio" value="1" name="design"/>
		<label for="design5" class="circled">5</label>		
		
		<input id="design6" type="radio" value="1" name="design"/>
		<label for="design6" class="circled">6</label>
		
		<p class="description">(1 = sehr gut, 6 = ungenügend)</p>
	</div>
		
	<div class="field">
		<label for="name">Name <span class="required">*</span></label>
		<input type="text" name="name" id="name" class="validate[required,custom[name]] itext" value="<?php if(!empty($name)){echo $name;}?>" />
	</div>

	<div class="field">
		<label for="email">Email <span class="required">*</span></label>
		<input class="validate[required,custom[email]] itext" type="email" name="email" id="email" value="<?php if(!empty($email)){echo $email;}?> required" />
	</div>

	<div class="field">
		<label for="vorschlag" class="full-width">Was würdest du verbessern?</label>
		<textarea name="vorschlag" ><?php if(!empty($vorschlag)){echo $vorschlag;}?></textarea>
	</div>


	<p class="required">* Pflichtfelder</p>

	<div id="capcha">
		<?php include("lib/s3Capcha.php"); ?>
	</div>

	<div class="field">
		<input class="button"  type="submit" name="submit" id="submit" value="Feedback absenden" />
	</div>

</form>