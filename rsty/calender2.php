<?php
$posn="-35 45"; //Die Position des Kalendars
$scale="0.7"; //Die größe des Kalendars
$posn2="-62 -34"; //Die Position des Kalendars
$scale2="0.75"; //Die größe des Kalendars
$actualday=date(j);
if($_GET['y']=="" or $_GET["y"]==date(Y)){
$y=date(Y); 
} else {
$y=$_GET['y'];
$actualday=44;
}
if($_GET['date']=="" or $_GET["date"]==date(n)){
$monat=date(n);
} else {
$monat=$_GET['date'];
$actualday=44;
}
$erstertag=date("N", mktime(0, 0, 0, $monat, 1, $y));
if($_GET['date']==""){
$days=date(t);
} else {
$days=date("t", mktime(0, 0, 0, $monat, 1, $y));
}
$days=$days+$erstertag-1;
echo '<frame posn="'.$posn2.'" scale="'.$scale2.'">
<quad posn="-1.5 '.(3.5+3).' 3" sizen="23 24.5" image="./header/dark.png"/>
<frame posn="0 0 50" scale="0.75"><label posn="-1.2 3 50">$F0F$s$o M   D  M   D   F   S   S$z</label></frame>';
$i=$erstertag;
$d=1;
$posx=$erstertag * 3 - 2.5;
$posy=0;
$zo="t";
  while($i<=$days){
    echo '<label posn="'.$posx.' '.$posy.' 50">$500';
	if($d==$actualday){
	  echo '$00F';
	  }
	elseif($i % 7 == 0){
	  echo '$f00';
	}
	echo '$o$n'.$d.'</label>';
  $posx=$posx+3.1;
  if($i % 7 == 0 && $zo=="t"){
      $posy=$posy-3.8;
      $posx=0;
    }
	if($posy<=0-3.8*5){
  $posy=$posy+3.8*5;
  $posx=0;
  $zo="dd";
  	  echo '$g';
  }
$i++;
$d++;
}
$monat1=$monat-1;
$y1=$y;
if($monat1==0){
$y1--;
$monat1=12;
}
$monat2=$monat+1;
$y2=$y;
if($monat1==13){
$y2++;
$monat1=1;
}
$monat5=array('0','Januar','Februar','M&#228;rz','April','Mai','Juni','Juli','August','September','November','Dezember'
);
//style="Bgs1" substyle="NavButtonBlink"
echo '
  <quad manialink="'.$ml.'?date='.$monat2.'&amp;y='.$y2.'" posn="20 3.2 17" sizen="3.1 3.1" halign="center" valign="bottom" style="Icons64x64_1" substyle="ArrowNext" />
  <quad manialink="'.$ml.'?date='.$monat1.'&amp;y='.$y1.'" posn="0.1 3.2 17" sizen="3.1 3.1" halign="center" valign="bottom" style="Icons64x64_1" substyle="ArrowPrev" />
  ';
echo '</frame>';
?>