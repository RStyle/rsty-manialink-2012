<html>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body style="background:#bbbbbb; font-family:Arial, sans-serif">
<?php

require_once('./classes/tmfcolorparser.inc.php');

$cp= new TMFColorParser();


$nick1 = '$s$i$08foorf $ffffuck$08ffish ($lmailto:tmn@stabb.de$l) $z$wproudly$m presents $this$m';
$nick2 = '$s$F00T$F10M$F20F$F30 $F40C$F50o$F60l$F80o$F90r$FA0P$FB0a$FC0r$FD0s$FE0e$FF0r $zwith $f00$l[http://fish.stabb.de]links$l and $h[T.O.M]stuff.';

echo '<span style="font-weight:bold; color:white">Input Texts:</span><br>'.$nick1.'<br>'.$nick2.'<br>'.$nick3;
echo '<br><br><br><span style="font-weight:bold; color:white">Default Parsing:</span><br>'.$cp->toHTML($nick1)."<br>".$cp->toHTML($nick2).'<br><br>';
echo "<img src='image.php?nick=".urlencode($nick1)."' border = 0/><br>";
echo "<img src='image.php?nick=".urlencode($nick2)."' border = 0/><br>";


//Now with stripped color:

echo '<br><br><br><span style="font-weight:bold; color:white">Stripped Color:</span><br>'.$cp->toHTML($nick1, true)."<br>".$cp->toHTML($nick2, true).'<br><br>';
echo "<img src='image.php?nick=".urlencode($nick1)."&amp;strip=true' border = 0/><br>";
echo "<img src='image.php?nick=".urlencode($nick2)."&amp;strip=true' border = 0/><br>";


//Now with stripped links:

echo '<br><br><br><span style="font-weight:bold; color:white">Stripped Links:</span><br>'.$cp->toHTML($nick1, true, true)."<br>".$cp->toHTML($nick2, true, true).'<br><br>';
echo "<img src='image.php?nick=".urlencode($nick1)."&amp;strip=true' border = 0/><br>";
echo "<img src='image.php?nick=".urlencode($nick2)."&amp;strip=true' border = 0/><br>";

//Now color matched to background stripped links:

$text = '$fff$o$s[PHP]$z $F00T$F11MF$E22 $E33Co$E44l$D55o$D66r $D77P$C88ar$C99s$CAAe$BAAr$BBB $BBBb$BBAy$CCA $CC9o$CC8o$CC7r$DD7f$DD6|$DD5f$DD4u$EE4c$EE3k$EE2f$EE1i$FF1s$FF0h';
$cp->autoContrastColor('');
echo '<br><br><br><span style="font-weight:bold; color:white">Default Color Handling:</span><br>'.$cp->toHTML($text)."<br>";

$cp->autoContrastColor('#bbbbbb');
echo '<br><span style="font-weight:bold; color:white">Color Correction by Color Difference to background:</span><br>'.$cp->toHTML($text)." (Default)<br>";

$cp->forceBrighterColors();
echo $cp->toHTML($text)." (force brighter colors)<br>";

$cp->forceDarkerColors();
echo $cp->toHTML($text)." (force darker colors)<br>";

echo '<br><span style="font-weight:bold; color:white">Same for images:</span><br>';
echo "<img src='image.php?nick=".urlencode($text)."&amp;bg=187&amp;width=330' border = 0/> w/o color correction<br>";
echo "<img src='image.php?nick=".urlencode($text)."&amp;bg=187&amp;contrast=1&amp;width=330' border = 0/> default correction<br>";

$cp->forceBrighterColors();
echo "<img src='image.php?nick=".urlencode($text)."&amp;bg=187&amp;contrast=1&amp;darker=-1&amp;width=330' border = 0/> force brighter colors<br>";

$cp->forceDarkerColors();
echo "<img src='image.php?nick=".urlencode($text)."&amp;bg=187&amp;contrast=1&amp;darker=1&amp;width=330' border = 0/> force darker colors<br>";


?>
</body>
</html>