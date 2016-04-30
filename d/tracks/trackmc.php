<?php
session_start();
header('Content-type: application/xml');
$_GET["preis"]=$_GET["ppreis"];

if(isset($_GET["ppreis"]) && isset($_GET["name"])){
	require('../../connect.php');
	$name=trim(str_replace("\n","",$_GET["name"]));
	$fetch = $pdo->prepare('SELECT * FROM tracks WHERE name = :name LIMIT 1');
	$fetch->execute(array(':name' => $name.'.Challenge.Gbx'));
	$infos = $fetch->fetch(PDO::FETCH_ASSOC);
	$new=$infos["downloads"]+1;
	$fetch = $pdo->prepare('UPDATE tracks SET downloads= :new WHERE id = :id AND name = :name LIMIT 1');
	$fetch->execute(array(':name' => $name.'.Challenge.Gbx', ':new' => $new, ':id' => $infos['id']));

	$p=array("10","50","30","0");
	include("../../zahl.php");
	$ppp=$_GET["preis"]-1;
	auszahl($infos["uploader"],$p[$ppp],"tracks");

	echo '
	<?xml version="1.0" encoding="UTF-8"?>
	<maniacode noconfirmation="1">
	<install_track>
		<name>'.$name.'</name>
		<url>http://rstyle.paragon-esports.com/2010_HD/d/tracks/'.$infos["envi"].'/'.$_GET["ppreis"].'/'.$name.'.Challenge.Gbx</url>
	</install_track>
	<show_message>
		<message>Danke '.$_SESSION['nickname'].'</message>
	</show_message>
	</maniacode>
	';
	$mysqli->close();
} else {	
echo '<?xml version="1.0" encoding="UTF-8"?>
	<maniacod noconfirmation="1"e>
	<show_message>
		<message>Error, please retry.</message>
	</show_message>
	</maniacode>
	';
	
}
?>