<?php
include_once('../connect.php');
$aus='SELECT * FROM manializer_visits ORDER BY id DESC;';
$myless=$mysqli->query($aus);
$textmysql=$myless->fetch_array();
echo'
<?xml version="1.0" encoding="utf-8"?>
<manialink>
<timeout>0</timeout>
<label posn="0 0 0" sizen="40 3" text="'.$textmysql["nick"].'" />
</manialink>
';
#$mysqli->close();
?>