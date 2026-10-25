<?php 
session_start();

$values = array('Apfel',
													'Erdbeere',
													'Zitrone',
													'Kirsche',
													'Birne'
													);

$rand = mt_rand(0,(sizeof($values)-1));

shuffle($values);

$s3Capcha = '<p>SpamCheck: Bitte auf <strong>'.$values[$rand]."</strong> klicken.</p>";

for($i=0;$i<sizeof($values);$i++) {
	$value2[$i] = mt_rand();
	$s3Capcha .= '<input id="'.$value2[$i].'" type="radio" name="s3capcha" value="'.$value2[$i].'" /><label for="'.$value2[$i].'" title="' . $values[$i] . '">'.$values[$i].' </label>';
}

$_SESSION['s3capcha'] = $value2[$rand];

echo $s3Capcha;
?>