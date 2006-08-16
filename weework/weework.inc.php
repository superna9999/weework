<?php

if(!defined("WEEWORK_PATH"))
    define("WEEWORK_PATH", dirname(__FILE__));

if(!defined("SMARTY_PATH"))
    define("SMARTY_PATH", WEEWORK_PATH . "smarty/");

define("PLUGINS_PATH", WEEWORK_PATH . "plugins");

/* Wee Defines */

define("PAGE_PREFIX", "page");
define("PART_PREFIX", "part_");
define("PLUGIN_NAME", ".plugin.php");
define("PLUGIN_INIT", "_plugin_init");

require WEEWORK_PATH . 'includes.inc.php';

?>
