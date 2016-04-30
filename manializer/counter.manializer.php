<?php
// +-----------------------------+---------+
// |     :Manializer by SanX     |  Part1  |
// +-----------------------------+---------+
// |              The Counter              |
// +---------------------------------------+

// 1. Connect to database
$configfilename = "config.php";
require $configfilename;
//sicherrung
if($_GET["path"]==""&&$_GET["nickname"]!=""){
	if($sql = mysql_query("SELECT * FROM manializer_players WHERE `login`='".$_GET["playerlogin"]."' LIMIT 1")){
		$row = mysql_fetch_array($sql);
		$_GET["path"]=$row['path'];
		$_GET["lang"]=$row['lng'];
	}
}

// 1,5. Bad nicknames
$nickn = str_replace("{", ".", $_GET["nickname"]);
$nickn = str_replace("}", ".", $nickn);
$nickn = str_replace("¦", ".", $nickn);


// 2. Check playerids
$sql5 = mysql_query("SELECT * FROM manializer_visits ORDER by `id` DESC LIMIT 1");
while($last = mysql_fetch_array($sql5)) {
 $lastlogin = $last['login'];
}

$sql = mysql_query("SELECT id,boss FROM manializer_main LIMIT 1");
while($row = mysql_fetch_array($sql)) {
 $boss = $row['boss'];
}

$plid = 1;

$date = strftime("%d.%m.%y");
$sql = mysql_query("SELECT * FROM `manializer_visits` WHERE `login`='".$_GET["playerlogin"]."' AND `date`='".$date."'");
while($xxx = mysql_fetch_array($sql))
{
	$plid = 0;
}

if($_GET["playerlogin"] == "")
{
	$plid = 0;
}

/*if($_GET["playerlogin"] == $boss)
{
	$plid = 0;
	$luois="admin";
}*/

// 3. The day
if($plid == 1)
{
	$date = strftime("%m.%y");
	$day = strftime("%d");
	$sql = mysql_query("SELECT * FROM manializer_days WHERE `date`='".$date."' AND `daynum`='".$day."'");
	$exits = mysql_num_rows($sql);

	if($exits == 0)
	{
		$time2 = strftime("%d.%m.%y");
		$sql2 = "INSERT INTO `manializer_days` (`id` , `date` , `num_visits` , `daynum`) VALUES ('', '".$date."', '1', '".$day."')";
		mysql_query($sql2);
	} else {
		$time = strftime("%d.%m.%y");
		while($row = mysql_fetch_array($sql)) {
			$newnum = $row['num_visits'] + 1;
			$sql2 = "UPDATE `manializer_days` SET `num_visits`='".$newnum."' WHERE `date`='".$date."' AND `daynum`='".$day."'";
			mysql_query($sql2);
			}
	}
}

// 4. The visit
if($plid == 1 or $_SERVER['HTTP_REFERER'] != "")
{
	//my!!!
	if($_SERVER['HTTP_REFERER'] != "") { # wenn er ueber einen Link kommt 
		$adresse=$_SERVER['HTTP_REFERER'];
		$sql = mysql_query("SELECT * FROM manializer_adresse WHERE `name`='".$adresse."'");
		$exits = mysql_num_rows($sql);
		if($exits == 0){
			$sql = "INSERT INTO `manializer_adresse` (`name` , `besucher`) VALUES ('".$adresse."', '1')";
			mysql_query($sql);
		} else {
			$sqlold = mysql_query("SELECT * FROM manializer_adresse WHERE `name`='".$adresse."' ");
			$old = mysql_fetch_array($sqlold);
			$sql2 = "UPDATE `manializer_adresse` SET `besucher`='".($old["besucher"]+1)."' WHERE `name`='".$adresse."' ";
			mysql_query($sql2);
		}
	} else { # ohne Link, kommt durchs Adresse eintippen im Browser 
		$adresse='EINGETIPPT';
		$sqlold = mysql_query("SELECT * FROM manializer_adresse WHERE `name`='eingetippt' ");
		$old = mysql_fetch_array($sqlold);
		$sql2 = "UPDATE `manializer_adresse` SET `besucher`='".($old["besucher"]+1)."' WHERE `name`='eingetippt' ";
		mysql_query($sql2);
	}
	//myend
	
	$time = strftime("%d.%m.%y");
	$ip = $_SERVER["REMOTE_ADDR"];
	if($_GET['path'] == '' && $_SESSION['path'] != '')
		$_GET['path'] = $_SESSION['path'];
	$sql = "INSERT INTO `manializer_visits` (`login` , `nick` , `path` , `lng` , `date` , `ip` , `adresse`, `time`) VALUES ('".$_GET["playerlogin"]."', '".$_GET['nickname']."', '".$_GET["path"]."', '".$la."', '".$time."', '".$ip."', '".$adresse."', '".date("i.H")."')";
	mysql_query($sql);
}

