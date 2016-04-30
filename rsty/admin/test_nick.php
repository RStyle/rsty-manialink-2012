<?php
include_once('../../connect.php');
$aus="SELECT * FROM manializer_players WHERE login = 'luois_fun_gaal' LIMIT 1;";
$myless=$mysqli->query($aus);
$textmysql=$myless->fetch_array();
echo'
<label sizen="30 5" posn="0 0 6" text="'.$textmysql["nick"].'" />
';
#$mysqli->close();
?>