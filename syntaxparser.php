<?php
class cfg {
###############   Config   ###############
const ignore_path		= "";		// Deletes specified path from PHP error messages
const source_enabled	= true; 	// true/false - Enables/Disables possibility to view the XML source
const php_source_enabled= false; 	// true/false - Enables/Disables possibility to view the PHP source
const toolbar			= true;  	// true/false - Enables/Disables a toolbar with links for more information
const url				= "";		// You can set your own Manialink, which will be displayed instead of the whole URL

const color_tagname		= '$A2A';
const color_attribute	= '$EA0';
const color_value		= '$D24';
const color_comment		= '$3A0';
const color_highlight	= '136';   	// bgcolor value

############### End Config ###############
}
class Syntaxparser extends cfg {
	protected $parsing_time;
	protected $url;
	function __construct() {
		$this->parsing_time = microtime(true);
		
		$this->url = cfg::url ? cfg::url : "http://".$_SERVER['HTTP_HOST'].str_replace("&", "&amp;", $_SERVER['REQUEST_URI']);
		if     ($position = strpos($this->url, "sp_source"))		$this->url = substr($this->url, 0, $position-1);
		elseif ($position = strpos($this->url, "sp_php_source"))	$this->url = substr($this->url, 0, $position-1);
		elseif ($position = strpos($this->url, "sp_errors"))		$this->url = substr($this->url, 0, $position-1);
		$this->url .= (strstr($this->url, "?") ? "&amp;" : "?");
	}
	function structure() {
		if (isset($_GET['sp_source']) AND cfg::source_enabled) {
			ob_start(array(new ViewCode, "view_source"));
		} elseif (isset($_GET['sp_php_source']) AND cfg::php_source_enabled) {
			new ViewPHPCode;
			exit;
		} elseif (!isset($_GET['sp_ignore'])) {
			set_error_handler(array(new Errorhandler, "errorhandler"));

			ob_start(array(new XMLSyntaxparser, "syntaxparser"));
		}
	}
}
class Errorhandler extends Syntaxparser {
	private $sp_error = "";
	private $sp_count = array();
	function __construct() {
		$this->sp_count['error'] = $this->sp_count['warning'] = $this->sp_count['information'] = 0; // Setting global error variables
	}

	function sp_error_string ($string) { // SP string editing function
		$string = htmlspecialchars($string);
		$string = str_replace('$', '$$', $string);
		$string = str_replace(cfg::ignore_path, "", $string);
		$string = wordwrap($string, 90);
		return $string;
	}
	function errorhandler ($code, $string, $file, $line) {
		if ($code & error_reporting()) { // Checking if an error shall be generated
			$string = preg_replace('/ \[<a href=.*<\/a>]/', '', $string); // Removing this strange link to the function
			switch ($code) {
				case E_USER_ERROR: case E_ERROR:
					$this->sp_error .= '$o$C13PHP: Fatal Error:$z '.$this->sp_error_string("$string in $file on line $line\n");
					$this->sp_count['error'] ++;
					exit;
				break;
				case E_USER_WARNING: case E_WARNING:
					$this->sp_error .= '$EC0PHP: Warning:$z '.$this->sp_error_string("$string in $file on line $line\n");
					$this->sp_count['warning'] ++;
				break;
				case E_USER_NOTICE: case E_NOTICE:
					$this->sp_error .= '$39FPHP: Notice:$z '.$this->sp_error_string("$string in $file on line $line\n");
					$this->sp_count['information'] ++;
				break;
				default: 
					$this->sp_error .= '$C13PHP: $z '.$this->sp_error_string("$string in $file on line $line\n");
					$this->sp_count['error'] ++;
				break;
			}
		}
		return true;
	}
}
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
class ViewPHPCode extends Syntaxparser {
	private $offset;
	private $rows_file;
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
class XMLSyntaxparser extends Syntaxparser {
	var $row = 1;
	var $char_start = 0;
	var $temp_count = 0;
	var $count = array();
	var $start = array();
	var $status_old = "";
	var $view = "";
	var $status = "manialink";
	var $i;
	var $error;
	function status ($statusname, $overwrite = true) {
		if ($overwrite) {
			$this->start[$statusname] = $this->i;
			$this->status_old = $this->status;
		}
		$this->status = $statusname;
		$this->temp_count = 0;
	}
	
