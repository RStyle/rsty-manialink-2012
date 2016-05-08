<?php
if (!empty($_GET["link" ]) && $_GET["link"] != "LINK" && strtolower($_GET["link"])!="ugly" && $_GET['linkname']!="" && $_GET['linkname']!="LINK-NAME") {
	$id=$_GET['id'];
	$linkname2=$_GET['linkname'];
	$linkname2=str_replace('$o',"",$linkname2);
	$dateis=fopen("./rsty/links/$id.txt",'a');
	  fputs($dateis,"\n");
	  fputs($dateis,$_GET['link']);
	  fputs($dateis,"\n");
	  fputs($dateis,$linkname2);
	fclose($dateis);
	chmod($dateis,0777);
} else {
	$dateis=fopen("./rsty/links/$id.txt",'w');
	fputs($dateis,"");
	fclose($dateis);
	chmod($dateis,0777);
}
$links=array();
for ($a=0;$a<60;$a++) {
	if (file_exists("./rsty/links/".$a.".txt")) {
		$links[$a]=file("./rsty/links/".$a.".txt");
	}
}
$posx=-28-7-3;
$posx_old=$posx;
$posy=33;
for ($u=0;$u<=29+6+6+7;$u++) {
	if ($links[$u][1]=="") {
		echo '
		<quad posn="'.$posx.' '.$posy.' 16" sizen="13 7" halign="center" valign="center"
		style="Bgs1InRace" substyle="BgList" manialink="'.$ml.'?page=links&amp;addyourml=true&amp;id='.$u.'" />
		<label posn="'.$posx.' '.($posy+1.6).' 20" sizen="11 4" style="TextTitle2Blink" halign="center" valign="center">$0F0Add your
			ML!$z</label>
		';
	} else {
		echo '
		<quad posn="'.$posx.' '.$posy.' 16" sizen="13 7" halign="center" valign="center"
		style="Bgs1InRace" substyle="BgList"  manialink="'.$links[$u][1].'" />
		<label posn="'.$posx.' '.$posy.' 20" style="TextCardRaceRank" sizen="11 4" manialink="'.$links[$u][1].'" halign="center" valign="center">$o'.$links[$u][2].'$z</label>
		';
		if ($_SESSION['login']=="admin") {
			echo'
			<label posn="'.($posx+4.6).' '.($posy+4).' 22" sizen="6 2.5" style="TextSubTitle1" text="$fffE" textcolor="FFF" manialink="'.$ml.'?page=admin&amp;site=links_edit&amp;edit='.$u.'" />
			<label halign="right" posn="'.($posx-4.5).' '.($posy+4).' 24" sizen="6 2.5" style="TextSubTitle1" text="$fffX" textcolor="FFF" manialink="'.$ml.'?page=admin&amp;site=links_edit&amp;delete='.($u+0).'" />
			';
		}
	}
	$posx=$posx+14;
	if ($posx>=37+11) {
		$posx=$posx_old;
		$posy=$posy-8.5;
	}
}
$posy=$posy+9.5;
echo '
<label posn="0 '.(33+5.6).' 16" halign="center" valign="center">$oMANIALINKS$z</label>';
if ($_GET['addyourml']=="true") {
	echo'
	<quad posn="0 '.($posy-14).' 1" sizen="42 11" halign="center" valign="center" style="Bgs1InRace" substyle="BgList" />
	<entry posn="-10 '.($posy-15).' 16" sizen="16 2.5" halign="center" valign="center" default="LINK" name="ml" />
	<entry posn="10 '.($posy-15).' 16" sizen="16 2.5" halign="center" valign="center" default="LINK-NAME" name="mlname" />
	<label posn="0 '.($posy-11).' 16" sizen="18 2.7" style="TextButtonMedium" manialink="'.$ml.'?page=links&amp;link=ml&amp;linkname=mlname&amp;id='.$_GET['id'].'" halign="center" valign="center">$o$f00Add your ML$z</label>

	';
} else {
	echo'
	<label posn="0 '.($posy-7).' 16" halign="center" valign="center">$o'.trim($_SESSION["server"][$la]).'$z</label>
	';
	$posy=$posy-15.5;
	echo '
	<quad posn="-28 '.$posy.' 16" sizen="16 8" halign="center" valign="center"
	style="Bgs1InRace" substyle="BgList" manialink="tmtp:///#join=Rumpelbude_2" />
	<label posn="-28 '.$posy.' 16" halign="center" valign="center">MANIACITY</label>

	<quad posn="'.(-28 +18.9).' '.$posy.' 16" sizen="16 8" halign="center" valign="center"
	style="Bgs1InRace" substyle="BgList" manialink="tmtp:///#join=zeroladder35" />
	<label posn="'.(-28 +18.9).' '.($posy+2).' 16" halign="center" valign="center">$tFull Speed
		ZERO</label>
		
		<quad posn="'.(-28 +18.9*2).' '.$posy.' 16" sizen="16 8" halign="center" valign="center"
	style="Bgs1InRace" substyle="BgList" manialink="tmtp:///#join=ichglotz2" />
	<label posn="'.(-28 +18.9*2).' '.($posy+2).' 16" halign="center" sizen="15.5 6" valign="center">$tAceKings
	NASCAR RACING</label>

	<quad posn="'.(-28 +18.9*3).' '.$posy.' 16" sizen="16 8" halign="center" valign="center"
	style="Bgs1InRace" substyle="BgList" manialink="" />
	<label posn="'.(-28 +18.9*3).' '.$posy.' 16" halign="center" valign="center"></label>
	';
}
?>