<?php
if($_SESSION["login"]!="" && $_GET["page"]=="track"){
//TrackPage!

if(isset($_FILES["track"]["name"]) or isset($_FILES["bild"]["name"]) or $_POST["name"]!=""){
	if(!empty($_FILES["track"]["name"]) && !empty($_FILES["bild"]["name"]) && $_POST["name"]!=""){
		if(move_uploaded_file($_FILES["track"]["tmp_name"], "../d/tracks/".$_POST["envi"]."/".$_POST["preis"]."/".$_FILES["track"]["name"]) && move_uploaded_file($_FILES["bild"]["tmp_name"], "../bilder/".substr($_FILES["bild"]["name"], 8).$_FILES["bild"]["name"])){
			echo'<script type="text/javascript">

			alert("UPLOAD ERFOLGREICH!");

			</script>';
			$insert="INSERT INTO tracks
			(name,datum,bild,preis,envi,uploader,nick,gps,kom)
			VALUES
			('".$mysqli->real_escape_string($_FILES["track"]["name"])."','".date("j.n.Y")."', '".$mysqli->real_escape_string(substr($_FILES["bild"]["name"], 8).$_FILES["bild"]["name"])."', '".$_POST["preis"]."', '".$_POST["envi"]."', '".$mysqli->real_escape_string($_SESSION["username"])."', '".$mysqli->real_escape_string($_SESSION["nickname"])."','".$_POST["gps"]."','".$mysqli->real_escape_string($_POST["kom"])."')";
			$insertausfuhr=$mysqli->query($insert);

		}else{ ?>
			<script type="text/javascript">

			alert("UPLOAD GESCHEITERT Track und/oder Bild KONNTE NICHT HOCHGELADEN WERDEN");

			</script>
		<?php
		}
	}else{ ?>
	<script type="text/javascript">

	alert("UPLOAD GESCHEITERT\n\nUnvollständige Angaben! - Trackupload fail");

	</script>
	<?php
	}
}

echo'
<table border="1">
 <colgroup>
 <col width="120">
 </colgroup>
<form action="" method="post" enctype="multipart/form-data">
<tr><th>Track: </th><th><input type="file" name="track" ></th></tr>
<tr><th>Bild: </th><th><input type="file" name="bild" ></th></tr>
<tr><th>Name: </th><th><input type="text" name="name" size="25" /></th></tr>
<tr><th>Envi: </th><th><select name="envi">
<option value="stadium">Stadion</option>
<option value="snow">Snow</option>
<option value="rally">Rally</option>
<option value="island">Island</option>
<option value="desert">Desert</option>
<option value="coast">Coast</option>
<option value="bay">Bay</option>
</select></th></tr>
<tr><th>GPS: </th><th><select name="gps">
<option value="0">NEIN</option>
<option value="1">JA</option>
</select></th></tr>
<tr><th>UPLOADER :</th><th> '.$_SESSION["username"].' </th></tr>
<tr><th>NICKNAME :</th><th> '.$cp->toHTML($_SESSION["nickname"]).' </th></tr>
<tr><th>Beschreibung :</th><th><textarea name="kom" rows="4" cols="25" ></textarea></th></tr>
<tr><th>PREIS: </th><th><select name="preis">
<option value="1">10 Coppers</option>
<option value="3">30 Coppers</option>
<option value="2">50 Coppers</option>
</select></th></tr>
<tr><th>DATUM :</th><th>'.date("j.n.Y").'</th></tr>
<tfood><tr><th>
<input type="image" name="upload" width="150" height="40" src="upload.png" alt="Absenden"> <br/>
</th></tr></tfood>
</form>
</table>
';
//<textarea name="kom" rows="4" cols="25" ></textarea>
}
//TRACKEND
//AVATAR!!!:
if($_SESSION["login"]!="" && $_GET["page"]=="avatar"){

//AVATAR!

if(isset($_FILES["avatar"]["name"])){
if(!empty($_FILES["avatar"]["name"])){
if(move_uploaded_file($_FILES["avatar"]["tmp_name"], "../d/avatars/".$_FILES["avatar"]["name"])){
echo'<script type="text/javascript">

alert("UPLOAD ERFOLGREICH!");

</script>';
$insert="INSERT INTO avatars
(name,datum,uploader,nick)
VALUES
('".$mysqli->real_escape_string($_FILES["avatar"]["name"])."','".date("j.n.Y")."', '".$mysqli->real_escape_string($_SESSION["username"])."','".$mysqli->real_escape_string($_SESSION["nickname"])."')";
$insertausfuhr=$mysqli->query($insert);	
}else{ ?>
<script type="text/javascript">

alert("UPLOAD GESCHEITERT Avatar KONNTE NICHT HOCHGELADEN WERDEN");

</script>
<?php
}

}else{ ?>
<script type="text/javascript">

alert("UPLOAD GESCHEITERT\n\nUnvollständige Angaben!");

</script>
<?php
}
}

echo'
<table border="1">
 <colgroup>
 <col width="120">
 </colgroup>
<form action="" method="post" enctype="multipart/form-data">
<tr><th>AVATAR: </th><th><input type="file" name="avatar" ></th></tr>
<tr><th>UPLOADER :</th><th> '.$_SESSION["username"].' </th></tr>
<tr><th>NICKNAME :</th><th>'.$cp->toHTML($_SESSION["nickname"]).'</th></tr>
<tr><th>DATUM :</th><th>'.date("j.n.Y").'</th></tr>
<tfood><tr><th>
<input type="image" name="upload" width="150" height="40" src="upload.png" alt="Absenden"> <br/>
</th></tr></tfood>
</form>
</table>
';
}

