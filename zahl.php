<?php
function auszahl($a,$b,$c){
global $mysqli;
$b=floor(abs($b*70/100));
$aa="SELECT * FROM admins WHERE user = '".$a."'";
$aab=$mysqli->query($aa);
 $exits = $aab->num_rows;
 if($exits == 0)
 {
  $sql2 = "INSERT INTO `admins` (`user` , `cc` , `".$c."`, `now`) VALUES ('".$a."', '".$b."', '".$b."', '".$b."')";
  $eintraga=$mysqli->query($sql2);
 }
 else
 {
 $aus="SELECT * FROM admins WHERE user = '".$a."' LIMIT 1 ;";
$myless=$mysqli->query($aus);
$infos=$myless->fetch_array();
$new=$infos["cc"]+$b;
$new2=$infos[$c]+$b;
$new3=$infos["now"]+$b;
   $sql2 = "UPDATE `admins` SET `cc`='".$new."'  WHERE user = '".$a."' LIMIT 1";
   $sql3 = "UPDATE `admins` SET `".$c."`='".$new2."'  WHERE user = '".$a."' LIMIT 1";
   $sql4 = "UPDATE `admins` SET `now`='".$new3."'  WHERE user = '".$a."' LIMIT 1";
   $updateausfuhra=$mysqli->query($sql2);
   $updateausfuhrb=$mysqli->query($sql3);
   $updateausfuhrc=$mysqli->query($sql4);
 }

}
?>