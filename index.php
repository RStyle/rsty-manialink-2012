<?php
ob_start();
session_start();

if(isset($_GET['t0'])){ini_set('display_errors',1);  error_reporting(E_ALL);}
define('path', '/var/www/virtual/rstyle.mania-server.net/htdocs/2010_HD/', true);
define('fpath', 'http://vu2016.admin.paragon-esports.com/2010_HD/', true);
//if(!isset($_GET['sy'])) //to parse syntax
//	require('syntaxparser/include.php');


//$_SESSION["Sprache"]["de"] = true; //zu Testzwecken, kein Bock auf Übersetzungserrors
$la="en";
require_once("lang.php");

if(isset($_GET["h"]))header('Content-type: application/xml');
chdir("../");

$ml="rk";
 $ip=$_SERVER['REMOTE_ADDR'];
 $iptxt="./rsty/ip/".$ip.".txt";
 $imageurl="./style2/"; //$ml="r2r";
 $iub="./style2/new/";
 if(file_exists($iptxt) && $_SESSION["nickname"]=="" && $_SESSION["username"]==""){
 $dataip=file($iptxt);
 $_SESSION["username"]=str_replace("\n","",trim($dataip[0]));
 $_SESSION["nickname"]=str_replace("\n","",trim($dataip[1]));
 $_GET["playerlogin"]= $_SESSION["username"];
 }
 if($_GET["playerlogin"]=="" && $_SESSION["username"]!=""){
  $_GET["playerlogin"]= $_SESSION["username"];
 }
require('connect.php');
$aus="SELECT * FROM `set` WHERE login = '".$_GET["playerlogin"]."' ;";
$myless=$mysqli->query($aus);
$infos=$myless->fetch_array();
$la=$infos["set7"];
//if($la=="")$la="en";
 if(!isset($_SESSION["Sprache"]["de"]) or $_GET["lang"]=="delete")require_once("lang.php");
 $aus="SELECT * FROM `set` WHERE login = '".$_GET["playerlogin"]."' ;";
$myless=$mysqli->query($aus);
$infos=$myless->fetch_array();
$setttings=$infos["set1"];
#$mysqli->close();
if($a!="")return $settings;
$c_t=time()+60*60*24*7*12;
$b = 0;
if($_GET["lang"]=="de"){$setttings["set7"]="de"; $b=1;}
if($_GET["lang"]=="en"){$setttings["set7"]="en"; $b=1;}
if($_GET["lang"]=="fr"){$setttings["set7"]="fr"; $b=1;}
if($_GET["lang"]=="it"){$setttings["set7"]="it"; $b=1;}
if($_GET["lang"]=="sp"){$setttings["set7"]="sp"; $b=1;}
if($_GET["lang"]=="un"){$setttings["set7"]="un"; $b=1;}
if($b==1 && $_GET["playerlogin"]!=""){
#$mysqli= new mysqli("localhost" , "web10" , "", "usr_web10_1");
   $sql4 = "UPDATE `set` SET `set7`='".$_GET['lang']."'  WHERE login = '".$_GET["playerlogin"]."' LIMIT 1";
   $updateausfuhra=$mysqli->query($sql4);
   #$mysqli->close();
}
  $setttings=$infos["set1"];
