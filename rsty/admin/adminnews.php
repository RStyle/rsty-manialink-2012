<?php
include_once('../../connect.php');
include('function.colortm.php');
function newnews($string, $geheftet){
if(empty($string)){
trigger_error("Bitte <b>gueltigen</b> String angeben!");
}
if(!is_numeric($geheftet)){
trigger_error("$geheftet ist <b>keine</b> gueltige Zahl!");
}
$string='$s'.str_replace('$w', '', str_replace('$o', '', htmlspecialchars($string)));
$datum=date("j. F Y");
$bef="INSERT INTO news (news, datum, geheftet) VALUES('$string', '$datum', '$geheftet');";
$mysqli->query($bef);
if(!$quer){
trigger_error("<b>Fatal Error:</b>".mysql_error());
}
}

echo'
<entry halign="center" valign="center" posn="0 0 5" sizen="30 3" default="Neue Nachricht" name="a" />
<entry halign="center" valign="center" posn="0 -5 5" sizen="30 3" default="2" name="b" />
<label halign="center" valign="center" posn="0 -12 5" sizen="30 3" text="Schreiben" manialink="'.$ml.'?page=admin&amp;site=adminnews&amp;a=a&amp;b=b" />
';
if($_GET["a"]!="" && $_GET["b"]!=""){
newnews(trim($_GET["a"]), $_GET["b"]);
}
?>