<?php 
#$mysqli= new mysqli("localhost" , "web10" , "", "usr_web10_1");
if($_GET['part']==""){
echo '
<label autonewline="1" style="TextCardSmallScores2" halign="center" valign="top" posn="0 -40 4" sizen="60 27" >ACTION:
BILD-UPLOAD!
</label>

 <frame posn="0 6.4" scale="1.3">
<label halign="center" valign="center" posn="0 7 3.6" sizen="30 3" text="UPLOADER : '.$_SESSION['loginname'].'" style="TextCardSmallScores2" />
<fileentry posn="0 0 4" halign="center" valign="center" sizen="20 2" style="TextCardSmallScores2" 
name="file" folder="" default="BILD"/>
<quad halign="center" valign="center" posn="0 0 3" sizen="21 3" style="Bgs1" substyle="BgList"/> 
<quad halign="center" valign="center" posn="0 -6.4 3.6" sizen="10 10" style="Icons128x128_1" substyle="Upload" 
manialink="POST('.$ml.'?page=admin&amp;site=upload track&amp;part=0.5&amp;upload=file,file)"/>
<label halign="center" valign="center" posn="0 -6.4 3.7" sizen="10 3" text="UPLOAD" style="TextCardSmallScores2"
manialink="POST('.$ml.'?page=admin&amp;site=upload track&amp;part=0.5&amp;upload=file,file)"/>
</frame>';

	} elseif($_GET["part"]=="0.5"){
		$uu=$_GET["upload"];
	$_SESSION["bild"]=$_GET["upload"];
if(!empty($_GET["upload"]) && !file_exists("./bilder/$uu")) { //Überprüfen ob die Seite aufgerufen wird  
$up="./bilder/".$uu;
    file_put_contents($up, file_get_contents('php://input'));  
	chmod($up,0777);
	}
$p1=-40;
$p2=10;	
//style="Bgs1InRace" substyle="BgWindow1"
$envis=array("bay","desert","coast","island","rally","snow","stadium");
	echo '
<label autonewline="1" style="TextCardSmallScores2" halign="center" valign="top" posn="0 -40 4" sizen="60 27" >ACTION:
UMGEBUNG DER STRECKE-WAHL!
</label>
';for($i=0;$i<7;$i++){
$envi=$envis[$i];
$text=$envi;
$text[0]=strtoupper($text[0]);


echo'
<label halign="center" valign="center" posn="'.$p1.' '.$p2.' 3.9" sizen="20 3" text="$o$00F'.$text.'" style="TextCardSmallScores2" manialink="'.$ml.'?page=admin&amp;site=upload track&amp;part=1&amp;envi='.$envi.'"/>
<quad halign="center" valign="center" posn="'.$p1.' '.$p2.' 3.7" sizen="10 10" image="./envis/'.$envi.'.dds" manialink="'.$ml.'?page=admin&amp;site=upload track&amp;part=1&amp;envi='.$envi.'"/>
<quad halign="center" valign="center" posn="'.$p1.' '.$p2.' 3.6" sizen="12 12" style="Bgs1InRace" substyle="BgWindow1" />
';
$p1+=20;
if($p1>40){
$p1=-10;
$p2-=30;
}
}
} elseif($_GET["part"]=="1"){
echo '
<label autonewline="1" style="TextCardSmallScores2" halign="center" valign="top" posn="0 -40 4" sizen="60 27" >ACTION:
UMGEBUNG DES STRECKEN-PREISES!
+ $oSTRECKEN-UPLOAD$o!
</label>
';
$_SESSION["envi"]=$_GET["envi"];
echo' <frame posn="0 6.4" scale="1.3">
<label halign="center" valign="center" posn="0 7 3.6" sizen="30 3" text="UPLOADER : '.$_SESSION['loginname'].'" style="TextCardSmallScores2" />
<fileentry posn="0 0 4" halign="center" valign="center" sizen="20 2" style="TextCardSmallScores2" 
name="file" folder="Tracks/Challenges/My Challenges" default="TRACK"/>
<quad halign="center" valign="center" posn="0 0 3" sizen="21 3" style="Bgs1" substyle="BgList"/> 
<quad halign="center" valign="center" posn="-20 -6.4 3.6" sizen="10 10" style="Icons128x128_1" substyle="Upload" />
<label halign="center" valign="center" posn="-20 -6.4 3.7" sizen="20 3" text="UPLOAD Preis 1 (10 CC)" style="TextCardSmallScores2"
manialink="POST('.$ml.'?page=admin&amp;site=upload track&amp;part=2&amp;preis=1&amp;envi='.$_GET["envi"].'&amp;a=1&amp;upload=file,file)"/>

<quad halign="center" valign="center" posn="0 -6.4 3.6" sizen="10 10" style="Icons128x128_1" substyle="Upload" />
<label halign="center" valign="center" posn="0 -6.4 3.7" sizen="20 3" text="UPLOAD Preis 2 (50 CC)" style="TextCardSmallScores2"
manialink="POST('.$ml.'?page=admin&amp;site=upload track&amp;part=2&amp;preis=2&amp;envi='.$_GET["envi"].'&amp;a=1&amp;upload=file,file)"/>

<quad halign="center" valign="center" posn="20 -6.4 3.6" sizen="10 10" style="Icons128x128_1" substyle="Upload" />
<label halign="center" valign="center" posn="20 -6.4 3.7" sizen="20 3" text="UPLOAD Preis 3 (100 CC)" style="TextCardSmallScores2"
manialink="POST('.$ml.'?page=admin&amp;site=upload track&amp;part=2&amp;preis=3&amp;envi='.$_GET["envi"].'&amp;a=1&amp;upload=file,file)"/>
</frame>';
	
	
	
	
	
	
	} elseif($_GET["part"]=="2" && $_GET["a"]=="1"){
	$uu=$_GET["upload"];

	if(!empty($_GET["upload"])) {
       $up="./d/tracks/".$_GET["envi"]."/".($_GET["preis"]+0)."/".$uu;
    file_put_contents($up, file_get_contents('php://input'));  
	chmod($up,0777);
	$insert="INSERT INTO tracks
(name,datum,bild,preis,envi,uploader,nick)
VALUES
('".$mysqli->real_escape_string($_GET["upload"])."','".date("j.n.Y")."', '".$mysqli->real_escape_string($_SESSION["bild"])."', '".$_GET["preis"]."', '".$_GET["envi"]."', '".$mysqli->real_escape_string($_SESSION["username"])."', '".$mysqli->real_escape_string($_SESSION["nickname"])."')";
$insertausfuhr=$mysqli->query($insert);
	echo '
<label autonewline="1" style="TextCardSmallScores2" halign="center" valign="top" posn="0 -40 4" sizen="60 27" >!TRACK ERFOLGREICH HOCHGELADEN!</label>
';
	}
	}



echo '
<label autonewline="1" style="TextCardSmallScores2" halign="center" valign="top" posn="0 40 4" sizen="60 27" >$F00REGELN:$z
1.Nur TRACKS im .GBX FORMAT Hochladen!
3.Keine geklauten TRACKS von anderen ManiaLinks hochladen!
4.Ihr bekommt für jeden Download eures TRACKS Punkte, die ihr gegen Coppers umtauschen könnt.</label>
';

#$mysqli->close();
?>