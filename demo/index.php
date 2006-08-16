<?php

define("LIB_PATH", "../");

define("SMARTY_PATH", LIB_PATH . "smarty/");
define("WEEWORK_PATH", LIB_PATH . "weework/");

require_once WEEWORK_PATH . "weework.inc.php";
require_once "includes.php";

wee::weeRun();

?>