if($_SESSION["login"]!="" && $_GET["page"]=="horn"){

//horn!

if(isset($_FILES["horn"]["name"])){
if(!empty($_FILES["horn"]["name"])){
$datei=$_FILES["horn"]["name"];
if(preg_match("/\.wav$/", $datei) or preg_match("/\.ogg$/", $datei) or preg_match("/\.mux$/", $datei)){
if(move_uploaded_file($_FILES["horn"]["tmp_name"], "../d/horns/".$_FILES["horn"]["name"])){

$bv="../d/horns";
$verzeichnis=opendir($bv);
$txt=0;
while($datei = readdir($verzeichnis)){
if(preg_match("/\.txt$/", $datei)) {
$txt++;
}
}

 $datei=fopen("../d/horns/$txt.txt","w");
  fputs($datei,$_FILES['horn']['name']);
  fputs($datei,"\n");
  fputs($datei,$_SESSION['username']);
 fclose($datei);

echo'<script type="text/javascript">

alert("UPLOAD ERFOLGREICH!");

</script>';
}else{ ?>
<script type="text/javascript">

alert("UPLOAD GESCHEITERT Horn KONNTE NICHT HOCHGELADEN WERDEN");

</script>
<?php
}
} else {
echo'<script type="text/javascript">

alert("Falsches Format!\nNur Hupen in folgenden Formaten hochladen:\n.ogg .wav und .mux");

</script>';
}
}else{ ?>
<script type="text/javascript">

alert("UPLOAD GESCHEITERT\n\nUnvollständige Angaben!");

</script>
<?php
}
}

echo'
<table border="1">
 <colgroup>
 <col width="120">
 </colgroup>
<form action="" method="post" enctype="multipart/form-data">
<tr><th>horn: </th><th><input type="file" name="horn" ></th></tr>
<tr><th>UPLOADER :</th><th> '.$cp->toHTML($_SESSION["nickname"]).' </th></tr>
<tfood><tr><th>
<input type="image" name="upload" width="150" height="40" src="upload.png" alt="Absenden"> <br/>
</th></tr></tfood>
</form>
</table>
';
}


