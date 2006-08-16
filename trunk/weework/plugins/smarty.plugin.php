<?php

/* Smarty plugin */

if(!defined("SMARTY_PATH"))
	define("SMARTY_PATH", WEEWORK_PATH . "smarty/");

require_once SMARTY_PATH . "Smarty.class.php";

function smarty_plugin_init()
{
	$GLOBALS["smarty"] = new Smarty;

        $GLOBALS["smarty"]->compile_check = true;
        $GLOBALS["smarty"]->debugging = true;

	$GLOBALS["smarty"]->assign("BASE_HREF", $GLOBALS["BASE_HREF"]);
}

?>
