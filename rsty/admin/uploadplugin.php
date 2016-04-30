<?php
#$mysqli= new mysqli("localhost" , "web10" , "", "usr_web10_1");
if($_GET['part']==""){
echo' <frame posn="0 6.4" scale="1.3">
<label halign="center" valign="center" posn="0 7 3.6" sizen="30 3" text="UPLOADER : '.$_SESSION['loginname'].'" style="TextCardSmallScores2" />
<fileentry posn="0 0 4" halign="center" valign="center" sizen="20 2" style="TextCardSmallScores2" 
name="file" folder="" default="BILD"/>
<quad halign="center" valign="center" posn="0 0 3" sizen="21 3" style="Bgs1" substyle="BgList"/> 
<quad halign="center" valign="center" posn="0 -6.4 3.6" sizen="10 10" style="Icons128x128_1" substyle="Upload" 
manialink="POST('.$ml.'?page=admin&amp;site=uploadplugin&amp;part=1&amp;upload=file,file)"/>
<label halign="center" valign="center" posn="0 -6.4 3.7" sizen="10 3" text="UPLOAD" style="TextCardSmallScores2"
manialink="POST('.$ml.'?page=admin&amp;site=uploadplugin&amp;part=1&amp;upload=file,file)"/>
</frame>';
} elseif($_GET["part"]=="1"){
$uu=$_GET["upload"];
	$_SESSION["bild"]=$_GET["upload"];
if(!empty($_GET["upload"]) && !file_exists("./bilder/$uu")) { //Überprüfen ob die Seite aufgerufen wird  
$up="./bilder/".$uu;
    file_put_contents($up, file_get_contents('php://input'));  
	chmod($up,0777);
	}
echo' <frame posn="0 6.4" scale="1.3">
<label halign="center" valign="center" posn="0 7 3.6" sizen="30 3" text="UPLOADER : '.$_SESSION['loginname'].'" style="TextCardSmallScores2" />
<fileentry posn="0 0 4" halign="center" valign="center" sizen="20 2" style="TextCardSmallScores2" 
name="file" folder="" default="PLUGIN"/>
<quad halign="center" valign="center" posn="0 0 3" sizen="21 3" style="Bgs1" substyle="BgList"/> 
<quad halign="center" valign="center" posn="-20 -6.4 3.6" sizen="10 10" style="Icons128x128_1" substyle="Upload" />
<label halign="center" valign="center" posn="-20 -6.4 3.7" sizen="20 3" text="UPLOAD Preis 1 (10 CC)" style="TextCardSmallScores2"
manialink="POST('.$ml.'?page=admin&amp;site=uploadplugin&amp;part=2&amp;preis=1&amp;upload=file,file)"/>

<quad halign="center" valign="center" posn="0 -6.4 3.6" sizen="10 10" style="Icons128x128_1" substyle="Upload" />
<label halign="center" valign="center" posn="0 -6.4 3.7" sizen="20 3" text="UPLOAD Preis 2 (50 CC)" style="TextCardSmallScores2"
manialink="POST('.$ml.'?page=admin&amp;site=uploadplugin&amp;part=2&amp;preis=2&amp;upload=file,file)"/>

<quad halign="center" valign="center" posn="20 -6.4 3.6" sizen="10 10" style="Icons128x128_1" substyle="Upload" />
<label halign="center" valign="center" posn="20 -6.4 3.7" sizen="20 3" text="UPLOAD Preis 3 (100 CC)" style="TextCardSmallScores2"
manialink="POST('.$ml.'?page=admin&amp;site=uploadplugin&amp;part=2&amp;preis=3&amp;upload=file,file)"/>
</frame>';
	
	
	} elseif($_GET["part"]=="2"){
	$uu=$_GET["upload"];

	if(!empty($_GET["upload"])) {
       $up="./d/plugins/".($_GET["preis"]+0)."/".$uu;
    file_put_contents($up, file_get_contents('php://input'));  
	chmod($up,0777);
	$insert="INSERT INTO plugins
(name,datum,bild,preis)
VALUES
('".$_GET["upload"]."','".date("j.n.Y")."', '".$_SESSION["bild"]."', '".$_GET["preis"]."')";
$insertausfuhr=$mysqli->query($insert);
$_SESSION["bild"]="";
	
	
	
	}
	}



echo '
<label autonewline="1" style="TextCardSmallScores2" halign="center" valign="top" posn="0 40 4" sizen="60 27" >$F00REGELN:$z
1.Nur Plugins im .zip FORMAT Hochladen!
3.Keine geklauten Plugins von anderen ManiaLinks hochladen!
4.Ihr bekommt für jeden Download eures Plugins 30 Punkte, die ihr gegen 30 Coppers umtauschen könnt.</label>
';
#$mysqli->close();
?>