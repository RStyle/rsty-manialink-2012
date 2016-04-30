<?php
$bv="quiz";
$verzeichnis=opendir($bv);
$horns=array();
while($datei = readdir($verzeichnis)){
if(preg_match("/\.txt$/", $datei)) {
$horns[]= $datei;
}
}
$count=count($horns);
echo'
<entry sizen="40 3" default="Frage" posn="0 15 2" halign="center" valign="center" name="titel"/>
<entry sizen="40 3" default="1" posn="0 10 2" autonewline="1" halign="center" valign="center" name="f1"/>
<entry sizen="40 3" default="2" autonewline="1" posn="0 6 2" halign="center" valign="center" name="f2"/>
<entry sizen="40 3" autonewline="1" default="3" posn="0 2 2" halign="center" valign="center" name="f3"/>
<entry sizen="40 3" default="1/2/3" posn="0 -5 2" halign="center" valign="center" name="a"/>
<label posn="0 -12 2" halign="center" manialink="'.$ml.'?page=admin&amp;site=quizadmin&amp;titel=titel&amp;f1=f1&amp;f2=f2&amp;f3=f3&amp;a=a" valign="center" style="CardButtonMedium" text="Erstellen" />
';
if($_GET['titel']!=""&&$_GET['a']!=""){
$now=$_GET['titel'];
$now.="\n";
$now.=$_GET['f1'];
$now.="\n";
$now.=$_GET['f2'];
$now.="\n";
$now.=$_GET['f3'];
$now.="\n";
$now.=$_GET['a'];
$up="quiz/";
$up.=$count;
$up.=".txt";
file_put_contents($up, $now);
}
?>