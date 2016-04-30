<?php
#$mysqli= new mysqli("localhost" , "web10" , "", "usr_web10_1");
if($_GET["edit"]!=""){
if($_GET['eintrag']!=""){
$idedit=$_GET["id"]+0;
$eintragedit=trim($_GET['eintrag']);
$update="UPDATE gbook SET eintrag='".$eintragedit."', id='".$idedit."' WHERE id = ".$_GET['edit']."";
$updateausfuhr=$mysqli->query($update);
$_GET['edit']=$_GET['id'];
}


$id=$_GET["edit"]+0;
if($_GET["eintrag"]!=""){
$id=$_GET["id"];
}
$aus="SELECT * FROM gbook WHERE id = '".$id."' LIMIT 1;";
$myless=$mysqli->query($aus);
$textmysql=$myless->fetch_array();
$pos=0;
$pos2=0;
echo '
<quad posn="0 0 2.9" sizen="36 15" halign="center" valign="center" style="Bgs1InRace" substyle="BgWindow1" />
<entry  autonewline="1" sizen="30 11" maxline="4" posn="'.($pos2-17).' '.($pos+4.4).' 3" default="'.utf8_decode($textmysql['eintrag']).'" name="eintrag" />
<label posn="'.($pos2-17).' '.($pos+7).' 3"  sizen="22 2" text="'.$textmysql["nick"].'" />
<label posn="'.($pos2+17).' '.($pos+7).' 3" sizen="6 2" halign="right" text="'.$textmysql["datum"].'" />
<entry posn="'.($pos2+17).' '.($pos-7).' 3"  sizen="2 3.3" halign="right" valign="bottom" default="'.$textmysql["id"].'" name="id" />

<label posn="0 -15 3" sizen="10 2" halign="center" text="Edit" manialink="'.$ml.'?page=admin&amp;site=gbook_edit&amp;edit='.$_GET["edit"].'&amp;eintrag=eintrag&amp;id=id" />
';
} elseif($_GET["delete"]!=""){
$delete="DELETE FROM gbook WHERE id = ".$_GET['delete']."";
$deleteausfuhr=$mysqli->query($delete);
echo'
<label posn="0 0 3" sizen="60 5" halign="center" valign="center" text="Nachricht Nummer : '.$_GET["delete"].' wurde erfolgreich gel&#246;scht!" />
';
}
#$mysqli->close();
?>