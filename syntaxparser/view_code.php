<?php
class ViewCode extends Syntaxparser {
	function view_source($file) {
		set_time_limit(1);
		$return = "";
		$parsingtime = microtime(true);
		$rows = $grows = (substr_count($file, "\n")+1);

		$file = str_replace ("	", "     ", $file);
		$file = explode("\n", $file);
		$frames = isset($_GET['frames']) ? $_GET['frames'] : 0;
		$indent = 0;
		$max = 138;
		$gap = array();
		$repeat = false;
		for ($key=0;$key<31;$key++) {
			if (!array_key_exists($key, $file)) break;
			$row = $file[$key];
			$row = preg_replace('/^\s+/', "", $row);
			if (!$repeat) $frames -= substr_count($row, "</frame>");
			$row = @str_repeat("   ", $frames).$row;
			if (!$repeat) $frames += substr_count($row, "<frame");
			$row = wordwrap($row, $max);
			$rows = explode("\n", $row);
			if(isset($rows[1])) {
				if (strlen($rows[1]) > $max) {
					$rows[1] = substr($rows[1], 0, $max-6)." ".substr($rows[1], $max-6);
				}
				$file[$key-1] .= "\n".$rows[0];
				$file[$key] = "   ".implode(" ", array_slice($rows, 1));
				$gap[$key+2+array_sum($gap)] = true;
				$key--;
				$repeat = true;
			} else {
				$file[$key] = $row;
				$repeat = false;
			}
		}
		ksort($file);
		$result_file = array();
		foreach ($file as $row) {
			$row = explode("\n", $row);
			foreach ($row as $real_row) $result_file[] = $real_row; 
		}
		$file = $result_file;
		$grows = count($file);
		//foreach ($file as $key => $row) $return .= "$key: ".htmlspecialchars($row)." <br />\n";
		if (isset($_GET['highlight'])) {
			$highlight = (int) $_GET['highlight'];
			if ($_GET['position'] > strlen($file[$highlight])) {
				$count = strlen($file[$highlight]);
				$id = 1;
				while (($count += strlen($file[$highlight+$id])) < $_GET['position']) $id++;
				$highlight_line = $id;
			} else $highlight_line = 0;
			$line = ($highlight + $highlight_line - 10 >= 0 AND $grows > 30) ? $highlight + $highlight_line - 10 : 0;
		} else $line = (isset($_GET['line']) AND $_GET['line'] > 0) ? $_GET['line'] : 0;
		$file = array_slice($file, $line);
		$file = implode("\n", $file);
		$return .= "Highlight: $highlight; Highlight Line: $highlight_line; Line: $line";

		$file = str_replace ('$', '$$', $file);
		$file = preg_replace('/\$\$([a-f0-9]{3}|[ownt])/i', '\$<\$s\$$1\$\$$1\$>', $file);
		$file = str_replace ('$$i', '$<$i$$i $>', $file);
		$file = preg_replace('/\$(\$[szmg])/i', '$<$s$$1$>', $file);
		$file = preg_replace('/\$\$([lhp])/i', '\$<\$s\$$1[]\$\$$1\$>', $file);
		$file = str_replace ("<!--", cfg::color_comment.'<!--', $file);
		$file = str_replace ("-->", '-->$g', $file);
		
		preg_match_all('/(<\/|<)([a-z0-9_]*)(>| \/>| )/i', $file, $tagname);
		foreach($tagname[2] as $key => $string)
			$file = str_replace($tagname[1][$key].$string.$tagname[3][$key], $tagname[1][$key].cfg::color_tagname.$string.'$g'.$tagname[3][$key], $file);
		preg_match_all('/([a-z12]*)=("|\')([^"\']*)/', $file, $value);
		
		foreach($value[3] as $key => $string)
			$file = str_replace($value[1][$key]."=".$value[2][$key].$string.$value[2][$key], $value[1][$key]."=".$value[2][$key].cfg::color_value.$string.'$g'.$value[2][$key], $file);
			
		preg_match_all('/( |\n)([a-z12]*)=("|\')/s', $file, $attr);
		foreach($attr[2] as $key => $string)
			$file = str_replace($attr[1][$key]."$string=".$attr[3][$key], $attr[1][$key].cfg::color_attribute.$string.'$g='.$attr[3][$key], $file);

		if ($rows > 30) {
			$file = explode("\n", $file);
			$rows = 30;
			$file = array_slice($file, 0, 30);
			$file = implode("\n", $file);
		}

		$lines = substr_count($file, "\n") +1;
		$diff = array_sum(array_slice($gap, 0, $line));
		for ($i=1;$i<31;$i++) {
			if ($lines < $i) break;
			if (isset($gap[$i+$line]) AND $i != 1) { $diff++; continue; }
			$return .=  '<label posn="-54 '.(($i-1)*-2.44+38).'" textsize="2" halign="right" text="'.($i+$line-$diff).'" />';
		}
		if (isset($highlight)) {
			if ($highlight > 10 AND $grows > 30) $highlight = 10;
			$i = $j = 1;
			foreach ($gap as $key => $diff) if ($key < $highlight) $highlight ++;
			while (array_key_exists($highlight+$i, $gap) AND !array_key_exists($highlight, $gap)) $i++;
			$h_height = $i * 2.44 > 73.2 ? 73.2 : $i * 2.44;
			while (array_key_exists($highlight+$j-1, $gap)) $j++;
			$h_posy  = 38.2 - ($highlight-2+$j) * 2.44;
			if ($highlight_line) {
				$return .= '<quad posn="-57 '.$h_posy.'" sizen="114 '.$h_height.'" bgcolor="'.cfg::color_highlight.'6" />';
				$i = 1;
				$h_posy  = 38.2 - ($highlight_line-$line+1) * 2.44;
				$return .= '<quad posn="-57 '.$h_posy.'" sizen="114 2.44" bgcolor="'.cfg::color_highlight.'" />';
			} else $return .= '<quad posn="-57 '.$h_posy.'" sizen="114 '.$h_height.'" bgcolor="'.cfg::color_highlight.'" />';
		}
		$url = $this->url.'sp_source';
		$return .=  '<quad posn="-58 40 -1" sizen="116 80" style="Bgs1InRace" substyle="BgList" />
		<label posn="-53 38" textsize="2" textcolor="CCC" sizen="114" scale="0.95" text="'.htmlspecialchars($file).'" />
		<label posn="0 -35" halign="center" textsize="2" text="Zeile '.($line+1).' bis '.($lines+$line).' von '.$grows.'" />
		<label posn="0 -37" halign="center" textsize="1" text="Parsing time: '.round(microtime(true)-$parsingtime, 5).' Seconds" />';
		if ($line)
			$return .=  '<quad posn="-13 -35" sizen="3 3" style="Icons64x64_1" substyle="ArrowPrev" manialink="'.$url.'&amp;line='.($line-30).'&amp;frames='.$_GET['frames_old'].'" />
			<quad posn="-17 -35" sizen="3 3" style="Icons64x64_1" substyle="ArrowFirst" manialink="'.$url.'" />';
		$_GET['frames'] = (int) @$_GET['frames'];
		if ($line+30 < $grows)
			$return .=  '<quad posn="10 -35" sizen="3 3" style="Icons64x64_1" substyle="ArrowNext" manialink="'.$url.'&amp;line='.($line+30).'&amp;frames='.$frames.'&amp;frames_old='.$_GET['frames'].'" />
			<quad posn="14 -35" sizen="3 3" style="Icons64x64_1" substyle="ArrowLast" manialink="'.$url.'&amp;line='.($grows-20).'" />';
		$return .= '<label posn="-55 -35.5" textsize="2" text="$h['.$this->url.']Exit$h | $h['.$this->url.'sp_php_source]View PHP source$h" />';
		return '<?xml version="1.0" encoding="UTF-8" ?><manialink><timeout>0</timeout>' . $return . '</manialink>';
	}
}
?>