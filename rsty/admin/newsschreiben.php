<?php
if($_GET["action"]!="delete"){
$tt=date(j);
$monat=date(n);
echo '
<frame posn="0 10 0">

<quad posn="0 8 10" sizen="38 40" style="Bgs1" substyle="BgCardBuddy" halign="center" />
<entry posn="0 5 12" style="TextCardSmallScores2" name="titel" sizen="14 3" default="';if($_GET["action"]==""){echo'Titel';}else{ 
$story_p=$_GET['story'];
$story_t=file("./rsty/news/{$story_p}.txt");
echo trim(utf8_decode(str_replace("\\n\\","\n",$story_t[0+0])));
 } echo'"  halign="center" valign="center" />
<quad posn="0 5 12" sizen="14.4 3.4" halign="center" valign="center" style="Bgs1InRace" substyle="BgWindow1" />
<entry posn="0 -3 12" style="TextCardSmallScores2" name="date" sizen="10 3" default="';if($_GET["action"]==""){echo''.$tt.'.'.$monat.'';}else{ echo $_GET["story"];}echo'" halign="center" valign="center" />
<quad posn="0 -3 12" sizen="10.4 3.4" halign="center" valign="center" style="Bgs1InRace" substyle="BgWindow1" />
<entry posn="0 -10.5 12" style="TextCardSmallScores2" name="eintrag" sizen="30 14" autonewline="1" default="';if($_GET['action']=="edit"){echo utf8_decode(str_replace("\\n\\","\n",$story_t[1+0]));}echo'"  halign="center" />
<quad posn="0 -10 12" sizen="30.5 15.5" halign="center" style="Bgs1InRace" substyle="BgWindow1" />

<label posn="0 -28 10" style="TextCardSmallScores2" manialink="'.$ml.'?page=admin&amp;site=newsschreiben&amp;write=titel&amp;subwrite=eintrag&amp;datum=date" sizen="13 2.5" text="$F00$oNEWS SCHREIBEN$z" halign="center" valign="center" />
</frame>
';
if($_GET["datum"]!=""){
$da=explode(".",$_GET["datum"]);
$d1=utf8_decode($da[1+0]);
$y1=2010;
echo'
<label posn="0 -23 10" style="TextCardSmallScores2" manialink="'.$ml.'?page=news&amp;date='.$d1.'&amp;y='.$y1.'" sizen="13 2.5" text="$F00$o!Gehe zu der News Seite!$z" halign="center" valign="center" />
';
}
if($_GET['write']!=""&&$_GET['datum']!=""){
$datum=$_GET['datum'];
$sw=str_replace("\n",'\\n\\',$_GET["subwrite"]);
$_GET['write']=str_replace("\n","\\n\\",$_GET['write']);
$dateis=fopen("./rsty/news/$datum.txt","w");
  fputs($dateis,$_GET['write']);
  fputs($dateis,"\n");
  fputs($dateis,$sw);
fclose($dateis);
chmod("./rsty/news/$datum.txt",0777);
}
} else {
$story_p=$_GET['story'];
unlink("./rsty/news/{$story_p}.txt");
$da=explode(".",$_GET["datum"]);
$d1=utf8_decode($da[1+0]);
$y1=2010;
echo'
<label posn="0 -23 10" style="TextCardSmallScores2" manialink="'.$ml.'?page=news&amp;date='.$d1.'&amp;y='.$y1.'" sizen="13 2.5" text="$F00$o!Gehe zu der News Seite!$z" halign="center" valign="center" />
';
}
?>