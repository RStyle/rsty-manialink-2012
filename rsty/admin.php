<?php
if ($_GET['site']=="") {
	echo'<frame posn="20 -40" >';
	include("./rsty/newsbox.php");
	echo'</frame>';
	include("rsty/shoutb.php");
	$nnn='./rsty/mail/post/'.trim($_SESSION["username"]).'.txt';
	if (file_exists($nnn)) {
		$neuen2=file_get_contents($nnn);
		$neuen2++;
		$neuen2--;
	}
	if ($neuen2 >=1) {
		echo'
		<quad posn="0 0 39" sizen="30 20" style="Bgs1InRace" substyle="BgWindow1" halign="center" valign="center" />
		<quad posn="0 0 40" sizen="8 8" style="Icons64x64_1" substyle="NewMessage" manialink="'.$ml.'?page=admin&amp;site=posteingang" halign="center" valign="center" />
		<label posn="0 9 40" sizen="18 8" halign="center" text="SIE HABEN POST" />
		<label style="TextRaceChrono" posn="0 -9 40" sizen="25 3" valign="bottom" halign="center" text="'.$neuen2.' neue Nachrichten" manialink="'.$ml.'?page=admin&amp;site=posteingang" />
		<audio data="./rsty/mail/sie haben post.wav" sizen="0 0" play="1" looping="0" />
		';
	}
	$h=-30;
	$p=29.5;
	$po=$p;
	
	function adminml($a)
	{
		global $ml;
		if ($_SESSION["login2"]=="admin") {
			if ($a=="r2r:admin:m")
				$b="r2r:admin:m";
			else
				$b=$ml."?page=admin&amp;site=".$a;
			return $b;
		}
	}
	
	function memberml($a)
	{
		global $ml;
		if ($_SESSION["login"]!="") {
			$b=$ml."?page=admin&amp;site=".$a;
			return $b;
		}
	}
	echo'
	<label sizen="28 2.7" style="TextRaceChrono" halign="center" valign="center" posn="-20 46 16" >$00FAdmin-Seite</label>
	<label sizen="28 2.7" style="TextRaceChrono" halign="center" valign="center" posn="20 46 16" >$F00-'.$_SESSION['login'][0].'-'.$_SESSION['login'][1].'-'.$_SESSION['login'][2].'-'.$_SESSION['login'][3].'-'.$_SESSION['login'][4].'-'; if ($_SESSION['login']=="member") { echo $_SESSION['login'][5].'-'; }echo'$z</label>

	<label sizen="29 2" halign="center" valign="center" posn="0 6.6 16" style="TextCardRaceRank">$F00Admin-Rechte</label>

	<frame posn="5 0 0">

		<quad halign="center" posn="-36 30 2" image="./header/news.png" sizen="5 5" />
		<label halign="center" posn="-36 28 3" style="TextButtonSmall" text="NEWS" sizen="35 5" manialink="'.adminml("newsschreiben").'" />
		<quad halign="center" posn="-36 25 2" image="./header/avatar.png" sizen="5 5" />
		<label halign="center" posn="-36 23 3" style="TextButtonSmall" text="Besucher" sizen="35 5" manialink="'.adminml("r2r:admin:m").'" />
		<quad halign="center" posn="-36 20 2" image="./header/signs.png" sizen="5 5" />
		<label halign="center" posn="-36 18 3" style="TextButtonSmall" text="Design" sizen="35 5" manialink="'.adminml("tm").'" />
		<quad halign="center" posn="-36 15 2" image="./header/gbook.png" sizen="5 5" />
		<label halign="center" posn="-36 13 3" style="TextButtonSmall" text="GBook" sizen="35 5" manialink="'.adminml("gbook").'" />


		<quad halign="center" posn="-24.5 30 2" image="./header/links.png" sizen="5 5" />
		<label halign="center" posn="-24.5 28 3" style="TextButtonSmall" text="LINKS" sizen="35 5" manialink="'.adminml("links_edit").'" />
		<quad halign="center" posn="-24.5 25 1" image="./header/news.png" sizen="6 5" />
		<quad halign="center" posn="-24.5 25 2" image="./header/admin.png" sizen="5 5" />
		<label halign="center" posn="-24.5 23 3" style="TextButtonSmall" text="'.$_SESSION["admin news"][$la].'" sizen="35 5" manialink="'.adminml("adminnews").'" />

	</frame>



	<!--
	<quad sizen="90 30" posn="0 18 0.1" action="1" halign="center" valign="center" style="BgsChallengeMedals" substyle="BgNadeo" />
	<quad sizen="12 12" posn="34 8 3.1" action="1" halign="center" valign="center" style="MedalsBig" substyle="MedalNadeo" />
	-->
	<quad sizen="75 30" posn="0 18 0.2" action="1" halign="center" valign="center" bgcolor="FFF" />
	<quad sizen="75 30" posn="1 19 0.1" action="1" halign="center" valign="center" bgcolor="0FF" />
	';
	//MedalsBig-MedalNadeo
	//member------------------------------------------
	echo '
	<!--<quad sizen="90 30" posn="0 -14 0.1" action="1" halign="center" valign="center" style="BgsChallengeMedals" substyle="BgSilver" />-->
	<quad sizen="75 30" posn="0 -14 0.2" action="1" halign="center" valign="center" bgcolor="FFF" />
	<quad sizen="75 30" posn="1 -13 0.1" action="1" halign="center" valign="center" bgcolor="F0F" />

	<label sizen="20 2" halign="center" valign="center" posn="0 -26 16" style="TextCardRaceRank">$0F0Member-Rechte</label>
	';
	$h=-30;
	$p=-2.1;
	$po=$p;

	echo'
	<frame posn="5 0 0">

		<quad halign="center" posn="-36 -2 2" image="./header/admin.png" sizen="5 5" />
		<label halign="center" posn="-36 -4 3" style="TextButtonSmall" text="'.$_SESSION["passwort"][$la].'" sizen="12 5" manialink="'.memberml("pwedit").'" />
		<quad halign="center" posn="-36 -7 2" image="./header/mail.png" sizen="5 5" />
		<label halign="center" posn="-36 -9 3" style="TextButtonSmall" text="'.$_SESSION["posteingang"][$la].'" sizen="12 5" manialink="'.memberml("posteingang").'" />

		<quad halign="center" posn="-36 -12 2" style="Icons128x128_1" substyle="Coppers" sizen="5 5" />
		<label halign="center" posn="-36 -14 3" style="TextButtonSmall" text="'.$_SESSION["geld"][$la].'" sizen="12 5" manialink="'.memberml("geld").'" />
		<quad halign="center" posn="-36 -17 2" style="Icons64x64_1" substyle="TrackInfo" sizen="5 5" />
		<label halign="center" posn="-36 -19 3" style="TextButtonSmall" text="Infos" sizen="12 5" manialink="'.memberml("info").'" />

		<quad halign="center" posn="-24.5 -2 2" style="Icons64x64_1" substyle="Music" sizen="5 5" />
		<label halign="center" posn="-24.5 -4 3" style="TextButtonSmall" text="'.$_SESSION["musik"][$la].' Upload" sizen="12 5" manialink="'.memberml("uploadmusic").'" />

	</frame>


	<quad valign="center" halign="center" posn="25 -6 2" style="Icons128x128_1" substyle="Upload" sizen="8 8" />
	<label valign="center" halign="center" posn="25 -6.1 3" style="TextButtonSmall" text="Upload something" sizen="22 5" url="rsty.de.vu" />
	';
} elseif ($_SESSION['login']!="") {
	$site=$_GET['site'];
	if (file_exists("./rsty/member/$site.php")) {
		if ($site=="posteingang")
			echo '<frame posn="0 -10" >';
		include("./rsty/member/$site.php");
		if ($site=="posteingang")
			echo '</frame>';
	} elseif (file_exists("./rsty/admin/$site.php") && $_SESSION['login']=="admin") {
		include("./rsty/admin/$site.php");
	}
}
?>