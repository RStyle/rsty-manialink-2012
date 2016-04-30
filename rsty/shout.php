<?php
$smyl=array("","wand","schuss","freu","leptop","trauer","luck");
$shout=file(path.'rsty/shout.txt');
$ncc=explode(SECRET_CODE,$shout[0]);
$code=trim(file_get_contents(path.'rsty/code2.txt'));
if(!empty($_GET['shout'])&&!empty($_SESSION['nickname']) && $_GET["code"]==$code){
$shouttt=trim($_GET['shout']);
$spamtext=file('./rsty/shout.txt');
$spam1=explode(SECRET_CODE,$spamtext[0]);
$spam2=explode(SECRET_CODE,$spamtext[1]);
$count=count($spam1);
$count--;
$sicher1=$spam1[$count+0];
$sicher2=$spam2[$count+0];
$sicher3=$spam1[0];
$sicher4=$spam2[0];
if(!empty($shouttt)){
$_GET['shout']=rtrim($_GET['shout']);
$old=file_get_contents('./rsty/shout.txt');
$new=str_replace("\n","",$_GET['shout']);
$new.=SECRET_CODE;
$new.=$_SESSION["nickname"].'$z';
$new.=SECRET_CODE;
$new.=$ncc[2]+1;
$new.=SECRET_CODE;
$ss1=$_GET['s1'];
$ss2=$_GET['s2'];
$ss3=$_GET['s3'];
$ss4=$_GET['s4'];
$ss5=$_GET['s5'];
$ss6=$_GET['s6'];
$ss7=$_GET['s7'];
$ss8=$_GET['s8'];
$ss9=$_GET['s9'];
$ss10=$_GET['s10'];
$ss11=$_GET['s11'];
$ss12=$_GET['s12'];
$_GET['color']=substr($_GET['color'],0,3);
if($_GET["color"][2]=="")$_GET["color"][2]="F";
if($_GET["color"][1]=="")$_GET["color"][1]="F";
if($_GET["color"][0]=="")$_GET["color"][0]="F";
$ss13=str_replace("\n","",$_GET['color']);
$new.=$ss1;
$new.=SECRET_CODE;
$new.=$ss2;
$new.=SECRET_CODE;
$new.=$ss3;
$new.=SECRET_CODE;
$new.=$ss4;
$new.=SECRET_CODE;
$new.=$ss5;
$new.=SECRET_CODE;
$new.=$ss6;
$new.=SECRET_CODE;
$new.=$ss7;
$new.=SECRET_CODE;
$new.=$ss8;
$new.=SECRET_CODE;
$new.=$ss9;
$new.=SECRET_CODE;
$new.=$ss10;
$new.=SECRET_CODE;
$new.=$ss11;
$new.=SECRET_CODE;
$new.=$ss12;
$new.=SECRET_CODE;
$new.=$_SERVER['REMOTE_ADDR'];
$new.=SECRET_CODE;
$new.=$ss13;
$new.=SECRET_CODE;
$new.="\n";
$new.=$old;
file_put_contents("./rsty/shout.txt",$new);
$ttta="bb";
$newcode=md5($code);
file_put_contents("./rsty/code2.txt", $newcode);
$code=$newcode;
}
}
$shout=file(path.'rsty/shout.txt');
$n=-20;
$text=array();
if($_GET['id']+0<0)$_GET['id']=0;
$_GET["id"]=floor($_GET["id"]);
$sn=0+$_GET["id"];
$snn2=$sn+16;
$snn3=$sn+15;
if(trim($shout[$snn3])==""){
$count=count($shout);
$count--;
$sn=$count-15;
$_GET["id"]=$sn;
}

