<?php
/*
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
}  */

//$_SESSION['loginname']
$loginname=$_SESSION['loginname'];
$datei=array();
$datei=file("rsty/logins/$loginname.txt");
$datei[0]=str_replace("\n","",$datei[0]);
$datei[1]=str_replace("\n","",$datei[1]);
$pwa=$datei[0];
$z2=$datei[1]+0;
echo'
<quad sizen="35 18.8" posn="-17.5 8 0.1" image="./header/white.png" />
<quad sizen="26.4 3.2" posn="0 3 3" halign="center" valign="center" style="Bgs1InRace" substyle="BgWindow1" />
<entry style="TextCardSmallScores2" halign="center" valign="center" sizen="24 2.8" posn="0 3 3.1" name="pwo" default="Altes PW" />
<quad sizen="26.4 3.2" posn="0 0 3" halign="center" valign="center" style="Bgs1InRace" substyle="BgWindow1" />
<entry style="TextCardSmallScores2" halign="center" valign="center" sizen="24 2.8" posn="0 0 3.1" name="pwn" default="Neues PW" />
<label style="TextCardSmallScores2" posn="0 -7 3.1" halign="center" valign="center" sizen="16 2.8" manialink="'.$ml.'?page=admin&amp;site=pwedit&amp;pw=pwn&amp;old=pwo" >PassWort ändern</label> 
<quad sizen="26 3.2" posn="0 -7 3" halign="center" valign="center" style="Bgs1InRace" substyle="BgWindow1" />
';
if(!empty($_GET['pw']) && !empty($_GET['old']) && $_GET['old']!="Altes PW" && $_GET['pw'] != "Neues PW"){
	if(PassHash::check_password($pwa, $_GET['old'])){
		$datei=fopen("./rsty/logins/$loginname.txt","w");
		fputs($datei,PassHash::hash($_GET['pw']));
		fputs($datei,"\n");
		fputs($datei,$z2);
		fclose($datei);
		echo '
		<label style="TextCardSmallScores2" halign="center" valign="center" posn="0 20 4" sizen="16 2.8" >Hat geklappt!</label>
		';
	} else {
		echo '
		<label style="TextCardSmallScores2" halign="center" valign="center" posn="0 20 4" sizen="16 2.8" >Hat nicht geklappt!</label>
		';
	}
}
?>