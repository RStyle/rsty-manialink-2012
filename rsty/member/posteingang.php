<?php
#$mysqli= new mysqli("localhost" , "web10" , "", "usr_web10_1");
$nnnn='./rsty/mail/post/'.trim($_SESSION["username"]).'.txt';
if(file_exists($nnnn)){
	unlink($nnnn);
}

$aa="SELECT * FROM kontakt WHERE empfang = '".$_SESSION["username"]."' AND type <> '100'";
$aab=$mysqli->query($aa);
$exits = $aab->num_rows;
$exist_1=0;
if($exits == 0)
	$nachrichten=0;
else {
	$exist_1=1;
	$aa="SELECT COUNT(*) FROM kontakt WHERE empfang = '".$_SESSION["username"]."'";
	$aab=$mysqli->query($aa);
	$infos=$aab->fetch_array();
	$nachrichten=$infos[0];
}

echo'
<quad posn="0 10 2.9" sizen="45 55" halign="center" valign="center" style="Bgs1" substyle="BgList" />
';
if($_GET['write1']!=""){
echo '
<quad sizen="6 6" style="Icons128x128_1" substyle="Back" posn="-18.5 37 3" valign="top" halign="center" manialink="'.$ml.'?page=admin&amp;site=posteingang" />
<label sizen="10 3" style="TextCardInfoSmall" posn="-18.5 37 3" valign="top" halign="center" manialink="'.$ml.'?page=admin&amp;site=posteingang" text="Back" />
';
}
if($_GET['write']=="1"){
echo '
<quad sizen="6 6" style="Icons128x128_1" substyle="Back" posn="-18.5 37 3" valign="top" halign="center" manialink="'.$ml.'?page=admin&amp;site=posteingang" />
<label sizen="10 3" style="TextCardInfoSmall" posn="-18.5 37 3" valign="top" halign="center" manialink="'.$ml.'?page=admin&amp;site=posteingang" text="Back" />
';
}
if($_GET['write']==""&&$_GET['write1']==""&&$_GET['w1']==""&&$_GET['titel']==""&&$_GET['nachricht']==""){
if($_GET["delete"]!="" && $_GET["delete"]+0>=1){
$delete="UPDATE kontakt SET type='100' WHERE id2 = '".$_GET['delete']."' AND empfang = '".$_SESSION["username"]."'";
$deleteausfuhr=$mysqli->query($delete);
}
$a=0;
echo '
<label posn="0 33.3 3" valign="center" halign="center" text="Nachrichten: $o'.$nachrichten.'" />
';
if($exist_1==1){
	if($_GET['id']==""){
		$aus="SELECT * FROM kontakt WHERE empfang = '".$_SESSION["username"]."' AND type <> '100' ORDER BY id DESC LIMIT 12;";
		$myless=$mysqli->query($aus);

		echo'
		<quad sizen="6 6" style="Icons128x128_1" substyle="Back" posn="-18.5 37 3" valign="top" halign="center" manialink="'.$ml.'?page=admin" />
		<label sizen="10 3" style="TextCardInfoSmall" posn="-18.5 37 3" valign="top" halign="center" manialink="'.$ml.'?page=admin" text="Back" />

		<label style="TextCardInfoSmall" posn="-21.5 '.(27-3*$a).' 3"  text="$oNummer" />
		<label style="TextCardInfoSmall" posn="-11 '.(27-3*$a).' 3"  text="$oTitel" />
		<label style="TextCardInfoSmall" posn="10 '.(27-3*$a).' 3" halign="center" text="$oDATUM" />
		';
		$a++;
		while($infos=$myless->fetch_array()){
			$datum=explode(" ",$infos["datum"]);
			$datum=$datum[2];
			$m=3*$a;
			echo '
			<quad style="Bgs1" manialink="'.$ml.'?page=admin&amp;site=posteingang&amp;id='.$infos["id2"].'" substyle="NavButton" posn="-20.5 '.(27-3*$a+0.2).' 2.9" sizen="40.75 2.9" />
			<quad style="Icons64x64_1" substyle="Close" manialink="'.$ml.'?page=admin&amp;site=posteingang&amp;delete='.$infos["id2"].'" posn="17 '.(27-3*$a+0.2).' 3.1" sizen="2.75 2.75" />

			<label style="TextCardInfoSmall" posn="-17 '.(27-$m).' 3"  text="'.$infos["id"].'." />
			<label style="TextCardInfoSmall" posn="-11 '.(27-$m).' 3" sizen="17 3" text="'.$infos["titel"].'..." />
			<label style="TextCardInfoSmall" posn="10 '.(27-$m).' 3" halign="center" text="'.$datum.'" />
			';
			$a++;
		}
	} else {
		$id=$_GET['id'];
		$aus="SELECT * FROM kontakt WHERE empfang = '".$_SESSION["username"]."' AND id2 = '".$_GET["id"]."'";
		$myless=$mysqli->query($aus);
		$infos=$myless->fetch_array();
		echo '
		<quad sizen="6 6" style="Icons128x128_1" substyle="Back" posn="-18.5 37 3" valign="top" halign="center" manialink="'.$ml.'?page=admin&amp;site=posteingang" />
		<label sizen="10 3" style="TextCardInfoSmall" posn="-18.5 37 3" valign="top" halign="center" manialink="'.$ml.'?page=admin&amp;site=posteingang" text="Back" />
		<label sizen="42 3" posn="0 28 3" valign="top" halign="center" text="$00f$o'.xmlspecialchars2($infos["titel"]).'$z" />
		<label sizen="42 40" posn="-19 24.5 3" autonewline="1" text="'.xmlspecialchars2($infos["kom"]).'" />
		<quad valign="center" sizen="4 4" posn="-21.5 -12.5 4" style="BgRaceScore2" substyle="ScoreReplay" />
		<label valign="center" sizen="34 3" posn="-17.5 -12.5 3" text="$FFF'.$infos["datum"].'" />
		<label valign="center" sizen="38 3" posn="-20.5 -15.5 3" text="$0F0'.xmlspecialchars2($infos["absender"]).'" />
		';
	}
} else {
echo '
<quad sizen="6 6" style="Icons128x128_1" substyle="Back" posn="-18.5 37 3" valign="top" halign="center" manialink="'.$ml.'?page=admin" />
<label sizen="10 3" style="TextCardInfoSmall" posn="-18.5 37 3" valign="top" halign="center" manialink="'.$ml.'?page=admin" text="Back" />


<label style="TextCardInfoSmall" posn="0 5 3" valign="center" halign="center" text="KEINE NACHRICHTEN VORHANDEN" />
';
}
echo '
<quad sizen="6 6" style="Icons64x64_1" substyle="Outbox" posn="18.5 37 3" valign="top" halign="center" manialink="'.$ml.'?page=admin&amp;site=posteingang&amp;write=1" />
<label sizen="10 3" style="TextCardInfoSmall" posn="18.5 37 3" valign="top" halign="center" manialink="'.$ml.'?page=admin&amp;site=posteingang&amp;write=1" text="Nachricht schreiben" />
';
} elseif($_GET['write']=="1") {
$bv="rsty/logins";
$verzeichnis=opendir($bv);
$member=array("");
$mem=1;
$ll=$_SESSION['loginname'];
while($datei = readdir($verzeichnis)){
if(preg_match("/.txt/", $datei) && !preg_match("/$ll/", $datei)) {
$member[]=str_replace(".txt","",$datei);
$mem++;
}
}
for($a=1;$a<$mem;$a++){
$text=file("rsty/mail/$llb$a.txt");
$us=$member[$a];
$dato=$mysqli->query("SELECT * FROM  manializer_players WHERE login = '{$us}';");
$nickdata=$dato->fetch_array();
echo '
<label style="TextCardInfoSmall" manialink="'.$ml.'?page=admin&amp;site=posteingang&amp;write1='.$member[$a].'" posn="0 '.(27-3*$a).' 3" valign="center" halign="center" text="'.$a.'. '.$member[$a].' /  '.$nickdata['nick'].'" />
';
}
} elseif($_GET['write1']!="" && $_GET['write1']!=$_SESSION['loginname']){
echo '
<label posn="0 30 5" sizen="30 2" halign="center" valign="center" style="TextValueSmall" text="AN : '.$_GET['write1'].'" />
<label posn="-22 27 5" sizen="30 2" style="TextValueSmall" text="Titel:" />
<entry posn="-15 27 5" sizen="30 2" style="TextValueSmall" name="titel" />
<label posn="-22 24 5" sizen="6.5 20" style="TextValueSmall" text="Nachricht:" />
<entry posn="-15 24 5" sizen="30 20" autonewline="1" style="TextValueSmall" name="message" />
<label posn="0 2 5" halign="center" valign="center" manialink="'.$ml.'?page=admin&amp;site=posteingang&amp;w1='.$_GET['write1'].'&amp;titel=titel&amp;nachricht=message" style="CardButtonMedium" text="SendeN" />

<quad posn="-15.1 27.1 2.9" sizen="30.2 2.2" style="Bgs1InRace" substyle="BgWindow1" />
<quad posn="-15.1 24.1 2.9" sizen="30.2 20.2" style="Bgs1InRace" substyle="BgWindow1" />
';
} elseif($_GET['w1']!="" && $_GET['w1']!= $_SESSION['loginname'] && $_GET['nachricht']!="") {
$_GET['titel']=trim($_GET['titel']);
$_GET['nachricht']=trim($_GET['nachricht']);

$aa="SELECT * FROM kontakt WHERE empfang = '".$_GET["w1"]."'";
$aab=$mysqli->query($aa);
 $exits = $aab->num_rows;
 if($exits == 0)
 {
 $nummer=1;
 } else {
 $aa="SELECT COUNT(*) FROM kontakt WHERE empfang = '".$_GET["w1"]."'";
$aab=$mysqli->query($aa);
$infos=$aab->fetch_array();
$nummer=$infos[0]+1;
 }

$us=$_SESSION['username'];

  $sql2 = "INSERT INTO `kontakt` (`titel` , `kom` , `empfang`, `absender`, `datum`, `id`) VALUES ('".$_GET["titel"]."', '".$_GET["nachricht"]."', '".$_GET["w1"]."', '".$_SESSION["username"]."  --- ".$_SESSION["nickname"]."', 'AM : ".date("d.m.Y")."     UM : ".date("H:i")."', '".$nummer."')";
  $eintraga=$mysqli->query($sql2);

$shp='./rsty/mail/post/'.trim($_GET["wl"]).'.txt';
if(file_exists($shp)){
$neuen=file_get_contents($shp);
$neuen++;
} else {
$neuen=1;
}
file_put_contents($shp,$neuen);
chmod($shp,0777);
echo'
<label posn="0 30 5" sizen="35 2" halign="center" valign="center" text="AN : '.$_GET['w1'].' wurde deine Nachricht geschickt!" />
<label posn="0 25 5" sizen="35 2" style="CardButtonMedium" halign="center" valign="center" manialink="'.$ml.'?page=admin" text="Zurück zum AdminPanel!" />
';
}
#$mysqli->close();
//r2r?page=admin&site=posteingang&w1=tmracer96&titel=Hi+Janik%21&nachricht=Ich+hab+mir+jetzt+%28wie+du+siehst%29+einen+PostEingang+mit+der+Nachricht+schreiben+funktion+gecodet%21%0a%0aIch+hoffe%2c+diese+Nachricht+kommt+bei+dir+an%21
?>