<?php

	$id = $_GET["id"];
	

   $server = "db443562499.db.1and1.com";
   $user = "dbo443562499";
   $pass = "spitzmesser901369";
   $datenbank = "db443562499";
 
   $verbindung = mysql_connect($server,$user,$pass) or die ("Keine Verbindung möglich. Prüfen Sie die Zugangsdaten oder wenden Sie sich an den Administrator.");
   mysql_select_db($datenbank) or die ("Die Datenbank existiert nicht. Prüfen Sie die Schreibweise oder wenden Sie sich an den Administrator.");
 
$details = mysql_query("SELECT id, forwardlink FROM wp_gutschein_feed_offers WHERE id = $id LIMIT 1");
$d = mysql_fetch_array($details);

$shoplink = $d['forwardlink'];

	$counter = mysql_query("SELECT * FROM gp_used WHERE ID = $id LIMIT 1");
	$counter = mysql_fetch_assoc($counter);
	$counter = $counter["clicks"];

	if (empty($counter)) {
		mysql_query("INSERT INTO gp_used (id, clicks) VALUES ('$id', '1')");
	}
	if ($counter !== '0') {
		mysql_query("UPDATE gp_used SET clicks = $counter+1 WHERE id=$id");
	}	


$shoplink = str_replace("go.sparfuchs-gutschein","www.gutscheinpony", $shoplink);


header("Location: ".$shoplink."");


	header("Cache-Control: no-cache, must-revalidate");
	exit;	


?>
<!doctype html>
<html>
<head>
<meta name="robots" content="noindex,nofollow,noodp,noydir"/>
</head>

</html>