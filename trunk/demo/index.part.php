<?php

class part_index extends part
{ 
    function initPart($arg)
    {
        global $global;
        unset($global->login);
    }

    function pageDefault($arg)
    {
        global $smarty;

        $smarty->display("login.tpl");
    }

    function pageLogin($arg)
    {
        global $smarty;
        global $global;
        
        $p = $_POST;
        if(isset($p["user"]) && $p["user"]==="admin")
        {
            $global->login = true;
            userRedirect("/user");
        }
        else
           $smarty->display("error.tpl");
    }
}

?>

