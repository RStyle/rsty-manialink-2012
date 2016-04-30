<?php
ob_start();
session_start();
date_default_timezone_set("Europe/Berlin");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>!MOD UPLOAD!</title>
<meta name="editor" content="html-editor phase 5">
<style type="text/css">
p {background-color: white;color:blue;Position:absolute;Left:150px;Top:320px }
</style>
</head>
<body text="#00F0F0" bgcolor="#AFAFAF" link="#FF0000" alink="#F00000" vlink="#0F0000">
<?php if($_SESSION["login"]=="mod"){  ?>
<form action="<?php echo htmlspecialchars($SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
Mod: <br/><input type="file" name="mod" ><br/>
Bild: <br/><input type="file" name="bild" ><br/>
Name: <br/><input type="text" name="name" size="25" /><br/>
Beschreibung: <br/><textarea name="kom" rows="4" cols="25" ></textarea><br/>
<input type="submit" value="Hochladen"> <br/>
</form>
<?php
require_once('connect.php');

if(isset($_POST["mod"]) or $_POST["name"]!=""){
if(move_uploaded_file($_FILES["mod"]["name"], "d/mods/".$_FILES["mod"]["name"])){
// move_uploaded_file($_FILES['datei']['name'], "upload/".$_FILES['datei']['name'])
echo'<p>UPLOAD ERFOLGREICH</p><br/>';
}else{
echo'<p>UPLOAD GESCHEITERT</p><br/>';
}
	$sql_befehl = "
    INSERT INTO mods (
        deutsch,
        latein,
		lektion
    ) VALUES (
        '" . mysqli_real_escape_string($db, $_POST['deutsch']) . "',
        '" . mysqli_real_escape_string($db, $_POST['latein']) . "',
		'" .$l. "'
    )";
    //SQL-Befehl ausführen
    //if(!$mysqli->query($sql_befehl)){
        //Falls etwas hierbei fehlschlägt:
      //  die("Der Eintrag konnte nicht erstellt werden!");
    //}
}
?>
<?php } else { echo'
<script type="text/javascript">

alert("Du bist nicht eingeloggt!");

</script>
'; } ?>
</body>
</html>
<?php
  ob_end_flush();
?>