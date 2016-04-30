<?php
echo'<frame posn="-14 0">';
include('rsty/shout.php');
#$mysqli= new mysqli("localhost" , "web10" , "", "usr_web10_1");
$abfrage="SELECT * FROM manializer_visits WHERE login = 'djkueken' ORDER BY id DESC";
$do1=$mysqli->query($abfrage);
$infos = $do1->fetch_array();
//echo'
//<quad halgin="center" valign="center" posn="-31 32" sizen="63.55 17" image="./style2/new/info/modl_share_bg_white.png" />
//<label manialink="dj" style="TextButtonSmall" text="SnowAnimation made by '.$infos["nick"].'" valign="center" posn="-15 32" sizen="40 17" />
//';
echo'
<quad halgin="center" valign="center" posn="-31 32" sizen="63.55 17" image="./style2/new/info/modl_share_bg_white.png" />
<label style="TextButtonSmall" text="RStyMatchGame cooming soon..." valign="center" posn="-15 32" sizen="40 17" />
';
$d=array();
$login1 = "SELECT * FROM donate WHERE login = '".$_SESSION["username"]."' ";
$login2 = $mysqli->query($login1);
$login3 = $login2->fetch_array();
echo'<frame posn="17.5 -36">';
if($login3["spende"]>=1){
echo'
<frame posn="-27 43">
<label textsize="3" posn="41 3.1 20" sizen="13 4.6" valign="center" >'.trim($_SESSION["du hast gespendet"][$la]).' :</label>
   <label textsize="3" posn="65 3.1 20"  sizen="14 4.6" halign="left" valign="center" >'.$login3["spende"].'</label>
<quad posn="69 3.1 20" sizen="3 3" halign="right" valign="center" style="Icons128x128_1" substyle="Coppers"/>
';
} else {
echo'
<frame posn="-27 43">
<label textsize="3" posn="41 3.1 20"  sizen="16.5 4.6" valign="center" >'.trim($_SESSION["du hast gespendet"][$la]).' :</label>
   <label textsize="3" posn="65 3.1 20"  sizen="14 4.6" halign="right" valign="center" >???</label>
<quad posn="69 3.1 20" sizen="3 3" halign="right" valign="center" style="Icons128x128_1" substyle="Custom"/>
';
}
echo'
</frame>
</frame>
';
#$mysqli->close();
?>