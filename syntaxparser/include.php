<?php
class Syntaxparser {
	protected $parsing_time;
	protected $url;
	function __construct() {
		$this->parsing_time = microtime(true);
		
		require_once("config.php");
		$this->url = cfg::url ? cfg::url : "http://".$_SERVER['HTTP_HOST'].str_replace("&", "&amp;", $_SERVER['REQUEST_URI']);
		if     ($position = strpos($this->url, "sp_source"))		$this->url = substr($this->url, 0, $position-1);
		elseif ($position = strpos($this->url, "sp_php_source"))	$this->url = substr($this->url, 0, $position-1);
		elseif ($position = strpos($this->url, "sp_errors"))		$this->url = substr($this->url, 0, $position-1);
		$this->url .= (strstr($this->url, "?") ? "&amp;" : "?");
	}
	function structure() {
		if (isset($_GET['sp_source']) AND cfg::source_enabled) {
			require_once("view_code.php");
			ob_start(array(new ViewCode, "view_source"));
		} elseif (isset($_GET['sp_php_source']) AND cfg::php_source_enabled) {
			require_once("view_php_code.php");
			new ViewPHPCode;
			exit;
		} elseif (!isset($_GET['sp_ignore'])) {
			require_once("errorhandler.php");
			set_error_handler(array(new Errorhandler, "errorhandler"));

			require_once("syntaxparser.php");
			ob_start(array(new XMLSyntaxparser, "syntaxparser"));
		}
	}
}
error_reporting(E_ALL);
$Syntaxparser = new Syntaxparser;
$Syntaxparser->structure();
?>