$bv=path."header/bgs";
$verzeichnis=opendir($bv);
$bilder=array();
$a=0;
while($datei = readdir($verzeichnis)){
if(preg_match("/\.jpg$/", $datei) || preg_match("/\.png$/", $datei) || preg_match("/\.bik$/", $datei) || preg_match("/\.dds$/", $datei) || preg_match("/\.tga$/", $datei)) {
$bilder[]= trim($datei);
if($setttings==$datei)$b=$a;
$a++;
}
}
$abc=$a;
$bbc=$b;
if($_GET["b"]!=""){
#$mysqli= new mysqli("localhost" , "web10" , "", "usr_web10_1");
$setttings=$bilder[$_GET["b"]];
$sql4 = "UPDATE `set` SET `set1`='".$bilder[$_GET["b"]]."'  WHERE login = '".$_GET["playerlogin"]."' LIMIT 1";
$updateausfuhra=$mysqli->query($sql4);
#$mysqli->close();
}
//require('./syntaxparser.php');
function sett($a=""){
	global $mysqli;
	if($_GET["playerlogin"]!=""){
	#$mysqli= new mysqli("localhost" , "web10" , "", "usr_web10_1");
	$aa="SELECT * FROM `set` WHERE login = '".$_GET["playerlogin"]."'";
	$aab=$mysqli->query($aa);
	 $exits = $aab->num_rows;
	 if($exits == 0)
	 {
	  $sql2 = "INSERT INTO `set` (`login`) VALUES ('".$_GET["playerlogin"]."')";
	  $eintraga=$mysqli->query($sql2);
	 }
	 $aus="SELECT * FROM `set` WHERE login = '".$_GET["playerlogin"]."' ;";
	$myless=$mysqli->query($aus);
	$infos=$myless->fetch_array();
	$settings=$infos;
	if($infos["set1"]=="" && $_COOKIE['rsty_bg']!="" && $_GET["playerlogin"]!=""){
	   $sql4 = "UPDATE `set` SET `set1`='".$_COOKIE['rsty_bg']."'  WHERE login = '".$_GET["playerlogin"]."' LIMIT 1";
	   $updateausfuhra=$mysqli->query($sql4);
	 }elseif($infos["set1"]=="" && $_GET["playerlogin"]!=""){
		$sql4 = "UPDATE `set` SET `set1`='blue night.jpg'  WHERE login = '".$_GET["playerlogin"]."' LIMIT 1";
	   $updateausfuhra=$mysqli->query($sql4);
	 }
	 
	 if($infos["set2"]=="" && $_COOKIE['rsty_hg']!="" && $_GET["playerlogin"]!=""){
	   $sql4 = "UPDATE `set` SET `set2`='".$_COOKIE['rsty_hg']."'  WHERE login = '".$_GET["playerlogin"]."' LIMIT 1";
	   $updateausfuhra=$mysqli->query($sql4);
	 }elseif($infos["set2"]=="" && $_GET["playerlogin"]!=""){
		$sql4 = "UPDATE `set` SET `set2`='blue2.png'  WHERE login = '".$_GET["playerlogin"]."' LIMIT 1";
	   $updateausfuhra=$mysqli->query($sql4);
	 }
	 if($infos["set3"]=="" && $_COOKIE['rsty_tc1']!="" && $_GET["playerlogin"]!=""){
	   $sql4 = "UPDATE `set` SET `set3`='".$_COOKIE['rsty_tc1']."'  WHERE login = '".$_GET["playerlogin"]."' LIMIT 1";
	   $updateausfuhra=$mysqli->query($sql4);
	 }elseif($infos["set3"]=="" && $_GET["playerlogin"]!=""){
		$sql4 = "UPDATE `set` SET `set3`='fff'  WHERE login = '".$_GET["playerlogin"]."' LIMIT 1";
	   $updateausfuhra=$mysqli->query($sql4);
	 }
	  if($infos["set4"]=="" && $_COOKIE['rsty_ub']!="" && $_GET["playerlogin"]!=""){
	   $sql4 = "UPDATE `set` SET `set4`='".$_COOKIE['rsty_ub']."'  WHERE login = '".$_GET["playerlogin"]."' LIMIT 1";
	   $updateausfuhra=$mysqli->query($sql4);
	 }elseif($infos["set4"]=="" && $_GET["playerlogin"]!=""){
		$sql4 = "UPDATE `set` SET `set4`='0'  WHERE login = '".$_GET["playerlogin"]."' LIMIT 1";
	   $updateausfuhra=$mysqli->query($sql4);
	 }
	   if($infos["set5"]=="" && $_COOKIE['rsty_ib']!="" && $_GET["playerlogin"]!=""){
	   $sql4 = "UPDATE `set` SET `set5`='".$_COOKIE['rsty_ib']."'  WHERE login = '".$_GET["playerlogin"]."' LIMIT 1";
	   $updateausfuhra=$mysqli->query($sql4);
	 }elseif($infos["set5"]=="" && $_GET["playerlogin"]!=""){
		$sql4 = "UPDATE `set` SET `set5`='green.png'  WHERE login = '".$_GET["playerlogin"]."' LIMIT 1";
	   $updateausfuhra=$mysqli->query($sql4);
	 }
		if($infos["set6"]=="" && $_COOKIE['rsty_sb']!="" && $_GET["playerlogin"]!=""){
	   $sql4 = "UPDATE `set` SET `set6`='".$_COOKIE['rsty_sb']."'  WHERE login = '".$_GET["playerlogin"]."' LIMIT 1";
	   $updateausfuhra=$mysqli->query($sql4);
	 }elseif($infos["set6"]=="" && $_GET["playerlogin"]!=""){
		$sql4 = "UPDATE `set` SET `set6`='green.png'  WHERE login = '".$_GET["playerlogin"]."' LIMIT 1";
	   $updateausfuhra=$mysqli->query($sql4);
	 }
		 if($infos["set7"]=="" && $_COOKIE['rsty_lang']!="" && $_GET["playerlogin"]!=""){
	   $sql4 = "UPDATE `set` SET `set7`='".$_COOKIE['rsty_lang']."'  WHERE login = '".$_GET["playerlogin"]."' LIMIT 1";
	   $updateausfuhra=$mysqli->query($sql4);
	 }elseif($infos["set7"]=="" && $_GET["playerlogin"]!=""){
		$sql4 = "UPDATE `set` SET `set7`='en'  WHERE login = '".$_GET["playerlogin"]."' LIMIT 1";
	   $updateausfuhra=$mysqli->query($sql4);
	 }
	 }
}

