<?php

	$id = $_GET["id"];
	

   $server = "db443562499.db.1and1.com";
   $user = "dbo443562499";
   $pass = "spitzmesser901369";
   $datenbank = "db443562499";
 
   $verbindung = mysql_connect($server,$user,$pass) or die ("Keine Verbindung möglich. Prüfen Sie die Zugangsdaten oder wenden Sie sich an den Administrator.");
   mysql_select_db($datenbank) or die ("Die Datenbank existiert nicht. Prüfen Sie die Schreibweise oder wenden Sie sich an den Administrator.");
 
$details = mysql_query("SELECT id, forwardlink FROM wp_gutschein_feed_shops WHERE id = $id LIMIT 1");
$d = mysql_fetch_array($details);

$shoplink = $d['forwardlink'];
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