<?php session_start();


			
if(isset($_POST['submitted'])) {

	if($_POST['s3capcha'] == $_SESSION['s3capcha'] && $_POST['s3capcha'] != '') {
		unset($_SESSION['s3capcha']);

		$token = $_SESSION['token'];
		if (!empty($token) && $token === 'mFzYr6BvD5') {


		
			$timestamp = getdate();
			$datum = $timestamp[mday].".".$timestamp[mon].".".$timestamp[year]." um ".$timestamp[hours].":".$timestamp[minutes]." Uhr";
			$mail_to =  'info@sparfuchs-gutschein.de';

			$username = $_POST['username'];
			$useremail = $_POST['useremail'];
			$subject = $_POST['userbetreff'];
			$message = $_POST['usernachricht'];			
			
			$attachments = '';

			$mail_header = 'From:' . $email . "\n";

			$header =
			"Nachricht via Sparfuchs-Gutschein von:
			".$email."\nam ".$datum."\n-----------------------------------------------------";
			


			// Verschicken der Mail
			$send_check = wp_mail($mail_to, $subject, $message, $headers, $attachments );
			


			
			if (!$send_check) {
				$fehler = '<div class="error">Unbekannter Fehler beim Senden!</div>';
			}
			else {
				$name = "";
				$email = "";
				$betreff = "";
				$nachricht = "";
				$ok = '<div class="success">Nachricht erfolgreich gesendet!</div>';
			}
		}
		else {
			echo 'Access denied';
		}
	}
	else {
		$fehler = '<div class="error">Bitte SpamCheck korrigieren!</div>';
	}
}

?>