<?php
//ob_start();
session_start();

if ($_GET['deletec'] == '1') {
	foreach($_COOKIE AS $key => $value) {
		unset($_COOKIE[$key]);
		SETCOOKIE($key, '',TIME()-10000,"/");
	}
	foreach($_SESSION AS $key => $value) {
		$_SESSION[$key] = '';
	}
}

if (isset($_GET['t0']))
{
	ini_set('display_errors',1);  error_reporting(E_ALL);
	//for debugging
}

require_once('connect.php');

define('path', '/var/www/virtual/rstyle.paragon-esports.com/htdocs/2010_HD/', true);
define('fpath', 'http://rstyle.paragon-esports.com/2010_HD/', true);
$HTTP_GET_VARS = $_GET;
$redirect = '';
$la="en";
if (isset($_GET['reset_session']))
	$_SESSION = array();
if (isset($_GET['logmeout']))
{
	$_SESSION["login2"] = '';
	$_SESSION["login"] = '';
}

class PassHash {  
	//http://net.tutsplus.com/tutorials/php/understanding-hash-functions-and-keeping-passwords-safe/
  
    // blowfish  
    private static $algo = '$2a';
	
    // cost parameter  
    private static $cost = '$10';  
    // mainly for internal use  
    public static function unique_salt() {  
        return substr(sha1(mt_rand()),0,22);  
    }  
    // this will be used to generate a hash  
    public static function hash($password) {  
  
        return crypt($password,  
                    self::$algo .  
                    self::$cost .  
                    '$' . self::unique_salt());  
    }  
    // this will be used to compare a password against a hash  
    public static function check_password($hash, $password) {  
  
        $full_salt = substr($hash, 0, 29);  
  
        $new_hash = crypt($password, $full_salt);  
  
        return ($hash == $new_hash);  
    }  
}

define("window_green",'image="./header/window_green.png"', true);
define("window_red",'image="./header/window_red.png"', true);
define("window_white",'image="./header/white.png"', true);
if (!isset($_GET["header_b"])) {
	header('Content-type: application/xml');
}
if ($_SESSION["login2"]=="admin")$_SESSION["login"]="admin";

$_GET["page"]=str_replace('"',"''",$_GET["page"]);
$_GET["titel"]=str_replace('"',"''",$_GET["titel"]);
$_GET["nachricht"]=str_replace('"',"''",$_GET["nachricht"]);


function verlink($a="",$b="",$c="") {
	$ll=0;
	global $ml;
	$ausgabe=$ml."?";
	global $HTTP_GET_VARS;
	$_GET["page"]=str_replace('"',"''",$_GET["page"]);
	$_GET["titel"]=str_replace('"',"''",$_GET["titel"]);
	$_GET["nachricht"]=str_replace('"',"''",$_GET["nachricht"]);
	foreach($HTTP_GET_VARS as $key => $value) {
		$value=str_replace('"',"''",$value);
		//$value=str_replace(array("'",'"'),array('&apos;','&quot;'),$value);
		//$value=str_replace(array('\&apos;','\&quot;'),array('&apos;','&quot;'),$value);
		if ($a!=$key && $key!="on" && $key!="off" && $key!="lang" && $key!="old" && $key!=$b && $key!=$c && !preg_match("/design_/",$key) && $key!="bg" && $key!="eintrag" && $key!="shout" && $key!="code" && $key!="upload") {
			if ($ll==1)
				$ausgabe.='&amp;';
			$ausgabe.=$key;if ($value!="") {$ausgabe.='='.$value;}
			$ll=1;
		}
	}
	if ($ll==1)
	$ausgabe.="&amp;";
	return $ausgabe;
}