	function error ($type, $add_error, $position = false) {
		$newline = $this->error ? "\n" : "";
		$where = $position ? " on line \$o$this->row\$o, position ".($position-$this->char_start-1) : "";
		$title = "";
		switch ($type) {
			case "error": $title = '$o$C13Error:$z  '; break;
			case "warning": $title = '$EC0Warning:$z  '; break;
			case "information": $title = '$39fInformation:$z  '; break;
		}
		if ($position AND cfg::source_enabled) {
			$height = - (substr_count($this->error, "\n")+1) * 2.55 + 42.8;
			if (!$this->error) $height = 42.8;
			$this->view .= '<quad posn="-41 '.$height.'" sizen="3 3" style="Icons64x64_1" substyle="ArrowBlue" manialink="'.$this->url.'sp_source&amp;highlight='.$this->row.'&amp;position='.($position-$this->char_start-1).'" />';
		}
		$this->count[$type]++;
		$add_error = htmlspecialchars(wordwrap($add_error, 100));
		$add_error = str_replace('$', '$$', $add_error);
		$add_error = str_replace('§o', '$o', $add_error);

		$this->error .= $newline.$title.$add_error.$where;
	}
	
	function syntaxparser ($content) {
		$parsing_time = microtime(true);
		
		$a = isset($_GET['analyse']);
		$return = "";
		
		$attributes = $list_attributes = $this->count = $langid = $this->start = array();
		$this->error = $Errorhandler->sp_error ? substr($Errorhandler->sp_error, 0, -1) : "";
		$this->count['error'] = $Errorhandler->sp_count['error'] ? $Errorhandler->sp_count['error'] : 0;
		$this->count['warning'] = $Errorhandler->sp_count['warning'] ? $$Errorhandler->sp_count['warning'] : 0;
		$this->count['information'] = $Errorhandler->sp_count['information'] ? $Errorhandler->sp_count['information'] : 0;
		$chars = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z", 1, 2);
		$frames = $this->count[''] = 0;
		$attribute_started = $manialink_started = $ignore_manialink_start = $timeout = $xml_header = $info_amp = $info_scale = $info_halign = $info_valign = $info_pos = $stopped = false;

		// Tag and Attribute list
		$list_tags = array("manialink", "type", "dico", "label", "quad", "entry", "fileentry", "frame", "format", "timeout", "include", "music", "video", "audio", "redirect", "br");
		$attributes[0] = array("pos", "posn", "scale");
		$attributes[1] = array("size", "sizen", "halign", "valign");
		$attributes[2] = array("url", "urlid", "manialink", "manialinkid", "maniazones", "action", "addplayerid");
		$attributes[3] = array("textsize", "textcolor", "textfilter", "style", "focusareacolor1", "focusareacolor2");
		$attributes[4] = array("data", "dataid", "play", "looping", "height", "width");
		$list_attributes['label'] = array_merge($attributes[0], $attributes[1], $attributes[2], $attributes[3], array("text", "textid", "autonewline", "maxline"));
		$list_attributes['quad'] = array_merge($attributes[0], $attributes[1], $attributes[2], array("image", "imageid", "imagefocus", "imagefocusid", "style", "substyle", "bgcolor"));
		$list_attributes['entry'] = array_merge($attributes[0], $attributes[1], $attributes[3], array("name", "default", "autonewline"));
		$list_attributes['fileentry'] = array_merge($attributes[0], $attributes[1], $attributes[3], array("folder", "name", "default", "autonewline"));
		$list_attributes['frame'] = $attributes[0];
		$list_attributes['format'] = $attributes[3];
		$list_attributes['include'] = array("url", "urlid");
		$list_attributes['music'] = array("data", "dataid");
		$list_attributes['video'] = $list_attributes['audio'] = array_merge($attributes[0], $attributes[1], $attributes[4]);
		$list_attributes['manialink'] = $list_attributes['timeout'] = array();

		//////////// STARTING ANALYSING ////////////
		for ($this->i=0; isset($content[$this->i]); $this->i++) {
			$char = $content[$this->i];
			if (array_sum($this->count) > 19) {
				$stopped = true;
				$this->error("information", "Analysing stopped on line $this->row with 20 errors");
				break;
			} elseif ($char == "\n") {
				$this->row++;
				$this->char_start = $this->i;
				continue;
			}
			if ($this->temp_count > 1) $this->status("manialink");
			switch ($this->status) { #### START ####
			case "manialink":
				if ($char == "<") {
					$this->status("tag");
				}
			break;
			case "tag": #### TAG ####
				if ($char == "?") {
					$this->status("xml_header");
				} elseif ($char == "!") {
					if (substr($content, $this->i+1, 2) == "--") {
						$this->status("comment");
						$this->i += 2;
					} else {
						$this->error("error", "Unexpected §o'$char'§o, expecting '!--' for comment", $this->i);
					}
				} elseif ($char == "/") {
					$this->status("end_tag");
				} elseif (in_array($char, $chars)) {
					$this->status("tag_name");
					if (@$tag_open AND @$tag_open != "frame") {
						$tag_name = strpos($content, " ", $this->i);
						$end_tag_name = strpos($content, ">", $this->i);
						if (strlen($tag_name) >= strlen($end_tag_name)) $tag_name = $end_tag_name;
						$tag_name = substr($content, $this->i, $tag_name-$this->i);
						$this->error("warning", "Unexpected element §o'$tag_name'§o, expecting '</$tag_open>'", $this->i);
					}
				} else {
					$this->error("error", "Unexpected §o'$char'§o", $this->i);
					$this->status("manialink");
				}
			break;
			case "tag_name": #### TAG NAME ####
				if (!in_array($char, $chars) OR $content[$this->i-1] == "\n") {
					if ($char == " " OR $char == ">" OR $content[$this->i-1] == "\n") {
						if ($content[$this->i-1] == "\n") $this->i--;
						$tag_name = substr($content, $this->start["tag_name"], $this->i-$this->start["tag_name"]);
						if (!in_array($tag_name, $list_tags)) {
							$this->error("warning", "Unknown element §o'$tag_name'§o", $this->i);
						}
						if ($tag_name == "manialink" AND !$manialink_started) {
							$manialink_started = true;
							$this->status("manialink");
						} elseif ($tag_name == "br") {
							$this->status("php_error");
						} elseif ($tag_name == "redirect") {
							$this->status("redirect");
						} elseif ($tag_name == "manialink" AND $manialink_started) {
							$this->error("error", "Second Manialink start", $this->i);
							$ignore_manialink_start = true;
							$this->status("manialink");
						} elseif (!$manialink_started AND !$ignore_manialink_start) {
							$this->error("error", "Element §o'$tag_name'§o is not inside a <manialink>", $this->i);
							$ignore_manialink_start = true;
							$this->i++; $this->status("attribute"); $this->i--;
						} elseif ($tag_name == "dico") {
							$this->i++; $this->status("language"); $this->i--;
						} else {
							if ($tag_name == "frame") {
								$frames++;
							} elseif ($tag_name == "timeout") {
								$timeout = true;
							} elseif ($tag_name == "music" AND $frames > 0) {
								$this->error("information", "<music> does not work inside a frame", $this->i);
							}
							$this->i++; $this->status("attribute"); $this->i--;
							$this->count_attributes = 0;
							$attribute_name = array();
						}
						if ($char == ">" AND $tag_name != "manialink" AND $tag_name != "dico") {
							$tag_open = $tag_name;
							$this->status("manialink");
						}
					} else {
						$this->error("error", "Unexpected §o'$char'§o", $this->i);
					}
				}
			break;
			case "attribute": #### ATTRIBUTE ####
				if (!in_array($char, $chars) AND $attribute_started) {
					$attribute_started = false;
					if ($char == "=") {
						$name = substr($content, $this->start["attribute"], $this->i-$this->start["attribute"]);
						if (@in_array($name, $attribute_name)) {
							$this->error("error", "Double element §o'$name'§o", $this->i);
						}
						if (!@in_array($name, $list_attributes[$tag_name]) AND $list_attributes[$tag_name]) {
							$this->error("warning", "Unknown attribute §o'$name'§o in '$tag_name'", $this->i);
						}
						$attribute_name[$this->count_attributes] = $name;
						$this->count_attributes++;
						$this->i++;
						$char = $content[$this->i];
						if ($char != '"' AND $char != "'") {
							$word = substr($content, $this->i, strpos($content, " ", $this->i)-$this->i);
							if (!$word) $word = $char;
							if (strlen($word) > 20) $word = substr($word, 0, 20);
							$this->error("error", "Unexpected §o'$word'§o, expecting quotation marks", $this->i);
							$this->status("manialink");
							break;
						} elseif ($char == "'") {
							$apostrophe = true;
						} else {
							$apostrophe = false;
						}
						$this->i++;
						$this->status("value");
						$this->i--;
					} elseif ($char == ">") {
						$this->status("manialink");
					} elseif ($char == "'" OR $char == '"') {
						$this->error("error", "Expecting equal sign after attribute name", $this->i);
						$attribute_name[$this->count_attributes] = $name;
						$this->count_attributes++;
						$this->i++;
						$this->status("value");
						$this->i--;
					} else {
						$this->error("error", "Unexpected §o'$char'§o", $this->i);
						$this->i--;
						$this->status("manialink");
					}
				} elseif (in_array($char, $chars) AND !$attribute_started) {
					$attribute_started = true;
					$this->start["attribute"] = $this->i;
				} elseif ($char == "/" AND $content[$this->i+1] == ">") {
					$this->status("manialink");
				} elseif ($char == ">") {
					$this->status("manialink");
					if ($tag_name != "frame") {
						$tag_open = $tag_name;
					}
				}
			break;
			case "value": ##### VALUE #####
				if (($char == '"' AND !$apostrophe) OR ($char == "'" AND $apostrophe)) {
					$apos = $apostrophe ? "'" : '"';
					$value = substr($content, $this->start["value"], $this->i-$this->start["value"]);
					$this->start[""] = $this->i-strlen($value);
					$attribute = $attribute_name[$this->count_attributes-1];
					switch ($attribute) {
						case "posn": case "pos":
							$pos = explode(" ", $value);
							if (!is_numeric($pos[0]) OR (!is_numeric(@$pos[1]) AND isset($pos[1]))
								OR (!is_numeric(@$pos[2]) AND isset($pos[2]))) {
								$this->error("warning", "Wrong value §o'$value'§o in '$attribute', expecting number", $this->i-strlen($value));
							}
							if (isset($pos[3])) {
								$this->error("warning", "§o'$value'§o expects only 3 position values in '$attribute'", $this->i);
							}
							if ($value == "0 0 0" AND !$info_pos) {
								$this->error("information", "$attribute=".$apos."0 0 0$apos can be left out", $this->i);
								$info_pos = true;
							} elseif (@$pos[1] === "0" AND $pos[2] === "0" AND !$info_pos) {
								$this->error("information", "y- and z-positions of '$attribute' can be left out", $this->i);
								$info_pos = true;
							} elseif (@$pos[2] === "0" AND !$info_pos) {
								$this->error("information", "z-position of '$attribute' can be left out", $this->i);
								$info_pos = true;
							}
						break;
						case "sizen": case "size":
							$pos = explode(" ", $value);
							if (!is_numeric($pos[0]) OR (!is_numeric(@$pos[1]) AND isset($pos[1]))) {
								$this->error("warning", "Wrong value '$value' in '$attribute', expecting number", $this->start["value"]);
							}
							if (isset($pos[2])) {
								$this->error("warning", "$value expects only 2 size values in '$attribute'", $this->i);
							}
						break;
						case "text": case "manialink": case "url":
							if ($position = strpos($value, "&") AND !strstr(substr($value, $position, 6), ";") AND !$info_amp) {
								$this->error("information", "'§o&§o' won't work in '$attribute', use '&amp;' instead", $this->i);
								$info_amp = true;
							}
						break;
						case "scale":
							if (!is_numeric($value)) {
								$this->error("warning", "Wrong value '$value' in '$attribute', expecting float", $this->start["value"]);
							} elseif ($value == 1 AND !$info_scale) {
								$this->error("information", "scale=".$apos."1$apos can be left out", $this->i);
								$info_scale = true;
							}
						break;
						case "addplayerid":
							if ($value != 1) {
								$this->error("warning", "Wrong value '$value' in '$attribute', expecting '1'", $this->start["value"]);
							}
						break;
						case "textsize":
							if (!is_numeric($value)) {
								$this->error("warning", "Wrong value '$value' in '$attribute', expecting integer", $this->start["value"]);
							}
						break;
						case "textcolor": case "bgcolor": case "focusareacolor1": case "focusareacolor2":
							if (!preg_match("/^[0-9A-Fa-f]{3,4}$/", $value)) {
								$this->error("warning", "Wrong value '$value' in '$attribute', expecting hexadecimal number", $this->start["value"]);
							}
						break;
						case "play": case "looping":
							if ($value != 1 AND $value != 0) {
								$this->error("warning", "Wrong value '$value' in '$attribute', expecting '1' or '0'", $this->start["value"]);
							}
						break;
						case "halign":
							if ($value != "left" AND $value != "center" AND $value != "right") {
								$this->error("warning", "Unexpected value of 'halign', expecting left, center or right", $this->i);
							} elseif ($value == "left" AND !$info_halign) {
								$this->error("information", 'halign="left" can be left out', $this->i);
								$info_halign = true;
							}
						break;
						case "valign":
							if ($value != "top" AND $value != "center" AND $value != "bottom") {
								$this->error("warning", "Unexpected value of 'halign', expecting top, center or bottom", $this->i);
							}
							if ($value == "top" AND !$info_valign) {
								$this->error("information", 'valign="top" can be left out', $this->i);
								$info_valign = true;
							}
						break;
					}
					$this->status("attribute");
				} elseif ($char == "<" OR $char == ">") {
					$this->temp_count++;
					$this->error("error", "Unexpected §o'$char'§o", $this->i);
					$this->i--;
					$this->status("manialink");
				}
			break;
			case "end_tag": ##### END TAG #####
				if ($char == ">") {
					$this->start["end_tag"]++;
					$end_tag_name = substr($content, $this->start["end_tag"], $this->i-$this->start["end_tag"]);
					if ($end_tag_name == "frame") {
						$frames--;
					} elseif ($end_tag_name == "manialink") {
						if ($frames > 0) {
							$this->error("error", "Not all frames are closed", $this->i);
						} 
						$manialink_end = true;
						$manialink_started = $ignore_manialink_start = false;
					}
					if ($tag_open != $end_tag_name AND $tag_open) {
						$this->error("error", "Unexpected element §o'</$end_tag_name>'§o, expecting '</$tag_open>'", $this->i);
					}
					$this->status("manialink");
					$tag_open = "";
				}
			case "language": ##### LANGUAGE START #####
				if ($char == "<") {
					$this->status("language_tag");
				}
			break; ##### LANGUAGE TAG #####
			case "language_tag":
				if (substr($content, $this->i, 6) == "/dico>") {
					$this->i += 5;
					$this->status("manialink");
					break;
				}
				$language_tag = substr($content, $this->start["language_tag"]+1, 16);
				$language_tag = explode(" ", $language_tag);
				if ($language_tag[0] != "language") {
					$this->error("warning", "Unexpected element §o'$language_tag[0]'§o", $this->i);
					$this->i += strlen($language_tag[0]);
					$this->status("language");
					break;
				}
				if (substr($language_tag[1], 0, 3) != "id=") {
					$this->error("warning", "Unable to read attribute §o'id'§o in language tag", $this->i);
				} else {
					$lang_langid = substr($language_tag[1], 4, 6);
				}
				$this->status("language_space");
			break;
			case "language_space": ##### LANGUAGE SPACE #####
				if ($char == "<") {
					if (substr($content, $this->i, 4) == "<!--") {
						$this->status("comment");
					} else {
						$this->status("languageid");
					}
				}
			break;
			case "languageid": ##### LANGUAGE IDs #####
				if ($char == ">") {
					$langid_name = substr($content, $this->start["languageid"]+1, $this->i-$this->start["languageid"]-1);
					$langid[count($langid)] = $langid_name;
					$this->status("language_value");
				} elseif (substr($content, $this->start["languageid"], 11) == "</language>") {
					$langid_start = strpos($content, "<", $this->i);
					$this->i += ($langid_start - $this->i);
					$this->status("language_tag");
				}
			break;
			case "language_value": ##### LANGUAGE IDs' VALUE #####
				if ($char == "<") {
					$this->i++;
					$char = $content[$this->i];
					if ($char != "/") {
						$this->error("warning", "Unexpected §o'$char'§o, expecting '/'", $this->i);
					} else {
						$this->status("language_endtag");
					}
				}
			break;
			case "language_endtag": ##### LANGUAGE ENDTAG #####
				$end = strpos($content, ">", $this->start["language_endtag"]) - $this->start["language_endtag"];
				$language_endtag = substr($content, $this->start["language_endtag"] +1, $end -1);
				if ($language_endtag != $langid_name) {
					$this->error("error", "25*Unexpected end tag §o'$language_endtag'§o in dico, expecting '$langid_name'", $this->i);
				}
				$this->status("language_space");
			break;
			case "redirect": ##### REDIRECT #####
				if ($char == "<") {
					if (substr($content, $this->i, 11) != "</redirect>") {
						$this->error("error", "Expecting §o'</redirect>'§o", $this->i);
					} else {
						$redirection = substr($content, $redirect_start, $this->i-$redirect_start);
						$this->error("", "Redirection to: §o'$redirection'§o");
						$manialink_started = true;
					}
				}
			break;
			case "comment": ##### COMMENT #####
				if (substr($content, $this->i, 3) == "-->") {
					$this->i += 1;
					if ($this->status_old == "tag") {
						$this->status("manialink");
					} else {
						$this->status($this->status_old);
					}
				}
			break;
			case "xml_header": ##### XML HEADER #####
				if (substr($content, $this->i, 2) == "?>") {
					$this->i++;
					$this->status("manialink");
					$xml_header = true;
				}
			break;
			case "php_error": ##### (uncaught) PHP ERROR #####
				if ($content[$this->i-1] == "\n") {
					$php_error_end = strpos($content, "<br />", $this->i);
					$php_error = substr($content, $this->i, $php_error_end - $this->i);
					$php_error = str_replace(array("<b>", "</b>"), '§o', $php_error);
					$this->error("warning", 'PHP: '.$php_error, 0);
					$this->i = $php_error_end + 5;
					$this->row++;
					$this->status("manialink");
				}
			break;
			}
			if ($a) $return .= "$this->row; $this->i: $char|$this->status|".@${$this->status."_start"}."\n";
		}
		if ($frames > 0 AND !$stopped) $this->error("error", "Not all frames are closed");
		if (!$manialink_end AND $manialink_started AND !$stopped) $this->error("error", "<manialink> tag is not closed");
		
		if		(!$timeout AND !$xml_header) $this->error("information", "<timeout> and XML-Header are not set", 0);
		elseif	(!$timeout) $this->error("information", "<timeout> is not set", 0);
		elseif	(!$xml_header) $this->error("information", "XML-Header is not set", 0);
		if		(!$this->count["warning"] AND !$this->count["error"]) $this->error("", '§oNo errors or warnings found§o');
		

		$analyse = "File-size: ".round($this->i/1024, 2)."KB, Syntax Check time: ".round(microtime(true)-$parsing_time,4)." Seconds, File parsing time: ".round(microtime(true)-$this->parsing_time,4)." Seconds";
		$errors = ($this->count["error"] OR $this->count["warning"] OR $this->count["information"]) ? ", E/W/I: ".(array_sum($this->count)-1) : "";
		$this->error("", $analyse.$errors);
		
		$link = $this->url;
		$xml_link = cfg::source_enabled ? '$h['.$link.'sp_source]View XML source$h | ' : "";
		$php_link = cfg::php_source_enabled ? '$h['.$link.'sp_php_source]View PHP source$h | ' : "";
		$this->error .= "\n".$xml_link.$php_link. '$h['.$link.'sp_ignore]Ignore errors$h';
		
		$height = (substr_count($this->error, "\n")+1) * 2.6 + 4;
		$return .= '<?xml version="1.0" encoding="UTF-8" ?><manialink><timeout>0</timeout>';

		if (cfg::toolbar) {
			$toolbar = array();
				$toolbar[] = 'style="Icons64x64_1" substyle="Refresh" scale="0.9" manialink="'.$this->url.'"';
				$toolbar[] = 'style="Icons128x128_1" substyle="Options" scale="1.1" manialink="Example"';
			if ($this->count["information"])
				$toolbar[] = 'style="Icons64x64_1" substyle="LvlYellow" scale="0.9" manialink="'.$this->url.'sp_errors"';
			else
				$toolbar[] = 'style="Icons64x64_1" substyle="LvlGreen" scale="0.9" manialink="'.$this->url.'sp_errors"';
			if (cfg::php_source_enabled)
				$toolbar[] = 'style="Icons128x128_1" substyle="Browse" manialink="'.$this->url.'sp_php_source"';
			if (cfg::source_enabled)
				$toolbar[] = 'style="Icons128x128_1" substyle="Editor" manialink="'.$this->url.'sp_source"';
			$display_toolbar = '<frame posn="-62.5 -46.5 48">';
			$posx = 0;
			foreach ($toolbar as $entry) {
				$display_toolbar .= '<quad posn="'.$posx.'" halign="center" valign="center" sizen="3 3" '.$entry.' />';
				$posx += 3;
			}
			$display_toolbar .= '<quad posn="-1.5 0 -2" valign="center" sizen="'.$posx.' 3" style="BgsPlayerCard" substyle="ProgressBar" /></frame>';
		} else $display_toolbar = "";

		$display_errors = '<quad posn="0 45 -1" halign="center" sizen="87 '.$height.'" style="Bgs1InRace" substyle="BgList" action="1" />
		<label posn="-38 42.5" sizen="90" textsize="2">'.$this->error.'</label>';
		if ($this->count["error"] OR isset($_GET['sp_errors'])) {
			return $return . $display_errors . $this->view . "</manialink>";
		} elseif ($this->count["warning"]) {
			$remove =  array("<manialink>", "</manialink>", "<timeout>0</timeout>", '<?xml version="1.0" encoding="UTF-8" ?>', "<?xml version='1.0' encoding='UTF-8' ?>");
			$content = str_ireplace($remove, "", $content);
			$content = str_replace("<dico>", "</frame><dico>", $content);
			$content = str_replace("</dico>", '</dico><frame posn="0 0 -48">', $content);
			return $return . $display_errors . $this->view . '<frame posn="0 0 -48">' . $content . '</frame></manialink>';
		} elseif ($this->count["information"]) {
			$xml_header = strpos($content, "?>");
			if ($xml_header !== false) $xml_header += 2;
			$content = substr_replace($content, "\n<!-- valid Manialink, checked with Syntaxparser v0.56 -->", $xml_header, 0);
			$content = str_replace("</manialink>", $display_toolbar."</manialink>", $content);
			return $content;
		} else {
			$xml_header = strpos($content, "?>");
			if ($xml_header !== false) $xml_header += 2;
			$content = substr_replace($content, "\n<!-- examplary Manialink, checked with Syntaxparser v0.56 -->", $xml_header, 0);
			$content = str_replace("</manialink>", $display_toolbar."</manialink>", $content);
			return $content;
		}
	}
}
error_reporting(E_ALL);
$Syntaxparser = new Syntaxparser;
$Syntaxparser->structure();
?>