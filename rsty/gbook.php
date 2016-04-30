<?php
#$mysqli= new mysqli("localhost" , "web10" , "", "usr_web10_1");
if($_GET['id']!="" && $_GET["id"]>=1){
$id=$_GET['id']+0;
$id2=$_GET['id']+0;
} else {
$id=0;
}
$ida='SELECT COUNT(*) FROM gbook';
$idb=$mysqli->query($ida);
$idc=$idb->fetch_array();
$idmy=$idc[0+0];
$idmyp=$idmy+1;

$datum=date("j.m.Y");
$code=trim(file_get_contents('./rsty/code.txt'));
$_GET["eintrag"]=trim($_GET["eintrag"]);
if(!empty($_GET['eintrag']) && $_GET["code"]==$code && trim($_GET["eintrag"])!="Eintrag"){
$newcode=md5($code);
$newcode=md5($newcode);
$newcode=md5($newcode);
$newcode=md5($newcode);
$newcode=md5($newcode);
file_put_contents("./rsty/code.txt", $newcode);
$code=$newcode;
$_GET['eintrag']=trim($_GET['eintrag']);
if(!empty($_GET['eintrag'])){
$myplayer=$mysqli->real_escape_string($_SESSION['username']);
$mynick=$mysqli->real_escape_string($_SESSION['nickname']);
$_GET["eintrag"]=$mysqli->real_escape_string($_GET['eintrag']);
$insert="INSERT INTO gbook 
(nick,player,datum,eintrag,id)
VALUES
('".$mynick."','".$myplayer."','".$datum."','".$_GET['eintrag']."','".$idmyp."')";
$insertausfuhr=$mysqli->query($insert);
}
}

$a=7 * $id2;
$weiter=0;
$aus='SELECT * FROM gbook ORDER BY id DESC LIMIT '.$a.',7;';
$myless=$mysqli->query($aus);
$pos=33;
$posold=$pos;
$pos2=-20;
while($textmysql=$myless->fetch_array()){
if($_SESSION['login']=="admin"){
$a++;
echo'
<label posn="'.($pos2+3).' '.($pos+7).' 3" sizen="6 2.5" style="TextSubTitle1" text="$fffEdit " manialink="'.$ml.'?page=admin&amp;site=gbook_edit&amp;edit='.$textmysql["id"].'" />
<label posn="'.($pos2+0).' '.($pos+7).' 3" sizen="6 2.5" style="TextSubTitle1" text="$fffX" manialink="'.$ml.'?page=admin&amp;site=gbook_edit&amp;delete='.$textmysql["id"].'" />
';
}
$textmysql['eintrag']=explode('$$Admin$$',$textmysql['eintrag']);
echo '
<quad posn="'.$pos2.' '.($pos-0.5).' 2.9" sizen="36 16" halign="center" valign="center" style="Bgs1" substyle="BgList" />
<label sizen="30 11" maxline="4" posn="'.($pos2-17).' '.($pos+4.4).' 3" text="'.str_replace("\''","''",str_replace('"',"''",$textmysql['eintrag'][0])).'" />
<label sizen="34 5" posn="'.($pos2-17+30).' '.($pos+4.4-12.2).' 3" valign="bottom" halign="right" style="TextTitle2Blink" textsize="1" text="'.trim(str_replace("umu","\n",$textmysql['eintrag'][1])).'" />
<label posn="'.($pos2-17).' '.($pos+7).' 3"  sizen="36 15" text="'.$textmysql["nick"].'$z" />
<label posn="'.($pos2+17).' '.($pos+7).' 3"  sizen="36 15" halign="right" text="$i'.$textmysql["datum"].'" />
<label posn="'.($pos2+17).' '.($pos-8).' 3"  sizen="36 15" halign="right" valign="bottom" text="[$o'.$textmysql["id"].'$z]" />
';
//$gb[$i][3]
//halign="left|center|right"
$pos-=17;
if($pos<=-29){
$pos=33;
$pos2+=40;
}
}
$textmysql=$myless->fetch_array();
$pos=$posold-17*3;
$pos2=20;
echo '
<quad posn="20 '.$pos.' 2.9" sizen="36 16" halign="center" valign="center" style="Bgs1" substyle="BgList" />
<entry autonewline="1" sizen="30 11" posn="'.($pos2-15).' '.($pos+4.4).' 3" name="ein" default="'.$_SESSION["eintrag"][$la].'" />
<label posn="'.($pos2-17).' '.($pos+7).' 3"  sizen="36 15" text="'.$_SESSION['nickname'].'$z" />
<label posn="'.($pos2+17).' '.($pos+7).' 3"  sizen="36 15" halign="right" text="$i'.$datum.'" />
<label posn="'.$pos2.' '.($pos-7.5).' 3" style="CardButtonMedium" manialink="'.$ml.'?page=gbook&amp;code='.trim(file_get_contents('./rsty/code.txt')).'&amp;eintrag=ein" sizen="36 15" halign="center" valign="center" text="'.$_SESSION["senden"][$la].'" />
';
if($_GET['id']>=1){
if($_GET['id']==""){
$id++;
$idp=1;
}
echo'
<label posn="-15 -30 4" style="CardButtonMedium" manialink="'.$ml.'?page=gbook';if($_GET['id']>2.1){echo'&amp;id='.($id-1).'';}echo'" sizen="36 15" halign="center" valign="center" text="Seite '.($id-0).'" />
';
}
if($idp==1)$id--;
    $sql = "SELECT
                COUNT(*) as Anzahl
            FROM
                tracks";   
				
   $result = $mysqli->query($sql);
   $fetch=$result->fetch_array();
   $count=$fetch[0]+0;
   if($cout>=$id2*7){
echo'
<label posn="15 -30 4" style="CardButtonMedium" manialink="'.$ml.'?page=gbook&amp;id='.($id+1).'" sizen="36 15" halign="center" valign="center" text="Seite '.($id+2).'" />
';
}
#$mysqli->close();
?>