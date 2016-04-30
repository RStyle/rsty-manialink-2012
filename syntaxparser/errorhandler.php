<?php
class Errorhandler extends Syntaxparser {
	var $sp_error = "";
	var $sp_count = array();
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
?>