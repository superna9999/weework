<?php

/* Global&Session Config */

function global_plugin_init()
{
	/* Session */

    session_start();

    /* Globals */

    if(!isset($_SESSION["global"]))
    {
    	session_register("global");
	}

	if(!isset($_SERVER["SCRIPT_NAME"]) || empty($_SERVER["SCRIPT_NAME"]))
	{
		if(isset($_SERVER["PHP_SELF"]) && !empty($_SERVER["PHP_SELF"]))	
		{
			$GLOBALS["BASE_HREF"] = substr_replace($_SERVER["PHP_SELF"], "", strlen($GLOBALS['PATH_INFO']) * -1);
		}
		// fastCgi
		else if(isset($_SERVER["REDIRECT_URL"]) && !empty($_SERVER["REDIRECT_URL"]))
		{
			$GLOBALS["BASE_HREF"] = substr_replace($_SERVER["REDIRECT_URL"], "", strlen($GLOBALS['PATH_INFO']) * -1);
		}
	}
	else
		$GLOBALS["BASE_HREF"] = $_SERVER["SCRIPT_NAME"];

    $GLOBALS["global"] =& $_SESSION["global"];
}

?>
