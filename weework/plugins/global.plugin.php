<?php
/*
    This file is part of WeeWork.

    WeeWork is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    WeeWork is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with WeeWork; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

    $Id$
 */

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
		else if(isset($_ENV["REDIRECT_URL"]) && !empty($_ENV["REDIRECT_URL"]))
		{
			$GLOBALS["BASE_HREF"] = substr_replace($_ENV["REDIRECT_URL"], "", strlen($GLOBALS['PATH_INFO']) * -1);
		}
		else if(isset($_ENV["REQUEST_URI"]) && 
			!empty($_ENV["REQUEST_URI"]))
		{
			$GLOBALS["BASE_HREF"] = substr_replace($_ENV["REQUEST_URI"], "", strlen($GLOBALS['PATH_INFO']) * -1);
		}
	}
	else
		$GLOBALS["BASE_HREF"] = $_SERVER["SCRIPT_NAME"];

    $GLOBALS["global"] =& $_SESSION["global"];

    $GLOBALS["REQUEST_URL"] = "http";
    if ( (isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on') || $_SERVER['REMOTE_PORT'] == 443)
    {    
        $GLOBALS["SSL"] = true;
        $GLOBALS["REQUEST_URL"] .= "s";
    }
    else
        $GLOBALS["SSL"] = false;
    $GLOBALS["REQUEST_URL"] .= "://" . $_SERVER["HTTP_HOST"] . $_SERVER["SCRIPT_NAME"];

}


