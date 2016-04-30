<?php
$text=file('./rsty/gbook.txt');
if($_GET['id']!=""){
$id=$_GET['id']+0;
} else {
$id=1;
}
$datum=date("j.m.Y");
if(!empty($_GET['eintrag'])){
$_GET['eintrag']=trim($_GET['eintrag']);
if(!empty($_GET['eintrag'])){
$old=file_get_contents('./rsty/gbook.txt');
$new=str_replace("\n",":bmumb:",$_GET['eintrag']);
$new.=SECRET_CODE;
$new.=$_SESSION["nickname"].'$z ('.$_SESSION["username"].')';
$new.=SECRET_CODE;
$new.=$datum;
$new.=SECRET_CODE;
$ncc=explode(SECRET_CODE,$text[0]);
$new.=$ncc[3]+1;
$new.="\n";
$new.=$old;
file_put_contents("./rsty/gbook.txt",$new);
}
}
$text=file('./rsty/gbook.txt');
$textc=count($text);
$a=7 * $id - 7;
$tt=$textc-$a;
$ttp=$tt;
if($tt>=7){
$textc=$a+7;
}
$pos=33;
$pos2=-20;
for($i=$a;$i<$textc;$i++){
$gb[$i]=explode(SECRET_CODE,$text[$i]);
$gb[$i][0]=str_replace(":bmumb:","\n",$gb[$i][0]);
$gb[$i][3]=str_replace("\n","",$gb[$i][3]);
$gb[$i][1]=explode("(",$gb[$i][1]);
echo '
<quad posn="'.$pos2.' '.$pos.' 2.9" sizen="36 15" halign="center" valign="center" style="Bgs1InRace" substyle="BgWindow1" />
<label sizen="30 11" maxline="4" posn="'.($pos2-17).' '.($pos+4.4).' 3" text="'.$gb[$i][0].'" />
<label posn="'.($pos2-17).' '.($pos+7).' 3"  sizen="36 15" text="'.trim($gb[$i][1][0]).'" />
<label posn="'.($pos2+17).' '.($pos+7).' 3"  sizen="36 15" halign="right" text="'.$gb[$i][2].'" />
<label posn="'.($pos2+17).' '.($pos-7).' 3"  sizen="36 15" halign="right" valign="bottom" text="$o'.$gb[$i][3].'$z" />
';
//$gb[$i][3]
//halign="left|center|right"
$pos-=16;
if($pos<=-29){
$pos=33;
$pos2+=40;
}
}
$pos=-15;
$pos2=20;
echo '
<quad posn="20 -15 2.9" sizen="36 15" halign="center" valign="center" style="Bgs1InRace" substyle="BgWindow1" />
<entry autonewline="1" sizen="30 11" posn="'.($pos2-15).' '.($pos+4.4).' 3" name="ein" default="Eintrag" />
<label posn="'.($pos2-17).' '.($pos+7).' 3"  sizen="36 15" text="'.$_SESSION['nickname'].'$z" />
<label posn="'.($pos2+17).' '.($pos+7).' 3"  sizen="36 15" halign="right" text="'.$datum.'" />
<label posn="'.$pos2.' '.($pos-7.5).' 3" style="CardButtonMedium" manialink="'.$ml.'?page=gbook&amp;eintrag=ein" sizen="36 15" halign="center" valign="center" text="SENDEN" />
';
if($_GET['id']==""){
$id++;
}
if($_GET['id']>0.1){
echo'
<label posn="-15 -30 4" style="CardButtonMedium" manialink="'.$ml.'?page=gbook';if($_GET['id']>2.1){echo'&amp;id='.($id-1).'';}echo'" sizen="36 15" halign="center" valign="center" text="Seite '.($id-1).'" />
';
}
$i++;
if($ttp>=$i){
echo'
<label posn="15 -30 4" style="CardButtonMedium" manialink="'.$ml.'?page=gbook&amp;id='.$id.'" sizen="36 15" halign="center" valign="center" text="Seite '.$id.'" />
';
}
?>