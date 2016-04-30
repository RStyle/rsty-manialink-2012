<?php
$ml2="rsty_rou";
$us=$_SESSION['username'];
$dato=$mysqli->query("SELECT * FROM games WHERE player = '{$us}' ");
$daten=$dato->fetch_array();
echo '
<frame scale="0.93" posn="32 20">
<label posn="0 -24 5" sizen="15 2.1" halign="center" valign="center" text="EINSATZ : (0-'.$daten["geld"].')" />
<quad posn="0 -29 5" sizen="18 7.4" halign="center" valign="bottom" style="Bgs1InRace" substyle="BgWindow1" />
<entry posn="0 -27 5" sizen="15 2.1" halign="center" valign="center" name="b" default="0-'.$daten['geld'].'" />
</frame>
<frame posn="-10 -2.5">
<format  textcolor="DDFA" textsize="2.6" /> 
<quad bgcolor="FFF" sizen="1.6 61" posn="7.2 3 1.9" halign="center" valign="center" />
<quad bgcolor="FFF" sizen="1.6 61" posn="-7.2 3 1.9" halign="center" valign="center" />
<quad bgcolor="FFF" sizen="1.6 62" posn="33 3 2" halign="center" valign="center" />
<quad bgcolor="FFF" sizen="1.6 62" posn="-33 3 2" halign="center" valign="center" />

<label sizen="20 1.8" posn="0 -31 2" halign="center" valign="center" textsize="4.6" style="CardButtonMediumWide" manialink="'.$ml2.'?play=help" text="$F00REGELN" />

<quad bgcolor="FFF" sizen="64 1.8" posn="0 33 2" halign="center" valign="center" />
<quad bgcolor="FFF" sizen="64 1.8" posn="0 -27 2" halign="center" valign="center" />
';
$pos1=-14;
$pos2=30;
$farbe=array(
'',
'$F00','$000','$F00','$000','$F00','$000','$F00','$000','$F00','$000','$000','$F00','$000','$F00','$000','$F00','$000','$F00','$F00','$000','$F00','$000','$F00','$000','$F00','$000','$F00','$000','$000','$F00','$000','$F00','$000','$F00','$000','$F00'
);
for($i = 1; $i <= 36;$i++){
echo '
<label sizen="7 5"  posn="'.$pos1.' '.$pos2.' 1" halign="center" valign="center" manialink="'.$ml2.'?play='.$i.'&amp;set=b" style="TextRaceChrono" text="'.$farbe[$i].$i.'" />
';
$pos1+=14;
if($pos1>14.1){
$pos1=-14;
$pos2-=4;
}
}
$pos1=-14;
$pos2-=5;
for($i = 1; $i <= 3;$i++){
switch($i) {
    case 1 :
     $ii="1 - 12";
	break;
    case 2 :
     $ii="13 - 24";
	break;
    case 3 :
     $ii="25 - 36";
	break;
	}
echo '
<label sizen="11 7.9"  posn="'.$pos1.' '.$pos2.' 1" halign="center" valign="center" manialink="'.$ml2.'?play='.$ii.'&amp;set=b" style="TextRaceChrono" text="$0F0'.$ii.'" />
';
$pos1+=14;
}
$s1=9;
$s2=6;
$pos1=-26;
$pos2=27.5;
$ii="Red";
echo '
<label sizen="'.$s1.' '.$s2.' 1"  halign="center" valign="center" manialink="'.$ml2.'?play='.$ii.'&amp;set=b" style="TextRaceChrono" text="$D00'.$ii.'" posn="'.$pos1.' '.$pos2.'" />
';
$pos2-=17.5;
$ii="EVEN";
echo '
<label sizen="'.$s1.' '.$s2.' 1"  halign="center" valign="center" manialink="'.$ml2.'?play='.$ii.'&amp;set=b" style="TextRaceChrono" text="$00F'.$ii.'" posn="'.$pos1.' '.$pos2.'" />
';
$pos2-=17.5;
$ii="19-36";
echo '
<label sizen="'.$s1.' '.$s2.' 1"  halign="center" valign="center" manialink="'.$ml2.'?play='.$ii.'&amp;set=b" style="TextRaceChrono" text="$FFF'.$ii.'" posn="'.$pos1.' '.$pos2.'" />
';
$pos2-=17.5;
$ii="Black";
$pos1=26;
$pos2=27.5;
echo '
<label sizen="'.$s1.' '.$s2.' 1"  halign="center" valign="center" manialink="'.$ml2.'?play='.$ii.'&amp;set=b" style="TextRaceChrono" text="$111'.$ii.'" posn="'.$pos1.' '.$pos2.'" />
';
$pos2-=17.5;
$ii="ODD";
echo '
<label sizen="'.$s1.' '.$s2.' 1"  halign="center" valign="center" manialink="'.$ml2.'?play='.$ii.'&amp;set=b" style="TextRaceChrono" text="$00F'.$ii.'" posn="'.$pos1.' '.$pos2.'" />
';
$pos2-=17.5;
$ii="1 - 18";
echo '
<label sizen="'.$s1.' '.$s2.'"  posn="'.$pos1.' '.$pos2.' 1" halign="center" valign="center" manialink="'.$ml2.'?play='.$ii.'&amp;set=b" style="TextRaceChrono" text="$FFF'.$ii.'" />
';
$pos2-=17.5;