$arrays1=array("&","'","<",">",'"',"Ä","Ö","Ü","ä","ö","ü","ß");
$arrays2=array("&amp;","&apos;","&lt;","&gt;","&quot;","&#196;","&#214;","&#220;","&#228;","&#246;","&#252;","&#223;");
// if (isset($_GET["syntax"]))include("syntaxparser.php");
// This line was used to test the manialink with the library syntaxparser
// created by konte. I removed the library from my github repository.
// http://forum.deepsilver.com/forum/showthread.php/48951-XML-Syntaxparser-%96-Beta
$ip=$_SERVER['REMOTE_ADDR'];
$iptxt="./rsty/ip/".$ip.".txt";
$imageurl="./style2/";
$iub="./style2/new/";
$ml="$000RSty";
 
 if (!empty($_SESSION["nickname"])) {
	 $_SESSION["nickname"]=str_replace($arrays1,$arrays2,$_SESSION['nickname']);
	 $_SESSION["username"]=str_replace($arrays1,$arrays2,$_SESSION['username']);
	 $myxml2=array("&amp;","&apos;","&lt;","&gt;","&quot;","&#196;","&#214;","&#220;","&#228;","&#246;","&#252;","&#223;","&#196;","&#214;","&#220;","&#228;","&#246;","&#252;");
	 $array1=array("&amp;amp;","&amp;apos;","&amp;lt;","&amp;gt;","&amp;quot;","&amp;#196;","&amp;#214;","&amp;#220;","&amp;#228;","&amp;#246;","&amp;#252;","&amp;#223;","&amp;#196;","&amp;#214;","&amp;#220;","&amp;#228;","&amp;#246;","&amp;#252;");
	 $_SESSION["nickname"]=str_replace($array1,$myxml2,$_SESSION["nickname"]); 
	 $_SESSION["username"]=str_replace($array1,$myxml2,$_SESSION["username"]); 
	 // \&apos;
	 $_SESSION["nickname"]=str_replace('\&apos;','&apos;',$_SESSION["nickname"]);
	 $_SESSION["nickname"]=str_replace('\&quot;','&quot;',$_SESSION["nickname"]);
 }
 
if ($_GET['path'] != "")
	$_SESSION['path'] = $_GET['path'];
//ip-data
if (file_exists($iptxt) && $_SESSION["nickname"]=="" && $_SESSION["username"]=="") {
	$dataip=file($iptxt);
	$_SESSION["username"]=str_replace("\n","",trim($dataip[0]));
	$_SESSION["nickname"]=str_replace("\n","",trim($dataip[1]));
	$_SESSION["path"]=str_replace("\n","",trim($dataip[2]));
}
//ip-dataend
$counte=file("counterr.txt");
$count=$counte[0]+0;
if ($count=="") {
	$count=0;
}
if (trim($_GET['nickname'])!= "" && $_SESSION['nickname']=="") {
	if ($_SESSION["path"] == "")
	$_SESSION["path"] = $_GET['path'];
	$_SESSION["nickname"] = trim($_GET['nickname']);
	$_SESSION["username"] = trim($_GET['playerlogin']);
} elseif (!isset($_SESSION["nickname"])) {
	$vvv = "a";
	$datei=fopen("counterr.txt",'w');
	$countp=$count+1;
	$count=$countp;
	fputs($datei,$countp);
	fclose($datei);
	$count=$countp;
}
//ip
if (!file_exists($iptxt) && $_SESSION["nickname"]!="" && $_SESSION["username"]!="") {
	$iptext=$_SESSION["username"]."\n".$_SESSION["nickname"]."\n".$_SESSION["path"];
	file_put_contents($iptxt,$iptext);
	chmod($iptxt, 0777);
}
if ($_SESSION["nickname"]!="" && $_SESSION["nickname"]!=$_GET["nickname"]) {
	$_GET["nickname"]=$_SESSION["nickname"];
}
//ipend

if ($_SESSION["username"]!="" && $_SESSION["username"]!=$_GET["playerlogin"]) {
	$_GET["playerlogin"]=$_SESSION["username"];
}
echo'<?xml version="1.0" encoding="utf-8"?>';
if ($_GET["goto"]!="" && $_GET["goto"] != "rsty") {
	echo'<redirect>'.str_replace("goto=","",$_GET["goto"]).'</redirect>';
}
if ($_GET["oldlink"]==1) {
	echo'<redirect>$000RSty'.verlink().'</redirect>';
	exit;
}

if ($_GET["login"]=="" && $_GET['page']!="adminlogin" && trim($_SESSION["login"])=="" && $_SESSION["username"]!="") {
	$login=array();
	$a=$_SESSION["username"];
	$login=file("./rsty/logins/$a.txt");
	$login[0]=str_replace("\n","",$login[0]);
	if (PassHash::check_password($login[0], $_COOKIE["rsty_pw"]) && $_SESSION["username"]=="luois_fun_gaal" && $_COOKIE["rsty_pw"]!="") {
		$_SESSION['login']="admin";
		$_SESSION['login2']="admin";
		$_SESSION['loginname']="luois_fun_gaal";
		echo'
		<redirect>'.$ml.'?page=home&amp;admin</redirect>
		';
	} elseif ($_COOKIE["rsty_pw"]==$login[0] && $_COOKIE["rsty_pw"]!="" && $_SESSION["username"]!="luois_fun_gaal") {
		$_SESSION['login']="member";
		$_SESSION['loginname']=$_SESSION["username"];
		echo'
		<redirect>'.$ml.'?page=home&amp;member</redirect>
		';
	}
}

