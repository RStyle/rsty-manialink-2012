<?php
$_GET["nickname"]=str_replace("\n","",trim($_GET["nickname"]));
$_GET["playerlogin"]=str_replace("\n","",trim($_GET["playerlogin"]));
if($_GET["playerlogin"]!="" && $_GET["nickname"]!="")
{

$xxx=array();
require('../connect.php');

$donate=$_GET['donate']+0;
$nick=$mysqli->real_escape_string(trim($_GET['nickname']));
$login=$mysqli->real_escape_string(trim($_GET['playerlogin']));

//DONATE IN SB!
$eintrag=$_GET["nickname"];
$eintrag.=SECRET_CODE;
$eintrag.=$donate;
$eintrag.=SECRET_CODE;
$eintrag.="doNAte";
$eintrag.=SECRET_CODE;
$eintrag.=$_GET["playerlogin"];
$eintrag.=SECRET_CODE;
$eintrag.=date("d.m.Y");
$eintrag.="\n";
$eintrag.=file_get_contents('../rsty/shout.txt');
file_put_contents("../rsty/shout.txt",$eintrag);
//doNAte
//1.Nickname   2.Anzahl CC     3.doNAte
//DONATE IN SB! END

$sp="SELECT * FROM donate WHERE login='".trim($_GET["playerlogin"])."' ";
$sqlp = $mysqli->query($sp);
if($xxx = $sqlp->fetch_array())
{
if(trim($nick)!=$xxx["nick"]){
$updatenick="UPDATE donate SET nick='".$nick."' WHERE login = '".$login."'";
$updateausfuhrnick=$mysqli->query($updatenick);
}
$donate = $donate+$xxx["spende"];
$update="UPDATE donate SET spende = '".$donate."' WHERE login = '".$login."'";
$updateausfuhr=$mysqli->query($update);

$summeold = $xxx["summe"]+1;
$updatesumme="UPDATE donate SET summe = '".$summeold."' WHERE login = '".$login."'";
$updateausfuhrsumme=$mysqli->query($updatesumme);
echo'
<?xml version="1.0" encoding="utf-8" ?>
<maniacode noconfirmation="1">
<show_message>
    <message>Danke '.$_GET["nickname"].'$z, du hast jetzt insgesamt '.$donate.' (vorher : '.$xxx["spende"].' ) Coppers gespendet!</message>
</show_message>
<goto>
   <link>$000RSty</link>
</goto>
</maniacode>
';
} else {
$insert="INSERT INTO donate
(nick,login,spende)
VALUES
('".$nick."','".$login."','".$donate."')";
$insertausfuhr=$mysqli->query($insert);
$code=trim(file_get_contents('./rsty/code2.txt'));
echo'
<?xml version="1.0" encoding="utf-8" ?>
<maniacode noconfirmation="1">
	<show_message>
		<message>Danke '.$_GET["nickname"].'$z</message>
	</show_message>
	<goto>
	   <link>$000RSty</link>
	</goto>
</maniacode>
';
}
$dateis=fopen("last.txt",'w');
  fputs($dateis,$_GET['nickname']);
  fputs($dateis,"\n");
  fputs($dateis,$_GET['donate']);
fclose($dateis);
}else{
	echo'<?xml version="1.0" encoding="utf-8" ?>
	<maniacode noconfirmation="1">
		<show_message>
			<message>ERROR</message>
		</show_message>
	</maniacode>';
}
#$mysqli->close();
?>