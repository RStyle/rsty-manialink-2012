<?php
//  <quad posn="-35.00 35.00 1" sizen="10.00 10.00" style="Bgs1" substyle="BgCardBuddy" halign="center" valign="center" />
if($_GET["story"]!=""){
$st=$_GET["story"];
$story=trim($_GET['story']);
if(file_exists("./rsty/news/$st.txt")){
$story_t=file("./rsty/news/{$story}.txt");
echo'
<quad style="Bgs1" substyle="BgCardList" posn="0 0 47" sizen="50 40" halign="center" valign="center" />
<frame posn="0 9">
<label style="TextCardRaceRank" posn="24 9 48" sizen="7 3" text="X" valign="center" halign="right" manialink="'.$ml.'?';
$l=0;
foreach($HTTP_GET_VARS as $key => $value) {
if($key!="story"){
if($l==1){ echo'&amp;'; }
echo $key.'='.$value;
$l=1;
}
}
echo'" />
<label posn="-24 9 48" sizen="7 3" text="'.$story.'.2010" valign="center" />
<label posn="-15 9 48" sizen="20 3" text="'.xmlspecialchars($story_t["0"]).'" valign="center" />
<label posn="-24 5.1 48" textcolor="EEE" sizen="47 26" text="'.str_replace("\\n\\","\n",$story_t["1"]).'" valign="center" />
</frame>
';
} else {
echo'
<quad style="Bgs1" substyle="BgCardList" posn="0 0 47" sizen="50 40" halign="center" valign="center" />
<label posn="-5 9" sizen="20 3" text="./rsty/news/'.$st.'.txt" valign="center" />
';
}
}
$actualday=date(j);
if($_GET['y']==""){
$y=date(Y); 
} else {
$y=$_GET['y'];
}
if($_GET['date']==""){
$monat=date(n);
} else {
$monat=$_GET['date'];
}
$erstertag=date("N", mktime(0, 0, 0, $monat, 1, $y));
if($_GET['date']==""){
$days=date(t);
} else {
$days=date("t", mktime(0, 0, 0, $monat, 1, $y));
}
//$days=date(t);
//$days=$days+$erstertag-1;
$i=$erstertag;
$posx=$erstertag * 10 -30.00 -10 ;
$posy=37.00;
  for($d=1;$d<=$days;$d++){
  $posyt=$posy;
  if($posyt<="-10"){
  $posyt=-22.1;
  }
  if(file_exists("./rsty/news/$d.$monat.txt")){
   //$nn=file("./rsty/news/$d.$monat.txt");
   $nn=file("./rsty/news/$d.$monat.txt");
   $nn=$nn[0+0];
   $n=$nn;
   }else{
   $n="";
   }
  //substyle="BgCardBuddy"
  $n2=str_replace("\\n\\","\n",$n);
  if($_SESSION['login']=="admin" && $n!=""){
  echo'
  <label style="TextSubTitle1" posn="'.$posx.' '.($posy+5).' 10" sizen="3 2" textsize="2.9" text="X" manialink="'.$ml.'?page=admin&amp;site=newsschreiben&amp;action=delete&amp;story='.$d.'.'.$monat.'" valign="center" halign="right" />
  <label style="TextSubTitle1" posn="'.($posx+4).' '.($posy+5).' 10" sizen="3 2" textsize="2.9" text=" Edit " manialink="'.$ml.'?page=admin&amp;site=newsschreiben&amp;action=edit&amp;story='.$d.'.'.$monat.'" valign="center" halign="right" />
  ';
  }
  echo'
  
  <quad posn="'.$posx.' '.$posy.' 10" sizen="10 14" image="./header/white.png" halign="center" valign="center" />
  <label posn="'.($posx-3).' '.($posy+5).' 10" sizen="3 3" text="$F00'.$d.'$z" halign="center" valign="center" />
  <label autonewline="1" style="TextSubTitle1" posn="'.$posx.' '.($posy+3).' 10" sizen="8 7" textsize="2.9" text="$s$000$n$t'.str_replace(' ',"\n",$n2).'" ';if($n!=""){
  echo'manialink="'.$ml.'?page=news&amp;story='.$d.'.'.$monat;
  if($_GET['date']!=""){echo '&amp;date='.$_GET["date"];}
  if($_GET['y']!=""){echo '&amp;y='.$_GET["y"];}
  echo'"';}echo' halign="center" />
  ';
  
  $posx=$posx+10;
  if(($posx>30)&&($posy<=-12)){
  $t="t";
  $posy=$posy+14*4;
  $posx=-30;
  $zo="dd";
  echo '$g';
  } elseif($posx>30){
  $posx=-30;
  $posy=$posy-14;  
  }