sett();

    function xmlspecialchars2($a){
  $myxml=array("&","'","<",">",'"',"Ä","Ö","Ü","ä","ö","ü","ß");
  $myxml2=array("&amp;","&apos;","&lt;","&gt;","&quot;","&#196;","&#214;","&#220;","&#228;","&#246;","&#252;","&#223;");
  $ausgabe=str_replace($myxml,$myxml2,$a);
  $ausgabe=str_replace("Neür","Neuer",$ausgabe);
  $ausgabe=str_replace("NEÜR","NEUER",$ausgabe);
    $array1=array("&amp;amp;","&amp;apos;","&amp;lt;","&amp;gt;","&amp;quot;","&amp;#196;","&amp;#214;","&amp;#220;","&amp;#228;","&amp;#246;","&amp;#252;","&amp;#223;");
  $ausgabe=str_replace($array1,$myxml2,$ausgabe); 
  return $ausgabe;
  }
function xmlspecialchars3($a){
  $myxml=array("\'",'\"');
  $myxml2=array("&apos;","&quot;");
  $ausgabe=str_replace($myxml,$myxml2,$a);
  return $ausgabe;
  }
  function navi($a){
  $ll=0;
  global $ml;
  $ausgabe=$ml."?";
  if($_GET["plugin"]!="" && $_GET["plugin"]!="jukebox"){
  $ausgabe.='plugin='.$_GET["plugin"].'&amp;';
  }
  return $ausgabe;
  }//unter timeout <quad halign="center" valign="center" posn="0 0 -32" size="2 1.5" image="'.fpath.'header/bgs/'.$setttings.'" />
echo'<?xml version="1.0" encoding="utf-8"?>
<manialink>
<timeout>0</timeout>
<quad posn="0 0 -10" halign="center" valign="center" sizen="128 96" bgcolor="FFF4" />
<quad posn="-67 -36 -10.6" sizen="89 36" bgcolor="0009" />
<quad posn="-66 -37 -10.5" sizen="87 34" bgcolor="FFF7" />
<quad posn="-67 36 -10.7" sizen="89 66" image="'.fpath.'header/white.png" />
';
if($_GET["page"]!="1"){
echo'<frame posn="-24 6" >';
include('rsty/shout.php');
echo '<label posn="-22 -42 21" style="TextButtonSmall" scale="2.8" manialink="'.$ml.'?page=1" halign="center" text="!!!Erkunde die nächste Seite!!!" />';
}else{
echo '<label posn="-22 -42 21" style="TextButtonSmall" scale="2.8" manialink="'.$ml.'" halign="center" text="!!!Erkunde die nächste Seite!!!" />';	
echo '<quad posn="-66 35 3" sizen="87 64" image="'.fpath.'header/bgs/'.$setttings.'" />"';
echo '<quad posn="-50 -22 33" sizen="7 5" image="'.fpath.'keks/left.png" />"';
echo '<quad posn="-2 -22 33" sizen="7 5" image="'.fpath.'keks/right.png" />"';
echo $bbc;
$b1=$bbc-1;if($b1<0){$b1=count($bilder)-1;}
$b2=$bbc+1;if($b2>count($bilder)){$b2=0;}
if($_GET["b"]!=""){
$b1=$_GET["b"]-1;if($b1<0){$b1=count($bilder)-1;}
$b2=$_GET["b"]+1;if($b2>count($bilder)){$b2=0;}
}
echo '<quad posn="-50 -22 10" sizen="7 5" manialink="'.$ml.'?page=1&amp;b='.$b1.'" image="'.fpath.'leer.png" imagefocus="'.fpath.'header/bgs/'.$bilder[$b1].'" />"';
echo '<quad posn="-2 -22 10" sizen="7 5" manialink="'.$ml.'?page=1&amp;b='.$b2.'" image="'.fpath.'leer.png" imagefocus="'.fpath.'header/bgs/'.$bilder[$b2].'" />"';	
}
echo'<frame posn="15 '.(-8+30).'" scale="0.74" >';
include("statistik.php");
echo'</frame>';
echo'<frame posn="104 -54" >';
include("rsty/visitor.php");
echo'</frame>
<quad scale="0.74" image="'.fpath.'style2/new/fenster/green.png" halign="right" posn="62.3 12" sizen="40 72"  />';
echo '</manialink>';	
ob_end_flush();
?>