if ($_GET['page']=="adminlogin" && $_GET['playerlogin']!="" && $_GET['login']!="") {
	$login=array();
	$a=$_GET['playerlogin'];
	$login=file("./rsty/logins/$a.txt");
	$login[0]=str_replace("\n","",$login[0]);
	if (PassHash::check_password($login[0], $_GET['login']) && $_GET['playerlogin']=="luois_fun_gaal") {
		$_SESSION['login2']="admin";
		$_SESSION['login']="admin";
		$_SESSION['loginname']="luois_fun_gaal";
		setcookie("rsty_pw",$_GET["login"],time()+1000*60*60*24*7*58);
		echo'
		<redirect>'.$ml.'?page=admin</redirect>
		';
	} elseif (PassHash::check_password($login[0], $_GET['login']) && $_GET['login']!="") {
		$a=$_GET['playerlogin'];
		$_SESSION['login']="member";
		$_SESSION['loginname']=$a;
		setcookie("rsty_pw",$_GET["login"],time()+1000*60*60*24*7*58);
		echo'
		<redirect>'.$ml.'?page=admin</redirect>
		';
	}
} 
$mno=3.1;//	 <quad posn="0 0 -10" halign="center" valign="center" sizen="128 96" bgcolor="000F" />
function show($a) {
	$bv="./game/gegner";
	$verzeichnis=opendir($bv);
	$txt=array();
	while($datei = readdir($verzeichnis)) {
		if (!preg_match("/\.txt$/", $datei))
			$txt[]="./game/gegner/".$datei;
	}
	$bv="./game/bosse";
	$verzeichnis=opendir($bv);
	while($datei = readdir($verzeichnis)) {
		if (!preg_match("/\.txt$/", $datei)) {
			$txt[]="./game/bosse/".$datei;
		}
	}
	$z1=count($txt);
	$z1--;
	$z=rand(0,$z1);
	return $txt[$z];
}
echo'
   <manialink>
     <timeout>0</timeout>
	 <quad posn="0 0 -10" halign="center" valign="center" sizen="128 96" bgcolor="000F" />
';

/*
if (!file_exists('head.txt') or isset($_GET["head"])) {
	$b="";
	for($p=-62.5;$p<65;$p+=rand(1,14)/10+3.3) {
		$a=show();
		$p2=(48-rand(0,15)/10);
		$p3=(-9+rand(0,9)/10);
		echo'
		<quad posn="'.$p.' '.$p2.' '.$p3.'" halign="center" sizen="10 12" image="'.$a.'" />
		';
		$b.=$a.'||'.$p.'||'.$p2.'||'.$p3."\n";
	}
	file_put_contents('head.txt',$b);
} else {
	$a=file('head.txt');
	foreach($a as $i) {
		$i=trim($i);
		if ($i!="") {
			$info=explode("||",$i);
			echo'
			<quad posn="'.$info[1].' '.$info[2].' '.$info[3].'" halign="center" sizen="10 12" image="'.$info[0].'" />
			';
			// some nice images, not available at github
		}
	}
}
*/

