<?php
ob_start();
session_start();
define('path', '/var/www/virtual/rstyle.mania-server.net/htdocs/2010_HD/', true);
define('fpath', 'http://rstyle.paragon-esports.com/2010_HD/', true);
header('Content-type: application/xml');

    function xmlspecialchars2($a){
  $myxml=array("&","'","<",">",'"',"Ä","Ö","Ü","ä","ö","ü","ß");
  $myxml2=array("&amp;","&apos;","&lt;","&gt;","&quot;","&#196;","&#214;","&#220;","&#228;","&#246;","&#252;","&#223;");
  $ausgabe=str_replace($myxml,$myxml2,$a);
  $ausgabe=str_replace("Neür","Neuer",$ausgabe);
  $ausgabe=str_replace("NEÜR","NEUER",$ausgabe);
  return $ausgabe;
  }

if($_GET['play']!=""){
$_SESSION["play"]=$_GET['play'];
$play='<label posn="-32 47 40" text="MUSIK ZU '.$_SESSION['play'].' GEWECHSELT!" />';
}
echo "<?xml version='1.0' encoding='utf-8' ?>\n <manialink>  <timeout>0</timeout>";
echo $play;
if(file_exists("../".$_SESSION["play"]."") && $_SESSION["play"]!=""){
$play=fpath.$_SESSION["play"];
echo'<music data="'.$play.'" /><label posn="-32 43 40" text="MUSIK : ../'.$_SESSION['play'].'" />';
}else{//http://rsty.keksml.de/music/
$play=fpath.$_SESSION["play"];
echo'<music data="'.$play.'" /><label posn="-32 43 40" text="MUSIK : ../music/'.$_SESSION['play'].'" />';
}
//<music data="../music/" />
$lange="";
if($_GET["time"]==""){
$zone="
  <label posn=\"12 29 2\" sizen=\"16 2\" style=\"TextScoresSmall2Rank\" text=\"MANILINKS!\" />
  <quad posn=\"2 32 1.75\" sizen=\"8 8\" style=\"Icons128x128_1\" substyle=\"ManiaZones\" />
  ";
} else {
$zone="
  <label posn=\"12 29 2\" sizen=\"16 2\" style=\"TextScoresSmall2Rank\" text=\"STUNDEN!\" />
  <quad posn=\"2 32 1.75\" sizen=\"8 8\" style=\"BgRaceScore2\" substyle=\"ScoreReplay\" />
  ";
}
require "config.php";

$zone.="
  <quad posn=\"0 32 1.5\" sizen=\"32 8\" style=\"Bgs1\" substyle=\"BgListLine\" />
  <quad posn=\"0 32 1\" sizen=\"32 96\" style=\"Bgs1\" substyle=\"BgTitle3\" />
  <label posn=\"2 -61 2\" sizen=\"16 2\" style=\"CardButtonSmall\" text=\"Close\" manialink=\"".$mlzadmin."/admin.manializer.php\" />
";

$startpos = 3;
$startpos2 = 3;
$graph = "";
$sql = mysql_query("SELECT id,daynum,num_visits,date FROM manializer_days ORDER by `id` DESC LIMIT 13");
$hoch = 0;
$hochValue = 0;
function hoch($a, $b){
  global $hoch, $hochValue;
  if($b>$hochValue){
    $hoch=$a;
    $hochValue = $b;
  }
}
$zeit1=array();
$zeit2=array();
while($row = mysql_fetch_array($sql)) {
  if($row["daynum"]+0>=10){
    $daymy=$row["daynum"];
  } else {
    $daymy=$row["daynum"][1];
  }
  $mydate=explode(".",$row["date"]);
  if($mydate[0]+0 < 10){
    $mydate[0]=$mydate[0][1]+0;
  }//---...
  $row2=array();
  if($mysql=mysql_query("SELECT SUM(zeit) FROM manializer_zeit WHERE tag = '".$daymy."' AND monat = '".$mydate[0]."' AND jahr = '20".$mydate[1]."' ")){
    $row2 = mysql_fetch_array($mysql);
    $besucher=$row2[0];
    $size = $row['num_visits'] / 2;
    $ypos = 40 - $size;
    $pthisp=0;
    if($besucher<100){
      $size=$besucher*3/10+0;
      hoch($size,$besucher);
      $graph .= "  <quad posn=\"-".$startpos.".5 -40 1.75\" halign=\"center\" valign=\"bottom\" sizen=\"3 ".$size."\" bgcolor=\"F00F\" />\n";
      $graph .= "  <label posn=\"-".($startpos2-$pthisp).".5 -8 2\" halign=\"center\" sizen=\"4 2\" style=\"TextScoresSmall2Rank\" text=\"\$F00".$besucher."\" />\n";
    } elseif($besucher<1000){
      $size=$besucher*3/100+0;
      hoch($size, $besucher);
      $graph .= "  <quad posn=\"-".$startpos.".5 -40 1.75\" halign=\"center\" valign=\"bottom\" sizen=\"3 ".$size."\" bgcolor=\"00FF\" />\n";
      $graph .= "  <label posn=\"-".($startpos2-$pthisp).".5 -8 2\" halign=\"center\" sizen=\"4 2\" style=\"TextScoresSmall2Rank\" text=\"\$00F".$besucher."\" />\n";
    } elseif($besucher<10000){
      $size=$besucher*3/1000+0;
      hoch($size, $besucher);
      $graph .= "  <quad posn=\"-".$startpos.".5 -40 1.75\" halign=\"center\" valign=\"bottom\" sizen=\"3 ".$size."\" bgcolor=\"000F\" />\n";
      $graph .= "  <label posn=\"-".($startpos2-$pthisp).".5 -8 2\" halign=\"center\" sizen=\"4 2\" style=\"TextScoresSmall2Rank\" text=\"\$000".$besucher."\" />\n";
    } else {
      $size=$besucher*3/10000+0;
      hoch($size, $besucher);
      $graph .= "  <quad posn=\"-".$startpos.".5 -40 1.75\" halign=\"center\" valign=\"bottom\" sizen=\"3 ".$size."\" bgcolor=\"000F\" />\n";
      $graph .= "  <label posn=\"-".($startpos2-$pthisp).".5 -8 2\" halign=\"center\" sizen=\"4 2\" style=\"TextScoresSmall2Rank\" text=\"\$000".$besucher."\" />\n";
    }
    $zeit1[]=$besucher;
    $zeit2[]=$daymy.".".$mydate[0].".20".$mydate[1];
  }
  $size = $row['num_visits'] / 2;
  $ypos = 40 - $size;
  $rndcol = rand(111,999);
  $graph .= "  <quad posn=\"-".$startpos.".5 -".$ypos." 2.75\" sizen=\"2 ".$size."\" halign=\"center\" bgcolor=\"09FF\" />\n";
  $graph .= "  <label posn=\"-".$startpos.".5 -41 2\" sizen=\"3 2\" style=\"TextScoresSmall2Rank\" halign=\"center\" text=\"".$row['num_visits']."\" />\n";
  $graph .= "  <label posn=\"-".$startpos2.".5 -12 2\" sizen=\"4 2\" style=\"TextScoresSmall2Rank\" halign=\"center\" text=\"\$09F".$row['daynum'].".".$row['date']."\" />\n";
  $startpos = $startpos + 5;
  $startpos2 = $startpos2 + 5;
}
$graph .= ("  <label posn=\"-54 -3 2\" sizen=\"16 2\" style=\"TextScoresSmall2Rank\" text=\"Last days\" />
  <quad posn=\"-64 0 1.75\" sizen=\"8 8\" style=\"Icons64x64_1\" substyle=\"IconPlayers\" />");
