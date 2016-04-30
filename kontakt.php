<?php
$bv="rsty/mail";
$verzeichnis=opendir($bv);
$lkl=1;
while($datei = readdir($verzeichnis)){
$lkl2=str_replace(".txt","",$datei);
$lkl2=str_replace("\n","",$lkl2);
$lkl2=str_replace("ttbtt","",$lkl2);
if(preg_match("/luois_fun_gaal/", $lkl2)) {
$lkl++;
}
}
//http://rsty.keksml.de/envis/snow.dds
//http://rsty.keksml.de/smily/leptop.bik
//<quad posn="-22.2 28 1" sizen="44.2 2.2" bgcolor="0FF3" valign="bottom" />
//<quad posn="-22.2 -25 1" sizen="44.2 2.2" bgcolor="0FF3" />
//<quad posn="-22.2 28 1" sizen="2.2 53" bgcolor="0FF3" />
//<quad posn="22 28 1" sizen="2.2 53" bgcolor="0FF3" halign="right" />


//<quad posn="20 25 3.9" halign="right" sizen="5 3" bgcolor="000" valign="bottom" />
echo'
<quad posn="-22.2 30.2 1" sizen="44.2 53" image="./header/white.png" />

<quad posn="-20 25 3.9" sizen="35 3" bgcolor="1119" valign="bottom" />
<entry style="TextCardRaceRank" posn="-20 25 3.9" sizen="35 50" valign="bottom" name="titel" />
<label style="TextCardRaceRank" posn="-35 25 3.9" sizen="14 3" valign="bottom" text="Titel :" />
<quad posn="0 0 3.9" sizen="40 50" bgcolor="1119" halign="center" valign="center" />
<entry style="TextCardRaceRank" posn="-20 25 3.9" sizen="40 50" autonewline="1" name="message" />
<label style="TextCardRaceRank" posn="-35 25 3.9" sizen="14 3" text="Nachricht :" />

<label posn="0 30 1.9" sizen="44 57" valign="bottom" halign="center" text="'.$_SESSION['nickname'].'$z   ('.$_SESSION['username'].')" />
<label style="CardButtonMedium" posn="0 -30 1.9" sizen="44 57" valign="bottom" halign="center" text="SENDEN" manialink="'.$ml.'?page=kontakt&amp;titel=titel&amp;nachricht=message" />


<label posn="63 -37 1.9" sizen="44 57" valign="bottom" halign="right" text="©opyright - Ideas - Coding - Design - FUN   made by RSty " />

';
//<quad posn="-22 30 1.9" sizen="44 57" style="Icons128x128_1" substyle="ShareBlink" />
if($_GET['titel']!=""&&$_GET['nachricht']!=""){
$us=$_SESSION['username'];
$bv="rsty/kontakt";
$verzeichnis=opendir($bv);
$kk=array();
$n=0;
while($datei = readdir($verzeichnis)){
if(preg_match("/\.txt$/", $datei)) {
$n++;
}
if(preg_match("/{$us}/", $datei)) {
$kk[$datei]= $datei;
}
}

$new='rsty/mail/luois_fun_gaalttbtt'.$lkl.'.txt';
$inhalt=trim($_GET['titel']);
$inhalt.="\n";
$inhalt.=str_replace("\n",":-umu-:",trim($_GET['nachricht']));
$inhalt.="\n";
$inhalt.=$_SESSION['username'];
file_put_contents($new,$inhalt);
echo'
<label style="TextTitle2Blink" posn="0 -34 1.9" sizen="44 57" valign="bottom" halign="center" text="Nachricht Gesendet" />
';
//file_put_contents($up, $dee);
chmod($new,0777);
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
?>