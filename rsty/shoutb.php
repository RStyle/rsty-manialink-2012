<?php
echo'
<frame scale="0.7" posn="54 0">
';
$shout=file('rsty/member/shoutbox.txt');
$ncc=explode(SECRET_CODE,$shout[0]);
if(!empty($_GET['shout'])&&!empty($_SESSION['nickname'])){
$shouttt=trim($_GET['shout']);
if(!empty($shouttt)){
$_GET['shout']=trim($_GET['shout']);
$old=file_get_contents('rsty/member/shoutbox.txt');
$new=str_replace("\n","",$_GET['shout']);
$new.= SECRET_CODE;
$new.=$_SESSION["nickname"].'$z';
$new.= SECRET_CODE;
$new.=$ncc[2]+1;
$new.="\n";
$new.=$old;
file_put_contents("rsty/member/shoutbox.txt",$new);
$ttta="bb";
}
}
$shout=file('rsty/member/shoutbox.txt');
$n=0;
$text=array();
$sn=0;
$bg=15;
for($i=24;$i>=$n;$i-=2){
$text[$i]=explode(SECRET_CODE,$shout[$sn]);
//<label style="TextCardSmallScores2" posn="-35 '.$i.' 3" sizen="71 3.2" halign="left" valign="center" text="'.$shout[$i].'test" />

echo '
<label style="TextCardSmallScores2" posn="-15 '.($i-$bg).' 9" sizen="8.5 3.2" halign="left" valign="center" text="'.$text[$i][1].'" />
<label style="TextCardSmallScores2" posn="-6 '.($i-$bg).' 9" sizen="20 3.2" halign="left" valign="center" text="'.$text[$i][0].'" />
';
$sn++;
}
$www=utf8_decode($_GET['write']);
echo '
<quad posn="0 -25 2.9" sizen="20 3.1" halign="center" valign="top" style="Bgs1InRace" substyle="BgWindow1" />
<quad posn="0 -3.5 2.9" sizen="30 30" halign="center" valign="center" style="Bgs1" substyle="BgList" />
<entry style="TextCardSmallScores2" posn="0 -25.1 10" sizen="19 3.2" halign="center" default="'.$www.'" name="shout" />
<label style="TextCardSmallScores2" posn="0 -23 3" sizen="12 3.2" halign="left" valign="center" text="'.$_SESSION['nickname'].'" />
<label style="CardButtonMedium" posn="2 -31 3" sizen="12 3.2" manialink="'.$ml.'?page=admin&amp;shout=shout" halign="center" valign="center" text="SHOUT" />
</frame>
';
//http://rsty.keksml.de/smily/fenster.bik
?>