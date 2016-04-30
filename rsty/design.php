<?php
#$mysqli= new mysqli("localhost" , "web10" , "", "usr_web10_1");
$design=$_GET["design"];
//'.$_SESSION[""][$la].'
if(isset($_GET["old"]))$_SESSION["old"]=$_GET["old"];
echo'
<quad posn="0 33 0.1" sizen="60 67.5" halign="center" image="./header/white.png" />
<quad posn="-12 32 1" sizen="5 5" halign="center" image="./header/admin.png" />
<quad posn="12.4 32 1" sizen="5 5" halign="center" image="./header/admin.png" />
<label posn="0 32 2" halign="center" text="Design-'.$_SESSION["einstellungen"][$la].'"/>
';
if($_GET["off"]==="1" && $_GET["on"]!=="1"){
$setttings["set4"]=2;
   $sql4 = "UPDATE `set` SET `set4`='2'  WHERE login = '".$_GET["playerlogin"]."' LIMIT 1";
   $updateausfuhra=$mysqli->query($sql4);
}elseif($_GET["on"]==="1"){
$setttings["set4"]=0;
   $sql4 = "UPDATE `set` SET `set4`='0'  WHERE login = '".$_GET["playerlogin"]."' LIMIT 1";
   $updateausfuhra=$mysqli->query($sql4);
}
if($design=="home"){
if($setttings["set3"]+0>1){
//Überblendungs Effekt
echo'
<label halign="right" posn="29 26 2" text="$f00OFF" manialink="'.verlink("on","off","old").'off=1" style="TextButtonSmall" />
<label halign="right" posn="24 26 2" text="$0c0ON" manialink="'.verlink("on","off","old").'on=1" style="TextButtonSmall" />
<label halign="right" posn="19 26 2" text="'.$_SESSION["Hintergrund Verhellung"][$la].' :" style="TextButtonSmall" />
';
}else{
echo'
<label halign="right" posn="29 26 2" text="$c00OFF" manialink="'.verlink("on","off","old").'off=1" style="TextButtonSmall" />
<label halign="right" posn="24 26 2" text="$0f0ON" manialink="'.verlink("on","off","old").'on=1" style="TextButtonSmall" />
<label halign="right" posn="19 26 2" text="'.$_SESSION["Hintergrund Verhellung"][$la].'" manialink="'.verlink("on","off","old").'on=1" style="TextButtonSmall" />
';
}
$home=1;
echo '
<label posn="-29 26 2" text="'.ltrim($_SESSION["hintergrund"][$la]).'" manialink="'.verlink("design","old").'design=background" style="TextButtonSmall" />
<label posn="-29 23 2" text="Shoutbox" manialink="'.verlink("design","old").'design=shoutbox" style="TextButtonSmall" />
<label posn="-29 20 2" text="'.ltrim($_SESSION["info-box"][$la]).'" manialink="'.verlink("design","old").'design=infobox" style="TextButtonSmall" />
<label posn="-29 17 2" text="'.ltrim($_SESSION["Navigations Text Farbe"][$la]).'" manialink="'.verlink("design","old").'design=color1" style="TextButtonSmall" />
<label posn="-29 14 2" text="'.ltrim($_SESSION["header"][$la]).'" manialink="'.verlink("design","old").'design=hg" style="TextButtonSmall" />
';

}  elseif($design=="background")  {
$bv="header/bgs";
$verzeichnis=opendir($bv);
$bilder=array();
$p1=-29;
$p2=26;
$p2o=$p2;
$a=0;
while($datei = readdir($verzeichnis)){
if(preg_match("/\.jpg$/", $datei) || preg_match("/\.png$/", $datei) || preg_match("/\.bik$/", $datei) || preg_match("/\.dds$/", $datei) || preg_match("/\.tga$/", $datei)) {
$bilder[$datei]= $datei;
echo'
<quad manialink="'.$ml.'?page=design&amp;design=background&amp;bg='.$datei.'" posn="'.$p1.' '.$p2.' 13" sizen="18.5 14.5" image="./header/bgs/'.$datei.'" />
';
$p2-=15;
$a++;
if($a%4==0){
$p2=$p2o;
$p1+=19.5;
}
}
}
if(file_exists("./header/bgs/{$_GET['bg']}") && !empty($_GET["bg"])){
$setttings["set1"]=$_GET["bg"];
   $sql4 = "UPDATE `set` SET `set1`='".$_GET["bg"]."'  WHERE login = '".$_GET["playerlogin"]."' LIMIT 1";
   $updateausfuhra=$mysqli->query($sql4);
echo'
<label posn="0 -34 32" halign="center" valign="bottom" text="Design Erfolgreich geändert"/>
';
}
}  elseif($design=="shoutbox"){
$bv="./style2/new/country";
$verzeichnis=opendir($bv);
$bilder=array();
$p1=-29;
$p2=26;
$p2o=$p2;
$a=0;
while($datei = readdir($verzeichnis)){
if(preg_match("/\.jpg$/", $datei) || preg_match("/\.png$/", $datei) || preg_match("/\.bik$/", $datei) || preg_match("/\.dds$/", $datei) || preg_match("/\.tga$/", $datei)) {
$bilder[$datei]= $datei;
echo'
<quad manialink="'.$ml.'?page=design&amp;design=shoutbox&amp;bg='.$datei.'" posn="'.$p1.' '.$p2.' 13" sizen="19 14.5" image="./style2/new/country/'.$datei.'" />
';
$p2-=15;
$a++;
if($a%4==0){
$p2=$p2o;
$p1+=19.5;
}
}
}
if(file_exists("./style2/new/country/{$_GET['bg']}")  && !empty($_GET["bg"])){
$setttings["set6"]=$_GET["bg"];
   $sql4 = "UPDATE `set` SET `set6`='".$_GET['bg']."'  WHERE login = '".$_GET["playerlogin"]."' LIMIT 1";
   $updateausfuhra=$mysqli->query($sql4);
echo'
<label posn="0 -34 32" halign="center" valign="bottom" text="Design Erfolgreich geändert"/>
';
}
}  elseif($design=="infobox"){
$bv="./style2/new/country";
$verzeichnis=opendir($bv);
$bilder=array();
$p1=-29;
$p2=26;
$p2o=$p2;
$a=0;
while($datei = readdir($verzeichnis)){
if(preg_match("/\.jpg$/", $datei) || preg_match("/\.png$/", $datei) || preg_match("/\.bik$/", $datei) || preg_match("/\.dds$/", $datei) || preg_match("/\.tga$/", $datei)) {
$bilder[$datei]= $datei;
echo'
<quad manialink="'.$ml.'?page=design&amp;design=infobox&amp;bg='.$datei.'" posn="'.$p1.' '.$p2.' 13" sizen="19 14.5" image="./style2/new/fenster/'.$datei.'" />
';
$p2-=15;
$a++;
if($a%4==0){
$p2=$p2o;
$p1+=19.5;
}
}
}
if(file_exists("./style2/new/fenster/{$_GET['bg']}")  && !empty($_GET["bg"])){
   $sql4 = "UPDATE `set` SET `set5`='".$_GET['bg']."'  WHERE login = '".$_GET["playerlogin"]."' LIMIT 1";
   $updateausfuhra=$mysqli->query($sql4);
echo'
<label posn="0 -34 32" halign="center" valign="bottom" text="Design Erfolgreich geändert"/>
';
}
}  elseif($design=="color1"){
$p1=-29;
$p2=26;
$p2o=$p2;
$a=0;
$ar=array("FFF","000","f00","0f0","00f","ff0","f0f","0ff","D40","04D","4d0","40d","0d4","d04","F90",'FFF$i$s','000$i$s','f00$i$s','0f0$i$s','00F$i$s','FF0$i$s','F0F$i$s','0FF$i$s','F60$i$s');
foreach($ar as $cc){
echo'
<label textsize="10" manialink="'.$ml.'?page=design&amp;design=color1&amp;bg='.$cc.'" posn="'.$p1.' '.$p2.' 13" sizen="19 14.5" style="TextButtonSmall" focusareacolor1="0000" focusareacolor2="0000"  text="$'.$cc.''.trim($_SESSION["beispieltext"][$la]).'" textcolor="'.$cc.'" />
';
$p2-=7;
$a++;
if($a%8==0){
$p2=$p2o;
$p1+=19.5;
}
}
if(!empty($_GET["bg"])){
$setttings["set3"]=$_GET["bg"];
   $sql4 = "UPDATE `set` SET `set3`='".$_GET['bg']."'  WHERE login = '".$_GET["playerlogin"]."' LIMIT 1";
   $updateausfuhra=$mysqli->query($sql4);
$tt=time()+60*60*24*7*55;
echo'
<label posn="0 -34 32" halign="center" valign="bottom" text="Design Erfolgreich geändert"/>
';
}
}  elseif($design=="hg"){
$bv="./header/header";
$verzeichnis=opendir($bv);
$bilder=array();
$p1=-29;
$p2=26;
$p2o=$p2;
$a=0;
while($datei = readdir($verzeichnis)){
if(preg_match("/\.jpg$/", $datei) || preg_match("/\.png$/", $datei) || preg_match("/\.bik$/", $datei) || preg_match("/\.dds$/", $datei) || preg_match("/\.tga$/", $datei)) {
$bilder[$datei]= $datei;
echo'
<quad manialink="'.$ml.'?page=design&amp;design=hg&amp;bg='.$datei.'" posn="'.$p1.' '.$p2.' 13" sizen="19 14.5" image="./header/header/'.$datei.'" />
';
$p2-=15;
$a++;
if($a%4==0){
$p2=$p2o;
$p1+=19.5;
}
}
}
if(file_exists("./header/header/{$_GET['bg']}")  && !empty($_GET["bg"])){
$setttings["set2"]=$_GET["bg"];
   $sql4 = "UPDATE `set` SET `set2`='".$_GET["bg"]."'  WHERE login = '".$_GET["playerlogin"]."' LIMIT 1";
   $updateausfuhra=$mysqli->query($sql4);
echo'
<label posn="0 -34 32" halign="center" valign="bottom" text="Design Erfolgreich geändert"/>
';
}
}
if($home!=1)echo '<quad manialink="'.$ml.'?page=design&amp;design=home" posn="-26 32 1" sizen="5 5" halign="center" style="Icons128x128_1" substyle="Back" />';
echo '<quad manialink="'.$ml;if(!empty($_SESSION["old"]))echo'?page='.$_SESSION["old"].'';echo'" posn="26 32 1" sizen="5 5" halign="center" style="Icons64x64_1" substyle="Close" />';
#$mysqli->close();
?>