$sql2 = mysql_query("SELECT id,daynum,num_visits,date FROM manializer_days ORDER by `num_visits` DESC LIMIT 1");
$best = mysql_num_rows($sql2);
while($row2 = mysql_fetch_array($sql2)) {
$size = $row2['num_visits'] / 2;
}
$ypos = 40 - $size;
$graph .= "   <quad posn=\"-64 -".$ypos." 3\" sizen=\"64 0.25\" style=\"Bgs1\" substyle=\"BgWindow1\" />
<quad posn=\"-64 ".(-40+$hoch)." 2\" sizen=\"64 0.25\" bgcolor=\"FFFF\" />";

$startpos = 12;
$players = "";
$sql = mysql_query("SELECT * FROM manializer_visits ORDER by `id` DESC LIMIT 12");
$sql2 = mysql_query("SELECT * FROM manializer_zeit ORDER by `id` DESC LIMIT 12");
while($row = mysql_fetch_array($sql)) {
  $row2 = mysql_fetch_array($sql2);
  $ypos = 40 - $row['num_visits'];
  $nick = str_replace("\$000", "\$888", $row['nick']);// 	$h[b@]$i$o$08fB$ffflack$h$h[d4y]$08f×±$111Ò“Ñ
  $nick = str_replace('$h[', '-------mmmm---$yhyy-------mmmm---', $nick);
  $nick = str_replace('[', '[$h', $nick);
  $nick = str_replace('-------mmmm---','[',$nick);
  $nick = str_replace(']', ']LINK$yhyy]', $nick);
  $nick = str_replace("\$h", 	'$i$i', $nick);
  $nick = str_replace('$yhyy', '$h', $nick);
  $nick = str_replace("\$l", "", $nick);
  $nick = str_replace("&", "&amp;", $nick);
  $time_=explode(".",$row["date"]);
  $players .= "
  <label posn=\"4 -".$startpos." 2\" sizen=\"20 2\" style=\"TextScoresSmall2Rank\" text=\"".xmlspecialchars2($nick)."\" manialink=\"".$mlzadmin."/admin.manializer.php?login=".$row['login']."&amp;zeitID=".$row2["id"]."&amp;visitsID=".$row["id"]."\" />\n
  <label posn=\"24.2 -".$startpos." 2\" sizen=\"20 2\" style=\"TextScoresSmall2Rank\" text=\"".$time_[0].".".$time_[1]."\" />\n
  ";
  $startpos = $startpos + 3;
}
$players .= ("  <label posn=\"12 -3 2\" sizen=\"16 2\" style=\"TextScoresSmall2Rank\" text=\"Last visits\" />
  <quad posn=\"2 0 1.75\" sizen=\"8 8\" style=\"Icons128x128_1\" substyle=\"Buddies\" />");

$sql2 = mysql_query("SELECT * FROM manializer_visits");
$sql3 = mysql_query("SELECT * FROM manializer_days");
$sql4 = mysql_query("SELECT * FROM manializer_players");


