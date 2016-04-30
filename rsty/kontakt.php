<?php
#$mysqli= new mysqli("localhost" , "web10" , "", "usr_web10_1");


//http://rsty.keksml.de/envis/snow.dds
//http://rsty.keksml.de/smily/leptop.bik
//<quad posn="-22.2 28 1" sizen="44.2 2.2" bgcolor="0FF3" valign="bottom" />
//<quad posn="-22.2 -25 1" sizen="44.2 2.2" bgcolor="0FF3" />
//<quad posn="-22.2 28 1" sizen="2.2 53" bgcolor="0FF3" />
//<quad posn="22 28 1" sizen="2.2 53" bgcolor="0FF3" halign="right" />


//<quad posn="20 25 3.9" halign="right" sizen="5 3" bgcolor="000" valign="bottom" />
echo'
<quad posn="-22.2 30.2 1" sizen="44.2 57.4" image="./header/white.png" />

<quad posn="-20 25 3.9" sizen="40 3" bgcolor="1119" valign="bottom" />
<entry style="TextCardRaceRank" posn="-20 25 3.9" sizen="40 50" valign="bottom" name="titel" />
<label style="TextCardRaceRank" posn="-35 25 3.9" sizen="12 3" valign="bottom" text="'.trim($_SESSION["titel"][$la]).' :" />
<quad posn="0 0 3.9" sizen="40 50" bgcolor="1119" halign="center" valign="center" />
<entry style="TextCardRaceRank" posn="-20 25 3.9" sizen="40 50" autonewline="1" name="message" />
<label style="TextCardRaceRank" posn="-35 25 3.9" sizen="12 3" text="'.ltrim($_SESSION["Nachricht"][$la]).' :" />

<label posn="0 30 1.9" sizen="44 57" valign="bottom" halign="center" text="'.$_SESSION['nickname'].'$z   ('.$_SESSION['username'].')" />
<label style="CardButtonMedium" posn="0 -30 1.9" sizen="44 57" valign="bottom" halign="center" text="'.$_SESSION["senden"][$la].'" manialink="'.$ml.'?page=kontakt&amp;titel=titel&amp;nachricht=message" />


<label posn="0 -37 1.9" sizen="128 3" valign="bottom" halign="center" text="$000©opyright - Ideas - Coding - Design - FUN   made by RSty " />
<quad posn="0 -38 1" sizen="128 4.1" image="./header/white.png" valign="bottom" halign="center" />

';
//<quad posn="-22 30 1.9" sizen="44 57" style="Icons128x128_1" substyle="ShareBlink" />
$_GET['titel']=trim($_GET['titel']);
$_GET['nachricht']=trim($_GET['nachricht']);
$_GET['titel']=xmlspecialchars2($_GET['titel']);
$_GET['nachricht']=xmlspecialchars2($_GET['nachricht']);
if($_GET['titel']!="" && $_GET['nachricht']!=""){

$aa="SELECT * FROM kontakt WHERE empfang = 'luois_fun_gaal'";
$aab=$mysqli->query($aa);
 $exits = $aab->num_rows;
 if($exits == 0)
 {
 $nummer=1;
 } else {
 $aa="SELECT COUNT(*) FROM kontakt WHERE empfang = 'luois_fun_gaal'";
$aab=$mysqli->query($aa);
$infos=$aab->fetch_array();
$nummer=$infos[0]+1;
 }

$us=$_SESSION['username'];

  $sql2 = "INSERT INTO `kontakt` (`titel` , `kom` , `empfang`, `absender`, `datum`, `id`) VALUES ('".$_GET["titel"]."', '".$_GET["nachricht"]."', 'luois_fun_gaal', '".$_SESSION["username"]."  --- ".$_SESSION["nickname"]."', 'AM : ".date("d.m.Y")."     UM : ".date("H:i")."', '".$nummer."')";
  $eintraga=$mysqli->query($sql2);


echo'
<label style="TextTitle2Blink" posn="0 -34 1.9" sizen="44 57" valign="bottom" halign="center" text="Nachricht Gesendet" />
';
//file_put_contents($up, $dee);
$shp='./rsty/mail/post/luois_fun_gaal.txt';
if(file_exists($shp)){
$neuen=file_get_contents($shp);
$neuen++;
} else {
$neuen=1;
}
file_put_contents($shp,$neuen);
chmod($shp,0777);
}
//CardButtonMedium

#$mysqli->close();
?>