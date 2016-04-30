<?php
  function verlink(){
  $ll=0;
  global $ml;
  $ausgabe=$ml."?";
  global $HTTP_GET_VARS;
  $_GET["page"]=str_replace('"',"''",$_GET["page"]);
$_GET["titel"]=str_replace('"',"''",$_GET["titel"]);
$_GET["nachricht"]=str_replace('"',"''",$_GET["nachricht"]);
  foreach($HTTP_GET_VARS as $key => $value) {
  $value=str_replace('"',"''",$value);
  //$value=str_replace(array("'",'"'),array('&apos;','&quot;'),$value);
  //$value=str_replace(array('\&apos;','\&quot;'),array('&apos;','&quot;'),$value);
  if($key!="on" && $key!="off" && $key!="lang" && $key!="old" && !preg_match("/design_/",$key) && $key!="bg" && $key!="eintrag" && $key!="shout" && $key!="code" && $key!="upload"){
  if($ll==1){ $ausgabe.='&amp;'; }
    $ausgabe.=$key;if($value!=""){$ausgabe.='='.$value;}
	$ll=1;
  }
  }
  return $ausgabe;
  }
$link='$000RSty';
if($_GET["page"]!="")$link.="";
echo'
<?xml version="1.0" encoding="utf-8"?>
<redirect>'.$link.verlink().'</redirect>
';
?>