//settings_start
function sett($a="") {
	global $mysqli, $pdo;
	if ($_GET["playerlogin"]!="") {
		
		/*$aa="SELECT * FROM `set` WHERE login = '".$_GET["playerlogin"]."'";
		$aab=$mysqli->query($aa);
		 $exits = $aab->num_rows;*/
		 
		$fetch = $pdo->prepare('SELECT * FROM `set` WHERE login = :login');
		$fetch->execute(array(':login' => $_GET["playerlogin"]));
		$exits = $fetch->fetchColumn();
		if ($exits == 0) {
			//$sql2 = "INSERT INTO `set` (`login`) VALUES ('".$_GET["playerlogin"]."')";
			//$eintraga=$mysqli->query($sql2);
			$sql2 = $pdo->prepare('INSERT INTO `set` (`login`) VALUES ( :login )');
			$sql2->execute(array(':login' => $_GET["playerlogin"]));
		 }
		 /*$aus="SELECT * FROM `set` WHERE login = '".$_GET["playerlogin"]."' ;";
		$myless=$mysqli->query($aus);
		$infos=$myless->fetch_array();*/
		
		$fetch = $pdo->prepare('SELECT * FROM `set` WHERE login = :login');
		$fetch->execute(array(':login' => $_GET["playerlogin"]));
		$infos = $fetch->fetch(PDO::FETCH_ASSOC);
		
		$settings=$infos;
		if ($infos["set1"]=="" && $_COOKIE['rsty_bg']!="" && $_GET["playerlogin"]!="") {
			$fetch = $pdo->prepare('UPDATE `set` SET `set1`= :rsty_bg  WHERE login = :login LIMIT 1');
			$fetch->execute(array(':login' => $_GET["playerlogin"], ':rsty_bg' => $_COOKIE['rsty_bg']));
		}elseif ($infos["set1"]=="" && $_GET["playerlogin"]!="") {
		   	$fetch = $pdo->prepare('UPDATE `set` SET `set1`="blue night.jpg"  WHERE login = :login LIMIT 1');
			$fetch->execute(array(':login' => $_GET["playerlogin"]));
		}
		 
		if ($infos["set2"]=="" && $_COOKIE['rsty_hg']!="" && $_GET["playerlogin"]!="") {
			$fetch = $pdo->prepare('UPDATE `set` SET `set2`= :rsty_hg  WHERE login = :login LIMIT 1');
			$fetch->execute(array(':login' => $_GET["playerlogin"], ':rsty_hg' => $_COOKIE['rsty_hg']));
		}elseif ($infos["set2"]=="" && $_GET["playerlogin"]!="") {
		   	$fetch = $pdo->prepare('UPDATE `set` SET `set2`="blue2.png"  WHERE login = :login LIMIT 1');
			$fetch->execute(array(':login' => $_GET["playerlogin"]));
		}
		if ($infos["set3"]=="" && $_COOKIE['rsty_tc1']!="" && $_GET["playerlogin"]!="") {
			$fetch = $pdo->prepare('UPDATE `set` SET `set3`= :rsty_tc1  WHERE login = :login LIMIT 1');
			$fetch->execute(array(':login' => $_GET["playerlogin"], ':rsty_tc1' => $_COOKIE['rsty_tc1']));
		}elseif ($infos["set3"]=="" && $_GET["playerlogin"]!="") {
		   	$fetch = $pdo->prepare('UPDATE `set` SET `set3`="fff"  WHERE login = :login LIMIT 1');
			$fetch->execute(array(':login' => $_GET["playerlogin"]));
		}
		if ($infos["set4"]=="" && $_COOKIE['rsty_ub']!="" && $_GET["playerlogin"]!="") {
			$fetch = $pdo->prepare('UPDATE `set` SET `set4`= :rsty_ub  WHERE login = :login LIMIT 1');
			$fetch->execute(array(':login' => $_GET["playerlogin"], ':rsty_ub' => $_COOKIE['rsty_ub']));
		}elseif ($infos["set4"]=="" && $_GET["playerlogin"]!="") {
		   	$fetch = $pdo->prepare('UPDATE `set` SET `set4`="0"  WHERE login = :login LIMIT 1');
			$fetch->execute(array(':login' => $_GET["playerlogin"]));
		}
		if ($infos["set5"]=="" && $_COOKIE['rsty_ib']!="" && $_GET["playerlogin"]!="") {
			$fetch = $pdo->prepare('UPDATE `set` SET `set5`= :rsty_ib  WHERE login = :login LIMIT 1');
			$fetch->execute(array(':login' => $_GET["playerlogin"], ':rsty_ib' => $_COOKIE['rsty_ib']));
		}elseif ($infos["set5"]=="" && $_GET["playerlogin"]!="") {
		   	$fetch = $pdo->prepare('UPDATE `set` SET `set5`="green.png"  WHERE login = :login LIMIT 1');
			$fetch->execute(array(':login' => $_GET["playerlogin"]));
		}
		if ($infos["set6"]=="" && $_COOKIE['rsty_sb']!="" && $_GET["playerlogin"]!="") {
			$fetch = $pdo->prepare('UPDATE `set` SET `set6`= :rsty_sb  WHERE login = :login LIMIT 1');
			$fetch->execute(array(':login' => $_GET["playerlogin"], ':rsty_sb' => $_COOKIE['rsty_sb']));
		}elseif ($infos["set6"]=="" && $_GET["playerlogin"]!="") {
		   	$fetch = $pdo->prepare('UPDATE `set` SET `set6`="green.png"  WHERE login = :login LIMIT 1');
			$fetch->execute(array(':login' => $_GET["playerlogin"]));
		}
		if ($infos["set7"]=="" && $_COOKIE['rsty_lang']!="" && $_GET["playerlogin"]!="") {
			$fetch = $pdo->prepare('UPDATE `set` SET `set7`= :rsty_lang  WHERE login = :login LIMIT 1');
			$fetch->execute(array(':login' => $_GET["playerlogin"], ':rsty_lang' => $_COOKIE['rsty_lang']));
		}elseif ($infos["set7"]=="" && $_GET["playerlogin"]!="") {
		   	$fetch = $pdo->prepare('UPDATE `set` SET `set7`="en"  WHERE login = :login LIMIT 1');
			$fetch->execute(array(':login' => $_GET["playerlogin"]));
		}
		 //$_COOKIE["rsty_ub"]
		$fetch = $pdo->prepare('SELECT * FROM `set` WHERE login = :login LIMIT 1');
		$fetch->execute(array(':login' => $_GET["playerlogin"]));
		$infos = $fetch->fetch(PDO::FETCH_ASSOC);
		$setttings=$infos;
		if ($a!="")return $settings;
	}elseif ($a!="") {
		$default= array('set1' => 'blue night.jpg', 'set2' => 'lila.png', 'set3' => '0FF$i$s', 'set4' => 2, 'set5' => 'white.png', 'set6' => 'white.png', 'set7' => 'en');
		return $default;
	}
}
sett();
//settings_end  