if($_GET['play']=="help"){
echo '
<label textsize="4.6" posn="0 27 5" sizen="50 50" halign="center" valign="top">
$o$F00REGELN$z$o

            Gewinne:
			
Zahl
1-12
13-24
25-36
1-18
19-36
EVEN/Gerade
ODD/Ungerade
$F00RED$z$o
$000BLACK$z$o
</label>
<label textsize="4.6" posn="15 4.6 5"  >
11 Fache des Einsatzes
2 Fache des Einsatzes
2 Fache des Einsatzes
2 Fache des Einsatzes
1.5 Fache des Einsatzes
1.5 Fache des Einsatzes
1.5 Fache des Einsatzes
1.5 Fache des Einsatzes
1.5 Fache des Einsatzes
1.5 Fache des Einsatzes
</label>
<label style="TextButtonBig" manialink="'.$ml.'?page=games&amp;site=Roullet" textsize="4.6" posn="31 26 5"  >
X
</label>
<quad posn="0 -4.5 5" sizen="70 66" halign="center" valign="center" style="Bgs1InRace" substyle="BgWindow1" />
';
} elseif($_GET['play']!="" && $_GET['play']!="help" && $_GET['a']=="b"){

$zahll=rand(1,36);
$zahll2=$zahll % 2;
$game="game2";
$us=$_SESSION['username'];
$newnum = $daten['game3'] + 1;
$dato=$mysqli->query("SELECT * FROM games WHERE player = '{$us}' ");
$daten=$dato->fetch_array();
if($_GET['play']==$zahll && $_GET['play'] != "1 - 12" && $_GET['play'] != "13 - 24" && $_GET['play'] != "25 - 36" && $_GET['play'] != "1 - 18" && $_GET['play'] != "19 - 36"){
$w=12;
$spiel="GEWONNEN";
$g="Gewonnen!";
include("rsty/game/auszahl.php");
$gewinn=120;
} elseif($_GET['play']=="1 - 12" && $zahll<=12){
$w=2;
$spiel="GEWONNEN";
$g="Gewonnen!";
include("rsty/game/auszahl.php");
$gewinn=20;
} elseif($_GET['play']=="13 - 24" && $zahll<=24 && $zahll>=13){
$w=2;
$spiel="GEWONNEN";
$g="Gewonnen!";
include("rsty/game/auszahl.php");
$gewinn=20;
} elseif($_GET['play']=="25 - 36" && $zahll<=36 && $zahll>=25){
$spiel="GEWONNEN";
$gewinn=20;
$w=2;
$g="Gewonnen!";
include("rsty/game/auszahl.php");
} elseif($_GET['play']=="1 - 18" && $zahll<=18 ){
$spiel="GEWONNEN";
$gewinn=15;
$w=1.5;
$g="Gewonnen!";
include("rsty/game/auszahl.php");
} elseif($_GET['play']=="19 - 36" && $zahll>=18 ){
$spiel="GEWONNEN";
$gewinn=15;
$w=1.5;
$g="Gewonnen!";
include("rsty/game/auszahl.php");
} elseif($_GET['play']=="Red" && $farbe[$zahll]=='$F00' ){
$spiel="GEWONNEN";
$gewinn=15;
$w=1.5;
$g="Gewonnen!";
include("rsty/game/auszahl.php");
} elseif($_GET['play']=="Black" && $farbe[$zahll]=='$000' ){
$spiel="GEWONNEN";
$gewinn=15;
$w=1.5;
$g="Gewonnen!";
include("rsty/game/auszahl.php");
} elseif($_GET['play']=="EVEN" && $zahll2==0 ){
$spiel="GEWONNEN";
$gewinn=15;
$w=1.5;
$g="Gewonnen!";
include("rsty/game/auszahl.php");
} elseif($_GET['play']=="ODD" && $zahll2==1 ){
$spiel="GEWONNEN";
$gewinn=15;
$w=1.5;
$g="Gewonnen!";
include("rsty/game/auszahl.php");
} else {
$spiel="VERLOREN";
$gewinn=0;
include("rsty/game/auszahl.php");
}
echo '
<label sizen="64 1.8" posn="0 35 3" halign="center" valign="center" textsize="6.6" style="CardButtonMediumWide" action="1" text="'.$spiel.'   -   Zahl: '.$zahll.'" />
';
//ODD=UNGERADE/EVEN=GERADE
}
echo'
</frame>
';
?>