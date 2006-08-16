<?php

class part
{
    function part()
    {
        //Must Find something to do
    }

    function lookUp($path)
    {
        //path should be "page", "params"...
        if(isset($path["args"]))
        {
            $args = $path["args"];
        }
        else
        {
            $args = array();
        }

        if(isset($path["page"]))
        {
            $pagename = PAGE_PREFIX . $path["page"];

            if(method_exists($this, $pagename))
               return $this->$pagename($args);
        }

       return $this->pageDefault($args);
                   
    }

    function initPart($arg)
    {
        //Should be Overridden
    }

    function pageDefault($arg)
    {
        die("This should be overridden");
    }
}

?>