$total = mysql_num_rows($sql2);
$days = mysql_num_rows($sql3);
$players2 = mysql_num_rows($sql4);
$sql = mysql_query("SELECT * FROM manializer_main LIMIT 1");
while($row = mysql_fetch_array($sql)) {
$linkurl=$row['lizesurl'];
$boss = "  <label posn=\"-62 35 2\" sizen=\"64 2\" style=\"TextScoresSmall2Rank\" text=\"Started for : ".$row['bossnick']."\" />\n";
$boss .= "  <label posn=\"-62 32 2\" sizen=\"64 2\" style=\"TextScoresSmall2Rank\" text=\"Running at : \$h[".$row['lizesurl']."]".$row['lizestitle']."\$h\" />\n";
$boss .= "  <label posn=\"-62 29 2\" sizen=\"64 2\" style=\"TextScoresSmall2Rank\" text=\"Started at  : ".$row['starttime']."\" />\n";
$boss .= "  <label posn=\"-62 26 2\" sizen=\"64 2\" style=\"TextScoresSmall2Rank\" text=\"Total visits : ".$total."\" />\n";
$boss .= "  <label posn=\"-62 23 2\" sizen=\"64 2\" style=\"TextScoresSmall2Rank\" text=\"Recorded days : ".$days."\" />\n";
$boss .= "  <label posn=\"-62 20 2\" sizen=\"64 2\" style=\"TextScoresSmall2Rank\" text=\"Players who have seen ".$row['lizestitle']."\$z : ".$players2."\" />\n";
$lol=$row['lizestitle'];
}
    $sql = "SELECT
                COUNT(*) as Anzahl
            FROM
                Online
			WHERE
                DATE_SUB(NOW(), INTERVAL 2 MINUTE) < Datum";   
   $result = mysql_query($sql);
    $row = mysql_fetch_assoc($result);
    echo "
	<label posn=\"-62.2 16 5\" sizen=\"64 2\" style=\"TextScoresSmall2Rank\">User Online auf ".$lol." :  ".($row['Anzahl']+0)."</label>
	";

$jukebox='';
if(trim($_GET["jukebox"])=="manian" or $_GET["jukebox"]=="m"){
	$oldch=getcwd();
	$bv="../manian/";
	$horns=array();
	$verzeichnis=opendir($bv);
	// ORDER BY 'anzahl' DESC ;
	$startpos = 23;
	$musik_array=array(".wav",".ogg",".mux");
	while($datei = readdir($verzeichnis)){
		if(preg_match("/\.ogg$/", $datei) || preg_match("/\.mux$/", $datei) || preg_match("/\.wav$/", $datei) || preg_match("/\.wave$/", $datei)) {
			$jukebox.='<label posn="'.(0.5).' '.$startpos.' 35" sizen="27.4 2" style="TextScoresSmall2Rank" manialink="r2r:admin:m?play=manian/'.$datei.'" text="'.str_replace($musik_array,"",$datei).'" />';

			$startpos-=3.41;	
		}
	}
}elseif($_GET["jukebox"]!=""){
$jukebox='';
$oldch=getcwd();
	$bv="../music/";
$horns=array();
$verzeichnis=opendir($bv);
// ORDER BY 'anzahl' DESC ;
$startpos = 23;
$musik_array=array(".wav",".ogg",".mux");
while($datei = readdir($verzeichnis)){
if(preg_match("/\.ogg$/", $datei) || preg_match("/\.mux$/", $datei) || preg_match("/\.wav$/", $datei) || preg_match("/\.wave$/", $datei)) {
$jukebox.='<label posn="'.(0.5+0).' '.$startpos.' 35" sizen="27.4 2" style="TextScoresSmall2Rank" manialink="r2r:admin:m?play='.$datei.'" text="'.str_replace($musik_array,"",$datei).'" />';

$startpos-=3.41;	
}
}
}
	
