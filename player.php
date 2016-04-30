<?php
 $ip=$_SERVER['REMOTE_ADDR'];
 $iptxt="./rsty/ip/".$ip.".txt";
 //$fp = @fopen($iptxt,"r");
 echo'<label posn="0 0 5" sizen="30 5" text="INCLUDE FUNZT" valign="center" halign="center" />';
 $fp=file_exists($iptxt);
  if($fp && $_SESSION["nickname"]=="" && $_SESSION["username"]=="" && $_SESSION["playerlogin"]==""){
 $dataip=file($iptxt);
 $_GET["nickname"]=str_replace("\n","",trim($dataip[1]));
 $_GET["playerlogin"]=str_replace("\n","",trim($dataip[0]));
 $_SESSION["nickname"]=$_GET["nickname"];
 $_SESSION["playerlogin"]=$_GET["playerlogin"];
 $_SESSION["username"]=$_GET["playerlogin"];
 }
 elseif(!$fp && $_GET["nickname"]!="" && $_GET["playerlogin"]!=""){
 $iptext=$_GET["playerlogin"]."\n".$_GET["nickname"];
 file_put_contents($iptxt,$iptext);
 chmod($iptxt, 0777);
 $_SESSION["nickname"]=$_GET["nickname"];
 $_SESSION["playerlogin"]=$_GET["playerlogin"];
 $_SESSION["username"]=$_GET["playerlogin"];
 } elseif($_SESSION["nickname"]=="" && $_SESSION["username"]=="" && $_SESSION["playerlogin"]=="" && $_GET["nickname"]=="" && $_GET["playerlogin"]==""){
 //...
 }
?>