<?php
require_once('connect.php');
$aus='SELECT * FROM language';
if($aus2=$mysqli->query($aus)){
while($infos=$aus2->fetch_array()){
$de=$infos['de'];
$_SESSION[$de]=array(
'de' => $infos['de'],
'en'=>$infos['en'],
'fr'=>str_replace('é','e',$infos['fr']),
'it' => $infos['it'],
'sp'=>$infos['sp'],
'un'=>$infos['un']
);
$_SESSION[strtolower($de)] = array(
'de' => $infos['de'],
'en'=>$infos['en'],
'fr'=>str_replace('é','e',$infos['fr']),
'it' => $infos['it'],
'sp'=>$infos['sp'],
'un'=>$infos['un']
);
}
}