if($_GET["musik"]!=""){
$musik="";
$oldch=getcwd();
	$bv="../music/";
$horns=array();
$verzeichnis=opendir($bv);
// ORDER BY 'anzahl' DESC ;
$startpos = 23;
$musik_array=array(".wav",".ogg",".mux");
$leer=array();
while($datei = readdir($verzeichnis)){
if(preg_match("/\.ogg$/", $datei) || preg_match("/\.mux$/", $datei) || preg_match("/\.wav$/", $datei) || preg_match("/\.wave$/", $datei)) {
$t="SELECT * FROM manializer_musik WHERE name LIKE '%".mysql_real_escape_string($datei)."%' ;";
if($sql = mysql_query($t)){
$row=mysql_fetch_array($sql);

	$musik.='<label posn="'.(0.5).' '.$startpos.' 35" sizen="17.4 2" style="TextScoresSmall2Rank" text="'.str_replace($musik_array,"",$datei).'" />';
	$besucher=$row['zahl'];
	$p=20;
if($besucher<=10){
$musik.='<quad posn="'.$p.' '.$startpos.' 22.9" bgcolor="00F" sizen="'.($besucher/1).' 2" />';
} elseif($besucher<=100){
$musik.='<quad posn="'.$p.' '.$startpos.' 22.9" bgcolor="0F0" sizen="'.($besucher/10).' 2" />';
} elseif($besucher<=1000){
$musik.='<quad posn="'.$p.' '.$startpos.' 22.9" bgcolor="F00" sizen="'.($besucher/100).' 2" />';
}
$musik.='<label posn="22 '.$startpos.' 23.9" bgcolor="F00" text="'.$row['zahl'].'" />';
	$startpos-=3.41;	
	
}

}
}
	
	
	
	
	
	}
	if($_GET["lange"] != ""){
	$c=count($zeit2);
	$c--;
	$startpos = 23;
	for($i=0;$i<=$c;$i++){
	$lange.='<label posn="'.(0+11).' '.$startpos.' 15" halign="right" sizen="10 2" style="TextScoresSmall2Rank" text="$o'.$zeit2[$i].'" />';
	if($zeit1[$i] == "")
		$zeit1[$i] = 0;
	$besucher=$zeit1[$i];
	$p=12;
if($besucher<10){
$lange.='<quad posn="'.$p.' '.$startpos.' 2.9" bgcolor="00F" sizen="'.($besucher/1*2).' 2" />';
} elseif($besucher<100){
$lange.='<quad posn="'.$p.' '.$startpos.' 2.9" bgcolor="0F0" sizen="'.($besucher/10*2).' 2" />';
} elseif($besucher<1000){
$lange.='<quad posn="'.$p.' '.$startpos.' 2.9" bgcolor="F00" sizen="'.($besucher/100*2).' 2" />';
} elseif($besucher<10000){
$lange.='<quad posn="'.$p.' '.$startpos.' 2.9" bgcolor="FFF" sizen="'.($besucher/1000*2).' 2" />';
}
$lange.='<label posn="12 '.$startpos.' 3.9" bgcolor="F00" text="'.$zeit1[$i].' sec" />';
	$startpos-=3.41;	
	
	}
	
	}


	//----------------------------------------------------------
if($_GET["time"]!=""){
$all=array();
$sql = mysql_query("SELECT * FROM manializer_stunde ORDER BY 'anzahl' DESC ;");
while($row = mysql_fetch_array($sql)) {
$startpos = 20-3.3*$row["time"];
if($row["time"]!=date("G")){
$zone.='
<label posn="0 '.$startpos.' 5" sizen="10 2" style="TextScoresSmall2Rank" text="$00F'.$row["time"].'" />
'; } else {
$zone.='
<label posn="0 '.$startpos.' 5" sizen="10 2" style="TextScoresSmall2Rank" text="$F00$o'.$row["time"].'" />
';
}
$besucher=$row["anzahl"];
if($besucher<10){
$zone.='<quad posn="10 '.$startpos.' 4.9" bgcolor="0F0" sizen="'.$besucher.' 2" />';
} elseif($besucher<100){
$zone.='<quad posn="10 '.$startpos.' 4.9" bgcolor="00F" sizen="'.($besucher/10).' 2" />';
} elseif($besucher<1000){
$zone.='<quad posn="10 '.$startpos.' 4.9" bgcolor="F00" sizen="'.($besucher/100).' 2" />';
}
$all[$row["time"]]=1;
$zone.='
<label posn="'.(10+$besucher/10/2).' '.$startpos.' 6" text="'.($besucher/10*10).'" />
';
}
for($i=0;$i<24;$i++){
if($all[$i]!=1){
$startpos = 20-3.3*$i;
$zone.='
<label posn="0 '.$startpos.' 5" sizen="10 2" style="TextScoresSmall2Rank" text="$i'.$i.'" />
';
}
}
}
//.........------........
if($_GET["adresse"]!=""){
$startpos = 23;
if($_GET["adresse"]==='true'){
$sql = mysql_query("SELECT * FROM manializer_adresse WHERE `name` IS NOT NULL ORDER BY besucher ;");
while($row = mysql_fetch_array($sql)) {
$zone.='
<label posn="0 '.$startpos.' 2" sizen="10 2" style="TextScoresSmall2Rank" text="'.$row["name"].'" manialink="'.$mlzadmin.'/admin.manializer.php?adresse='.$row["name"].'" />
';
$besucher=$row["besucher"];
if($besucher<10){
$zone.='<quad posn="10 '.$startpos.' 1.9" bgcolor="0F0" sizen="'.($row["besucher"]/1).' 2" />';
} elseif($besucher<100){
$zone.='<quad posn="10 '.$startpos.' 1.9" bgcolor="00F" sizen="'.($row["besucher"]/10).' 2" />';
} elseif($besucher<1000){
$zone.='<quad posn="10 '.$startpos.' 1.9" bgcolor="F00" sizen="'.($row["besucher"]/10).' 2" />';
}

$zone.='
<label posn="'.(10+$row["besucher"]/10/2).' '.$startpos.' 3" text="'.($row["besucher"]/10*10).'" />
';
$startpos-=3.3;
}
} else {
$sql = mysql_query("SELECT * FROM manializer_adresse WHERE name = '".$_GET["adresse"]."' ");
$startpos = 23;
$row = mysql_fetch_array($sql);
$besucher=$row["besucher"];
$zone.='
<label posn="15 '.$startpos.' 2" sizen="10 2" halign="center" style="TextScoresSmall2Rank" text="'.$row["name"].'" />
';
$nt=4;
if($besucher<10){
$zone.='<quad posn="15 '.($startpos-$nt).' 1.9" halign="center" bgcolor="0F0" sizen="2 '.($row["besucher"]/1).'" />';
} elseif($besucher<100){
$zone.='<quad posn="15 '.($startpos-$nt).' 1.9" halign="center" bgcolor="00F" sizen="3 '.($row["besucher"]/10).'" />';
} elseif($besucher<1000){
$zone.='<quad posn="15 '.($startpos-$nt).' 1.9" halign="center" bgcolor="F00" sizen="4 '.($row["besucher"]/10).'" />';
}

$zone.='
<label posn="15 '.($startpos-6).' 2" textsize="9" sizen="10 2" halign="center" style="TextScoresSmall2Rank" text="'.$besucher.'" />
';
//'.$row["besucher"].'
}
}
  function reload(){
  $ll=0;
  global $_GET;
  $ausgabe="r2r:admin:m";
  foreach($_GET as $key => $value) {
  if($ll==1){ $ausgabe.='&amp;'; } else { $ausgabe.='?'; }
    $ausgabe.=$key.'='.$value;
	$ll=1;
  }
  return $ausgabe;
  }