$c_t=time()+60*60*24*7*12;
if ($_GET["lang"]=="de") {$setttings["set7"]="de"; $b=1;}
if ($_GET["lang"]=="en") {$setttings["set7"]="en"; $b=1;}
if ($_GET["lang"]=="fr") {$setttings["set7"]="fr"; $b=1;}
if ($_GET["lang"]=="it") {$setttings["set7"]="it"; $b=1;}
if ($_GET["lang"]=="sp") {$setttings["set7"]="sp"; $b=1;}
if ($_GET["lang"]=="un") {$setttings["set7"]="un"; $b=1;}
if ($b==1 && $_GET["playerlogin"]!="") {
	$fetch = $pdo->prepare('UPDATE `set` SET `set7`= :lang  WHERE login = :login LIMIT 1');
	$fetch->execute(array(':login' => $_GET["playerlogin"], 'lang' => $_GET["lang"]));
}

sett();
$fetch = $pdo->prepare('SELECT * FROM `set` WHERE login = :login LIMIT 1');
$fetch->execute(array(':login' => $_GET["playerlogin"]));
$infos = $fetch->fetch(PDO::FETCH_ASSOC);
$la=$infos["set7"];
if ($la=="")
	$la="en";
if (!isset($_SESSION["Sprache"]["de"]) or $_GET["lang"]=="delete")
	include("lang.php");
 
function xmlspecialchars($a) {
	$myxml=array("&","'","<",">",'"',"Ä","Ö","Ü","ä","ö","ü","ß","AE","OE","UE","ae","oe","ue");
	$myxml2=array("&amp;","&apos;","&lt;","&gt;","&quot;","&#196;","&#214;","&#220;","&#228;","&#246;","&#252;","&#223;","&#196;","&#214;","&#220;","&#228;","&#246;","&#252;");
	$ausgabe=str_replace($myxml,$myxml2,$a);
	$ausgabe=str_replace("Neür","Neuer",$ausgabe);
	$ausgabe=str_replace("NEÜR","NEUER",$ausgabe);
	$array1=array("&amp;amp;","&amp;apos;","&amp;lt;","&amp;gt;","&amp;quot;","&amp;#196;","&amp;#214;","&amp;#220;","&amp;#228;","&amp;#246;","&amp;#252;","&amp;#223;","&amp;#196;","&amp;#214;","&amp;#220;","&amp;#228;","&amp;#246;","&amp;#252;");
	$ausgabe=str_replace($array1,$myxml2,$ausgabe); 
	return $ausgabe;
}

