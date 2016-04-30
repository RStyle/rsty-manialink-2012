<?php
	require_once('./classes/tmfcolorparser.inc.php');
	

	$nick = urldecode($_GET["nick"]);
	$strip = $_GET["strip"];
	$bg = $_GET["bg"];
	$contrast = $_GET["contrast"];
	$darker = $_GET['darker'];
	$width = $_GET['width'];
	
	if (!$width) $width = 420;
	if (!$bg) $bg = 140;
	
	$cp = new TMFColorParser();
	$cp->alwaysDrawFontShadows = false;
	
	if ($contrast) $cp->autoContrastColor('#bbbbbb');
	if ($darker==-1) $cp->forceBrighten = true;
	if ($darker==1) $cp->forceDarken = true;
	
	$img = imagecreatetruecolor($width,25);
	$gray = imagecolorallocate($img,$bg,$bg,$bg);
	imagefill($img, 0,0,$gray);
	$white = imagecolorallocate($img, 255,255,255);
	$arial="fonts/tahoma";
	
	if (!$strip) $cp->drawStyledString($img, 10, 5, 17, $white, $arial, $nick);
	else $cp->drawStyledString($img, 10, 5, 17, $white, $arial, $nick, true);  // strip the colors and display everything in the default color
	imagepng($img);

?>