<?php
$setttings=sett("1");
$_GET["sta"]=trim($_GET["sta"]);
if($_GET["sta"]!=""){
$_SESSION["sta"]=$_GET["sta"];
}
//style="Bgs1InRace" substyle="BgWindow1"
$_SESSION["sta"]+=0;
//---infos
$zahl0 = "SELECT COUNT(*) FROM manializer_players WHERE login <> 'testlogin'";
$zahl2 = $mysqli->query($zahl0);
$zahl3 = $zahl2->fetch_array();
$zahl4 = $zahl3[0];
$zahll0 = "SELECT COUNT(*) FROM manializer_visits WHERE login <> 'testlogin'";
$zahll2 = $mysqli->query($zahll0);
$zahll3 = $zahll2->fetch_array();
$zahll4 = $zahll3[0];
$user0 = "SELECT * FROM Online LIMIT 6";
$user1=$mysqli->query($user0);
$besucher1=array();
while($user=$user1->fetch_array()){
$besucher1[]=str_replace($arrays1,$arrays2,$user["nick"]);
}
$anzahl1 = "SELECT SUM(summe) FROM donate";
$ann=$mysqli->query($anzahl1);
$ann2=$ann->fetch_array();
$anzahl=$ann2[0];
$best1 = "SELECT * FROM donate ORDER BY spende DESC LIMIT 6 ";
$best2 = $mysqli->query($best1);
$pp=-1;
$an=0;
$best_=array();
	while($now = $best2->fetch_array()){
if($now["spende"]>0){
$best_0[]=str_replace($arrays1,$arrays2,$now['nick']);
$best_1[]=$now['spende'];
}}
$summe   = "SELECT SUM(spende) FROM donate";
$alln=$mysqli->query($summe);
$alln2=$alln->fetch_array();
$all=$alln2[0];
$badn=file(path."donate/last.txt");
$bad=$badn[0];
$bad=str_replace("\n","",$bad);
$bad=str_replace($arrays1,$arrays2,$bad);
$anzahl1 = "SELECT SUM(summe) FROM donate";
$ann=$mysqli->query($anzahl1);
$ann2=$ann->fetch_array();
$anzahl=$ann2[0];
$bzahl = "SELECT COUNT(*) FROM donate WHERE login <> 'luois_fun_gaal' AND login <> 'testlogin'";
$bzahl2 = $mysqli->query($bzahl);
$bzahl3 = $bzahl2->fetch_array();
$bzahl4 = $bzahl3[0];
//-musik
$m_name=array();
$m_zahl=array();

$t="SELECT * FROM manializer_musik ORDER BY zahl DESC LIMIT 4 ;";
$t2=$mysqli->query($t);
while($in=$t2->fetch_array()){
$m_name[]=$in["name"];
$m_zahl[]=$in["zahl"];
}
//----infosend