function xmlspecialchars2($a) {
	$myxml=array("&","'","<",">",'"',"Ä","Ö","Ü","ä","ö","ü","ß");
	$myxml2=array("&amp;","&apos;","&lt;","&gt;","&quot;","&#196;","&#214;","&#220;","&#228;","&#246;","&#252;","&#223;");
	$ausgabe=str_replace($myxml,$myxml2,$a);
	$ausgabe=str_replace("Neür","Neuer",$ausgabe);
	$ausgabe=str_replace("NEÜR","NEUER",$ausgabe);
	$array1=array("&amp;amp;","&amp;apos;","&amp;lt;","&amp;gt;","&amp;quot;","&amp;#196;","&amp;#214;","&amp;#220;","&amp;#228;","&amp;#246;","&amp;#252;","&amp;#223;");
	$ausgabe=str_replace($array1,$myxml2,$ausgabe); 
	return $ausgabe;
}
  
function xmlspecialchars3($a) {
	$myxml=array("\'",'\"');
	$myxml2=array("&apos;","&quot;");
	$ausgabe=str_replace($myxml,$myxml2,$a);
	return $ausgabe;
}

function antibild($a) {
	$a_array=array("'",".dds",".png",".jpg");
	$ausgabe=str_replace($a_array,"",$a);
	return $ausgabe;
}
  
function anticolor($a) {
	$a_array=array('$0','$1','$2','$3','$4','$5','$6','$7','$8','$9','$A','$a','$B','$b','$C','$c','$D','$d','$E','$e','$F','$f');
	$b_array=array('$','$','$','$','$','$','$','$','$','$','$','$','$','$','$','$','$','$','$','$','$','$');

	$a=str_replace($a_array,$b_array,$a);
	$a=str_replace($a_array,$b_array,$a);
	$ausgabe=str_replace($a_array,'$000',$a);
	$ausgabe=str_replace('$z','$z$000',$ausgabe);
	$ausgabe=str_replace('$g','$g$000',$ausgabe);
	return $ausgabe;
}

  
function navi($a) {
	$ll=0;
	global $ml;
	$ausgabe=$ml."?";
	if ($_GET["plugin"]!="" && $_GET["plugin"]!="jukebox") {
		$ausgabe.='plugin='.$_GET["plugin"].'&amp;';
	}
	return $ausgabe;
}

$allcolor=array("blue","grau","green","orange","pink","red");

$sizend='sizen="10.8 5.9"';
//$_SERVER['REMOTE_ADDR'] = ip!!!
//!navi!

//<quad posn="0.00 0.00 0.02" sizen="90.00 96" halign="center" valign="center" style="BgsChallengeMedals" substyle="BgPlayed" />

//<quad posn="0.00 0.00 -0.09" sizen="130 100" scale="0.99" halign="center" valign="center" bgcolor="FFFF" />
//manialink="Manialink:Home?game=united"
echo'<frame posn="0 -12">';
if ($_GET["page"]!="game" && $_GET["page"]!="game_test" && $_GET["page"]!="games" && $_GET["page"] != 'links' && $_GET["page"]!='tracks')
	include("./rsty/visitor.php");
echo'
	</frame>
	<format focusareacolor1="0A63" focusareacolor2="0F75" textcolor="D01F" textsize="3.6" /> 
