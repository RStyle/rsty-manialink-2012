<?php
#$mysqli= new mysqli("localhost" , "web10" , "", "usr_web10_1");

if($_GET['id']!="" && $_GET["id"]>=1){
$id=$_GET['id']*9;
} else {
$id=0;
}
    $sql = "SELECT
                COUNT(*) as Anzahl
            FROM
                screens"; 
				   $result = $mysqli->query($sql);
   $fetch=$result->fetch_array();
   $count=$fetch[0]+0;
				
$aus="SELECT * FROM screens ORDER BY id DESC LIMIT ".$id.",9 ;";
$aus2=$mysqli->query($aus);

$pos1=-30;
$pos2=30;
$p=31;
while($infos=$aus2->fetch_array()){
if($_GET["vollbild"]==$infos["id"]){
//'.(-2.5+0.801-5.7).'
//-38
if(trim($_SESSION[$infos["kom"]][$la])!="")$infos["kom"]=trim($_SESSION[$infos["kom"]][$la]);
echo '
    <quad halign="center" valign="bottom" posn="0 -38 28" sizen="128 83.6" manialink="'.$ml.'?page=screens'; if($_GET["id"]>=1)echo '&amp;id='.$_GET["id"]; echo'" image="./d/screens/'.$infos["file"].'"  />
';
}
echo'<quad posn="'.$pos1.' '.($pos2+13.5).' 1.3" sizen="27 20" halign="center" manialink="rsty:screens?id='.$infos["id"].'" image="./leer.png" imagefocus="./download.png" />

<quad posn="'.$pos1.' '.($pos2+14).' 0.1" sizen="28 36" halign="center" style="Bgs1InRace" substyle="BgTitle3_3" />
<quad posn="'.$pos1.' '.($pos2+13.5).' 1.1" sizen="27 20" halign="center" image="./d/screens/'.$infos["file"].'" />
<label text="$fff[    ]" posn="'.($pos1+13).' '.($pos2+13.5-0.1).' 1.3" textcolor="FFF" style="TextButtonSmall" manialink="'.$ml.'?page=screens&amp;vollbild='.$infos["id"]; if($_GET["id"]>=1)echo '&amp;id='.$_GET["id"]; echo'" halign="right" sizen="27 3" />
<label posn="'.$pos1.' '.($pos2+13.5-20.5).' 1.2" textcolor="DDD" halign="center" sizen="27 3" text="'.$infos["name"].'" />
<label posn="'.($pos1-13.5).' '.($pos2+13.5-23).' 1.2" style="TextInfoSmall" textcolor="DDD" sizen="27 3" text="'.trim($_SESSION["beschreibung"][$la]).' :" />
<label posn="'.($pos1-13.5).' '.($pos2+13.5-25.5).' 1.2" style="TextInfoSmall" textcolor="DDD" sizen="27 10" autonewline="1" text="'.$infos["kom"].'" />
';

$pos1+=$p;
if($pos1>=30){
$pos1=-30;
$pos2-=37;
}
}

$idm=$ml."?page=screens&amp;id=".($_GET["id"]-1);
if($id-9==0)$idm=$ml."?page=screens";
if($count>$id+9){
echo '
<quad posn="45 0 1" sizen="6 6" manialink="'.$ml.'?page=screens&amp;id'.($_GET["id"]+1).'" style="Icons64x64_1" substyle="ArrowNext"  />
';
}
if($_GET["id"]+0>=1){
echo '
<quad posn="-45 0 1" sizen="6 6" manialink="'.$idm.'" style="Icons64x64_1" substyle="ArrowPrev"  />
';
}

#$mysqli->close();
?>