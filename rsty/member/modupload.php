<?php
#$mysqli= new mysqli("localhost" , "web10" , "", "usr_web10_1");
$a=0;
$envis=array("bay","desert","coast","island","rally","snow","stadium");
$color1='$0F0';
$color2='$777';
$colorr='$F00';
//php://input
$_GET["imageurl"]=$SESSION["modbild"];
if($_GET["step"]=="" && $_GET["fileupload"]==""){
if($_GET["envi"]!=""){
$_SESSION["mod_envi"]=$envis[$_GET["envi"]];
}
echo'
<label posn="-35 21 3">'.$color1.'Mod :</label>
<quad posn="-36 18 2.5" sizen="32 4" style="Bgs1" substyle="BgWindow2"/>
<fileentry posn="-35 17 3" sizen="30 2" style="TextValueSmall" name="mod" folder="Skins"/>
<label posn="-35 13 3">'.$color1.'Bild-Name :</label>
<quad posn="-36 10 2.5" sizen="32 4" style="Bgs1" substyle="BgWindow2"/>
<label posn="-35 9 3" sizen="30 2" style="TextValueSmall" text="'.$_SESSION["modbild"].'"/>
<label posn="-35 7 3" sizen="30 2" style="TextValueSmall" text="Bild Hochladen" manialink="'.$ml.'?page=admin&amp;site=modupload&amp;step=bild"/>
<label posn="-35 5 3">'.$color1.'Name :</label>
<quad posn="-36 2 2.5" sizen="32 4" style="Bgs1" substyle="BgWindow2"/>
<entry posn="-35 1 3" sizen="30 2" style="TextValueSmall" name="name" default="'.$_GET["name"].'"/>
<label posn="-35 -3 3">'.$color1.'Umgebung :</label>
<quad posn="-36 -6 2.5" sizen="32 4" style="Bgs1" substyle="BgWindow2"/>
<label posn="-35 -7 3" sizen="30 2" style="TextValueSmall" text="'.$_SESSION["mod_envi"].'"/>
<label posn="-1 21 3">'.$color1.'Zeit :</label>
<quad posn="-2 18 2.5" sizen="32 4" style="Bgs1" substyle="BgWindow2"/>
<label posn="-1 17 3" sizen="30 2" style="TextValueSmall" text="'.date("d.m.Y").'"/>
<label posn="-1 5 3">'.$color1.'Beschreibung :</label>
<quad posn="-2 2 2.5" sizen="40 20" style="Bgs1" substyle="BgWindow2"/>
<entry posn="-1 1 3" style="TextValueSmall" autonewline="1" sizen="38 18" name="description" default="'.$_GET["kommentar"].'"/>
<label posn="-35 -25 3">$W'.$color2.'Alle Felder außer Beschreibung müssen ausgefüllt werden</label>
<label posn="-35 -29 3" style="CardButtonMedium" manialink="'.$ml.'?page=admin&amp;site=modupload&amp;name=name&amp;kommentar=description&amp;fileupload=mod">Hochladen</label>
<label posn="-2 -29 3" style="CardButtonMedium" manialink="'.$ml.'?page=admin">Zurück</label>
<quad sizen="10 10" posn="-45 -9 3" halign="center" manialink="'.$ml.'?page=admin&amp;site=modupload&amp;name=name&amp;kommentar=description&amp;mod=mod&amp;envi='.$a.'" image="./envis/'.$envis[$a].'.dds" />
';
$a++;echo'<quad sizen="10 10" posn="-35 -9 3" halign="center" manialink="'.$ml.'?page=admin&amp;site=modupload&amp;name=name&amp;kommentar=description&amp;mod=mod&amp;envi='.$a.'" image="./envis/'.$envis[$a].'.dds" />';
$a++;echo'<quad sizen="10 10" posn="-25 -9 3" halign="center" manialink="'.$ml.'?page=admin&amp;site=modupload&amp;name=name&amp;kommentar=description&amp;mod=mod&amp;envi='.$a.'" image="./envis/'.$envis[$a].'.dds" />';
$a++;echo'<quad sizen="10 10" posn="-15 -9 3" halign="center" manialink="'.$ml.'?page=admin&amp;site=modupload&amp;name=name&amp;kommentar=description&amp;mod=mod&amp;envi='.$a.'" image="./envis/'.$envis[$a].'.dds" />';
$a++;echo'<quad sizen="10 10" posn="-45 -19 3" halign="center" manialink="'.$ml.'?page=admin&amp;site=modupload&amp;name=name&amp;kommentar=description&amp;mod=mod&amp;envi='.$a.'" image="./envis/'.$envis[$a].'.dds" />';
$a++;echo'<quad sizen="10 10" posn="-35 -19 3" halign="center" manialink="'.$ml.'?page=admin&amp;site=modupload&amp;name=name&amp;kommentar=description&amp;mod=mod&amp;envi='.$a.'" image="./envis/'.$envis[$a].'.dds" />';
$a++;echo'<quad sizen="10 10" posn="-25 -19 3" halign="center" manialink="'.$ml.'?page=admin&amp;site=modupload&amp;name=name&amp;kommentar=description&amp;mod=mod&amp;envi='.$a.'" image="./envis/'.$envis[$a].'.dds" />';
$uu=$_GET["fileupload"];

}	elseif(!empty($_GET["fileupload"])) { //Überprüfen ob die Seite aufgerufen wird  
if($_SESSION["modbild"]!=""){
$ex="./d/mods/bilder/".$_SESSION["modbild"];
if(file_exists($ex)){
if(preg_match("/\.png$/", $_SESSION["modbild"]) or preg_match("/\.PNG$/", $_SESSION["modbild"]) or preg_match("/\.dds$/", $_SESSION["modbild"]) or preg_match("/\.jpg$/", $_SESSION["modbild"]) or preg_match("/\.bik$/", $_SESSION["modbild"])or preg_match("/\.JPG$/", $_SESSION["modbild"]) or preg_match("/\.DDS$/", $_SESSION["modbild"])){
if(preg_match("/\.zip$/", $_GET["fileupload"])){
if(!empty($_SESSION["mod_envi"])){
if($_GET["name"]!=""){
$uu=$_GET["fileupload"];
$up="./d/mods/".$uu;
if(file_exists($up)){
	chmod($up,0777);
	}
$fileupload=real_escape_string($_GET["fileupload"]);	
$name=real_escape_string($_GET["name"]);
$nick=real_escape_string($_SESSION["nickname"]);
$username=real_escape_string($_SESSION["username"]);
$envi=real_escape_string($_SESSION["mod_envi"]);
$datum=date("d.m.Y");
$kom=real_escape_string($_GET["kommentar"]);
$modbild=real_escape_string($_SESSION["modbild"]);
	
$insert="INSERT INTO mods 
(mod,name,nick,uploader,envi,datum,kommentar,bild)
VALUES
('".$fileupload."','".$name."','".$nick."','".$username."','".$envi."','".$datum."','".$kom."','".$modbild."')";
$mysqli->query($insert);	
//$_SESSION["modbild"]="";	
	
	echo'<label posn="0 0 33" sizen="80 4">!'.$color1.'UPLOAD HAT GEKLAPPT!</label>';
	} else { echo'<label halign="center" posn="0 0 33" sizen="80 4">'.$colorr.'ERROR - DER MOD HAT KEINEN NAMEN -</label>';	}
	} else { echo'<label halign="center" posn="0 0 33" sizen="80 4">'.$colorr.'ERROR - ES WURDE KEINE UMGEBUNG AUSGESUCHT -</label>';	}
	} else { echo'<label halign="center" posn="0 0 33" sizen="80 4">'.$colorr.'ERROR - DER MOD WURDE IM FLASCHEN FORMAT (.zip) HOCHGELADEN -</label>';	}
	} else { echo'<label halign="center" posn="0 0 33" sizen="80 4">'.$colorr.'ERROR - DAS BILD WURDE IM FALSCHEN FORMAT (.png|.PNG|.dds|.DDS|.jpg|.JPG|.bik) HOCHGELADEN -</label>';	}
	} else { echo'<label halign="center" posn="0 0 33" sizen="80 4">'.$colorr.'ERROR - DAS BILD WURDE FALSCH HOCHGELADEN -  --- '.$_SESSION["modbild"].' konnte nicht gefunden werden!</label>';	}
    } else { echo'<label halign="center" posn="0 0 33" sizen="80 4">'.$colorr.'ERROR - ES WURDE KEIN BILD HOCHGELADEN -</label>';	  }
	}else {
echo'
<label posn="-35 21 3">'.$color1.'Bild :</label>
<quad posn="-36 18 2.5" sizen="32 4" style="Bgs1" substyle="BgWindow2"/>
<fileentry posn="-35 17 3" sizen="30 2" style="TextValueSmall" default="" name="image" folder=""/>
<label posn="-35 12 3" sizen="80 4">'.$color2.'- Bitte lade das Bild nur im '.$color1.'.png|.PNG|.dds|.DDS|.jpg|.JPG|.bik'.$color2.' Format hoch.</label>
<label posn="-35 9 3">'.$color2.'- Das Bild sollte nach möglichkeit nicht größer als '.$color1.'500kb'.$color2.' sein.</label>
<label posn="-35 6 3">'.$color2.'- Das Bild sollte nicht größer als '.$color1.'500 x. 375 Pixel'.$color2.' groß sein.</label>
<label posn="-35 -24 3" style="CardButtonMedium" manialink="POST('.$ml.'?page=admin&amp;site=modupload&amp;step=image_u&amp;image=image,image)">Bild hochladen</label>
<label posn="-35 -28 3" style="CardButtonMedium" manialink="'.$ml.'?page=admin&amp;site=modupload">Zurück zum Trackupload</label>';
if($_GET["step"]=="image_u" && !file_exists("./d/mods/bilder/".$_GET["image"].""))
    $up="./d/mods/bilder/".$_GET["image"]."";
	file_put_contents($up, file_get_contents('php://input'));  
	chmod($up,0777);
	$_SESSION["modbild"]=$_GET["image"];;
	
	
	}
	#$mysqli->close();
?>