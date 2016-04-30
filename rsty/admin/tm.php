<?php
$bv="./style2/new/";
$verzeichnis=opendir($bv);
$bilder=array();
while($datei = readdir($verzeichnis)){
if(!preg_match("/\.txt$/", $datei) && $datei!="." && $datei!="..") {
if(preg_match("/\.png$/", $datei)){
$bilder[]= $datei;
} else {
$bv2="./style2/new/".$datei."";
$verzeichnis2=opendir($bv2);
while($datei2 = readdir($verzeichnis2)){
if(preg_match("/\.png$/", $datei2)) {
$bilder[]=$datei."/".$datei2;
}
}
}
}
}
$c=count($bilder);
$s="14 8";
$p1=-30;
$p2=35;
$p2o=$p2;
foreach($bilder as $bild){
echo'<quad posn="'.$p1.' '.$p2.' 7" sizen="'.$s.'" halign="center" valign="center" image="'.fpath.'style2/new/'.$bild.'" />';
$p2-=8.5;
if($p2<=-35){
$p2=$p2o;
$p1+=15;
}
}
?>