if($_SESSION["login"]=="admin" && $_GET["page"]=="plugin"){

//plugin!

if(isset($_FILES["plugin"]["name"])){
if(!empty($_FILES["plugin"]["name"])){
if(move_uploaded_file($_FILES["plugin"]["tmp_name"], "../d/plugins/".$_POST["preis"]."/".$_FILES["plugin"]["name"]) && move_uploaded_file($_FILES["bild"]["tmp_name"], "../bilder/".$_FILES["bild"]["name"])){
echo'<script type="text/javascript">

alert("UPLOAD ERFOLGREICH!");

</script>';
	$insert="INSERT INTO plugins
(name,datum,bild,preis)
VALUES
('".$mysqli->real_escape_string($_FILES["plugin"]["name"])."','".date("j.n.Y")."', '".$mysqli->real_escape_string($_FILES["bild"]["name"])."', '".$_POST["preis"]."')";
$insertausfuhr=$mysqli->query($insert);	
}else{ ?>
<script type="text/javascript">

alert("UPLOAD GESCHEITERT Plugin KONNTE NICHT HOCHGELADEN WERDEN");

</script>
<?php
}
}else{ ?>
<script type="text/javascript">

alert("UPLOAD GESCHEITERT\n\nUnvollständige Angaben!");

</script>
<?php
}
}
echo'
<table border="1">
 <colgroup>
 <col width="120">
 </colgroup>
<form action="" method="post" enctype="multipart/form-data">
<tr><th>Plugin: </th><th><input type="file" name="plugin" ></th></tr>
<tr><th>Bild: </th><th><input type="file" name="bild" ></th></tr>
<tr><th>Preis: </th><th><select name="preis">
<option value="1">10 Coppers</option>
<option value="3">30 Coppers</option>
<option value="2">50 Coppers</option>
</select></th></tr>
<tr><th>DATUM :</th><th>'.date("j.n.Y").'</th></tr>
<tfood><tr><th>
<input type="image" name="upload" width="150" height="40" src="upload.png" alt="Absenden"> <br/>
</th></tr></tfood>
</form>
</table>
';
}


if($_SESSION["login"]=="admin" && $_GET["page"]=="screen"){

//screen!

if(isset($_FILES["screen"]["name"])){
if(!empty($_FILES["screen"]["name"]) && !empty($_POST["name"])){
if(move_uploaded_file($_FILES["screen"]["tmp_name"], "../d/screens/".$_FILES["screen"]["name"])){
echo'<script type="text/javascript">

alert("UPLOAD ERFOLGREICH!");

</script>';
	$insert="INSERT INTO screens
(file,datum,name,uploader,nick,kom)
VALUES
('".$mysqli->real_escape_string($_FILES["screen"]["name"])."','".date("j.n.Y")."', '".$mysqli->real_escape_string($_POST["name"])."', '".$mysqli->real_escape_string($_SESSION["username"])."', '".$mysqli->real_escape_string($_SESSION["nickname"])."', '".$mysqli->real_escape_string($_POST["kom"])."')";
$insertausfuhr=$mysqli->query($insert);	
}else{ ?>
<script type="text/javascript">

alert("UPLOAD GESCHEITERT Wallpaper KONNTE NICHT HOCHGELADEN WERDEN");

</script>
<?php
}

}else{ ?>
<script type="text/javascript">

alert("UPLOAD GESCHEITERT\n\nUnvollständige Angaben!");

</script>
<?php
}
}
echo'
<table border="1">
 <colgroup>
 <col width="120">
 </colgroup>
<form action="" method="post" enctype="multipart/form-data">
<tr><th>Bild/Screen/Wallpaper: </th><th><input type="file" name="screen" ></th></tr>
<tr><th>Name: </th><th><input type="text" name="name" size="25" /></th></tr>
<tr><th>Preis: </th><th>25 Coppers</th></tr>
<tr><th>UPLOADER :</th><th> '.$cp->toHTML($_SESSION["username"]).' </th></tr>
<tr><th>UPLOADER-Nickname :</th><th> '.$cp->toHTML($_SESSION["nickname"]).' </th></tr>
<tr><th>DATUM :</th><th>'.date("j.n.Y").'</th></tr>
<tr><th>Beschreibung :</th><th><textarea name="kom" rows="4" cols="30" ></textarea></th></tr>
<tfood><tr><th>
<input type="image" name="upload" width="150" height="40" src="upload.png" alt="Absenden"> <br/>
</th></tr></tfood>
</form>
</table>
';
}


