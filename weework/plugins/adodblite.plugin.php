<?php

/* AdodbLite plugin */

if(!defined("ADODBLITE_PATH"))
	define("ADODBLITE_PATH", WEEWORK_PATH . "adodb_lite/");

if(!defined("DB_TYPE"))
	define("DB_TYPE", "mysql");

require_once ADODBLITE_PATH . "adodb.inc.php";

function adodblite_plugin_init()
{
	$GLOBALS["db"] = ADONewConnection(DB_TYPE);
}

?>
