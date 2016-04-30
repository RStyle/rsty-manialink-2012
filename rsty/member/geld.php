<?php
#$mysqli= new mysqli("localhost" , "web10" , "", "usr_web10_1");
$aus="SELECT * FROM admins WHERE user = '".$_SESSION["username"]."' LIMIT 1 ;";
$myless=$mysqli->query($aus);
$infos=$myless->fetch_array();
echo'
<quad posn="0 -8 1" sizen="132 19" halign="center" valign="bottom" image="./header/white.png" />
<label posn="-33 10 1" text="Infos '.xmlspecialchars("über").' die Einnahmen von '.$_SESSION["nickname"].'$z  $i('.$_SESSION["username"].')$i
Du bekommst '.xmlspecialchars("für").' jeden Download eines deiner Sachen 70% des Preises!
Momentan schulde ich dir : $o$i'.($infos["now"]+0).'$o$i Coppers." />
<label posn="-45 0 1" halign="center" text="Insgesamt" />
<label posn="-45 -4 1" halign="center" text="'.($infos["cc"]+0).'" />
<label posn="-35 0 1" halign="center" text="Tracks" />
<label posn="-35 -4 1" halign="center" text="'.($infos["tracks"]+0).'" />
<label posn="-25 0 1" halign="center" text="Skins" />
<label posn="-25 -4 1" halign="center" text="'.($infos["skins"]+0).'" />
<label posn="-15 0 1" halign="center" text="Avatars" />
<label posn="-15 -4 1" halign="center" text="'.($infos["avatars"]+0).'" />
<label posn="-5 0 1" halign="center" text="Signs" />
<label posn="-5 -4 1" halign="center" text="'.($infos["signs"]+0).'" />
<label posn="5 0 1" halign="center" text="Horns" />
<label posn="5 -4 1" halign="center" text="'.($infos["horns"]+0).'" />
<label posn="15 0 1" halign="center" text="Mods" />
<label posn="15 -4 1" halign="center" text="'.($infos["mods"]+0).'" />
<label posn="25 0 1" halign="center" text="Plugins" />
<label posn="25 -4 1" halign="center" text="'.($infos["plugins"]+0).'" />
<label posn="35 0 1" halign="center" text="Screens" />
<label posn="35 -4 1" halign="center" text="'.($infos["screens"]+0).'" />

';
#$mysqli->close();
?>