if($_GET["zone"] != ""){
	$startpos = 23;
	$zone = "";
	$sql = mysql_query("SELECT * FROM manializer_players");
  $countries = array();
	while($zeile = mysql_fetch_array($sql)) {
		$living = explode("|", $zeile['path']);
		$lving = $living[1];
        if(!empty($countries[$lving]))
            $countries[$lving] = $countries[$lving] + 1;
        else
            $countries[$lving] = 1;
	}
    $data = array(array(), array());
    foreach($countries as $countrie => $visits){
        $data[0][] = $countrie;
        $data[1][] = $visits;
    }
    array_multisort($data[1], SORT_DESC, $data[0], SORT_DESC);
    $i = 0;
    foreach($data[0] as $countrie){
	   $zone .= "  <label posn=\"4 ".$startpos." 2\" sizen=\"20 2\" style=\"TextScoresSmall2Rank\" text=\"".$countrie." (".$data[1][$i].")\" />\n";
	   $startpos = $startpos - 3;
       $i++;
    }
	$zone .= ("  <quad posn=\"0 32 1.5\" sizen=\"32 8\" style=\"Bgs1\" substyle=\"BgListLine\" />
	  <quad posn=\"0 32 1\" sizen=\"32 96\" style=\"Bgs1\" substyle=\"BgTitle3\" />
	  <label posn=\"12 29 2\" sizen=\"16 2\" style=\"TextScoresSmall2Rank\" text=\"Countries\" />
	  <quad posn=\"2 32 1.75\" sizen=\"8 8\" style=\"Icons128x128_1\" substyle=\"ManiaZones\" />
	  <label posn=\"2 -61 2\" sizen=\"16 2\" style=\"CardButtonSmall\" text=\"Close\" manialink=\"".$mlzadmin."/admin.manializer.php\" />");
	mysql_query("TRUNCATE `manializer_temp`");
}
$h=40;
// style=\"BgRaceScore2\" substyle=\"ScoreReplay\"
$ten=8;
//manialink=\"".$mlzadmin."/admin.manializer.php?jukebox=true\"
$t2=9.5;
$other = ("  <label posn=\"44 ".(-3+$h+$ten)." 2\" sizen=\"16 2\" style=\"TextScoresSmall2Rank\" text=\"Other features\" />
  <quad posn=\"34 ".(0+$h+$ten)." 1.85\" sizen=\"8 8\" style=\"Icons128x128_1\" substyle=\"Custom\" />
  <quad posn=\"32 ".($h+$ten)." 1.6\" sizen=\"32 8\" style=\"Bgs1\" substyle=\"BgButtonBig\" />

  
  <label posn=\"44 ".(27+3+$t2)." 2\" sizen=\"20 4\" style=\"TextScoresSmall2Rank\" text=\"-!JUKE BOX!-\" />
    <label posn=\"43 ".(27+0+$t2)." 2\" sizen=\"20 4\" text=\"\$222MANIAN*\"  style=\"TextCardInfoSmall\" manialink=\"".$mlzadmin."/admin.manializer.php?jukebox=manian\" />
	  <label posn=\"53 ".(27+0+$t2)." 2\" sizen=\"20 4\" text=\"\$222*NORMAL\"  style=\"TextCardInfoSmall\" manialink=\"".$mlzadmin."/admin.manializer.php?jukebox=true\" />
  <quad posn=\"34 ".(30+$t2)." 1.75\" sizen=\"8 8\" image=\"".fpath."style2/music1.png\" imagefocus=\"".fpath."style2/music2.png\" action=\"1\"/>
  <quad posn=\"32 ".(30+$t2)." 1.6\" sizen=\"32 8\" style=\"Bgs1\" substyle=\"BgButtonBig\"  />
  
  <label posn=\"44 ".(27+0)." 2\" sizen=\"20 4\" style=\"TextScoresSmall2Rank\" text=\"Beliebteste Musik?\" />
  <quad posn=\"34 30 1.75\" sizen=\"8 8\" style=\"Icons64x64_1\" substyle=\"Music\" />
  <quad posn=\"32 30 1.6\" sizen=\"32 8\" style=\"Bgs1\" substyle=\"BgButtonBig\" manialink=\"".$mlzadmin."/admin.manializer.php?musik=true\" />

  <label posn=\"44 ".(17+1)." 2\" sizen=\"20 4\" style=\"TextScoresSmall2Rank\" text=\"Wie lange sind die\n Leute auf ".str_replace("- ManiaLink","",$lol)." ?\" valign=\"center\" />
  <quad posn=\"34 20 1.75\" sizen=\"8 8\" style=\"Icons128x32_1\" substyle=\"RT_TimeAttack\" />
  <quad posn=\"32 20 1.6\" sizen=\"32 8\" style=\"Bgs1\" substyle=\"BgButtonBig\" manialink=\"".$mlzadmin."/admin.manializer.php?lange=true\" />
  
  <label posn=\"44 ".(7-1)." 2\" sizen=\"20 4\" style=\"TextScoresSmall2Rank\" autonewline=\"1\" text=\"Von welchen ML kommen die Leute?\" valign=\"center\" />
  <quad posn=\"34 10 1.75\" sizen=\"8 8\" style=\"Icons128x128_1\" substyle=\"ManiaZones\" />
  <quad posn=\"32 10 1.6\" sizen=\"32 8\" style=\"Bgs1\" substyle=\"BgButtonBig\" manialink=\"".$mlzadmin."/admin.manializer.php?adresse=true\" />
  
  <label posn=\"44 -1.5 2\" sizen=\"20 4\" style=\"TextScoresSmall2Rank\" autonewline=\"1\" text=\"Die besten Uhrzeiten!\" />
  <quad posn=\"34 0 1.75\" sizen=\"8 8\" style=\"BgRaceScore2\" substyle=\"ScoreReplay\" />
  <quad posn=\"32 0 1.6\" sizen=\"32 8\" style=\"Bgs1\" substyle=\"BgButtonBig\" manialink=\"".$mlzadmin."/admin.manializer.php?time=true\" />
  
  <label posn=\"44 -11.5 2\" sizen=\"16 4\" style=\"TextScoresSmall2Rank\" autonewline=\"1\" text=\"Wo leben die Leute?\" />
  <quad posn=\"34 -10 1.75\" sizen=\"8 8\" style=\"Icons128x128_1\" substyle=\"ManiaZones\" />
  <quad posn=\"32 -10 1.6\" sizen=\"32 8\" style=\"Bgs1\" substyle=\"BgButtonBig\" manialink=\"".$mlzadmin."/admin.manializer.php?zone=1\" />

  <label posn=\"44 -23 2\" sizen=\"16 4\" style=\"TextScoresSmall2Rank\" autonewline=\"1\" text=\"Login-Suche\" />
  <quad posn=\"34 -20 1.75\" sizen=\"8 8\" style=\"Icons64x64_1\" substyle=\"Maximize\" />
  <quad posn=\"32 -20 1.6\" sizen=\"32 8\" style=\"Bgs1\" substyle=\"BgButtonBig\" manialink=\"".$mlzadmin."/admin.manializer.php?search=1\" />

  <label posn=\"44 -33 2\" sizen=\"16 4\" style=\"TextScoresSmall2Rank\" autonewline=\"1\" text=\"Refresh\" />
  <quad posn=\"34 -30 1.75\" sizen=\"8 8\" style=\"Icons64x64_1\" substyle=\"Refresh\" />
  <quad posn=\"32 -30 1.6\" sizen=\"32 8\" style=\"Bgs1\" substyle=\"BgButtonBig\" manialink=\"".trim(reload(),"")."\" />
  
  <label posn=\"44 -43 2\" sizen=\"16 4\" style=\"TextScoresSmall2Rank\" autonewline=\"1\" text=\"Zurück\" />
  <quad posn=\"34 -40 1.75\" sizen=\"8 8\" style=\"Icons128x128_1\" substyle=\"Back\" />
  <quad posn=\"32 -40 1.6\" sizen=\"32 8\" style=\"Bgs1\" substyle=\"BgButtonBig\" manialink=\"".$linkurl."\" />");
