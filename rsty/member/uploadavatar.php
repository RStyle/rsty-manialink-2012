<?php
#$mysqli= new mysqli("localhost" , "web10" , "", "usr_web10_1");
if($_GET['part']==""){
echo' <frame posn="0 6.4" scale="1.3">
<label halign="center" valign="center" posn="0 7 3.6" sizen="30 3" text="UPLOADER : '.$_SESSION['loginname'].'" style="TextCardSmallScores2" />
<fileentry posn="0 0 4" halign="center" valign="center" sizen="20 2" style="TextCardSmallScores2" 
name="file" folder="" default="BILD"/>
<quad halign="center" valign="center" posn="0 0 3" sizen="21 3" style="Bgs1" substyle="BgList"/> 
<quad halign="center" valign="center" posn="0 -6.4 3.6" sizen="10 10" style="Icons128x128_1" substyle="Upload" 
manialink="POST('.$ml.'?page=admin&amp;site=uploadavatar&amp;part=1&amp;upload=file,file)"/>
<label halign="center" valign="center" posn="0 -6.4 3.7" sizen="10 3" text="UPLOAD" style="TextCardSmallScores2"
manialink="POST('.$ml.'?page=admin&amp;site=uploadavatar&amp;part=1&amp;upload=file,file)"/>
</frame>';
} elseif($_GET["part"]=="1"){
$uu=$_GET["upload"];
	$_SESSION["bild"]=$_GET["upload"];
if(!empty($_GET["upload"]) && !file_exists("./d/avatars/$uu")) { //Überprüfen ob die Seite aufgerufen wird  
$up="./d/avatars/".$uu;
    file_put_contents($up, file_get_contents('php://input'));  
	chmod($up,0777);
echo'
<label halign="center" valign="center" posn="0 7 3.6" sizen="30 3" text="$00FUPLOAD ERFOLGREICH" style="TextCardSmallScores2" />
';
	$insert="INSERT INTO avatars
(name,datum,uploader,nick)
VALUES
('".$_GET["upload"]."','".date("j.n.Y")."', '".$mysqli->real_escape_string($_SESSION["username"])."', '".$mysqli->real_escape_string($_SESSION["nickname"])."')";
$insertausfuhr=$mysqli->query($insert);	
	
	} else {
	echo'
<label halign="center" valign="center" posn="0 7 3.6" sizen="30 3" text="$F00!UPLOAD GESCHEITERT!" style="TextCardSmallScores2" />
';
	}

	
	

$_SESSION["bild"]="";
	}



echo '
<label autonewline="1" style="TextCardSmallScores2" halign="center" valign="top" posn="0 40 4" sizen="60 27" >$F00REGELN:$z
1.Nur Avatars im .dds und .bik FORMAT Hochladen!
2.Keine Avatars doppelt hochladen!
3.Keine geklauten Avatars von anderen ManiaLinks hochladen!
4.Ihr bekommt für jeden Download eures Avatars Punkte, die ihr gegen Coppers umtauschen könnt.</label>
';
#$mysqli->close();
?>