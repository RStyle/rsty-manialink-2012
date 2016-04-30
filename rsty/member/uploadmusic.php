<?php
echo' <frame posn="0 -6.4" scale="1.3">
<quad valign="center" halign="center" posn="0 -3 0.1" image="./header/white.png" sizen="32 30" />
<label halign="center" valign="center" posn="0 7 3.6" sizen="30 3" tetcolor="000F" text="$000UPLOADER : '.$_SESSION['loginname'].'" style="TextCardSmallScores2" />
<fileentry posn="0 0 4" halign="center" valign="center" sizen="20 2" style="TextCardSmallScores2" 
name="file" folder="" default="!MusiK!"/>
<quad halign="center" valign="center" posn="0 0 3" sizen="21 3" style="Bgs1" substyle="BgList"/> 
<quad halign="center" valign="center" posn="0 -6.4 3.6" sizen="10 10" style="Icons128x128_1" substyle="Upload" 
manialink="POST(r2r?page=admin&amp;site=uploadmusic&amp;upload=file,file)"/>
<label halign="center" valign="center" posn="0 -6.4 3.7" sizen="10 3" text="UPLOAD" style="TextCardSmallScores2"
manialink="POST(r2r?page=admin&amp;site=uploadmusic&amp;upload=file,file)"/>
';
$uu=$_GET["upload"];
if(isset($_GET["upload"]) && !file_exists("music/$uu")) //Überprüfen ob die Seite aufgerufen wird  
    {
	$up="./music/";
	$up.=$uu;
    file_put_contents($up, file_get_contents('php://input'));  
	chmod($up,0777);
}

echo '
<label textcolor="000F" autonewline="1" style="TextCardSmallScores2" halign="center" valign="top" posn="0 -10 4" sizen="31 27" >$F00REGELN:$z$000
Nur .ogg oder .mux oder .wav MusikDateien Hochladen!</label>
</frame>';
?>