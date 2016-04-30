<?php
$yourlink = $_GET["ylink"];
$yourname = $_GET["yname"];
$id = $_GET["id"];
if($id == ""){
$id = 0;
}
$did = $id * 18;
$idm = $id - 1;
$idp = $id + 1;
$idpp = $id + 2;
echo'<frame posn="'.$mainframeposn.'">';
$link=file('data/linkdata.txt');
$link[0]=explode("|",$link[0 + $did]);
$link[1]=explode("|",$link[1 + $did]);
$link[2]=explode("|",$link[2 + $did]);
$link[3]=explode("|",$link[3 + $did]);
$link[4]=explode("|",$link[4 + $did]);
$link[5]=explode("|",$link[5 + $did]);
$link[6]=explode("|",$link[6 + $did]);
$link[7]=explode("|",$link[7 + $did]);
$link[8]=explode("|",$link[8 + $did]);
$link[9]=explode("|",$link[9 + $did]);
$link[10]=explode("|",$link[10 + $did]);
$link[11]=explode("|",$link[11 + $did]);
$link[12]=explode("|",$link[12 + $did]);
$link[13]=explode("|",$link[13 + $did]);
$link[14]=explode("|",$link[14 + $did]);
$link[15]=explode("|",$link[15 + $did]);
$link[16]=explode("|",$link[16 + $did]);
$link[17]=explode("|",$link[17 + $did]);
echo'
<label posn="-35 25 3" style="TextRankingsBig">$i'.$maincolor.'Links :</label>
<quad posn="-35 20 3" sizen="45 05" style="BgsPlayerCard" substyle="BgPlayerName"/>
<quad posn="-35 14.5 3" sizen="45 05" style="BgsPlayerCard" substyle="BgPlayerName"/>
<quad posn="-35 9 3" sizen="45 05" style="BgsPlayerCard" substyle="BgPlayerName"/>
<quad posn="-35 3.5 3" sizen="45 05" style="BgsPlayerCard" substyle="BgPlayerName"/>
<quad posn="-35 -2 3" sizen="45 05" style="BgsPlayerCard" substyle="BgPlayerName"/>
<quad posn="-35 -7.5 3" sizen="45 05" style="BgsPlayerCard" substyle="BgPlayerName"/>
<quad posn="-35 -13 3" sizen="45 05" style="BgsPlayerCard" substyle="BgPlayerName"/>
<quad posn="-35 -18.5 3" sizen="45 05" style="BgsPlayerCard" substyle="BgPlayerName"/>
<quad posn="-35 -24 3" sizen="45 05" style="BgsPlayerCard" substyle="BgPlayerName"/>
<quad posn="12 20 3" sizen="45 05" style="BgsPlayerCard" substyle="BgPlayerName"/>
<quad posn="12 14.5 3" sizen="45 05" style="BgsPlayerCard" substyle="BgPlayerName"/>
<quad posn="12 9 3" sizen="45 05" style="BgsPlayerCard" substyle="BgPlayerName"/>
<quad posn="12 3.5 3" sizen="45 05" style="BgsPlayerCard" substyle="BgPlayerName"/>
<quad posn="12 -2 3" sizen="45 05" style="BgsPlayerCard" substyle="BgPlayerName"/>
<quad posn="12 -7.5 3" sizen="45 05" style="BgsPlayerCard" substyle="BgPlayerName"/>
<quad posn="12 -13 3" sizen="45 05" style="BgsPlayerCard" substyle="BgPlayerName"/>
<quad posn="12 -18.5 3" sizen="45 05" style="BgsPlayerCard" substyle="BgPlayerName"/>
<quad posn="12 -24 3" sizen="45 05" style="BgsPlayerCard" substyle="BgPlayerName"/>
<label posn="-33 18.5 4" style="TextButtonSmall" manialink="'.$link[0][0].'">'.$color2.''.$link[0][1].'</label>
<label posn="-33 13 4" style="TextButtonSmall" manialink="'.$link[1][0].'">'.$color2.''.$link[1][1].'</label>
<label posn="-33 7.5 4" style="TextButtonSmall" manialink="'.$link[2][0].'">'.$color2.''.$link[2][1].'</label>
<label posn="-33 2 4" style="TextButtonSmall" manialink="'.$link[3][0].'">'.$color2.''.$link[3][1].'</label>
<label posn="-33 -3.5 4" style="TextButtonSmall" manialink="'.$link[4][0].'">'.$color2.''.$link[4][1].'</label>
<label posn="-33 -9 4" style="TextButtonSmall" manialink="'.$link[5][0].'">'.$color2.''.$link[5][1].'</label>
<label posn="-33 -14.5 4" style="TextButtonSmall" manialink="'.$link[6][0].'">'.$color2.''.$link[6][1].'</label>
<label posn="-33 -20 4" style="TextButtonSmall" manialink="'.$link[7][0].'">'.$color2.''.$link[7][1].'</label>
<label posn="-33 -25.5 4" style="TextButtonSmall" manialink="'.$link[8][0].'">'.$color2.''.$link[8][1].'</label>
<label posn="14 18.5 4" style="TextButtonSmall" manialink="'.$link[9][0].'">'.$color2.''.$link[9][1].'</label>
<label posn="14 13 4" style="TextButtonSmall" manialink="'.$link[10][0].'">'.$color2.''.$link[10][1].'</label>
<label posn="14 7.5 4" style="TextButtonSmall" manialink="'.$link[11][0].'">'.$color2.''.$link[11][1].'</label>
<label posn="14 2 4" style="TextButtonSmall" manialink="'.$link[12][0].'">'.$color2.''.$link[12][1].'</label>
<label posn="14 -3.5 4" style="TextButtonSmall" manialink="'.$link[13][0].'">'.$color2.''.$link[13][1].'</label>
<label posn="14 -9 4" style="TextButtonSmall" manialink="'.$link[14][0].'">'.$color2.''.$link[14][1].'</label>
<label posn="14 -14.5 4" style="TextButtonSmall" manialink="'.$link[15][0].'">'.$color2.''.$link[15][1].'</label>
<label posn="14 -20 4" style="TextButtonSmall" manialink="'.$link[16][0].'">'.$color2.''.$link[16][1].'</label>
<label posn="14 -25.5 4" style="TextButtonSmall" manialink="'.$link[17][0].'">'.$color2.''.$link[17][1].'</label>
<entry posn="-33 -30 4" sizen="20 3" style="TextButtonSmall" name="$llink" default="Link"/>
<entry posn="14 -30 4" sizen="20 3" style="TextButtonSmall" name="$linkname" default="Link-Name"/>
<label posn="30 -30 4" style="TextButtonSmall" manialink="rsty?mainpage=links&amp;ylink=$llink&amp;yname=$linkname">$oAdd your ML!$z</label>
</frame>';
if($link[17 + $did] != "") {
echo '<label posn="35 25.5 4" style="TextButtonSmall" manialink="rsty?mainpage=links&amp;id='.$idp.'">Seite '.$idpp.'</label>';
}
if($id != 0) {
echo '<label posn="25 25.5 4" style="TextButtonSmall" manialink="rsty?mainpage=links&amp;id='.$idm.'">Seite '.$id.'</label>';
}
if(!empty($_GET["ylink" ]) && $_GET["ylink"] != "Link"){
$dateis=fopen('data/linkdata.txt','a');
  fputs($dateis,"\n");
  fputs($dateis,$yourlink);
  fputs($dateis,"|");
  fputs($dateis,$yourname);
fclose($dateis);
}
echo '
<quad posn="24 27 0.1" sizen="21 5" style="BgsPlayerCard" substyle="BgPlayerName"/>
';
echo '
<quad posn="-35 -29 0.1" sizen="77 4" style="BgsPlayerCard" substyle="BgPlayerName"/>
';
?>