';
if (($_SESSION["kalender"]=="" or $_GET["kalender"]==="false") && $_GET["kalender"]!=="true"
	&& !in_array($_GET['page'],array('tracks', 'skins', 'mods', 'avatars', 'signs', 'plugins', 'screens', 'games', 'horns' )) ) {
	echo'<frame posn="0 64">';
	include("./rsty/donate.php");
	echo'</frame>';
}
//include("./rsty/calender2.php");
include("./rsty/online.php");
require_once("./manializer/counter.manializer.php");
//ツ ツ smilies!
echo '<frame posn="0 -10">';
include("./rsty/juke.php");  
switch(trim($_GET['page'])) {
	case "skins" :
		include("./rsty/skins.php");
		break;
	case "tracks" :
		include("./rsty/tracks.php");
		break;
	case "avatars" :
		include("./rsty/avatars.php");
		break;
	case "horns" :
		include("./rsty/horns.php");
		break;
	case "screens" :
		include("./rsty/screens.php");
		break;
	case "mods" :
		include("./rsty/mods.php");
		break;
	case "signs" :
		include("./rsty/signs.php");
		break;
	case "links" :
		include("./rsty/links.php");
		break;
	case "news" :
		include("./rsty/news.php");
		break;
	case "gbook" :
		include("./rsty/gbook.php");
		break;
	case "kontakt" :
		include("./rsty/kontakt.php");
		break;
	case "plugins" :
		include("./rsty/plugins.php");
		break;
	case "games" :
		//http://thefrugalsaver.com/images/under_construction_simpsons.jpg
		echo '
		<quad halign="center" valign="center" posn="0 '.(-3.2+0.801).' 28" size="2 1.5" image="http://thefrugalsaver.com/images/under_construction_simpsons.jpg" />
		';
		break;
	case "game_test" :
		echo'</frame>';
		include("./rsty/game_main.php");
		echo'<frame>';
		break;
	case "admin" :
		if ($_SESSION['login']!="") {
			echo'</frame>';
			include("rsty/admin.php");
			echo'<frame>';
		}else{
			include("rsty/home.php");
			include("statistik.php");
		}
		break;
	case "plugins" :
		include("./rsty/plugins.php");
		break;
	case "design":
		include("./rsty/design.php");
		sett();
		break;
	default:
		include("rsty/home.php");
		include("statistik.php");
}
echo '</frame>';

include("./header/header.php");

//<quad posn="0 0 0" sizen="16 16" halign="left" valign="top" style="Bgs1InRace" substyle="BgWindow1" />
if ($_GET['plugin']=="admin") {
	echo'
	<label posn="63 34 8" sizen="15 3.7" halign="right" >'.$_GET['playerlogin'].'</label>
	<entry posn="64 30 8" sizen="15 3.4" halign="right" style="TextValueSmall" name="pwadmin" />
	<quad posn="64 30 9" sizen="15 3" halign="right" bgcolor="009" />
	<label sizen="18 2.7" posn="60 25 6" halign="right" manialink="'.$ml.'?page=adminlogin&amp;login=pwadmin&amp;playerlogin='.$_GET['playerlogin'].'" style="TextButtonSmall">LOGIN</label>
	<quad sizen="27 14.4" posn="60 35 3" halign="center" valign="top" style="Bgs1InRace" substyle="BgWindow1" />
	';
	//playerlogin,login
}

if (!file_exists('./music/'.$_SESSION["musik"]))
	$_SESSION["musik"]='Lund - Alone.ogg';
if (date("n")>10 or (date("n")<2 && date("j")<10))
	echo '
	<quad posn="0 0 55" sizen="128 96" image="./schnee.bik" halign="center" valign="center" />
	<quad posn="-'.rand(2,14).' '.rand(2,14).' 55" sizen="128 96" image="./schnee.bik" halign="center" valign="center" />
	<quad posn="'.rand(2,14).' '.rand(-9,14).' 55" sizen="128 96" image="./schnee.bik" halign="center" valign="center" />
	';
echo' 
  <quad posn="64 -48 22" halign="right" valign="bottom" image="./header/de.png" sizen="4 4" manialink="'.verlink("lang").'lang=de" />
  <quad posn="60 -48 22" halign="right" valign="bottom" image="./header/en.png" sizen="4 4" manialink="'.verlink("lang").'lang=en" />
  <quad posn="56 -48 22" halign="right" valign="bottom" image="./header/fr.png" sizen="4 4" manialink="'.verlink("lang").'lang=fr" />
  <quad posn="52 -48 22" halign="right" valign="bottom" image="./header/it.png" sizen="4 4" manialink="'.verlink("lang").'lang=it" />
  <quad posn="48 -48 22" halign="right" valign="bottom" image="./header/sp.png" sizen="4 4" manialink="'.verlink("lang").'lang=sp" />
  <quad posn="44 -48 22" halign="right" valign="bottom" image="./header/un.png" sizen="4 4" manialink="'.verlink("lang").'lang=un" />
<music data="http://rstyle.paragon-esports.com/2010_HD/music/'.$_SESSION["musik"].'" />


</manialink>';

if ($redirect!="") {
	echo'
	<redirect>'.$redirect.'</redirect>
	';
}
//ob_end_flush();
?>