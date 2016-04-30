<?php
$v=file(path.'/rsty/visitor.txt');
$va=count($v);
$va--;
$a0=explode("(,-,",$v[$va]);
$a1=explode("(,-,",$v[$va-1]);
$a2=explode("(,-,",$v[$va-2]);
$a3=explode("(,-,",$v[$va-3]);
$a4=explode("(,-,",$v[$va-4]);

if(($_GET['playerlogin']!="")&&($_GET['nickname']!="")&&($a0[0]!=$_GET['playerlogin']) && $_GET["playerlogin"]!="Nadeo" && $_GET["playerlogin"]!="xan"){
$oll=file_get_contents("rsty/visitor.txt");
$ini="\n";
$ini.=$_GET['playerlogin'];
$ini.="(,-,";
$ini.=$_GET['nickname'];
$oll=str_replace($ini,"",$oll);
$oll.=$ini;
file_put_contents("rsty/visitor.txt",$oll);
//

}

$b1=xmlspecialchars3($a0[1]);
$b2=xmlspecialchars3($a1[1]);
$b3=xmlspecialchars3($a2[1]);
$b4=xmlspecialchars3($a3[1]);
$b5=xmlspecialchars3($a4[1]);

$b1=xmlspecialchars2($b1);
$b2=xmlspecialchars2($b2);
$b3=xmlspecialchars2($b3);
$b4=xmlspecialchars2($b4);
$b5=xmlspecialchars2($b5);
echo '
<label posn="-55 44 11" sizen="18 3" style="TextRaceMessage" halign="center" valign="center">$o'.trim($_SESSION["Letzte Besucher"][$la]).' :$z</label>
<label posn="-55 40 11" sizen="15.5 2.6" halign="center" valign="center">'.$b1.'</label>
<label posn="-55 36 11" sizen="15.5 2.6" halign="center" valign="center">'.$b2.'</label>
<label posn="-55 33 11" sizen="15.5 2.6" halign="center" valign="center">'.$b3.'</label>
<label posn="-55 30 11" sizen="15.5 2.6" halign="center" valign="center">'.$b4.'</label>
<label posn="-55 27 11" sizen="15.5 2.6" halign="center" valign="center">'.$b5.'</label>
<quad posn="-68 45.5 10" sizen="26 20.5" bgcolor="FFFA" halign="left" valign="top" />
';//image="./style2/naf.png"
///style2/fenster.png  --  style="Bgs1" substyle="BgCardBuddy" 
//acekings(,-,$h[gtm]$o$s$w$00f?$0f0?C?$f1e?i?g?$00f?
?>