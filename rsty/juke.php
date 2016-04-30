<?php
//http://rsty.keksml.de/style2/jukebox1.png
if($_GET['musik']!=""){
	$m=trim($_GET['musik']);
	if(file_exists("music/$m.ogg")){ $m.=".ogg"; }
	if(file_exists("music/$m.mux")){ $m.=".mux"; }
	if(file_exists("music/$m.wav")){ $m.=".wav"; }
	$_SESSION['musik']=$m;
	$time_m=60*60*24*30*3*10*100;
	setcookie("rsty_musik",$m,time()+$time_m);
	//+++
	////COUNTER

	$fetch = $pdo->prepare('SELECT * FROM manializer_musik WHERE name = :name');
	$fetch->execute(array(':name' => $m));
	
	$exits = $fetch->fetchColumn();
	if($exits == 0){
		$sql2 = $pdo->prepare('INSERT INTO `manializer_musik` (`name`,zahl) VALUES ( :name ,"1")');
		$sql2->execute(array(':name' => $m));
	} else {
		$fetch = $pdo->prepare('SELECT * FROM manializer_musik WHERE name = :name');
		$fetch->execute(array(':name' => $m));
		$infos = $fetch->fetch(PDO::FETCH_ASSOC);
		$old=$infos["zahl"];
		$new=$old+1;
		$fetch = $pdo->prepare('UPDATE `manializer_musik` SET `zahl`= :new WHERE `name`= :name ');
		$fetch->execute(array(':name' => $m, ':new' => $new));
	}
	//+++
}
if($_SESSION["musik"]=="" or $_SESSION["musik"]=="Array" or $_SESSION["musik"]==array()){
	$m='./music/'.$_COOKIE["rsty_musik"];
	if(!empty($_COOKIE["rsty_musik"]) && $_COOKIE["rsty_musik"]!="Array" && $_COOKIE["rsty_musik"]!=array() && file_exists("./music/$m")){
	 $_SESSION["musik"]=$_COOKIE['rsty_musik'];
	}else{
	 $_SESSION["musik"]='Lund - Alone.ogg';
	}
}

if($_GET['plugin']=="jukebox"){
	$_SESSION["sta"]=25;
	$_GET["sta"]=25;
	$bv="music";
	$verzeichnis=opendir($bv);
	$music=array("");
	$pos=-8;
	$old_pos=$pos;
	echo'
	<label posn="'.(45.9-0).' '.(0-5.4).' 4" halign="center" style="TextCardInfoSmall" text="'.ltrim($_SESSION["jukebox"][$la]).'" />
	';
	while($datei = readdir($verzeichnis)){
		if(preg_match("/\.ogg$/", $datei) || preg_match("/\.mux$/", $datei) || preg_match("/\.wav$/", $datei)) {
			$music[]=$datei;
			$name=str_replace(".ogg","",$datei);
			$name=str_replace(".wav","",$name);
			$name=str_replace(".mux","",$name);
			echo'
			<label manialink="'.$ml.'?';
			if($_GET['page']!=""){echo 'page='.$_GET["page"].'&amp;';}
				if($_GET['site']!=""){echo 'site='.$_GET["site"].'&amp;';}
				if($_GET['number']!=""){echo 'number='.$_GET["number"].'&amp;';}
				if($_GET["y"]!=""){echo 'y='.$_GET["y"].'&amp;';}
				if($_GET['date']!=""){echo 'date='.$_GET["date"].'&amp;';}
			if($_GET['id']!=""){echo 'id='.$_GET["id"].'&amp;';}
			if($_GET['write']!=""){echo 'write='.$_GET["write"].'&amp;';}
			echo'musik='.$name.'&amp;plugin=jukebox" text="'; if($datei == $_SESSION['musik'])echo'$o$fff'; echo $name.'" sizen="14 3" posn="'.(45.4-14+$sop).' '.$pos.' 4" style="TextRaceStaticSmall" />
			';
			//'.(45.9-14).' '.($p-2.1).'
			$pos-=2.1;
			if($pos<=$old_pos-2.1*5){
				$pos=$old_pos;
				$sop+=15;
			}
		}
	}
} elseif($_SESSION["sta"]=="25") {
	$_SESSION["sta"]=0;
}
if($_GET["page"]=="home" or $_GET["page"]==""){
	echo '
	<quad manialink="'.$ml.'?';
	if($_GET['page']!=""){echo 'page='.$_GET["page"].'&amp;';}
		if($_GET['site']!=""){echo 'site='.$_GET["site"].'&amp;';}
		if($_GET['number']!=""){echo 'number='.$_GET["number"].'&amp;';}
		if($_GET["y"]!=""){echo 'y='.$_GET["y"].'&amp;';}
		if($_GET['date']!=""){echo 'date='.$_GET["date"].'&amp;';}
	if($_GET['id']!=""){echo 'id='.$_GET["id"].'&amp;';}
	if($_GET['write']!=""){echo 'write='.$_GET["write"].'&amp;';}
	echo'plugin=jukebox" posn="47 -24.4 6.11" halign="center" valign="center" sizen="12 8" image="./style2/music1.png" imagefocus="./style2/music2.png" />
	<label textcolor="000" posn="54 -24.4 6.11" valign="center" text="'.ltrim($_SESSION["jukebox"][$la]).'" />
	<label textcolor="000" posn="41 -24.4 6.11" valign="center" halign="right" text="'.ltrim($_SESSION["jukebox"][$la]).'" />
	';
}
?>