// 5. The login
if($plid == 1)
{
	$sql = mysql_query("SELECT * FROM manializer_players WHERE `login`='".$_GET["playerlogin"]."'");
	$exits = mysql_num_rows($sql);
	$time = strftime("%d.%m.%y");

	if($exits == 0)
	{
		$ip = $_SERVER["REMOTE_ADDR"];
		$sql2 = "INSERT INTO `manializer_players` (`id` , `lstvisit` , `num_visits` , `login` , `nick` , `path` , `lng` , `ip`) VALUES ('', '".$time."', '1', '".$_GET["playerlogin"]."', '".$_GET['nickname']."', '".$_GET["path"]."', '".$_GET["lang"]."', '".$ip."')";
		mysql_query($sql2);
	} else {
		$time = strftime("%d.%m.%y");
		while($row = mysql_fetch_array($sql)) {
			$newnum = $row['num_visits'] + 1;
			$sql2 = "UPDATE `manializer_players` SET `num_visits`='".$newnum."' WHERE `login`='".$_GET["playerlogin"]."'";
			mysql_query($sql2);
			$sql2 = "UPDATE `manializer_players` SET `lstvisit`='".$time."' WHERE `login`='".$_GET["playerlogin"]."'";
			mysql_query($sql2);
		}
	}
}
//6. Stunde -- my
$sql = mysql_query("SELECT * FROM manializer_stunde WHERE `time`='".date("G")."'");
$exits = mysql_num_rows($sql);

if($exits == 0 && $luois!="admin"){
	$sql2 = "INSERT INTO `manializer_stunde` (`time` , `anzahl`) VALUES ('".date("G")."', '1')";
	mysql_query($sql2);
	$_SESSION["time"]=date("G.z");
} elseif($_SESSION["time"]!=date("G.z") && $luois!="admin") {
	$_SESSION["time"]=date("G.z");
	$sql5 = mysql_query("SELECT * FROM manializer_stunde WHERE time = '".date("G")."' ");
	$infos = mysql_fetch_array($sql5);
	$old=$infos["anzahl"];
	$new=$old+1;
	$sql2 = "UPDATE `manializer_stunde` SET `anzahl`='".$new."' WHERE `time`='".date("G")."' ";
	mysql_query($sql2);
}

//ZEIT my!
$exits = 0;
if(isset($_SESSION["username"])){
	$sql = mysql_query("SELECT * FROM manializer_zeit WHERE `login`='".$_SESSION["username"]."' AND tag = ".date("j")." AND monat = ".date("n")." AND jahr = ".date("Y")."");
	$exits = mysql_num_rows($sql);
}
$na=1;
if($exits == 0 && $_SESSION["username"]!=""){
	$sql2 = "INSERT INTO `manializer_zeit` (`login` , `zeit`, `tag`,`monat`,`jahr`, `timestamp`) VALUES ('".$_SESSION["username"]."', '20', '".date("j")."', '".date("n")."', '".date("Y")."', '".time()."')";
	mysql_query($sql2);
} elseif(($luois!="admin" or $na="1") && $_SESSION["username"]!="") { //($edit>=1) &&  ???
	$sql5 =$sql;
	$infos = mysql_fetch_array($sql5);
	$old=$infos["zeit"];
	if(time()-$infos["timestamp"] < 90)
		$new=$old+(time()-$infos["timestamp"]); //Zeitunterschied seit letztem Besuch dazurechnen, wenn der Unterschied < 200 Sekunden beträgt.
	else
		$new=$old+20; //2 Minuten dazurechnen, da es ein neuer Besuch (am gleich Tag) ist
	$sql2 = "UPDATE `manializer_zeit` SET `zeit`='".$new."', `timestamp` = '".time()."'  WHERE `login`='".$_SESSION["username"]."' AND tag = ".date("j")." AND monat = ".date("n")." AND jahr = ".date("Y")." ";
	mysql_query($sql2);
}

//ZEIT my end!
?>