<?php
#$mysqli= new mysqli("localhost" , "web10" , "", "usr_web10_1");
$envis=array("bay","desert","coast","island","rally","snow","stadium");
//./d/tracks/envis/'.$envi.'.dds
if($_GET["envi"]=="all"){
	$_GET["envi"]="";
}
echo'
<quad posn="0 45.2 1" sizen="80 8.4" halign="center" style="Bgs1InRace" substyle="BgTitle3_3" />
<frame posn="1.5 -0.3">';
if($_GET["envi"]!=""){
echo'
	<quad manialink="'.$ml.'?page=tracks&amp;envi=all" style="Icons128x128_1" substyle="United" sizen="7 7" posn="-40 45 4" />
	';
} else {
echo'
	<quad style="Icons128x128_1" substyle="United" sizen="8 8" posn="-40 45 4" />
	';
}
for($a=0;$a<7;$a++){
	$envi=$envis[$a];
	if($_GET["envi"]!=$envi){
		echo'
		<quad manialink="'.$ml.'?page=tracks&amp;envi='.$envi.'" image="./envis/'.$envi.'.dds" sizen="7 7" posn="'.(-30+10*$a).' 45 4" />
		';
	} else {
		echo'
		<quad image="./envis/'.$envi.'.dds" sizen="8 8" posn="'.(-30+10*$a).' 45 4" />
		';
	}
}
echo'</frame>';
if($_GET['id']!="" && $_GET["id"]>=1){
	$id=$_GET['id']+0;
} else {
	$id=0;
}
$a=9 * $id;
$weiter=0;
if($_GET['envi']==""){
	$aus="SELECT * FROM tracks ORDER BY id DESC LIMIT ".$a.",9 ;";
} else {
	$aus="SELECT * FROM tracks WHERE envi = '".$_GET["envi"]."' ORDER BY id DESC LIMIT ".$a.",9 ;";
}
$myless=$mysqli->query($aus);
$pos1=-30;
$pos2=25;
$p=42.67;
while($infos=$myless->fetch_array()){
$preis=array("10","50","30");
$envi=$infos["envi"];
$envi[0]=strtoupper($envi[0]);
$name=str_replace(".Challenge.Gbx","",$infos["name"]);
$name[0]=strtoupper($name[0]);
$p2=0;
$n=7.8;
$s=15;
//style="Bgs1InRace" substyle="BgWindow1"
$ppp=$infos['preis']-1;
if($_GET["infos"]==$infos["id"]){
	$infos["gps"]="NEIN";
	if($infos["gps"]=="1")
		$infos["gps"]="JA";


	$wert=abs(floor($_GET["wert"]));
	$up="./header/stars/tracks.".$infos["id"].".".$_SESSION["username"].".txt";
	if($wert>=1 && $wert <=5 && !file_exists($up)){
		$new_werter=$infos["werter"]+1;
		$new_wert=$infos["wert"]+$wert;
		$updateb="UPDATE tracks SET wert='".$new_wert."',werter='".$new_werter."' WHERE id = ".$_GET["infos"]." LIMIT 1";
		$updateausfuhrb=$mysqli->query($updateb);
		file_put_contents($up,date("j.n.Y"));
		chmod($up,0777);	
		$infos["werter"]=$new_werter;
		$infos["wert"]=$new_wert;
		$bew=$infos["wert"]/$infos["werter"];
		$updatecc="UPDATE tracks SET bew = '".$bew."' WHERE id = ".$_GET['infos']." LIMIT 1";
		$updateausfuhrcc=$mysqli->query($updatecc);
	}

		if($infos["werter"]+0=="0")$bew=0; else $bew=floor($infos["wert"]/$infos["werter"]*10)/10;
		if($bew<=0.5)$s1="star5_grau_left"; else $s1="star5_gold";
		if($bew<=1.5)$s2="star5_grau_left"; else $s2="star5_gold";
		if($bew<=2.5)$s3="star5_grau_left"; else $s3="star5_gold";
		if($bew<=3.5)$s4="star5_grau_left"; else $s4="star5_gold";
		if($bew<=4.5)$s5="star5_grau_left"; else $s5="star5_gold";

		if(trim($_SESSION[$infos["kom"]][$la])!="")$infos["kom"]=trim($_SESSION[$infos["kom"]][$la]);
		echo'
		<quad posn="0 17 16" sizen="59 26" halign="center" manialink="rsty:tracks:'.$infos["preis"].'?name='.str_replace(".Challenge.Gbx","",$infos["name"]).'" image="./leer.png" imagefocus="./download.png" />

		<quad posn="0 20 5" sizen="60 50" halign="center" style="Bgs1InRace" substyle="BgIconBorder" />
		<quad posn="0 17 14" sizen="59 26" halign="center" image="./bilder/'.$infos["bild"].'" />
		<label posn="0 19.5 22" halign="center" textcolor="DDD" sizen="'.$s.' 30" text="$000'.str_replace(".Challenge.Gbx","",$infos["name"]).'" />
		<label style="TextCardRaceRank" posn="28 19.5 22" halign="right" textcolor="DDD" sizen="'.$s.' 30" manialink="'.$ml.'?page=tracks';if($_GET["id"]>=1)echo'&amp;id='.$_GET["id"];echo'" text="$000X" />
		<label textcolor="0FF" posn="-29 -9 22" sizen="55 30" text="'.trim($_SESSION["uploader"][$la]).' : '.$infos["nick"].'$z    ($i'.$infos["uploader"].'$i)" />
		<label textcolor="0FF" halign="right" posn="28.5 -15 22" sizen="25 30" text="'.trim($_SESSION["datum"][$la]).': '.$infos["datum"].'" />
		<label textcolor="0FF" posn="-29 -15 22" sizen="'.$s.' 30" text="'.trim($_SESSION["downloads"][$la]).': $o'.$infos["downloads"].'" />
		<label textcolor="0FF" posn="-29 -18 22" sizen="23 30" text="'.trim($_SESSION["umgebung"][$la]).' : '.$envi.'" />
		<quad posn="-10 -18 22" sizen="4.4 4.4" image="./envis/'.$infos["envi"].'.dds" />
		<label textcolor="0FF" posn="-29 -21 22" sizen="'.$s.' 30" text="'.trim($_SESSION["preis"][$la]).': $o'.$preis[$ppp+0].'" />
		<quad posn="-18 -21 22" sizen="3.4 3.4" style="Icons128x128_1" substyle="Coppers" />
		<label posn="-29 -24 22" sizen="30 3.4" text="GPS :  '.$infos["gps"].'"  textcolor="0FF" />

		<frame posn="2.5 0" >
		<quad halign="right" posn="-10 -12 21.5" sizen="2.5 2.5" image="./header/stars/'.$s5.'.png" />
		<quad halign="right" posn="-12.5 -12 21.5" sizen="2.5 2.5" image="./header/stars/'.$s4.'.png" />
		<quad halign="right" posn="-15 -12 21.5" sizen="2.5 2.5" image="./header/stars/'.$s3.'.png" />
		<quad halign="right" posn="-17.5 -12 21.5" sizen="2.5 2.5" image="./header/stars/'.$s2.'.png" />
		<quad halign="right" posn="-20 -12 21.5" sizen="2.5 2.5" image="./header/stars/'.$s1.'.png" />
		<quad halign="right" manialink="'.$ml.'?page=tracks&amp;infos='.$_GET["infos"]; if($_GET["id"]>=1)echo'&amp;id='.$_GET["id"]; echo'&amp;wert=1" posn="-20 -12 22.5" sizen="'.(2.5*1).' 2.5" image="./leer.png" imagefocus="./header/stars/star5.png" />
		<quad halign="right" manialink="'.$ml.'?page=tracks&amp;infos='.$_GET["infos"]; if($_GET["id"]>=1)echo'&amp;id='.$_GET["id"]; echo'&amp;wert=2" posn="-17.5 -12 22.4" sizen="'.(2.5*2).' 2.5" image="./leer.png" imagefocus="./header/stars/star4.png" />
		<quad halign="right" manialink="'.$ml.'?page=tracks&amp;infos='.$_GET["infos"]; if($_GET["id"]>=1)echo'&amp;id='.$_GET["id"]; echo'&amp;wert=3" posn="-15 -12 22.3" sizen="'.(2.5*3).' 2.5" image="./leer.png" imagefocus="./header/stars/star3.png" />
		<quad halign="right" manialink="'.$ml.'?page=tracks&amp;infos='.$_GET["infos"]; if($_GET["id"]>=1)echo'&amp;id='.$_GET["id"]; echo'&amp;wert=4" posn="-12.5 -12 22.2" sizen="'.(2.5*4).' 2.5" image="./leer.png" imagefocus="./header/stars/star2.png" />
		<quad halign="right" manialink="'.$ml.'?page=tracks&amp;infos='.$_GET["infos"]; if($_GET["id"]>=1)echo'&amp;id='.$_GET["id"]; echo'&amp;wert=5" posn="-10 -12 22.1" sizen="'.(2.5*5).' 2.5" image="./leer.png" imagefocus="./header/stars/star1.png" />
		</frame>
		<label textcolor="0FF" posn="-29 -12 22" sizen="60 30" text="'.trim($_SESSION["bewerte"][$la]).'                         '.trim($_SESSION["bewertungen"][$la]).': '.$infos["werter"].'     Ø='.$bew.'" />



		<label textcolor="FFF" halign="right" autonewline="1" posn="29 -18 22" sizen="35 30" text="$222'.trim($_SESSION["beschreibung"][$la]).' : '.$infos["kom"].'$z" />
		';
	}
	//<label textcolor="0FF" posn="-29 -12 22" sizen="25 30" text="Bewertungen :" />
	echo'
	<frame posn="-12.67 0 0" >
	<quad halign="center" valign="center" posn="'.$pos1.' '.($pos2+$p2).' 1.3" sizen="18 18" manialink="'.$ml.'?page=tracks&amp;infos='.$infos["id"].'" image="./leer.png" imagefocus="./header/infos.bik" />

	<quad posn="'.$pos1.' '.($pos2+$p2+9-15).' 1.2" sizen="32 3" halign="center" bgcolor="FFF" />
	<quad posn="'.($pos1+0.5).' '.($pos2+$p2+9-15+0.5).' 1.1" sizen="32 3" halign="center" bgcolor="0FF" />
	<quad posn="'.$pos1.' '.($pos2+$p2).' 1" sizen="42.67 24" halign="center" valign="center" image="./bilder/'.$infos["bild"].'" />
	<label posn="'.($pos1).' '.($pos2+$p2-9.1+2.75).' 1.3" anialink="'.$ml.'?page=tracks&amp;infos='.$infos["id"].'" textcolor="333" halign="center" sizen="'.$s.' 30" text="$i'.str_replace(".Challenge.Gbx","",$infos["name"]).'" />
	</frame>
	';
	$pos1+=$p;
	if($pos1>70){
		$pos1=-30;
		$pos2-=24;
	}
}
    $sql = "SELECT
                COUNT(*) as Anzahl
            FROM
                tracks";   
				if($_GET["envi"]!=""){
				    $sql = "SELECT
                COUNT(*) as Anzahl
            FROM
                tracks WHERE envi= '".$_GET["envi"]."'";   
				}
   $result = $mysqli->query($sql);
   $fetch=$result->fetch_array();
   $count=$fetch[0]+0;
if($count>=$a+9){
echo'
<quad posn="35 -30 4" style="Icons64x64_1" substyle="ArrowNext" manialink="'.$ml.'?page=tracks&amp;id='.($id+1).'" sizen="5 5" halign="center" valign="center" />
';
} else {
echo'
<quad posn="35 -30 4" style="MedalsBig" substyle="MedalSlot" sizen="5 5" />
';
}
if($_GET["id"]>=1){
echo'
<quad posn="-35 -30 4" style="Icons64x64_1" substyle="ArrowPrev" manialink="'.$ml.'?page=tracks&amp;id='.($id-1).'" sizen="5 5" halign="center" valign="center" />
';
} else {
echo'
<quad posn="-35 -30 4" style="MedalsBig" substyle="MedalSlot" sizen="5 5" />
';
}

#$mysqli->close();
?>