if($_SESSION["login"]=="admin" && $_GET["page"]=="sign"){

//sign!

if(isset($_FILES["bild"]["name"])){
if(!empty($_FILES["bild"]["name"]) && !empty($_POST["name"]) && !empty($_FILES["sig1"]["name"]) && !empty($_FILES["sig2"]["name"]) && !empty($_FILES["sig3"]["name"]) && !empty($_FILES["sig4"]["name"]) && !empty($_FILES["sig5"]["name"]) && !empty($_FILES["sig6"]["name"]) && !empty($_FILES["sig7"]["name"]) && !empty($_FILES["sig8"]["name"]) && !empty($_FILES["sig9"]["name"])){
if(move_uploaded_file($_FILES["bild"]["tmp_name"], "../d/signs/".$_FILES["bild"]["name"]) && move_uploaded_file($_FILES["sig1"]["tmp_name"], "../d/signs/bilder/".$_FILES["sig1"]["name"]) && move_uploaded_file($_FILES["sig2"]["tmp_name"], "../d/signs/bilder/".$_FILES["sig2"]["name"]) && move_uploaded_file($_FILES["sig3"]["tmp_name"], "../d/signs/bilder/".$_FILES["sig3"]["name"]) && move_uploaded_file($_FILES["sig4"]["tmp_name"], "../d/signs/bilder/".$_FILES["sig4"]["name"])
 && move_uploaded_file($_FILES["sig5"]["tmp_name"], "../d/signs/bilder/".$_FILES["sig5"]["name"])
 && move_uploaded_file($_FILES["sig6"]["tmp_name"], "../d/signs/bilder/".$_FILES["sig6"]["name"]) && move_uploaded_file($_FILES["sig7"]["tmp_name"], "../d/signs/bilder/".$_FILES["sig7"]["name"]) && move_uploaded_file($_FILES["sig8"]["tmp_name"], "../d/signs/bilder/".$_FILES["sig8"]["name"]) && move_uploaded_file($_FILES["sig9"]["tmp_name"], "../d/signs/bilder/".$_FILES["sig9"]["name"])){
if(!empty($_FILES["sig10"]["name"]))move_uploaded_file($_FILES["sig10"]["tmp_name"], "../d/signs/bilder/".$_FILES["sig10"]["name"]);
if(!empty($_FILES["sig11"]["name"]))move_uploaded_file($_FILES["sig11"]["tmp_name"], "../d/signs/bilder/".$_FILES["sig11"]["name"]);
if(!empty($_FILES["sig12"]["name"]))move_uploaded_file($_FILES["sig12"]["tmp_name"], "../d/signs/bilder/".$_FILES["sig12"]["name"]);
if(!empty($_FILES["sig13"]["name"]))move_uploaded_file($_FILES["sig13"]["tmp_name"], "../d/signs/bilder/".$_FILES["sig13"]["name"]);
if(!empty($_FILES["sig14"]["name"]))move_uploaded_file($_FILES["sig14"]["tmp_name"], "../d/signs/bilder/".$_FILES["sig14"]["name"]);
if(!empty($_FILES["sig15"]["name"]))move_uploaded_file($_FILES["sig15"]["tmp_name"], "../d/signs/bilder/".$_FILES["sig15"]["name"]);
if(!empty($_FILES["sig16"]["name"]))move_uploaded_file($_FILES["sig16"]["tmp_name"], "../d/signs/bilder/".$_FILES["sig16"]["name"]);
 echo'<script type="text/javascript">

alert("UPLOAD ERFOLGREICH!");

</script>';
	$insert="INSERT INTO signs
(bild,datum,name,uploader,nick,sig1,sig2,sig3,sig4,sig5,sig6,sig7,sig8,sig9,sig10,sig11,sig12,sig13,sig14,sig15,sig16,kom)
VALUES
('".$mysqli->real_escape_string($_FILES["bild"]["name"])."','".date("j.n.Y")."', '".$mysqli->real_escape_string($_POST["name"])."', '".$mysqli->real_escape_string($_SESSION["username"])."', '".$mysqli->real_escape_string($_SESSION["nickname"])."',
'".$mysqli->real_escape_string($_FILES["sig1"]["name"])."',
'".$mysqli->real_escape_string($_FILES["sig2"]["name"])."',
'".$mysqli->real_escape_string($_FILES["sig3"]["name"])."',
'".$mysqli->real_escape_string($_FILES["sig4"]["name"])."',
'".$mysqli->real_escape_string($_FILES["sig5"]["name"])."',
'".$mysqli->real_escape_string($_FILES["sig6"]["name"])."',
'".$mysqli->real_escape_string($_FILES["sig7"]["name"])."',
'".$mysqli->real_escape_string($_FILES["sig8"]["name"])."',
'".$mysqli->real_escape_string($_FILES["sig9"]["name"])."',
'".$mysqli->real_escape_string($_FILES["sig10"]["name"])."',
'".$mysqli->real_escape_string($_FILES["sig11"]["name"])."',
'".$mysqli->real_escape_string($_FILES["sig12"]["name"])."',
'".$mysqli->real_escape_string($_FILES["sig13"]["name"])."',
'".$mysqli->real_escape_string($_FILES["sig14"]["name"])."',
'".$mysqli->real_escape_string($_FILES["sig15"]["name"])."',
'".$mysqli->real_escape_string($_FILES["sig16"]["name"])."', '".$mysqli->real_escape_string($_POST["kom"])."')";
$insertausfuhr=$mysqli->query($insert);	
}else{ ?>
<script type="text/javascript">

alert("UPLOAD GESCHEITERT Wallpaper KONNTE NICHT HOCHGELADEN WERDEN");

</script>
<?php
}
}else{ ?>
<script type="text/javascript">

alert("UPLOAD GESCHEITERT\n\nUnvollständige Angaben!");

</script>
<?php
}
}
echo'
<table border="1">
 <colgroup>
 <col width="120">
 </colgroup>
<form action="" method="post" enctype="multipart/form-data">
<tr><th>Bild welches auf dem Manialink erscheint : </th><th><input type="file" name="bild" ></th></tr>
<tr><th>Name: </th><th><input type="text" name="name" size="25" /></th></tr>

<tr><th>1. Sign : </th><th><input type="file" name="sig1" ></th></tr>
<tr><th>2. Sign : </th><th><input type="file" name="sig2" ></th></tr>
<tr><th>3. Sign : </th><th><input type="file" name="sig3" ></th></tr>
<tr><th>4. Sign : </th><th><input type="file" name="sig4" ></th></tr>
<tr><th>5. Sign : </th><th><input type="file" name="sig5" ></th></tr>
<tr><th>6. Sign : </th><th><input type="file" name="sig6" ></th></tr>
<tr><th>7. Sign : </th><th><input type="file" name="sig7" ></th></tr>
<tr><th>8. Sign : </th><th><input type="file" name="sig8" ></th></tr>
<tr><th>9. Sign : </th><th><input type="file" name="sig9" ></th></tr>
<tr><th>10. Sign : </th><th><input type="file" name="sig10" ></th></tr>
<tr><th>11. Sign : </th><th><input type="file" name="sig11" ></th></tr>
<tr><th>12. Sign : </th><th><input type="file" name="sig12" ></th></tr>
<tr><th>13. Sign : </th><th><input type="file" name="sig13" ></th></tr>
<tr><th>14. Sign : </th><th><input type="file" name="sig14" ></th></tr>
<tr><th>15. Sign : </th><th><input type="file" name="sig15" ></th></tr>
<tr><th>16. Sign : </th><th><input type="file" name="sig16" ></th></tr>

<tr><th>Preis: </th><th>78 Coppers</th></tr>
<tr><th>UPLOADER :</th><th> '.$cp->toHTML($_SESSION["username"]).' </th></tr>
<tr><th>UPLOADER-Nickname :</th><th> '.$cp->toHTML($_SESSION["nickname"]).' </th></tr>
<tr><th>DATUM :</th><th>'.date("j.n.Y").'</th></tr>
<tr><th>Beschreibung :</th><th><textarea name="kom" rows="4" cols="30" ></textarea></th></tr>
<tfood><tr><th>
<input type="image" name="upload" width="150" height="40" src="upload.png" alt="Absenden"> <br/>
</th></tr></tfood>
</form>
</table>
';
}


