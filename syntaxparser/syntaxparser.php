<?php
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
?>