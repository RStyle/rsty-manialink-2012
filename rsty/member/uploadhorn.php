<?php
echo' <frame posn="0 6.4" scale="1.3">
<label halign="center" valign="center" posn="0 7 3.6" sizen="30 3" text="UPLOADER : '.$_SESSION['loginname'].'" style="TextCardSmallScores2" />
<fileentry posn="0 0 4" halign="center" valign="center" sizen="20 2" style="TextCardSmallScores2" 
name="file" folder="" default="Horn"/>
<quad halign="center" valign="center" posn="0 0 3" sizen="21 3" style="Bgs1" substyle="BgList"/> 
<quad halign="center" valign="center" posn="0 -6.4 3.6" sizen="10 10" style="Icons128x128_1" substyle="Upload" 
manialink="POST(r2r?page=admin&amp;site=uploadhorn&amp;upload=file,file)"/>
<label halign="center" valign="center" posn="0 -6.4 3.7" sizen="10 3" text="UPLOAD" style="TextCardSmallScores2"
manialink="POST(r2r?page=admin&amp;site=uploadhorn&amp;upload=file,file)"/>
</frame>';
$uu=$_GET["upload"];
if(isset($_GET["upload"]) && !file_exists("./d/horns/$uu")) //Überprüfen ob die Seite aufgerufen wird  
    {
$bv="d/horns";
$verzeichnis=opendir($bv);
$txt=0;
while($datei = readdir($verzeichnis)){
if(preg_match("/\.txt$/", $datei)) {
$txt++;
}
}

 $datei=fopen("./d/horns/$txt.txt","w");
  fputs($datei,$_GET['upload']);
  fputs($datei,"\n");
  fputs($datei,$_SESSION['loginname']);
 fclose($datei);

	$uname=$_GET['upload'];
	$up="./d/horns/";
	$up.=$uname;
    file_put_contents($up, file_get_contents('php://input'));  
}

//---Rules
echo '
<label autonewline="1" style="TextCardSmallScores2" halign="center" valign="top" posn="0 40 4" sizen="60 27" >$F00REGELN:$z
1.Nur .ogg oder .mux oder .wav Dateien Hochladen!
2.Das Horn darf maximall 10 Sekunden lang sein!
3.Keine geklauten Horns von anderen ManiaLinks hochladen!
4.Ihr bekommt für jeden Download eures Horn 10 Punkte, die ihr gegen 10 Coppers umtauschen könnt.</label>
';
?>