$search = ("  <quad posn=\"0 0 1.5\" sizen=\"32 8\" style=\"Bgs1\" substyle=\"BgListLine\" />
  <quad posn=\"0 0 1\" sizen=\"32 48\" style=\"Bgs1\" substyle=\"BgTitle3\" />
  <label posn=\"12 -3 2\" sizen=\"16 2\" style=\"TextScoresSmall2Rank\" text=\"Login-search\" />
  <quad posn=\"2 0 1.75\" sizen=\"8 8\" style=\"Icons64x64_1\" substyle=\"Maximize\" />
  <label posn=\"2 -13 2\" sizen=\"16 2\" style=\"TextScoresSmall2Rank\" text=\"Enter a tm-login:\" />
  <entry posn=\"2 -16 2\" sizen=\"28 2\" style=\"TextScoresSmall2Rank\" name=\"login\" default=\"\" />
  <label posn=\"2 -23 2\" sizen=\"16 2\" style=\"CardButtonSmall\" text=\"Search!\" manialink=\"".$mlzadmin."/admin.manializer.php?logins=login\" />
  <label posn=\"2 -26 2\" sizen=\"16 2\" style=\"CardButtonSmall\" text=\"Close\" manialink=\"".$mlzadmin."/admin.manializer.php\" />");

