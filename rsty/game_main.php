<?php
#$mysqli= new mysqli("localhost" , "web10" , "", "usr_web10_1");
$ppp=0.15;
if(isset($_GET["logout"]))$_SESSION["game"]="";
$game=$ml."?page=game_test&amp;";
if($_GET["login"]!="")$_GET["login"]=trim($_GET["login"]);
if($_SESSION["game"]==""){
if($_GET["site"]!="reg"){
$_GET["pw"]=trim($_GET["pw"]);
if(!empty($_GET["pw"])){
//login
$aa="SELECT * FROM verein WHERE name = '".$_GET["verein"]."'";
$aab=$mysqli->query($aa);
 $exits = $aab->num_rows;
 if($exits == 0)
 {
echo '
<label posn="0 -47 22" valign="bottom" halign="center" text="Verein exestiert nicht!" manialink="'.trim($game,"&amp;").'" style="TextButtonSmall" />
';
} else {
$infos=$aab->fetch_array();
if($_GET["pw"]!=$infos["pw"]){
echo '
<label posn="0 -47 22" valign="bottom" halign="center" text="Falsches Passwort" manialink="'.trim($game,"&amp;").'" style="TextButtonSmall" />
';
} else {
$_SESSION["game"]=$infos["name"];
setcookie("rsty_verein",$_GET["verein"],time()+60*60*1000*24*7);
echo '
<label posn="0 -47 22" valign="bottom" halign="center" text="Erfolgreich eingeloggt" manialink="'.trim($game,"&amp;").'" style="TextButtonSmall" />
';
}
}
}
if($_SESSION["game"]==""){
//reg
if(trim($_GET["reg"]!="") && trim($_GET["v"]!="") ){
$_GET["reg"]=trim($_GET["reg"]);
$aa="SELECT * FROM verein WHERE user = '".$_SESSION["username"]."' AND verein = '".$_GET["v"]."'";
$aab=$mysqli->query($aa);
 $exits = $aab->num_rows;
 if($exits == 0)
 {
$aus="SELECT * FROM sponsor ";
$myless=$mysqli->query($aus);
$ar=array();
while($infos=$myless->fetch_array()){
 $ar[]=$infos["name"];
}
$arc=count($ar);
$arc--;
$co=rand(0,$arc);
$sp=$ar[$co]; 
  $sql2 = "INSERT INTO `verein` (`user`, `pw` , `name` , `sponsor`) VALUES ('".$_SESSION["username"]."','".$_GET["reg"]."' ,'".$_GET["v"]."', '".$sp."')";
  $eintraga=$mysqli->query($sql2);
echo '
<label posn="0 -37 22" valign="bottom" halign="center" text="Du hast erfolgreich deinen Verein '.$_GET["v"].'$z$o erstellt. Bitte loge dich nun ein." manialink="'.trim($game,"&amp;").'" style="TextButtonSmall" />
';
 }
 else
 {
echo '
<label posn="0 -37 22" valign="bottom" halign="center" text="$f00Der Verein '.$_GET["v"].'$z$f00 exestierst schon oder du hast dich schon regestriert!" manialink="'.trim($game,"&amp;").'" style="TextButtonSmall" />
';
 }

}
if($_GET['pwvergessen']=="1"){
echo'
<label posn="0 -21.5 12" style="TextButtonSmall" manialink="'.$ml.'?page=kontakt"  halign="center" text="Schreibe mir eine Nachricht in mein Kontakt-Formular!"/>
<quad halign="center" posn="0 -20 0.1" sizen="55 4.4" style="Bgs1" substyle="BgTitle3_4" />
';
}
echo'
<quad posn="-22.5 17.5 0.1" sizen="45 20" style="Bgs1" substyle="BgTitle3_4" />
<label posn="-4.5 11.5 2" halign="right" text="Verein :"/>
<entry posn="-2 11.5 2" sizen="20 2" default="'.$_COOKIE["rsty_verein"].'" name="verein" />
<label posn="-4.5 7.5 2" halign="right" text="Passwort :" />
<entry textsize="0.1" textcolor="0000" posn="-2 7.5 1" sizen="20 2" name="pw" />
<quad posn="-2 7.7 1.11" sizen="20 '.(2.5+$ppp).'" image="./game/un2.png" />
<label style="TextButtonSmall" posn="0 3 2" sizen="25 2" manialink="'.$game.'pw=pw&amp;verein=verein" halign="center" text="$0f0LOGIN" />
<label style="TextButtonSmall" halign="right" posn="22 0 2" sizen="25 2" manialink="'.$game.'site=reg"text="$00fReg." />
<label style="TextButtonSmall" posn="-22 0 2" sizen="25 2" manialink="'.$game.'pwvergessen=1" text="$00fPW vergessen" />
';
}
}else{
if($_SESSION["game"]==""){
echo'
<quad posn="-22.5 17.5 0.1" sizen="45 20" style="Bgs1" substyle="BgTitle3_4" />
<label posn="-4.5 11.5 2" halign="right" text="Verein :"/>
<entry posn="-2 11.5 1" sizen="20 2" name="v"/>
<label posn="-4.5 7.5 2" halign="right" text="Passwort :"/>
<entry textsize="0.1" textcolor="0000" posn="-2 7.5 1" sizen="20 2" name="pw"/>
<quad posn="-2 7.7 1.11" sizen="20 '.(2.5+$ppp).'" image="./game/un2.png" />
<label style="TextButtonSmall" posn="0 3 2" sizen="25 2" manialink="'.$game.'reg=pw&amp;v=v" halign="center" text="$0f0Regestrieren" />
<quad style="Icons128x128_1" substyle="Back" valign="center" posn="-22 0 2" sizen="5 5" manialink="'.trim($game,"&amp;").'" />
';
}
}
}
if(!empty($_SESSION["game"])){
echo'
<label valign="bottom" posn="-63 -47 3" text="$f00Logout" style="TextButtonSmall" manialink="'.$game.'logout" />
<quad valign="bottom" sizen="9 4" posn="-64 -48 2" '.window_white.' manialink="'.$game.'logout" />
';
include("./game/game.php");
}
#$mysqli->close();
?>