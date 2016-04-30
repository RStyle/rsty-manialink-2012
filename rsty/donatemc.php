<?php
$a=$_GET['playerlogin'];
$nick=$_GET['nickname'];
$donate=$_GET['donate']+0;
if($donate > 0){
if(file_exists("./rsty/donate/$a.txt")){
$d=file("./donate/$a.txt");
$d=$d[0];
} else {
$d=0;
}
$d=$d+$_GET['donate'];
$dateis=fopen("./rsty/donate/$a.txt",'w');
  fputs($dateis,$d);
fclose($dateis);
$best=file("./rsty/donate/bestd.txt");
if($d>=$best[0]){
$dateis=fopen("./rsty/donate/bestd.txt",'w');
  fputs($dateis,$d);
  fputs($dateis,"\n");
  fputs($dateis,$nickname);
  fputs($dateis,"\n");
  fputs($dateis,$_GET['playerlogin']);
fclose($dateis);
}
$alla=file("./rsty/donate/all.txt");
$alln=$alla[0]+$donate;
$dateis=fopen("./rsty/donate/all.txt",'w');
  fputs($dateis,$alln);
fclose($dateis);
//
echo '
<?xml version="1.0" encoding="utf-8" ?>
<maniacode noconfirmation="1">
<show_message>
    <message>THANK YOU '.$nick.'</message>
</show_message>
</maniacode>
';
$dateis=fopen("./rsty/donate/lastd.txt",'w');
  fputs($dateis,$_GET['nickname']);
  fputs($dateis,"\n");
  fputs($dateis,$_GET['donate']);
fclose($dateis);
} else {
echo '
<?xml version="1.0" encoding="utf-8" ?>
<maniacode noconfirmation="1">
<show_message>
    <message>You are bad '.$nick.'!</message>
</show_message>
</maniacode>
';
}
//http://rsty.keksml.de/donatemc.php?playerlogin=luois&nickname=test&donate=11
?>