$startpos = 12;
$logins = "";
$sql = mysql_query("SELECT * FROM manializer_players WHERE `login` LIKE '%".$_GET["logins"]."%' LIMIT 10");
while($row = mysql_fetch_array($sql)) {
$ypos = 40 - $row['num_visits'];
$nick = str_replace("\$000", "\$888", $row['nick']);
$nick = str_replace("\$h", "", $nick);
$logins .= "  <label posn=\"4 -".$startpos." 2\" sizen=\"20 2\" style=\"TextScoresSmall2Rank\" text=\"".$nick."\" manialink=\"".$mlzadmin."/admin.manializer.php?login=".$row['login']."\" />\n";
$startpos = $startpos + 3;
}
$logins .= ("  <quad posn=\"0 0 1.5\" sizen=\"32 8\" style=\"Bgs1\" substyle=\"BgListLine\" />
  <quad posn=\"0 0 1\" sizen=\"32 48\" style=\"Bgs1\" substyle=\"BgTitle3\" />
  <label posn=\"12 -3 2\" sizen=\"16 2\" style=\"TextScoresSmall2Rank\" text=\"Search Results\" />
  <quad posn=\"2 0 1.75\" sizen=\"8 8\" style=\"Icons64x64_1\" substyle=\"Maximize\" />
  <label posn=\"2 -41 2\" sizen=\"16 2\" style=\"CardButtonSmall\" text=\"Search again\" manialink=\"".$mlzadmin."/admin.manializer.php?search=1\" />
  <label posn=\"2 -44 2\" sizen=\"16 2\" style=\"CardButtonSmall\" text=\"Close\" manialink=\"".$mlzadmin."/admin.manializer.php\" />");

$startpos = 12;
$login = "";
$row2=array();
$sql2 = mysql_query("SELECT * FROM manializer_visits WHERE `id`='".$_GET["visitsID"]."' ORDER by `id` DESC LIMIT 1");
$sql = mysql_query("SELECT * FROM manializer_players WHERE `login`='".$_GET["login"]."' LIMIT 1");
while($row = mysql_fetch_array($sql)) {
  $row2 = mysql_fetch_array($sql2);
  //date---
  $info=explode(".",$row2["date"]);
  if($info[0]<10){
    $info[0]=$info[0][1]+0;
  }
  if($info[1]<10){
    $info[1]=$info[1][1]+0;
  }
  $my_time=explode(".",$row2['time']);
  $my_time=$my_time[1].":".$my_time[0];
  $sql3=mysql_query("SELECT * FROM manializer_zeit WHERE `id` = '".$_GET["zeitID"]."'");
  $row3 = mysql_fetch_array($sql3);
  $login .= "<frame posn=\"0 4\">  <label posn=\"4 -12 2\" sizen=\"25 2\" style=\"TextScoresSmall2Rank\" text=\"\$09f".$_GET["login"]."\" />\n";
  $login .= "  <label posn=\"4 -15 2\" sizen=\"25 2\" style=\"TextScoresSmall2Rank\" text=\"Nickname : ".xmlspecialchars2($row['nick'])."\" />\n";
  $login .= "  <label posn=\"4 -18 2\" sizen=\"25 2\" style=\"TextScoresSmall2Rank\" text=\"TIME : ".$my_time."\" />\n";
  $login .= "  <label posn=\"4 -21 2\" sizen=\"25 2\" style=\"TextScoresSmall2Rank\" text=\"".$row['path']."\" />\n";
  $login .= "  <label posn=\"4 -24 2\" sizen=\"25 2\" style=\"TextScoresSmall2Rank\" text=\"Language : ".$row['lng']."\" />\n";
  $login .= "  <label posn=\"4 -27 2\" sizen=\"25 2\" style=\"TextScoresSmall2Rank\" text=\"IP-Adress : ".$row['ip']."\" />\n";
  $login .= "  <label posn=\"4 -30 2\" sizen=\"25 2\" style=\"TextScoresSmall2Rank\" text=\"Last visit : ".$row['lstvisit']."\" />\n
  <label posn=\"4 -36 2\" sizen=\"25 2\" style=\"TextScoresSmall2Rank\" text=\"Kam von : ".$row2['adresse']."\" />\n
  <label posn=\"4 -39 2\" sizen=\"25 2\" style=\"TextScoresSmall2Rank\" text=\"War on : ".(floor($row3['zeit']/60))." : ".($row3['zeit']%60)."\" />\n";
  $login .= ("  <label posn=\"4 -33 2\" sizen=\"25 2\" style=\"TextScoresSmall2Rank\" text=\"Visits : ".$row['num_visits']."\" /></frame>
    <label posn=\"2 -38 2\" sizen=\"16 2\" style=\"CardButtonSmall\" text=\"Back\" manialink=\"".$mlzadmin."/admin.manializer.php?logins=".$_GET["login"]."\" />
    <label posn=\"2 -41 2\" sizen=\"16 2\" style=\"CardButtonSmall\" text=\"Search again\" manialink=\"".$mlzadmin."/admin.manializer.php?search=1\" />
    <label posn=\"2 -44 2\" sizen=\"16 2\" style=\"CardButtonSmall\" text=\"Close\" manialink=\"".$mlzadmin."/admin.manializer.php\" />");
}
$login .= ("  <quad action=\"1\" posn=\"0 0 1.5\" sizen=\"32 8\" style=\"Bgs1\" substyle=\"BgListLine\" />
  <quad action=\"1\" posn=\"0 0 1\" sizen=\"32 48\" style=\"Bgs1\" substyle=\"BgTitle3\" />
  <label posn=\"12 -3 2\" sizen=\"16 2\" style=\"TextScoresSmall2Rank\" text=\"User Details\" />
  <quad posn=\"2 0 1.75\" sizen=\"8 8\" style=\"Icons128x128_1\" substyle=\"ChallengeAuthor\" />");

