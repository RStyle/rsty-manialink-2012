<?php
#$mysqli= new mysqli("localhost" , "web10" , "", "usr_web10_1");

if($_GET['id']!="" && $_GET["id"]>=1){
$id=$_GET['id']*5;
} else {
$id=0;
}
    $sql = "SELECT
                COUNT(*) as Anzahl
            FROM
                signs"; 
				   $result = $mysqli->query($sql);
   $fetch=$result->fetch_array();
   $count=$fetch[0]+0;
				
$aus="SELECT * FROM signs ORDER BY id DESC LIMIT ".$id.",5 ;";
$aus2=$mysqli->query($aus);

$pos1=-20;
$pos2=30;
$p=60;
while($infos=$aus2->fetch_array()){

$wert=abs(floor($_GET["wert"]));
$up="./header/stars/sign.".$infos["id"].".".$_SESSION["username"].".txt";
if($wert>=1 && $wert <=5 && !file_exists($up) && $_GET["werter"]==$infos["id"]){
$new_werter=$infos["werter"]+1;
$new_wert=$infos["wert"]+$wert;
$updateb="UPDATE signs SET wert='".$new_wert."',werter='".$new_werter."' WHERE id = ".$_GET['werter']." LIMIT 1";
$updateausfuhrb=$mysqli->query($updateb);
    file_put_contents($up,date("j.n.Y"));
	chmod($up,0777);	
	$infos["werter"]=$new_werter;
	$infos["wert"]=$new_wert;
	$bew=$infos["wert"]/$infos["werter"];
$updatecc="UPDATE signs SET bew = '".$bew."' WHERE id = ".$_GET['werter']." LIMIT 1";
$updateausfuhrcc=$mysqli->query($updatecc);
}


if($infos["werter"]+0=="0")$bew=0; else $bew=floor($infos["wert"]/$infos["werter"]*10)/10;
if($bew<=0.5)$s1="star5_grau_left"; else $s1="star5_gold";
if($bew<=1.5)$s2="star5_grau_left"; else $s2="star5_gold";
if($bew<=2.5)$s3="star5_grau_left"; else $s3="star5_gold";
if($bew<=3.5)$s4="star5_grau_left"; else $s4="star5_gold";
if($bew<=4.5)$s5="star5_grau_left"; else $s5="star5_gold";


if(trim($_SESSION[$infos["kom"]][$la])!="")$infos["kom"]=trim($_SESSION[$infos["kom"]][$la]);
echo'<quad posn="'.$pos1.' '.($pos2+13.5).' 3.1" sizen="34 16" halign="center" manialink="rsty:sign?id='.$infos["id"].'" image="./leer.png" imagefocus="./download.png" />


<label posn="'.($pos1+0).' '.($pos2+13.5-19.5).' 2" text="'.trim($_SESSION["bewerter"][$la]).': '.(0+$infos["werter"]).'   Ø='.($bew+0).'" sizen="16.4 20" />
<frame scale="1.35" posn="'.($pos1+12.5).' '.($pos2+13.5-14.5+12).'" >
<quad halign="right" posn="-10 -12 21.5" sizen="2.5 2.5" image="./header/stars/'.$s5.'.png" />
<quad halign="right" posn="-12.5 -12 21.5" sizen="2.5 2.5" image="./header/stars/'.$s4.'.png" />
<quad halign="right" posn="-15 -12 21.5" sizen="2.5 2.5" image="./header/stars/'.$s3.'.png" />
<quad halign="right" posn="-17.5 -12 21.5" sizen="2.5 2.5" image="./header/stars/'.$s2.'.png" />
<quad halign="right" posn="-20 -12 21.5" sizen="2.5 2.5" image="./header/stars/'.$s1.'.png" />
<quad halign="right" manialink="'.$ml.'?page=signs&amp;werter='.$infos["id"]; if($_GET["id"]>=1)echo'&amp;id='.$_GET["id"]; echo'&amp;wert=1" posn="-20 -12 22.5" sizen="'.(2.5*1).' 2.5" image="./leer.png" imagefocus="./header/stars/star5.png" />
<quad halign="right" manialink="'.$ml.'?page=signs&amp;werter='.$infos["id"]; if($_GET["id"]>=1)echo'&amp;id='.$_GET["id"]; echo'&amp;wert=2" posn="-17.5 -12 22.4" sizen="'.(2.5*2).' 2.5" image="./leer.png" imagefocus="./header/stars/star4.png" />
<quad halign="right" manialink="'.$ml.'?page=signs&amp;werter='.$infos["id"]; if($_GET["id"]>=1)echo'&amp;id='.$_GET["id"]; echo'&amp;wert=3" posn="-15 -12 22.3" sizen="'.(2.5*3).' 2.5" image="./leer.png" imagefocus="./header/stars/star3.png" />
<quad halign="right" manialink="'.$ml.'?page=signs&amp;werter='.$infos["id"]; if($_GET["id"]>=1)echo'&amp;id='.$_GET["id"]; echo'&amp;wert=4" posn="-12.5 -12 22.2" sizen="'.(2.5*4).' 2.5" image="./leer.png" imagefocus="./header/stars/star2.png" />
<quad halign="right" manialink="'.$ml.'?page=signs&amp;werter='.$infos["id"]; if($_GET["id"]>=1)echo'&amp;id='.$_GET["id"]; echo'&amp;wert=5" posn="-10 -12 22.1" sizen="'.(2.5*5).' 2.5" image="./leer.png" imagefocus="./header/stars/star1.png" />
</frame>

<quad posn="'.$pos1.' '.($pos2+14).' 0.1" sizen="36 28" halign="center" style="Bgs1InRace" substyle="BgTitle3_3" />
<quad posn="'.$pos1.' '.($pos2+13.5).' 1.1" sizen="34 16" halign="center" image="./d/signs/'.$infos["bild"].'" />
<label posn="'.$pos1.' '.($pos2+13.5-16.5).' 1.2" textcolor="DDD" halign="center" sizen="27 3" text="'.$infos["name"].'" />
<label posn="'.($pos1-17.5).' '.($pos2+13.5-22.5).' 1.2" style="TextInfoSmall" textcolor="DDD" sizen="34 10" autonewline="1" text="'.$infos["kom"].'" />
';

$pos1+=$p;
if($pos1==100){
$pos1=0;
$pos2-=30;
}elseif($pos1==60){
$pos1=-20;
$pos2-=30;
}
}
$idm=$ml."?page=signs&amp;id=".($_GET["id"]-1);
if($_GET["id"]-1=="0")$idm=$ml."?page=signs";
if($count>$id+5){
echo '
<quad posn="45 0 1" sizen="6 6" manialink="'.$ml.'?page=signs&amp;id'.($_GET["id"]+1).'" style="Icons64x64_1" substyle="ArrowNext"  />
';
}
if($_GET["id"]+0>=1){
echo '
<quad posn="-45 0 1" sizen="6 6" manialink="'.$idm.'" style="Icons64x64_1" substyle="ArrowPrev"  />
';
}

#$mysqli->close();
?>