<?php
#$mysqli= new mysqli("localhost" , "web10" , "", "usr_web10_1");
if($_GET['id']!="" && $_GET["id"]>=1){
$id=$_GET['id']+0;
} else {
$id=0;
}
$a=9 * $id;
$weiter=0;
$aus="SELECT * FROM plugins ORDER BY id DESC LIMIT ".$a.",9 ;";
$myless=$mysqli->query($aus);
$pos1=-30;
$pos2=33;
$p=30;
while($infos=$myless->fetch_array()){
//style="Bgs1InRace" substyle="BgWindow1"
$name=str_replace(".zip","",$infos["name"]);
$name[0]=strtoupper($name[0]);
$n=14.1;
$p2=0;
$preis=array("10","50","30");
$ppp=$infos['preis']-1;

$wert=abs(floor($_GET["wert"]));
$up="./header/stars/plugin.".$infos["id"].".".$_SESSION["username"].".txt";
if($wert>=1 && $wert <=5 && !file_exists($up) && $_GET["werter"]==$infos["id"]){
$new_werter=$infos["werter"]+1;
$new_wert=$infos["wert"]+$wert;
$updateb="UPDATE plugins SET wert='".$new_wert."',werter='".$new_werter."' WHERE id = ".$_GET['werter']." LIMIT 1";
$updateausfuhrb=$mysqli->query($updateb);
    file_put_contents($up,date("j.n.Y"));
	chmod($up,0777);	
	$infos["werter"]=$new_werter;
	$infos["wert"]=$new_wert;
	$bew=$infos["wert"]/$infos["werter"];
$updatecc="UPDATE plugins SET bew = '".$bew."' WHERE id = ".$_GET['werter']." LIMIT 1";
$updateausfuhrcc=$mysqli->query($updatecc);
}


if($infos["werter"]+0=="0")$bew=0; else $bew=floor($infos["wert"]/$infos["werter"]*10)/10;
if($bew<=0.5)$s1="star5_grau_left"; else $s1="star5_gold";
if($bew<=1.5)$s2="star5_grau_left"; else $s2="star5_gold";
if($bew<=2.5)$s3="star5_grau_left"; else $s3="star5_gold";
if($bew<=3.5)$s4="star5_grau_left"; else $s4="star5_gold";
if($bew<=4.5)$s5="star5_grau_left"; else $s5="star5_gold";


if($infos["id"]!="1"){ echo'
<quad halign="center" valign="center" posn="'.$pos1.' '.$pos2.' 4" manialink="rsty:plugins:'.$infos["preis"].'?name='.str_replace(".zip","",$infos["name"]).'" image="./leer.png" imagefocus="./download.png" sizen="18 18" />
';} else {echo'
<quad halign="center" valign="center" posn="'.$pos1.' '.$pos2.' 4" manialink="rsty:kalender?name='.str_replace(".zip","",$infos["name"]).'" image="./leer.png" imagefocus="./download.png" sizen="18 18" />
';}
echo'
<quad valign="center" halign="center" posn="'.$pos1.' '.$pos2.' 3" image="./bilder/'.$infos["bild"].'" sizen="18 18" />
<quad halign="center" posn="'.$pos1.' '.($pos2+10).' 2" image="./header/white.png" sizen="20 30" />


<label halign="center" valign="center" posn="'.$pos1.' '.($pos2-14.7).' 2" text="'.trim($_SESSION["bewerter"][$la]).': '.(0+$infos["werter"]).'   Ø='.($bew+0).'" sizen="30 20" />
<frame scale="1.35" posn="'.($pos1+21.5).' '.($pos2-0).'" >
<quad halign="right" posn="-10 -12 21.5" sizen="2.5 2.5" image="./header/stars/'.$s5.'.png" />
<quad halign="right" posn="-12.5 -12 21.5" sizen="2.5 2.5" image="./header/stars/'.$s4.'.png" />
<quad halign="right" posn="-15 -12 21.5" sizen="2.5 2.5" image="./header/stars/'.$s3.'.png" />
<quad halign="right" posn="-17.5 -12 21.5" sizen="2.5 2.5" image="./header/stars/'.$s2.'.png" />
<quad halign="right" posn="-20 -12 21.5" sizen="2.5 2.5" image="./header/stars/'.$s1.'.png" />
<quad halign="right" manialink="'.$ml.'?page=plugins&amp;werter='.$infos["id"]; if($_GET["id"]>=1)echo'&amp;id='.$_GET["id"]; echo'&amp;wert=1" posn="-20 -12 22.5" sizen="'.(2.5*1).' 2.5" image="./leer.png" imagefocus="./header/stars/star5.png" />
<quad halign="right" manialink="'.$ml.'?page=plugins&amp;werter='.$infos["id"]; if($_GET["id"]>=1)echo'&amp;id='.$_GET["id"]; echo'&amp;wert=2" posn="-17.5 -12 22.4" sizen="'.(2.5*2).' 2.5" image="./leer.png" imagefocus="./header/stars/star4.png" />
<quad halign="right" manialink="'.$ml.'?page=plugins&amp;werter='.$infos["id"]; if($_GET["id"]>=1)echo'&amp;id='.$_GET["id"]; echo'&amp;wert=3" posn="-15 -12 22.3" sizen="'.(2.5*3).' 2.5" image="./leer.png" imagefocus="./header/stars/star3.png" />
<quad halign="right" manialink="'.$ml.'?page=plugins&amp;werter='.$infos["id"]; if($_GET["id"]>=1)echo'&amp;id='.$_GET["id"]; echo'&amp;wert=4" posn="-12.5 -12 22.2" sizen="'.(2.5*4).' 2.5" image="./leer.png" imagefocus="./header/stars/star2.png" />
<quad halign="right" manialink="'.$ml.'?page=plugins&amp;werter='.$infos["id"]; if($_GET["id"]>=1)echo'&amp;id='.$_GET["id"]; echo'&amp;wert=5" posn="-10 -12 22.1" sizen="'.(2.5*5).' 2.5" image="./leer.png" imagefocus="./header/stars/star1.png" />
</frame>



<label halign="center" valign="center" posn="'.$pos1.' '.($pos2-10).' 2" text="'.trim($_SESSION["downloads"][$la]).' : $i$o'.$infos["downloads"].'" sizen="20 20" />
<label halign="center" valign="center" posn="'.$pos1.' '.($pos2-12.5).' 2" text="$00f'.$name.'" sizen="20 20" />
';
$pos1+=$p;
if($pos1==30){
$pos1=-30;
$pos2-=33;
}
}
$aus2="SELECT * FROM plugins ORDER BY 'id' DESC LIMIT ".($a+9).",1 ;";
if($test=$mysqli->query($aus2)->fetch_array()){
echo'
<quad posn="45 10 4" style="Icons64x64_1" substyle="ArrowNext" manialink="'.$ml.'?page=plugins&amp;id='.($id+1).'" sizen="5 5" halign="center" valign="center" />
';
}
if($_GET["id"]>=1){
echo'
<quad posn="-45 10 4" style="Icons64x64_1" substyle="ArrowPrev" manialink="'.$ml.'?page=plugins&amp;id='.($id-1).'" sizen="5 5" halign="center" valign="center" />
';
}

#$mysqli->close();
?>