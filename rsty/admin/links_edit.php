<?php
$_GET["delete"]=trim($_GET["delete"])+0;
if($_GET["delete"]!=""){
$d=$_GET["delete"];
$a="./rsty/links/".$d.".txt";
file_put_contents($a,"");
chmod($a,0777);
} else {
$d=$_GET["edit"];
$a="./rsty/links/".$d.".txt";
$_GET["name"]=str_replace("\n","",trim($_GET["name"]));
$_GET["ml"]=str_replace("\n","",trim($_GET["ml"]));
if($_GET["ml"]!="" && $_GET["name"]!=""){
$dateis=fopen($a,'w');
  fputs($dateis,"\n");
  fputs($dateis,$_GET['ml']);
  fputs($dateis,"\n");
  fputs($dateis,$_GET["name"]);
fclose($dateis);
chmod($a,0777);
}
$links=file($a);
echo '
<quad posn="0 0 15" sizen="20 12" halign="center" valign="center" style="Bgs1InRace" substyle="BgList" />
<label posn="-11 -5.5 16" style="TextCardRaceRank" sizen="11 4" halign="right" valign="bottom" text="MANIALINK :" />
<label posn="-11 5.5 16" style="TextCardRaceRank" sizen="11 4" halign="right" text="NAME :" />
<entry posn="0 5.5 16" sizen="16 3" autonewline="0" halign="center" default="'.trim(utf8_decode($links[2])).'" name="name" />
<entry posn="0 -5.5 16" sizen="16 3" autonewline="0" halign="center" valign="bottom" default="'.trim($links[1]).'" name="ml" />
<label posn="0 -8.5 16" style="TextCardRaceRank" sizen="11 4" halign="center" text=" EDIT " manialink="'.$ml.'?page=admin&amp;site=links_edit&amp;edit='.$_GET["edit"].'&amp;name=name&amp;ml=ml" />
';
}
//$links[1]
//$n$000た$ff0わ$0f0し$s-$o$FF0R$00FSty
?>