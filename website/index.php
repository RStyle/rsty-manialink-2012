<?php
//echo ini_get(upload_max_filesize);
ob_start();
session_start();

if(isset($_GET['t0'])){ini_set('display_errors',1);  error_reporting(E_ALL);}

date_default_timezone_set("Europe/Berlin");
require_once('../connect.php');
require_once('./classes/tmfcolorparser.inc.php');

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


$cp= new TMFColorParser();

function is_bild($a){
$a=strtolower($a);
// .jpg, .png, .tga und .dds, sowie .bik
// preg_match("/\.png$/",$a) or
if(preg_match("/\.png$/",$a) or preg_match("/\.jpg$/",$a) or preg_match("/\.tga$/",$a) or preg_match("/\.dds$/",$a) or preg_match("/\.bik$/",$a)){

}
}
if($_GET["logout"]=="1"){
$_SESSION["login"]="";
}
echo'
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>!ONLINE ADMINPANEL!</title>
<meta name="editor" content="html-editor phase 5">
<style type="text/css">
p {background-color: white;color:blue }
.error {background-color: red;color:white }

</style>
<noscript>!Bitte aktiviere JAVASCRIPT!</noscript>
</head>
<body text="#00F" bgcolor="#DDD" link="#44F" alink="#44F" vlink="#44F">
';
$_GET["page"]=trim($_GET["page"]);
 /*$iptxt="../rsty/ip/".$_SERVER['REMOTE_ADDR'].".txt";
 $ip=file($iptxt);
  $_SESSION["username"]=str_replace("\n","",$ip[0]);
 $_SESSION["nickname"]=str_replace("\n","",$ip[1]);*/
 if(isset($_POST["name"]) && $_GET["page"]==""){
	$a=$_POST['name'];
	if(file_exists("../rsty/logins/$a.txt")){
		$login=file("../rsty/logins/$a.txt");
		$login[0]=str_replace("\n","",$login[0]); 
		if(PassHash::check_password($login[0], $_POST['pw']) == true && $_POST['name']=="luois_fun_gaal"){
			$_SESSION["login"]="admin";
			$_SESSION['username']='luois_fun_gaal';
			$_SESSION['nickname']='RStyle';
		} else {
			echo'
			  <hr/>
			  <p class="error">Falsche Passwort!</p>
			  <hr/>
			'; 
		}
	} else{
	echo'
	  <hr/>
	  <p class="error">Der Benutzername exestiert nicht!</p>
	  <hr/>
	  ';
	}
 }
 
 if($_SESSION["login"]!="")	{
	 $back='';
echo'
<hr/>
<a href="index.php"><img width="50" height="40" src="http://fish.stabb.de/styles/img_cache/r75c0c99d3a226d0b_60_100.png" /></a><a href="?logout=1">LOGOUT</a>
<hr/>';

}
 
 if($_SESSION["login"]=="admin" && trim($_GET["page"])==""){
   echo'
  Du bist als <b>ADMIN</b> eingeloggt!
  <hr/><br/>
  <a href="?page=track"><b>Trackupload</b></a><br/>
  <a href="?page=skin"><b>Skinupload</b></a><br/>
  <a href="?page=avatar"><b>Avatarupload</b></a><br/>
  <a href="?page=horn"><b>Hornupload</b></a><br/>
  <a href="?page=mod"><b>Modupload</b></a><br/>
  <a href="?page=sign"><b>Signupload</b></a><br/>
  <a href="?page=screen"><b>Wallpaperupload</b></a><br/>
  <a href="?page=plugin"><b>Pluginupload</b></a><br/> 
  <hr/>
  ';
 } elseif($_SESSION["login"]!="" && trim($_GET["page"])=="" && $_SESSION["login"]!="admin"){
    echo'
  <hr/>
  Du bist als <b>MEMBER</b> eingeloggt!
  <hr/><br/>
  <a href="?page=track"><b>Trackupload</b></a><br/>
  <a href="?page=skin"><b>Skinupload</b></a><br/>
  <a href="?page=avatar"><b>Avatarupload</b></a><br/>
  <a href="?page=horn"><b>Hornupload</b></a><br/>
  <a href="?page=screen"><b>Wallpaperupload</b></a><br/>
  <a href="?page=sign"><b>Signupload</b></a><br/>
  <hr/>
  ';
    }
	
	
include("./pages.php");	
	//<tr><th></th><th></th></tr>
	
if($_SESSION["login"]==""){
$_GET["page"]="";
//table-tr-th
echo'
<form action="" method="post" enctype="multipart/form-data">
<table border="1">
<caption><input type="image" name="upload" width="170" height="45" src="senden.png" alt="Absenden"></caption>
<tr><th>LOGIN:</th><th><input type="text" name="name" size="25" value="'.$ip[0].'" /></th></tr>
<tr><th>PASSWORT:</th><th><input type="password" name="pw" size="25" /></th></tr>
</table>
';
}

echo'
</body>
</html>
';
$mysqli->close();
  ob_end_flush();
?>