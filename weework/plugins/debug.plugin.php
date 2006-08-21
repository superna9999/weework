<?php

/* debug plugin, prints backtrace when error occures */

function debug_handler($errno, $errstr, $errfile, $errline, $context, $backtrace = NULL)
{
    $errortype = "Unknown";

    switch($errno)
	{
		case E_ERROR:
		case E_CORE_ERROR:
		case E_COMPILE_ERROR:
		case E_USER_ERROR:
			$errortype = "Fatal Error";
			break;

		case E_WARNING:
		case E_CORE_WARNING:
		case E_COMPILE_WARNING:
		case E_USER_WARNING:
			$errortype = "Warning";
			break;

		case E_NOTICE:
		case E_USER_NOTICE:
			$errortype = "Notice";
			break;
    }

    echo "<p><b>$errortype</b>: $errstr: <i>$errfile:$errline</i>:<br/>";
    //debug_print_backtrace();
    $backtrace = debug_backtrace();
    foreach($backtrace as $line)
    {
        if($line["function"] === "debug_handler")
            continue;
        echo "<i>".$line["file"].":".$line["line"]."</i>: ";
        if(isset($line["class"]))
        {
            echo "<b>".$line["class"]."</b>".$line["type"];
        }
        echo "<b>".$line["function"]."</b>(";
        if(!empty($line["args"]))
            print_r($line["args"]);
        echo ")<br/>";
    }
    echo "</p>";
}
    

function debug_plugin_init()
{
    set_error_handler('debug_handler');
}