$windows = "";
if($_GET["search"] == "1")
{
$windows = ("<frame posn=\"-20 16 3\">
".$search."
 </frame>");
}
if($_GET["logins"] != "")
{
$windows = ("<frame posn=\"-20 16 3\">
".$logins."
 </frame>");
}
if($_GET["login"] != "")
{
$windows = ("<frame posn=\"-20 16 3\">
".$login."
 </frame>");
}
if($_GET["zone"] != "" or $_GET["adresse"]!="" or $_GET["time"]!="")
{
$windows = ("<frame posn=\"-20 16 3\">
".$zone."
 </frame>");
}
if($_GET["lange"] != "")
{

$windows = ("<frame posn=\"-20 16 3\">
  <quad posn=\"0 32 1.5\" sizen=\"32 8\" style=\"Bgs1\" substyle=\"BgListLine\" />
  <quad posn=\"0 32 1\" sizen=\"32 96\" style=\"Bgs1\" substyle=\"BgTitle3\" />
  <label posn=\"2 -61 2\" sizen=\"16 2\" style=\"CardButtonSmall\" text=\"Close\" manialink=\"".$mlzadmin."/admin.manializer.php\" />
    <label posn=\"12 29 2\" sizen=\"16 2\" style=\"TextScoresSmall2Rank\" text=\"Wie Lange sind User on!\" />
  <quad posn=\"2 32 1.75\" sizen=\"8 8\" style=\"Icons128x32_1\" substyle=\"RT_TimeAttack\" />
".$lange."
 </frame>");
}
if($_GET["musik"] != "")
{

$windows = ("<frame posn=\"-20 16 3\">
  <quad posn=\"0 32 1.5\" sizen=\"32 8\" style=\"Bgs1\" substyle=\"BgListLine\" />
  <quad posn=\"0 32 1\" sizen=\"32 96\" style=\"Bgs1\" substyle=\"BgTitle3\" />
  <label posn=\"2 -61 2\" sizen=\"16 2\" style=\"CardButtonSmall\" text=\"Schließen\" manialink=\"".$mlzadmin."/admin.manializer.php\" />
    <label posn=\"12 29 2\" sizen=\"16 2\" style=\"TextScoresSmall2Rank\" text=\"Die beste Musik!\" />
  <quad posn=\"2 32 1.75\" sizen=\"8 8\" style=\"Icons64x64_1\" substyle=\"Music\" />
".$musik."
 </frame>");
}
if($_GET["jukebox"] != "")
{

$windows = ("<frame posn=\"-20 16 3\">
  <quad posn=\"0 32 1.5\" sizen=\"32 8\" style=\"Bgs1\" substyle=\"BgListLine\" />
  <quad posn=\"0 32 1\" sizen=\"32 96\" style=\"Bgs1\" substyle=\"BgTitle3\" />
  <label posn=\"2 -61 2\" sizen=\"16 2\" style=\"CardButtonSmall\" text=\"Schließen\" manialink=\"".$mlzadmin."/admin.manializer.php\" />
    <label posn=\"12 29 2\" sizen=\"16 2\" style=\"TextScoresSmall2Rank\" text=\"Die beste Musik!\" />
  <quad posn=\"2 32 1.75\" sizen=\"8 8\" style=\"Icons64x64_1\" substyle=\"Music\" />
".$jukebox."
 </frame>");
}
$mainpg = ("
 <format textcolor=\"000F\" />
 <frame>
  <quad posn=\"-64 48 1\" sizen=\"128 48\" style=\"Bgs1\" substyle=\"BgTitle3\" />
  <quad posn=\"-64 0 1\" sizen=\"64 48\" style=\"Bgs1\" substyle=\"BgTitle3\" />
  <quad posn=\"0 0 1\" sizen=\"32 48\" style=\"Bgs1\" substyle=\"BgTitle3\" />
  <quad posn=\"32 40 1.51\" sizen=\"72 88\" style=\"Bgs1\"  substyle=\"BgTitle3\" />

  <quad posn=\"-64 48 1.5\" sizen=\"128 8\" style=\"Bgs1\" substyle=\"BgListLine\" />
  <quad posn=\"-64 0 1.5\" sizen=\"64 8\" style=\"Bgs1\" substyle=\"BgListLine\" />
  <quad posn=\"0 0 1.5\" sizen=\"32 8\" style=\"Bgs1\" substyle=\"BgListLine\" />
  <quad posn=\"32 0 1.5\" sizen=\"32 8\" style=\"Bgs1\" substyle=\"BgListLine\" />


  <label posn=\"-54 45 2\" sizen=\"16 2\" style=\"TextScoresSmall2Rank\" text=\"Manializer\" />
  <quad posn=\"-64 48 1.75\" sizen=\"8 8\" style=\"Icons128x128_1\" substyle=\"Statistics\" />

".$other."

 </frame>

 <frame>
".$graph."
 </frame>

 <frame>
".$boss."
 </frame>

 <frame>
".$players."
 </frame>
".$windows."

</manialink>");

echo $mainpg;
  ob_end_flush();
?>