if($shout[$snn2]!=""){
echo'
<quad manialink="'.$ml.'?id='.($_GET["id"]+10).'" posn="39.05 -7 42.91" sizen="2.22 3.751" halign="left" valign="top" image="'.fpath.'header/unten.png" imagefocus="'.fpath.'header/unten2.png" />
';
} else {
echo'
<quad action="1" posn="39.05 -7 42.91" sizen="2.22 3.751" halign="left" valign="top" image="'.fpath.'header/unten.png" imagefocus="'.fpath.'header/unten2.png" />
';
}
for($i=13;$i>=$n+2;$i-=2){
$text[$i]=explode(SECRET_CODE,$shout[$sn]);
$smm1=$text[$i]['3'];
$smm2=$text[$i]['4'];
$smm3=$text[$i]['5'];
$smm4=$text[$i]['6'];
$smm5=$text[$i]['7'];
$smm6=$text[$i]['8'];
$smm7=$text[$i]['9'];
$smm8=$text[$i]['10'];
$smm9=$text[$i]['11'];
$smm10=$text[$i]['12'];
$smm11=$text[$i]['13'];
$smm12=$text[$i]['14'];
if($text[$i]['16']==""){
$cn=$text[$i]['2']*$text[$i]['2']%6;
$cn2=($cn*$text[$i]['2']*8-3)%6;
$text[$i]['16']=$text[$i]['15'][$cn2].$text[$i]['15'][$cn].$text[$i]['15'][0];
$text[$i]['16']=str_replace(".",'F',$text[$i]['16']);
if($text[$i]['16'][2]=="" or $text[$i]['16'][1]=="" or $text[$i]['16'][0]=="")$text[$i]['16']="FFF";
}
$color_now=$text[$i]['16'];
$text[$i][0]=str_replace('\"','&quot;',$text[$i][0]);
$text[$i][0]=str_replace("\'",'&apos;',$text[$i][0]);
$text[$i][1]=str_replace('\"','&quot;',$text[$i][1]);
$text[$i][1]=str_replace("\'",'&apos;',$text[$i][1]);
$text[$i][2]=str_replace('\"','&quot;',$text[$i][2]);
$text[$i][2]=str_replace("\'",'&apos;',$text[$i][2]);
//<label style="TextCardSmallScores2" posn="-35 '.$i.' 3" sizen="71 3.2" halign="left" valign="center" text="'.$shout[$i].'test" />
$exs2_=0;
if($text[$i][2]=='doNAte'){
// style="TextTitle2Blink"
$exs2_=1;
$exs=0;
echo '
<label textsize="0.9" style="TextInfoSmall" posn="-35 '.$i.' 9" sizen="13.1 2.2" halign="left" valign="center" text="'.$text[$i][0].'" />
<quad posn="-8 '.$i.' 9" sizen="3 3" halign="right" valign="center" style="Icons128x128_1" substyle="Coppers"/>
<label textsize="2.7" posn="-21 '.$i.' 9" sizen="56 3.2" halign="left" valign="center" text="';if($text[$i][2] !="news" && $text[$i][3] !="news"){echo''.trim($_SESSION["spendete"][$la]).' : '; $exs=4;} else { echo'$o$i'.$text[$i][1]; } echo'" />
';
if($exs==4){
echo'<label style="TextCardSmallScores2" posn="'.(-21+11.5).' '.$i.' 9" sizen="56 3.2" halign="center" valign="center" text="$o$i'.$text[$i][1].'" />';
}
} else {
// style="TextCardSmallScores2" 
$text[$i][0]=str_replace('$z','$z$'.$color_now.'',$text[$i][0]);
$text[$i][0]=str_replace('$g','$g$'.$color_now.'',$text[$i][0]);
echo '
<label style="TextCardSmallScores2" posn="-35 '.$i.' 9" sizen="12 3.2" halign="left" valign="center" text="'.$text[$i][1].'" />
<label textsize="2.7" textcolor="'.$color_now.'" posn="-21 '.$i.' 39" sizen="56 3.2" halign="left" valign="center" text="'.$text[$i][0].'" />
';
}
if($exs2_!=1){
$ssm1=$smm1+0;
if($smyl[$ssm1]!=""){
echo'
<quad image="'.fpath.'smily/'.$smyl[$smm1].'.bik" posn="-20 '.$i.' 4.1" sizen="3.5 3" halign="center" valign="center" />
';
}
$ssm2=$smm2+0;
if($smyl[$ssm2]!=""){
echo'
<quad image="'.fpath.'smily/'.$smyl[$ssm2].'.bik" posn="-15 '.$i.' 4.1" sizen="3.5 3" halign="center" valign="center" />
';
}
$ssm3=$smm3+0;
if($smyl[$ssm3]!=""){
echo'
<quad image="'.fpath.'smily/'.$smyl[$ssm3].'.bik" posn="-10 '.$i.' 4.1" sizen="3.5 3" halign="center" valign="center" />
';
}
$ssm4=$smm4+0;
if($smyl[$ssm4]!=""){
echo'
<quad image="'.fpath.'smily/'.$smyl[$ssm4].'.bik" posn="-5 '.$i.' 4.1" sizen="3.5 3" halign="center" valign="center" />
';
}
$ssm5=$smm5+0;
if($smyl[$ssm5]!=""){
echo'
<quad image="'.fpath.'smily/'.$smyl[$ssm5].'.bik" posn="0 '.$i.' 4.1" sizen="3.5 3" halign="center" valign="center" />
';
}
$ssm6=$smm6+0;
if($smyl[$ssm6]!=""){
echo'
<quad image="'.fpath.'smily/'.$smyl[$ssm6].'.bik" posn="5 '.$i.' 4.1" sizen="3.5 3" halign="center" valign="center" />
';
}
$ssm7=$smm7+0;
if($smyl[$ssm7]!=""){
echo'
<quad image="'.fpath.'smily/'.$smyl[$ssm7].'.bik" posn="10 '.$i.' 4.1" sizen="3.5 3" halign="center" valign="center" />
';}
$ssm8=$smm8+0;
if($smyl[$ssm8]!=""){
echo'
<quad image="'.fpath.'smily/'.$smyl[$ssm8].'.bik" posn="15 '.$i.' 4.1" sizen="3.5 3" halign="center" valign="center" />
';}
$ssm9=$smm9+0;
if($smyl[$ssm9]!=""){
echo'
<quad image="'.fpath.'smily/'.$smyl[$ssm9].'.bik" posn="20 '.$i.' 4.1" sizen="3.5 3" halign="center" valign="center" />
';}
$ssm10=$smm10+0;
if($smyl[$ssm10]!=""){
echo'
<quad image="'.fpath.'smily/'.$smyl[$ssm10].'.bik" posn="25 '.$i.' 4.1" sizen="3.5 3" halign="center" valign="center" />
';}
$ssm11=$smm11+0;
if($smyl[$ssm11]!=""){
echo'
<quad image="'.fpath.'smily/'.$smyl[$ssm11].'.bik" posn="30 '.$i.' 4.1" sizen="3.5 3" halign="center" valign="center" />
';}
$ssm12=$smm12+0;
if($ssm12>1){
echo'
<quad image="'.fpath.'smily/'.$smyl[$ssm12].'.bik" posn="35 '.$i.' 4.1" sizen="3.5 3" halign="center" valign="center" />
';
}
}
$sn++;
}
$www=utf8_decode($_GET['write']);
//./style2/new/country/blue.png
$frame1=4;
$setttings=sett("1");
if(!empty($setttings["set6"])){
echo'
<quad posn="0 -3.5 2.9" sizen="95 66" halign="center" valign="center" image="'.fpath.'style2/new/country/'.$setttings["set6"].'" />
';
} else {
echo'
<quad posn="0 -3.5 2.9" sizen="95 66" halign="center" valign="center" image="'.fpath.'style2/new/country/blue.png" />
';
}


//zufallsding
$colors=array('0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F');
$coc=count($colors);
$coc--;
$cc1=rand(0, $coc);
$cc2=rand(0, $coc);
$cc3=rand(0, $coc);
if($cc1<6 && $cc2<6 && $cc3<6){
$cc1+=7;
$cc2+=4;
$cc3+=2;
}
$c1=$colors[$cc1];
$c2=$colors[$cc2];
$c3=$colors[$cc3];

$color=$c1.$c2.$c3;
//zufallscolorend

// style="TextCardSmallScores2"
echo '

<quad posn="'.(-23+0).' '.(-23.4+$frame1).' 2.91" sizen="60 6.2" halign="left" valign="top" style="Bgs1InRace" substyle="BgWindow1" />
<entry textsize="2.7" focusareacolor1="0A60" focusareacolor2="FFF0" textcolor="'.$color.'" posn="-21 '.(-25+$frame1).' 10" sizen="55.5 3.2" halign="left" default="'.$www.'" valign="center" name="shout" />
<label style="TextCardSmallScores2" posn="-35 '.(-25+$frame1).' 3" sizen="12 3.2" halign="left" valign="center" text="'.$_SESSION['nickname'].'" />
<label style="CardButtonMedium" posn="7 '.(-28+$frame1).' 3" sizen="2.6 2.6" manialink="'.$ml.'?page=home&amp;code='.$code.'&amp;';if(!empty($_GET['s1'])){echo's1='.$_GET['s1'].'&amp;';}if(!empty($_GET['s2'])){echo's2='.$_GET['s2'].'&amp;';}if(!empty($_GET['s3'])){echo's3='.$_GET['s3'].'&amp;';}if(!empty($_GET['s4'])){echo's4='.$_GET['s4'].'&amp;';}if(!empty($_GET['s5'])){echo's5='.$_GET['s5'].'&amp;';}if(!empty($_GET['s6'])){echo's6='.$_GET['s6'].'&amp;';}if(!empty($_GET['s7'])){echo's7='.$_GET['s7'].'&amp;';}if(!empty($_GET['s8'])){echo's8='.$_GET['s8'].'&amp;';}if(!empty($_GET['s9'])){echo's9='.$_GET['s9'].'&amp;';}if(!empty($_GET['s10'])){echo's10='.$_GET['s10'].'&amp;';}if(!empty($_GET['s11'])){echo's11='.$_GET['s11'].'&amp;';}if(!empty($_GET['s12'])){echo's12='.$_GET['s12'].'&amp;';}echo'shout=shout&amp;color='.$color.'" ';if($vvv=="a"){ echo 'addplayerid="1"'; }echo' halign="center" valign="center" text="SHOUT" />
<quad image="'.fpath.'smily/wand.bik" 
manialink="'.$ml.'?page=home&amp;';if(!empty($_GET['s1'])){echo's1='.$_GET['s1'].'&amp;';}if(!empty($_GET['s2'])){echo's2='.$_GET['s2'].'&amp;';}if(!empty($_GET['s3'])){echo's3='.$_GET['s3'].'&amp;';}if(!empty($_GET['s4'])){echo's4='.$_GET['s4'].'&amp;';}if(!empty($_GET['s5'])){echo's5='.$_GET['s5'].'&amp;';}if(!empty($_GET['s6'])){echo's6='.$_GET['s6'].'&amp;';}if(!empty($_GET['s7'])){echo's7='.$_GET['s7'].'&amp;';}if(!empty($_GET['s8'])){echo's8='.$_GET['s8'].'&amp;';}if(!empty($_GET['s9'])){echo's9='.$_GET['s9'].'&amp;';}if(!empty($_GET['s10'])){echo's10='.$_GET['s10'].'&amp;';}if(!empty($_GET['s11'])){echo's11='.$_GET['s11'].'&amp;';}if(!empty($_GET['s12'])){echo's12='.$_GET['s12'].'&amp;';}echo'set=1&amp;write=shout"
 posn="-20 '.(-28+$frame1).' 3.1" sizen="2.6 2.6" halign="center" valign="center" />
<quad image="'.fpath.'smily/schuss.bik" 
manialink="'.$ml.'?page=home&amp;';if(!empty($_GET['s1'])){echo's1='.$_GET['s1'].'&amp;';}if(!empty($_GET['s2'])){echo's2='.$_GET['s2'].'&amp;';}if(!empty($_GET['s3'])){echo's3='.$_GET['s3'].'&amp;';}if(!empty($_GET['s4'])){echo's4='.$_GET['s4'].'&amp;';}if(!empty($_GET['s5'])){echo's5='.$_GET['s5'].'&amp;';}if(!empty($_GET['s6'])){echo's6='.$_GET['s6'].'&amp;';}if(!empty($_GET['s7'])){echo's7='.$_GET['s7'].'&amp;';}if(!empty($_GET['s8'])){echo's8='.$_GET['s8'].'&amp;';}if(!empty($_GET['s9'])){echo's9='.$_GET['s9'].'&amp;';}if(!empty($_GET['s10'])){echo's10='.$_GET['s10'].'&amp;';}if(!empty($_GET['s11'])){echo's11='.$_GET['s11'].'&amp;';}if(!empty($_GET['s12'])){echo's12='.$_GET['s12'].'&amp;';}echo'set=2&amp;write=shout"
 posn="-15 '.(-28+$frame1).' 3.1" sizen="2.6 2.5" halign="center" valign="center" />
<quad image="'.fpath.'smily/freu.bik" posn="-10 '.(-28+$frame1).' 3.1" sizen="2.6 2.6" halign="center" valign="center" 
manialink="'.$ml.'?page=home&amp;';if(!empty($_GET['s1'])){echo's1='.$_GET['s1'].'&amp;';}if(!empty($_GET['s2'])){echo's2='.$_GET['s2'].'&amp;';}if(!empty($_GET['s3'])){echo's3='.$_GET['s3'].'&amp;';}if(!empty($_GET['s4'])){echo's4='.$_GET['s4'].'&amp;';}if(!empty($_GET['s5'])){echo's5='.$_GET['s5'].'&amp;';}if(!empty($_GET['s6'])){echo's6='.$_GET['s6'].'&amp;';}if(!empty($_GET['s7'])){echo's7='.$_GET['s7'].'&amp;';}if(!empty($_GET['s8'])){echo's8='.$_GET['s8'].'&amp;';}if(!empty($_GET['s9'])){echo's9='.$_GET['s9'].'&amp;';}if(!empty($_GET['s10'])){echo's10='.$_GET['s10'].'&amp;';}if(!empty($_GET['s11'])){echo's11='.$_GET['s11'].'&amp;';}if(!empty($_GET['s12'])){echo's12='.$_GET['s12'].'&amp;';}echo'set=3&amp;write=shout" />
<quad image="'.fpath.'smily/leptop.bik" posn="23 '.(-28+$frame1).' 3.1" sizen="2.6 2.5" halign="center" valign="center" 
manialink="'.$ml.'?page=home&amp;';if(!empty($_GET['s1'])){echo's1='.$_GET['s1'].'&amp;';}if(!empty($_GET['s2'])){echo's2='.$_GET['s2'].'&amp;';}if(!empty($_GET['s3'])){echo's3='.$_GET['s3'].'&amp;';}if(!empty($_GET['s4'])){echo's4='.$_GET['s4'].'&amp;';}if(!empty($_GET['s5'])){echo's5='.$_GET['s5'].'&amp;';}if(!empty($_GET['s6'])){echo's6='.$_GET['s6'].'&amp;';}if(!empty($_GET['s7'])){echo's7='.$_GET['s7'].'&amp;';}if(!empty($_GET['s8'])){echo's8='.$_GET['s8'].'&amp;';}if(!empty($_GET['s9'])){echo's9='.$_GET['s9'].'&amp;';}if(!empty($_GET['s10'])){echo's10='.$_GET['s10'].'&amp;';}if(!empty($_GET['s11'])){echo's11='.$_GET['s11'].'&amp;';}if(!empty($_GET['s12'])){echo's12='.$_GET['s12'].'&amp;';}echo'set=4&amp;write=shout" />
<quad image="'.fpath.'smily/trauer.bik" posn="28 '.(-28+$frame1).' 3.1" sizen="2.6 2.6" halign="center" valign="center" 
manialink="'.$ml.'?page=home&amp;';if(!empty($_GET['s1'])){echo's1='.$_GET['s1'].'&amp;';}if(!empty($_GET['s2'])){echo's2='.$_GET['s2'].'&amp;';}if(!empty($_GET['s3'])){echo's3='.$_GET['s3'].'&amp;';}if(!empty($_GET['s4'])){echo's4='.$_GET['s4'].'&amp;';}if(!empty($_GET['s5'])){echo's5='.$_GET['s5'].'&amp;';}if(!empty($_GET['s6'])){echo's6='.$_GET['s6'].'&amp;';}if(!empty($_GET['s7'])){echo's7='.$_GET['s7'].'&amp;';}if(!empty($_GET['s8'])){echo's8='.$_GET['s8'].'&amp;';}if(!empty($_GET['s9'])){echo's9='.$_GET['s9'].'&amp;';}if(!empty($_GET['s10'])){echo's10='.$_GET['s10'].'&amp;';}if(!empty($_GET['s11'])){echo's11='.$_GET['s11'].'&amp;';}if(!empty($_GET['s12'])){echo's12='.$_GET['s12'].'&amp;';}echo'set=5&amp;write=shout" />
<quad image="'.fpath.'smily/luck.bik" posn="33 '.(-28+$frame1).' 3.1" sizen="2.6 2.6" halign="center" valign="center" 
manialink="'.$ml.'?page=home&amp;';if(!empty($_GET['s1'])){echo's1='.$_GET['s1'].'&amp;';}if(!empty($_GET['s2'])){echo's2='.$_GET['s2'].'&amp;';}if(!empty($_GET['s3'])){echo's3='.$_GET['s3'].'&amp;';}if(!empty($_GET['s4'])){echo's4='.$_GET['s4'].'&amp;';}if(!empty($_GET['s5'])){echo's5='.$_GET['s5'].'&amp;';}if(!empty($_GET['s6'])){echo's6='.$_GET['s6'].'&amp;';}if(!empty($_GET['s7'])){echo's7='.$_GET['s7'].'&amp;';}if(!empty($_GET['s8'])){echo's8='.$_GET['s8'].'&amp;';}if(!empty($_GET['s9'])){echo's9='.$_GET['s9'].'&amp;';}if(!empty($_GET['s10'])){echo's10='.$_GET['s10'].'&amp;';}if(!empty($_GET['s11'])){echo's11='.$_GET['s11'].'&amp;';}if(!empty($_GET['s12'])){echo's12='.$_GET['s12'].'&amp;';}echo'set=6&amp;write=shout" />
';
if($_GET["id"]>=10){
echo'
<quad manialink="'.$ml;if($_GET["id"]>=2)echo'?id='.($_GET["id"]-10);echo'" posn="39.05 7 42.91" sizen="2.22 3.751" halign="left" valign="top" image="'.fpath.'header/oben.png" imagefocus="'.fpath.'header/oben2.png" />
';
}else{
echo'
<quad manialink="'.$ml.'" posn="39.05 7 42.91" sizen="2.22 3.751" halign="left" valign="top" image="'.fpath.'header/oben.png" action="1" imagefocus="'.fpath.'header/oben2.png" />
';
}
if($_GET['set']!=""){
$pp=-20;
$a=$_GET['set'];
for($i=1;$i<=12;$i++){
echo'
<quad manialink="'.$ml.'?page=home&amp;';
if($_GET['s1']!=""&&$i!="1"){echo's1='.$_GET['s1'].'&amp;';}if($_GET['s2']!=""&&$i!="2"){echo's2='.$_GET['s2'].'&amp;';}if($_GET['s3']!=""&&$i!="3"){echo's3='.$_GET['s3'].'&amp;';}if($_GET['s4']!=""&&$i!="4"){echo's4='.$_GET['s4'].'&amp;';}if($_GET['s5']!=""&&$i!="5"){echo's5='.$_GET['s5'].'&amp;';}if($_GET['s6']!=""&&$i!="6"){echo's6='.$_GET['s6'].'&amp;';}if($_GET['s7']!=""&&$i!="7"){echo's7='.$_GET['s7'].'&amp;';}if($_GET['s8']!=""&&$i!="8"){echo's8='.$_GET['s8'].'&amp;';}if($_GET['s9']!=""&&$i!="9"){echo's9='.$_GET['s9'].'&amp;';}if($_GET['s10']!=""&&$i!="10"){echo's10='.$_GET['s10'].'&amp;';}if($_GET['s11']!=""&&$i!="11"){echo's11='.$_GET['s11'].'&amp;';}if($_GET['s12']!=""&&$i!="12"){echo's12='.$_GET['s12'].'&amp;';}
echo's'.$i.'='.$a.'&amp;write=shout" image="'.fpath.'smily/n.png" imagefocus="'.fpath.'smily/'.$smyl[$a].'.bik" posn="'.$pp.' '.(-25+$frame1).' 44.1" sizen="3.5 3" halign="center" valign="center" />
';
$pp+=5;
}
}
$pp=-20;
if($_GET['shout']==""){
for($i=1;$i<=12;$i++){
$ss=s;
$ss.=$i;
if($_GET[$ss]!=""){
$aamm=$_GET[$ss];
echo '
<quad image="'.fpath.'smily/'.$smyl[$aamm].'.bik" posn="'.$pp.' '.(-25+$frame1).' 4.1" sizen="3.5 3" halign="center" valign="center" />
';
}
$pp+=5;
}
}
echo'
</frame>
';
//'.fpath.'smily/fenster.bik
?>