if(!empty($setttings["set5"])){
echo '<quad posn="64 30 0.78" halign="right" sizen="40 62" image="'.fpath.'style2/new/fenster/'.$setttings["set5"].'" />';
}else{
echo '<quad posn="64 30 0.78" halign="right" sizen="40 62" image="'.fpath.'style2/new/fenster/green.png" />';
}
echo'
<label posn="47 16 1" halign="center" text="'.strtoupper(trim($_SESSION["statistik"][$la])).'" />
<quad posn="47 13.6 1" bgcolor="000D" halign="center" sizen="10 0.2" />
';
$array=array($_SESSION["Besucher"][$la],$_SESSION["Bester Spender"][$la],$_SESSION["Spenden Statistik"][$la],$_SESSION["Beliebteste Musik"][$la]);
$p=7;
$s=24;
if($_SESSION["sta"]=="15"){
//style="Bgs1InRace" substyle="BgWindow1"
echo '
<quad halign="center" posn="45.9 '.($p-11.9).' 1.8001" sizen="30.7 '.(12+2.9).'" style="Bgs1InRace" substyle="BgWindow1" />
';
}
for($i=0;$i<count($array);$i++){
if($_SESSION["sta"]!=$i){
echo'
<quad halign="center" posn="45.9 '.$p.' 1.79'.$i.'" sizen="30.7 '.(3+$s).'" style="Bgs1InRace" substyle="BgWindow1" />
<label style="TextCardInfoSmall" manialink="'.navi("page").'sta='.$i.'" halign="center" posn="45.9 '.($p-0.75).' 1.791" sizen="30.7 3" text="'.$array[$i].'" />
';
$p-=3;
$s-=3;
} else {
   switch(trim($_SESSION["sta"])) {
   	 case "0" :
	$text='
<label posn="'.(45.9-14).' '.($p-3.3).' 1.791" text="'.trim($_SESSION["klicks"][$la]).' : '.$zahll4.'" />
<label halign="right" posn="'.(45.9+14).' '.($p-3.3).' 1.791" text="'.trim($_SESSION["counter"][$la]).' : '.$zahl4.'" />
<label posn="'.(45.9-14).' '.($p-5.7).' 1.791" text="'.trim($_SESSION["besucher online"][$la]).' : '.$online.'" />
<label posn="'.(45.9-14.5).' '.($p-8.3).' 1.791" sizen="14.4 2" text="'.$besucher1[0].'" />
<label posn="'.(45.9+14.5).' '.($p-8.3).' 1.791" sizen="14.4 2" halign="right" text="'.$besucher1[1].'" />
<label posn="'.(45.9-14.5).' '.($p-10.7).' 1.791" sizen="14.4 2" text="'.$besucher1[2].'" />
<label posn="'.(45.9+14.5).' '.($p-10.7).' 1.791" sizen="14.4 2" halign="right" text="'.$besucher1[3].'" />
<label posn="'.(45.9-14.5).' '.($p-11.1).' 1.791" sizen="14.4 2" text="'.$besucher1[4].'" />
<label posn="'.(45.9+14.5).' '.($p-11.1).' 1.791" sizen="14.4 2" halign="right" text="'.$besucher1[5].'" />
';
	break;
	case "1" :
	$ii=3.2;
	$iip=2.9;
	$nnn=1.1;
	$en=2;
	$r=0;
	$m94=2.2;
	$ii2=1.05;
$text='
<label posn="'.(45.9-14).' '.($p-$ii-$ii2).' 2.792" sizen="18 4.6" valign="center" >'.$best_0[$r].'</label>
<label posn="'.(45.9+14).' '.($p-$ii-$ii2).' 2.792" sizen="36 4.6" halign="right" valign="center" >'.$best_1[$r].'         </label>
<quad posn="'.(45.9+14-$m94).' '.($p-$ii-$ii2).' 2.792" halign="center" sizen="'.(3-$r/$en+$nnn).' '.(3-$r/$en+$nnn).'" valign="center" style="Icons128x128_1" substyle="Coppers"/>
';
	$ii+=$iip;
	$r++;
$text.='
<label posn="'.(45.9-14).' '.($p-$ii-$ii2).' 2.792" sizen="18 4.6" valign="center" >'.$best_0[$r].'</label>
<label posn="'.(45.9+14).' '.($p-$ii-$ii2).' 2.792" sizen="36 4.6" halign="right" valign="center" >'.$best_1[$r].'         </label>
<quad posn="'.(45.9+14-$m94).' '.($p-$ii-$ii2).' 2.792" halign="center" sizen="'.(3-$r/$en+$nnn).' '.(3-$r/$en+$nnn).'" valign="center" style="Icons128x128_1" substyle="Coppers"/>
';
	$ii+=$iip;
	$r++;

$text.='
<label posn="'.(45.9-14).' '.($p-$ii-$ii2).' 2.792" sizen="18 4.6" valign="center" >'.$best_0[$r].'</label>
<label posn="'.(45.9+14).' '.($p-$ii-$ii2).' 2.792" sizen="36 4.6" halign="right" valign="center" >'.$best_1[$r].'         </label>
<quad posn="'.(45.9+14-$m94).' '.($p-$ii-$ii2).' 2.792" halign="center" sizen="'.(3-$r/$en+$nnn).' '.(3-$r/$en+$nnn).'" valign="center" style="Icons128x128_1" substyle="Coppers"/>
';
	$ii+=$iip;
	$r++;
$text.='
<label posn="'.(45.9-14).' '.($p-$ii-$ii2).' 2.792" sizen="18 4.6" valign="center" >'.$best_0[$r].'</label>
<label posn="'.(45.9+14).' '.($p-$ii-$ii2).' 2.792" sizen="36 4.6" halign="right" valign="center" >'.$best_1[$r].'         </label>
<quad posn="'.(45.9+14-$m94).' '.($p-$ii-$ii2).' 2.792" halign="center" sizen="'.(3-$r/$en+$nnn).' '.(3-$r/$en+$nnn).'" valign="center" style="Icons128x128_1" substyle="Coppers"/>
';
	$ii+=$iip;
	$r++;
$text.='
<label posn="'.(45.9-14).' '.($p-$ii-$ii2).' 2.792" sizen="18 4.6" valign="center" >'.$best_0[$r].'</label>
<label posn="'.(45.9+14).' '.($p-$ii-$ii2).' 2.792" sizen="36 4.6" halign="right" valign="center" >'.$best_1[$r].'         </label>
<quad posn="'.(45.9+14-$m94).' '.($p-$ii-$ii2).' 2.792" halign="center" sizen="'.(3-$r/$en+$nnn).' '.(3-$r/$en+$nnn).'" valign="center" style="Icons128x128_1" substyle="Coppers"/>
';
	break;
	case "2" :
	$mm=2.3;
	$text='
<label posn="'.(45.9-14).' '.($p-2.1).' 2" sizen="22 4.6" >'.trim($_SESSION["letzter spender"][$la]).' :</label>
<label posn="'.(45.9-14).' '.($p-7).' 3" sizen="16 4.6" halign="left" valign="center" >'.$bad.'$z</label>
<label posn="'.(45.9+11.5).' '.($p-7).' 3" sizen="16 4.6" halign="right" valign="center" >'.$badn[1].'</label>
<quad posn="'.(45.9+11.5).' '.($p-7).' 4" sizen="3 3" valign="center" style="Icons128x128_1" substyle="Coppers"/>

<label posn="'.(45.9-14).' '.($p-8.7-$mm).' 2" sizen="22 4.6" valign="center" >'.trim($_SESSION["summe spenden"][$la]).' :</label>
<label posn="'.(45.9+11.5).' '.($p-8.7-$mm).' 3" sizen="16 4.6" halign="right" valign="center" >'.$all.'$z</label>
<quad posn="'.(45.9+11.5).' '.($p-8.7-$mm).' 3" sizen="3 3" valign="center" style="Icons128x128_1" substyle="Coppers"/>

<label posn="'.(45.9-14).' '.($p-11.4-$mm).' 3" sizen="22 4.6" valign="center" >'.trim($_SESSION["anzahl spenden"][$la]).' :</label>
<label posn="'.(45.9+11.5).' '.($p-11.4-$mm).' 3" sizen="16 4.6" halign="right" valign="center" >'.$anzahl.'$z</label>
<quad posn="'.(45.9+11.5).' '.($p-11.4-$mm).' 3" sizen="3.4 3.4" valign="center" style="Icons128x128_1" substyle="MedalCount"/>

<label posn="'.(45.9-14).' '.($p-14.1-$mm).' 3" sizen="22 4.6" valign="center" >'.trim($_SESSION["anzahl spender"][$la]).' :</label>
<label posn="'.(45.9+11.5).' '.($p-14.1-$mm).' 3" sizen="16 4.6" halign="right" valign="center" >'.$bzahl4.'$z</label>
<quad posn="'.(45.9+11.5).' '.($p-14.1-$mm).' 3" sizen="3.4 3.4" valign="center" style="Icons128x128_1" substyle="Buddies"/>';
	break;
	case "3" :
	$text="";
	for($a=0;$a<4;$a++){
	$text.='
	<label textcolor="FFF" posn="'.(45.9-14).' '.($p-3-3*$a).' 2" sizen="22 4.6" >'.$m_name[$a].'</label>
    <label textcolor="FFF" posn="'.(45.9+13).' '.($p-3-3*$a).' 3" sizen="16 4.6" halign="right" >'.$m_zahl[$a].'$z</label>	
	';
	}
	$text.='
	<label posn="'.(45.9-14).' '.($p-3-12).' 2" sizen="11 4.6" >'.trim($_SESSION["name der musik"][$la]).'</label>
    <label posn="'.(45.9+14).' '.($p-3-12).' 3" sizen="13 4.6" halign="right" >'.ltrim($_SESSION["Wie oft gew&#228;hlt"][$la]).'</label>	
	';
	break;
   }
echo '
<quad halign="center" posn="45.9 '.$p.' 1.800003" sizen="30.7 '.(3+$s).'" style="Bgs1InRace" substyle="BgWindow1" />
<label style="TextCardInfoSmall" halign="center" posn="45.9 '.($p-0.3).' 1.791" sizen="30.7 3" text="'.$array[$i].'" />
'.$text.'
';
$p-=18.1;
$s-=18.1;
}
}
#$mysqli->close();
?>