if($_SESSION["login"]!="" && $_GET["page"]=="skin"){

//skins!

if(isset($_FILES["skin"]["name"])){
if(!empty($_FILES["skin"]["name"]) && !empty($_FILES["bild"]["name"]) && !empty($_POST["name"])){
if(preg_match("/\.zip$/",$_FILES["skin"]["name"])){
if(move_uploaded_file($_FILES["skin"]["tmp_name"], "../d/skins/".$_FILES["skin"]["name"]) && move_uploaded_file($_FILES["bild"]["tmp_name"], "../d/skins/".$_FILES["bild"]["name"])){
echo'<script type="text/javascript">

alert("UPLOAD ERFOLGREICH!");

</script>';
	$insert="INSERT INTO skins
(datum,file,name,bild,uploader,nickname,kom,3d)
VALUES
('".date("j.n.Y")."', '".$mysqli->real_escape_string($_FILES["skin"]["name"])."', '".$mysqli->real_escape_string($_POST["name"])."', '".$mysqli->real_escape_string($_FILES["bild"]["name"])."',
'".$mysqli->real_escape_string($_SESSION["username"])."', '".$mysqli->real_escape_string($_SESSION["nickname"])."', '".$mysqli->real_escape_string($_POST["kom"])."', '".$mysqli->real_escape_string($_POST["d3"])."')";
$insertausfuhr=$mysqli->query($insert);	
}else{ ?>
<script type="text/javascript">

alert("UPLOAD GESCHEITERT Skin KONNTE NICHT HOCHGELADEN WERDEN");

</script>
<?php
}
} else {
echo'<script type="text/javascript">

alert("Die Skins nur in .zip hochladen!");

</script>';
}
}else{ ?>
<script type="text/javascript">

alert("UPLOAD GESCHEITERT\n\nUnvollständige Angaben!");

</script>
<?php
}
}
echo'
<table border="1">
 <colgroup>
 <col width="120">
 </colgroup>
<form action="" method="post" enctype="multipart/form-data">
<tr><th>Skin: </th><th><input type="file" name="skin" ></th></tr>
<tr><th>Bild: </th><th><input type="file" name="bild" ></th></tr>
<tr><th>Name: </th><th><input type="text" name="name" size="25" /></th></tr>
<tr><th>3d: </th><th><input type="text" name="d3" value="Nadeo" size="25" /></th></tr>
<tr><th>Preis: </th><th>90 Coppers</th></tr>
<tr><th>UPLOADER :</th><th> '.$cp->toHTML($_SESSION["username"]).' </th></tr>
<tr><th>UPLOADER-Nickname :</th><th> '.$cp->toHTML($_SESSION["nickname"]).' </th></tr>
<tr><th>DATUM :</th><th>'.date("j.n.Y").'</th></tr>
<tr><th>Beschreibung :</th><th><textarea name="kom" rows="4" cols="30" ></textarea></th></tr>
<tfood><tr><th>
<input type="image" name="upload" width="150" height="40" src="upload.png" alt="Absenden"> <br/>
</th></tr></tfood>
</form>
</table>
';
}


