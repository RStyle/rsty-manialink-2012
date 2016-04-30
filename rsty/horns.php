<?php
//http://rsty.keksml.de/style2/z_play.png
$play=fpath."style2/z_";
$bv="d/horns";
$verzeichnis=opendir($bv);
$horns=array();
while($datei = readdir($verzeichnis)){
	if(preg_match("/\.ogg$/", $datei) || preg_match("/\.mux$/", $datei) || preg_match("/\.wav$/", $datei) || preg_match("/\.wave$/", $datei)) {
		$horns[$datei]= $datei;
	}
}
$a=count($horns);
$a--;
$p1=-31;
$p2=38.1;
$p2o=$p2;
if($_GET['number']>0.1){
	echo'
	<quad manialink="'.$ml.'?page=horns" posn="-38 40 17" sizen="5 5" halign="center" valign="center" style="Icons64x64_1" substyle="ArrowPrev" />
	';
	$aaa=$_GET['number']+0;//meber=1
	$io=16*$aaa;//16

} else {
	$io=0;
}
//$a=55;//Nur damit 20 Butons angezeigt werden!
$ioa=$a-$io;//
if($ioa>=16){
	$a=$io+15;
	echo'
	  <quad manialink="'.$ml.'?page=horns&amp;number='.($_GET['number']+1).'" posn="38 40.00 17" sizen="5 5" halign="center" valign="center" style="Icons64x64_1" substyle="ArrowNext" />
	';
}
elseif($ioa<0){
	$a=0;
}
//for($i = $a; $i >= $ioa;$i--){n
//for($i = $io; $i <= $a;$i++){
$aa++;
//$i=aktuelle zahl --  $io 0/16/32 je nach Seite... --- $a= anzahl hupen
//for($i = $io; $i <= $a;$i++){
$fen=1;
for($i = $a; $i >= $io;$i--){
	if(file_exists("./d/horns/$i.txt")){
		$t=file("./d/horns/$i.txt");
		$t[0]=str_replace("\n","",$t[0]);
		$t[0]=str_replace(".ogg","",$t[0]);
		$t[0]=str_replace(".mux","",$t[0]);
		$t[0]=str_replace(".wav","",$t[0]);
		$t[0]=str_replace(".wave","",$t[0]);
		$mader=$t[1];
		$dd="down";
		//str_replace("\n","",$bad);
	} else {
		$t=array("No Horns available","exist");
		$dd="";
	}
	$idg=$_GET['id']+0;
	if($idg!=$i || !isset($_GET['id'])){
		$number=$_GET['number']+0;
		echo'
		<quad sizen="6 6" halign="center" valign="center" posn="'.$p1.' '.($p2+2).' 4.2" image="'.$play.'play.png" imagefocus="'.$play.'play_focus.png" manialink="'.$ml.'?page=horns&amp;number='.$number.'&amp;id='.$i.'" />
		';
	} else {
		echo'
		<quad sizen="6 6" halign="center" valign="center" posn="'.$p1.' '.($p2+2).' 4.2" image="'.$play.'played.png" imagefocus="'.$play.'played_focus.png" manialink="'.$ml.'?page=horns&amp;number='.$number.'" />
		';
	}
	$us=str_replace("\n","",$t[1]);
	$fetch = $pdo->prepare('SELECT * FROM  manializer_players WHERE login = :login');
	$fetch->execute(array(':login' => $us));
	$nickdata = $fetch->fetch(PDO::FETCH_ASSOC);
	$name=$t[0];
	$name[0]=strtoupper($name[0]);
	echo'
	<quad posn="'.$p1.' '.($p2-2.4+9).' 1.1" sizen="20 19" halign="center" image="./header/dark.png" />

	<label  sizen="17.5 2.7" halign="center" valign="center" posn="'.$p1.' '.($p2-2.3).' 4.1" >$fff'.$name.'$z</label>
	<label  sizen="15 2.7" halign="center" valign="center" textcolor="444" posn="'.$p1.' '.($p2-5).' 4.1" >'.$nickdata['nick'].'$z</label>

	<label '; if($dd=="down"){echo 'manialink="rstyhorn?id='.$i.'"';} echo 'style="TextCardInfoSmall" sizen="13 2.7" halign="center" valign="center" posn="'.$p1.' '.($p2-7.8).' 4.1" >$0FF'.$_SESSION["Download"][$la].'$z</label>
	';
	$p2-=19;
	if($p2<=-25){
		$p2=$p2o;
		$p1+=20;
	}
	$fen++;
}
for($a=$fen;$a<=16;$a++){
	echo'
	<quad posn="'.$p1.' '.($p2-2.4+9).' 1.1" sizen="20 19" halign="center" image="./header/dark.png" />
	';
	$p2-=19;
	if($p2<=-25){
		$p2=$p2o;
		$p1+=20;
	}
}
if(isset($_GET['id'])){
	$id=$_GET['id']+0;
	$musik=file(fpath."d/horns/$id.txt");
	//<audio data="http://localhost/manialink/music.ogg" play="1" />
	echo'
	<audio data="'.fpath.'d/horns/'.$musik[0].'" play="1" sizen="0 0" posn="0 0 -3" />
	';
}
?>