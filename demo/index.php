<?php

define("LIB_PATH", "../");

define("SMARTY_PATH", LIB_PATH . "smarty/");
define("ADODBLITE_PATH", LIB_PATH . "adodb_lite/");
define("WEEWORK_PATH", LIB_PATH . "weework/");

/* AdoDB Lite - mysql */
define("DB_TYPE", "mysql");
//define("DB_TYPE", "postgres");
//define("DB_TYPE", "sqlite");

require_once WEEWORK_PATH . "weework.inc.php";
require_once "includes.php";

$wee = new wee();
$wee->weeRun();

?>
