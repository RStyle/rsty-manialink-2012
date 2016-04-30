<manialink>
<timeout>0</timeout>
<?php
require "config.php";

$startpos = 63;

$num = 0;

$graph = "";
$sql = mysql_query("SELECT id,daynum,num_visits,date FROM manializer_days ORDER by `id` DESC");
while($row = mysql_fetch_array($sql)) {
$size = $row['num_visits'];

$num = $num + 1;

$col = rand(111, 999);

$graph .= "  <quad posn=\"".$startpos." -47 1.75\" sizen=\"0.2 ".$size."\" valign=\"bottom\" bgcolor=\"".$col."F\" />\n";
$startpos = $startpos - 0.2;

if($num == 20)
{
$graph .= "  <label posn=\"".$startpos." 0 3\" sizen=\"3.5 3\" valign=\"bottom\" text=\"".$row['daynum'].".".$row['date']."\" />\n";
$num = 0;
}

}

echo $graph;

?>
</manialink>