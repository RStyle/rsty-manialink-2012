<?php
$stand=30;//Regestrierbonus
#$mysqli= new mysqli("localhost" , "web10" , "", "usr_web10_1");
$site="page=admin&amp;site=game";
$datum=date(Y.'-'.n.'-');
$datum.=date(d);
$dd=$_SESSION['username'];
$path=$_SESSION['path'];
//<quad posn="0 0 0" sizen="16 16" halign="center" valign="center" style="Bgs1InRace" substyle="BgWindow1" />
echo'
<quad posn="0 20 3" sizen="30.2 3" halign="center" valign="center" style="Bgs1InRace" substyle="BgWindow1" />
<entry posn="0 20 4" sizen="29.4 2.8" halign="center" valign="center" name="zahl" default="PassWort" />
<label posn="0 16 4" sizen="24 1.8" halign="center" style="CardButtonMedium" valign="center" text="Regestrieren" manialink="'.$ml.'?'.$site.'&amp;pw=ZAHL" />
';
if($_GET['pw']!="" && !file_exists("./rsty/game/{$dd}.txt")){
$up="./rsty/game/";
$up.=$dd;
$up.=".txt";
file_put_contents($up, $dd); 
$d=$mysqli->real_escape_string($_SESSION['nickname']);
$p=$mysqli->real_escape_string($_SESSION['username']);
$b=$_GET['pw'];
//$insert="INSERT INTO games VALUES (".$b.",".$d.",'0',NULL)";
$mysqli->query("INSERT INTO games VALUES ('{$d}','{$stand}','{$datum}',NULL,'{$p}','{$b}','{$path}')");
}
$ergebnis=$mysqli->query("SELECT * FROM games LIMIT 1");
$pos=6;
while($z=$ergebnis->fetch_array()){
echo'
<label posn="0 '.$pos.' 5" sizen="30 5" text="$F00'.$z[0].'$z ist der neueste Spieler" halign="center" vlign="center" />
';
$pos-=5;
}
#$mysqli->close();
?>