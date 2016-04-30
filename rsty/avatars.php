<?php
#$mysqli= new mysqli("localhost" , "web10" , "", "usr_web10_1");
if($_GET['id']!="" && $_GET["id"]>=1){
$id=$_GET['id']+0;
} else {
$id=0;
}
$a=12 * $id;
$weiter=0;
$aus="SELECT * FROM avatars ORDER BY id DESC LIMIT ".$a.",12 ;";
$myless=$mysqli->query($aus);
$pos1=-36;
$p1o=$pos1;
$pos2=30;
$p=24;
while($infos=$myless->fetch_array()){
//style="Bgs1InRace" substyle="BgWindow1"
$name=antibild($infos["name"]);
$name[0]=strtoupper($name[0]);
$n=14.1;
$p2=0;
$preis=array("10","50","100");
$ppp=$infos['preis']-1;
echo'
<quad halign="center" valign="center" posn="'.$pos1.' '.$pos2.' 4" manialink="rsty:avatars?name='.antibild($infos["name"]).'" image="./leer.png" imagefocus="./download.png" sizen="18 18" />
<quad valign="center" halign="center" posn="'.$pos1.' '.$pos2.' 3" image="./d/avatars/'.$infos["name"].'" sizen="18 18" />
<quad halign="center" posn="'.$pos1.' '.($pos2+10).' 2" image="./header/dark.png" sizen="20 20" />
';
$pos1+=$p;
if($pos1>=40){
$pos1=$p1o;
$pos2-=25;
}
}
$aus2="SELECT * FROM avatars ORDER BY 'id' DESC LIMIT ".($a+12).",1 ;";
if($test=$mysqli->query($aus2)->fetch_array()){
echo'
<quad posn="50 10 4" style="Icons64x64_1" substyle="ArrowNext" manialink="'.$ml.'?page=avatars&amp;id='.($id+1).'" sizen="5 5" halign="center" valign="center" />
';
}
if($_GET["id"]>=1){
echo'
<quad posn="-50 10 4" style="Icons64x64_1" substyle="ArrowPrev" manialink="'.$ml.'?page=avatars&amp;id='.($id-1).'" sizen="5 5" halign="center" valign="center" />
';
}

#$mysqli->close();
?>