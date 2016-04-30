<?php
#$mysqli= new mysqli("localhost" , "web10" , "", "usr_web10_1");

if($_GET['id']!="" && $_GET["id"]>=1){
$id=$_GET['id'];
} else {
$id=0;
}
    $sql = "SELECT
                COUNT(*) as Anzahl
            FROM
                mods"; 
				   $result = $mysqli->query($sql);
   $fetch=$result->fetch_array();
   $count=$fetch[0]+0;
				
$aus="SELECT * FROM mods ORDER BY id DESC LIMIT ".($id*2).",2 ;";
$aus2=$mysqli->query($aus);

$pos1=-30;
$pos2=0;
$p=60;
while($infos=$aus2->fetch_array()){
$envi=$infos["envi"];
$envi[0]=strtoupper($envi[0]);


$wert=abs(floor($_GET["wert"]));
$up="./header/stars/mod.".$infos["id"].".".$_SESSION["username"].".txt";
if($wert>=1 && $wert <=5 && !file_exists($up) && $_GET["werter"]==$infos["id"]){
$new_werter=$infos["werter"]+1;
$new_wert=$infos["wert"]+$wert;
$updateb="UPDATE mods SET wert='".$new_wert."',werter='".$new_werter."' WHERE id = ".$_GET['werter']." LIMIT 1";
$updateausfuhrb=$mysqli->query($updateb);
    file_put_contents($up,date("j.n.Y"));
	chmod($up,0777);	
	$infos["werter"]=$new_werter;
	$infos["wert"]=$new_wert;
	$bew=$infos["wert"]/$infos["werter"];
$updatecc="UPDATE mods SET bew = '".$bew."' WHERE id = ".$_GET['werter']." LIMIT 1";
$updateausfuhrcc=$mysqli->query($updatecc);
}


if($infos["werter"]+0=="0")$bew=0; else $bew=floor($infos["wert"]/$infos["werter"]*10)/10;
if($bew<=0.5)$s1="star5_grau_left"; else $s1="star5_gold";
if($bew<=1.5)$s2="star5_grau_left"; else $s2="star5_gold";
if($bew<=2.5)$s3="star5_grau_left"; else $s3="star5_gold";
if($bew<=3.5)$s4="star5_grau_left"; else $s4="star5_gold";
if($bew<=4.5)$s5="star5_grau_left"; else $s5="star5_gold";


if(trim($_SESSION[$infos["kom"]][$la])!="")$infos["kom"]=trim($_SESSION[$infos["kom"]][$la]);
echo'<quad posn="'.($pos1-22).' '.($pos2+24.5-2.5).' 15.1" sizen="44 46" manialink="rsty:mod?id='.$infos["id"].'" image="./leer.png" imagefocus="./download.png" />


<label posn="'.($pos1-22).' '.($pos2-3.76).' 2" style="TextInfoSmall" textcolor="ddd" text="'.trim($_SESSION["bewerter"][$la]).': '.(0+$infos["werter"]).'   Ø='.($bew+0).'" sizen="30 20" />
<frame  posn="'.($pos1+0.35).' '.($pos2+6.5).'" >
<quad halign="right" posn="-10 -12 21.5" sizen="2.5 2.5" image="./header/stars/'.$s5.'.png" />
<quad halign="right" posn="-12.5 -12 21.5" sizen="2.5 2.5" image="./header/stars/'.$s4.'.png" />
<quad halign="right" posn="-15 -12 21.5" sizen="2.5 2.5" image="./header/stars/'.$s3.'.png" />
<quad halign="right" posn="-17.5 -12 21.5" sizen="2.5 2.5" image="./header/stars/'.$s2.'.png" />
<quad halign="right" posn="-20 -12 21.5" sizen="2.5 2.5" image="./header/stars/'.$s1.'.png" />
<quad halign="right" manialink="'.$ml.'?page=mods&amp;werter='.$infos["id"]; if($_GET["id"]>=1)echo'&amp;id='.$_GET["id"]; echo'&amp;wert=1" posn="-20 -12 22.5" sizen="'.(2.5*1).' 2.5" image="./leer.png" imagefocus="./header/stars/star5.png" />
<quad halign="right" manialink="'.$ml.'?page=mods&amp;werter='.$infos["id"]; if($_GET["id"]>=1)echo'&amp;id='.$_GET["id"]; echo'&amp;wert=2" posn="-17.5 -12 22.4" sizen="'.(2.5*2).' 2.5" image="./leer.png" imagefocus="./header/stars/star4.png" />
<quad halign="right" manialink="'.$ml.'?page=mods&amp;werter='.$infos["id"]; if($_GET["id"]>=1)echo'&amp;id='.$_GET["id"]; echo'&amp;wert=3" posn="-15 -12 22.3" sizen="'.(2.5*3).' 2.5" image="./leer.png" imagefocus="./header/stars/star3.png" />
<quad halign="right" manialink="'.$ml.'?page=mods&amp;werter='.$infos["id"]; if($_GET["id"]>=1)echo'&amp;id='.$_GET["id"]; echo'&amp;wert=4" posn="-12.5 -12 22.2" sizen="'.(2.5*4).' 2.5" image="./leer.png" imagefocus="./header/stars/star2.png" />
<quad halign="right" manialink="'.$ml.'?page=mods&amp;werter='.$infos["id"]; if($_GET["id"]>=1)echo'&amp;id='.$_GET["id"]; echo'&amp;wert=5" posn="-10 -12 22.1" sizen="'.(2.5*5).' 2.5" image="./leer.png" imagefocus="./header/stars/star1.png" />
</frame>



<quad posn="'.$pos1.' '.($pos2+25).' 0.1" sizen="46 50" halign="center" style="Bgs1InRace" substyle="BgTitle3_3" />
<quad posn="'.($pos1-22).' '.($pos2+24.5-2.5).' 1.1" sizen="22 23" image="./d/mods/bilder/'.$infos["bild1"].'" />
<quad posn="'.$pos1.' '.($pos2+24.5-2.5).' 1.1" sizen="22 23" image="./d/mods/bilder/'.$infos["bild2"].'" />
<quad posn="'.$pos1.' '.($pos2+2.5-3.5).' 1.1" sizen="22 23" image="./d/mods/bilder/'.$infos["bild3"].'" />
<quad posn="'.($pos1-22).' '.($pos2+2.5-3.5).' 17.6" sizen="22 23" image="./leer.png" action="1" />
<label posn="'.$pos1.' '.($pos2+24.5).' 1.2" textcolor="DDD" halign="center" sizen="27 3" text="'.$infos["name"].'" />
<label posn="'.($pos1-22).' '.($pos2-1).' 1.2" style="TextInfoSmall" textcolor="DDD" sizen="27 3" text="'.trim($_SESSION["made by"][$la]).' : '.$infos["nick"].'" />
<label posn="'.($pos1-22).' '.($pos2-8).' 1.2" style="TextInfoSmall" textcolor="DDD" sizen="27 3" text="'.trim($_SESSION["downloads"][$la]).' : $o'.$infos["down"].'" />
<label posn="'.($pos1-22).' '.($pos2-10.5).' 1.2" style="TextInfoSmall" textcolor="DDD" sizen="18 3"  text="'.trim($_SESSION["umgebung"][$la]).' :'.$envi.'" />
<quad posn="'.($pos1-1).' '.($pos2-10).' 1.3" halign="right"  sizen="3 3" text="Envi :'.$envi.'" image="./envis/'.$infos["envi"].'.dds" />
<label posn="'.($pos1-22).' '.($pos2-13).' 1.2" style="TextInfoSmall" textcolor="DDD" sizen="25 10" autonewline="1" text="'.trim($_SESSION["beschreibung"][$la]).' : '.xmlspecialchars($infos["kom"]).'" />
';

$pos1+=$p;
}
$idm=$ml."?page=mods&amp;id=".($_GET["id"]-1);
if($_GET["id"]-1=="0")$idm=$ml."?page=mods";
if($count>$id+2){
echo '
<quad posn="45 0 1" sizen="6 6" manialink="'.$ml.'?page=mods&amp;id'.($_GET["id"]+1).'" style="Icons64x64_1" substyle="ArrowNext"  />
';
}
if($_GET["id"]+0>=1){
echo '
<quad posn="-45 0 1" sizen="6 6" manialink="'.$idm.'" style="Icons64x64_1" substyle="ArrowPrev"  />
';
}

#$mysqli->close();
?>