//$i++;
 }
 for($d=$d;$d<=35;$d++){
 echo'
  
  <quad posn="'.$posx.' '.$posy.' 10" sizen="10 14" image="./header/white.png" halign="center" valign="center" />
  ';
    $posx=$posx+10;
  if(($posx>30)&&($posy<=-12)){
  $t="t";
  $posy=$posy+14*4;
  $posx=-30;
  $zo="dd";
  echo '$g';
  } elseif($posx>30){
  $posx=-30;
  $posy=$posy-14;  
  }
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
}//&#228;
$monat5=array('0','Januar','Februar','März','April','Mai','Juni','Juli','August','September','November','Dezember'
);
//$monat5[3]=str_replace( "ä", &auml;, $monat5[3] );
function leer($a){
$ab="";
for($v = 1; $v <= $a+0; $v++){
$ab.=" ";
}
return $ab;
}
  $posmm=48.4;
  if($la=="de" && $monat=="3"){ echo'
    <label posn="-63 -37 33" sizen="30.5 3" valign="bottom" >$F00Marz.'.$y.'$z</label>
    <label posn="-61.2 -35.5 33" sizen="30.5 3" valign="bottom" >$F00..</label>
  ';
  } else {
  echo'
    <label posn="-63 -37 33" sizen="30.5 3" valign="bottom" >$F00'.trim($_SESSION[$monat5[$monat]][$la]).'.'.$y.'$z</label>
  ';
  }
echo '
  <quad manialink="'.$ml.'?page=news&amp;date='.$monat2.'&amp;y='.$y2.'" posn="38 40.00 17" sizen="5 5" halign="center" valign="center" style="Icons64x64_1" substyle="ArrowNext" />
  <quad manialink="'.$ml.'?page=news&amp;date='.$monat1.'&amp;y='.$y1.'" posn="-38 40.00 17" sizen="5 5" halign="center" valign="center" style="Icons64x64_1" substyle="ArrowPrev" />

  <label posn="-30 -37 18" textsize="3.4" halign="center"  valign="bottom" text="$000'.$_SESSION["montag"][$la].'" />
  <label posn="-20 -37 18" textsize="3.4" halign="center" sizen="9.3 3" valign="bottom" text="$000'.$_SESSION["dienstag"][$la].'" />
  <label posn="-10 -37 18" textsize="3.4" halign="center" sizen="9.3 3"  valign="bottom" text="$000'.$_SESSION["mittwoch"][$la].'" />
  <label posn="0 -37 18" textsize="3.4" halign="center" sizen="9.3 3" valign="bottom" text="$000'.$_SESSION["donnerstag"][$la].'" />
  <label posn="10 -37 18" textsize="3.4" halign="center"  valign="bottom" text="$000'.$_SESSION["freitag"][$la].'" />
  <label posn="20 -37 18" textsize="3.4" halign="center"  valign="bottom" text="$000'.$_SESSION["samstag"][$la].'" />
  <label posn="30 -37 18" textsize="3.4" halign="center"  valign="bottom" text="$000'.$_SESSION["sonntag"][$la].'" />
  <quad posn="0 -38 3" sizen="128 4.1" image="./header/white.png" valign="bottom" halign="center" ation="1" />
  ';
?>