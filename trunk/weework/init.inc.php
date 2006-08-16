<?php

/* Globals */
$smarty = NULL;
$global = array();

class wee
{
    function weeRun()
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

        /* Params */
        if(isset($_SERVER["PATH_INFO"]))
        {
            $path = $_SERVER["PATH_INFO"];
        }
        else
        {
            $path = "/";
        }

        if(substr($path,0,1) === "/")
        {
            $path = substr($path, 1);
        }

        $expl = explode("/", $path);

        $args = array();
        if(isset($expl[0]) && strlen($expl[0])>0 )
        {
            $args["part"] = $expl[0];

            if(isset($expl[1]) && strlen($expl[1])>0 )
            {
                $args["page"] = $expl[1];

                $args["args"] = array();
                if(count($expl) > 2)
                {    
                    for($i = 2 ; $i < count($expl) ; ++$i)
                        $args["args"][] = $expl[$i];
                }
            }

        }
        else
            $args["part"] = "index";

        /* Find Part */
        $classname = PART_PREFIX . $args["part"];

        if(class_exists($classname))
        {
            $part = new $classname();
            $part->initPart($args);
            $part->lookUp($args);
        }
        else
            die("Class $classname does not exist !");
    }
}

?>

