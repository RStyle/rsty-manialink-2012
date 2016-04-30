<?php
header("Content-Type: text/xml");
include_once('../connect.php');
$k=10;
echo '<frame posn="-63.3 -2" scale="0.85">
<quad posn="-0.5 10.5 20" sizen="48.5 0.3" image="http://myplugin.manialinkhost.de/Manialink/image/red.bik" />
<quad posn="-1 15 5" sizen="50 21" style="Bgs1" substyle="NavButton" />
<quad posn="-1 15 5" sizen="50 21" style="Bgs1" substyle="NavButton" />';
$bef="SELECT * FROM news WHERE geheftet = '2' ORDER BY ID DESC LIMIT 0,5;";
$quer=$mysqli->query($bef);
while($row = $quer->fetch_assoc()){
  echo '
<label posn="0 '.$k.' 6" sizen="9 3">
$fc2'.$row['datum'].'
</label>
<label posn="10 '.$k.' 6" sizen="38.5 0 5">
$fc2'.$row['news'].'</label>';
  $k=$k-3;
}
$bef1="SELECT * FROM news WHERE geheftet = '1' ORDER BY ID DESC LIMIT 1;";
$quer1=$mysqli->query($bef1);
while($row1 =  $quer1->fetch_assoc()){
echo '
<label posn="0 14 6" sizen="9 3">
$f00'.$row1['datum'].'
</label>
<label posn="10 14 6" style="TextTitle2Blink" sizen="37.5 0 5">
$f00'.$row1['news'].'</label>';}
echo '</frame>';
?>