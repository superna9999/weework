<?php

class part_info extends part
{
    function initPart($arg)
    {
        global $global; 
    }

    function pageDefault($arg)
    {
       phpinfo();
    }

    function pageTest($arg)
    {
        echo $GLOBALS["BASE_HREF"];
    }
}

?>

