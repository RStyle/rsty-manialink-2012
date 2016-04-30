<?php
class ViewPHPCode extends Syntaxparser {
	var $offset;
	var $rows_file;
	function search_includes ($construct, $where) {
		$position = strpos($where, $construct.'(', $this->offset);
		if ($position) return $position;
		return $this->offset;
	}

	function highlight ($file) {
		$file = @highlight_file($file, true);
		if (!$file) return false;
		$replace = array("<code>", "</code>", "</span>", '<span style="color: #000">');
		$file = str_replace($replace, "", $file);
		$file = str_replace("<br />", "\n", $file);
		$this->rows_file = isset($this->rows_file) ? $this->rows_file : substr_count($file, "\n");
		$file = str_replace("&nbsp;", " ", $file);
		$file = str_replace('$', '$$', $file);
		$file = preg_replace('/<span style="color: #([0-9A-Fa-f]{3})">/', '$$1', $file);
		$file = wordwrap($file, 140);
		$this->offset = $end = 0;
		while (($this->offset = $this->search_includes("include", $file)) != $end OR ($this->offset = $this->search_includes("require", $file)) != $end
				OR ($this->offset = $this->search_includes("include_once", $file)) != $end OR ($this->offset = $this->search_includes("require_once", $file)) != $end) {
			$this->offset = strpos($file, cfg::color_value, $this->offset) + 5;
			$end = strpos($file, substr($file, $this->offset-1, 1), $this->offset);
			$include_file = substr($file, $this->offset, $end-$this->offset);
			if (!stristr($include_file, "syntaxparser") AND !isset($_GET['noincludes'])) {
				$include_file = $this->highlight($include_file);
				if ($file) {
					$include_file = explode("\n", $include_file);
					foreach ($include_file as $key => $row) $include_file[$key] = '$&lt;$FFF &gt;   $&gt;'.$row;
					$include_file = implode("\n", $include_file);
					$include_file = str_replace('$&gt;$&lt;$FFF', '', $include_file);
					$insert_position = strpos($file, "\n", $end) + 1;
					$file = substr($file, 0, $insert_position) . '$&lt;$FFF' . $include_file . '$&gt;' . substr($file, $insert_position);
				}
			}
			$this->offset = $end;
		}
		return $file;
	}
	function __construct() {
		parent::__construct();
		$parsingtime = microtime(true);
		ini_set("highlight.string",  "#".substr(cfg::color_value, 1));
		ini_set("highlight.comment", "#".substr(cfg::color_comment, 1));
		ini_set("highlight.keyword", "#".substr(cfg::color_tagname, 1));
		ini_set("highlight.default", "#".substr(cfg::color_attribute, 1));
		ini_set("highlight.html", "#000");
		set_time_limit(1);
		
		$line = isset($_GET['line']) ? (int) $_GET['line'] : 0;
		$file = $this->highlight($_SERVER['SCRIPT_FILENAME']);
		$file = explode("\n", $file);
		$rows = count($file);
		$file = array_slice($file, $line, 30);
		$file = implode("\n", $file);
		$narrow = isset($_GET['narrow']) ? '$n' : '';
		echo '<?xml version="1.0" encoding="UTF-8" ?>
		<manialink>
		<timeout>0</timeout>
		<quad posn="-58 40 -1" sizen="116 80" style="Bgs1InRace" substyle="BgList" />';
		for ($i=1;$i<31;$i++) {
			echo '<label posn="-54 '.(($i-1)*-2.44+38).'" textsize="2" halign="right" text="'.($i+$line).'" />';
		}
		$url = $this->url.'sp_php_source' . (isset($_GET['narrow']) ? "&amp;narrow" : "") . (isset($_GET['noincludes']) ? "&amp;noincludes" : "");
		echo '<label posn="-53 38" textsize="2" sizen="114" scale="0.95">'.$narrow.$file.'</label>
		<label posn="0 -35" halign="center" textsize="2" text="Zeile '.($line+1).' bis '.($line+30).' von '.$this->rows_file.' (File) / '.$rows.' (Entire Code)" />
		<label posn="0 -37" halign="center" textsize="1" text="Parsing time: '.round(microtime(true)-$parsingtime, 5).' Seconds" />';
		if ($line) 
			echo '<quad posn="-23 -35" sizen="3 3" style="Icons64x64_1" substyle="ArrowPrev" manialink="'.$url.'&amp;line='.($line-30).'" />
			<quad posn="-27 -35" sizen="3 3" style="Icons64x64_1" substyle="ArrowFirst" manialink="'.$url.'" />';
		$_GET['frames'] = (int) @$_GET['frames'];
		if ($line+30 < $rows) 
			echo '<quad posn="20 -35" sizen="3 3" style="Icons64x64_1" substyle="ArrowNext" manialink="'.$url.'&amp;line='.($line+30).'" />
			<quad posn="24 -35" sizen="3 3" style="Icons64x64_1" substyle="ArrowLast" manialink="'.$url.'&amp;line='.($rows-30).'" />';
		$include_link = isset($_GET['noincludes']) ? '$h['.str_replace("&amp;noincludes", "", $url).']Enable Includes$h' : '$h['.$url.'&amp;noincludes]Disable Includes$h';
		$narrow_link  = isset($_GET['narrow'])     ? '$h['.str_replace("&amp;narrow", "", $url).']Normal code$h'         : '$h['.$url.'&amp;narrow]Narrow code$h';
		echo'<label posn="-55 -35.5" textsize="2" text="$h['.$this->url.']Exit$h | $h['.$this->url.'sp_source]View XML source$h" />
		<label posn="55 -35.5" halign="right" textsize="2" text="'.$include_link.' | '.$narrow_link.'" />
		</manialink>';
	}
}
?>