if($_SESSION["login"]!="" && $_GET["page"]=="mod"){
//modPage!

if(isset($_FILES["mod"]["name"]) or isset($_FILES["bild"]["name"]) or $_POST["name"]!=""){
if(!empty($_FILES["mod"]["name"]) && !empty($_FILES["bild1"]["name"]) && !empty($_FILES["bild2"]["name"]) && !empty($_FILES["bild3"]["name"]) && $_POST["name"]!="" && $_POST["envi"]!=""){
if(move_uploaded_file($_FILES["mod"]["tmp_name"], "../d/mods/".$_POST["envi"]."/".$_FILES["mod"]["name"]) && move_uploaded_file($_FILES["bild1"]["tmp_name"], "../d/mods/bilder/".$_FILES["bild1"]["name"])
 && move_uploaded_file($_FILES["bild2"]["tmp_name"], "../d/mods/bilder/".$_FILES["bild2"]["name"]) && move_uploaded_file($_FILES["bild3"]["tmp_name"], "../d/mods/bilder/".$_FILES["bild3"]["name"])){
echo'<script type="text/javascript">

alert("UPLOAD ERFOLGREICH!");

</script>';
$insert="
INSERT INTO `mods` (
`name` ,
`file` ,
`bild1` ,
`bild2` ,
`bild3` ,
`user` ,
`nick` ,
`envi` ,
`kom` ,
`datum`
)
VALUES (
'".$mysqli->real_escape_string($_POST["name"])."',  '".$mysqli->real_escape_string($_FILES["mod"]["name"])."',  '".$mysqli->real_escape_string($_FILES["bild1"]["name"])."',  '".$mysqli->real_escape_string($_FILES["bild2"]["name"])."',  '".$mysqli->real_escape_string($_FILES["bild3"]["name"])."',  '".$mysqli->real_escape_string($_SESSION["username"])."',  '".$mysqli->real_escape_string($_SESSION["nickname"])."',  '".$mysqli->real_escape_string($_POST["envi"])."', '".$mysqli->real_escape_string($_POST["kom"])."',  '".date("j.n.Y")."'
);

";
// `usr_web10_1`.`mods`
$insertausfuhr=$mysqli->query($insert);
echo $insert;
}else{ ?>
<script type="text/javascript">

alert("UPLOAD GESCHEITERT mod und/oder Bild KONNTE NICHT HOCHGELADEN WERDEN");

</script>
<?php
}
}else{ ?>
<script type="text/javascript">

alert("UPLOAD GESCHEITERT\n\nUnvollständige Angaben!");

</script>
<?php
}
}

echo'
<table border="1">
 <colgroup>
 <col width="120">
 </colgroup>
<form action="" method="post" enctype="multipart/form-data">
<tr><th>Mod: </th><th><input type="file" name="mod" ></th></tr>
<tr><th>1.Bild: </th><th><input type="file" name="bild1" ></th></tr>
<tr><th>2.Bild: </th><th><input type="file" name="bild2" ></th></tr>
<tr><th>3.Bild: </th><th><input type="file" name="bild3" ></th></tr>
<tr><th>Name: </th><th><input type="text" name="name" size="25" /></th></tr>
<tr><th>Envi: </th><th><select name="envi">
<option value="stadium">Stadion</option>
<option value="snow">Snow</option>
<option value="rally">Rally</option>
<option value="island">Island</option>
<option value="desert">Desert</option>
<option value="coast">Coast</option>
<option value="bay">Bay</option>
</select></th></tr>
<tr><th>UPLOADER :</th><th> '.$_SESSION["username"].' </th></tr>
<tr><th>NICKNAME :</th><th> '.$cp->toHTML($_SESSION["nickname"]).' </th></tr>
<tr><th>PREIS: </th><th>65 Coppers</th></tr>
<tr><th>DATUM :</th><th>'.date("j.n.Y").'</th></tr>
<tr><th>Beschreibung :</th><th><textarea name="kom" rows="4" cols="25" ></textarea></th></tr>
<tfood><tr><th>
<input type="image" name="upload" width="150" height="40" src="upload.png" alt="Absenden"> <br/>
</th></tr></tfood>
</form>
</table>
';
//<textarea name="kom" rows="4" cols="25" ></textarea>
}

?>