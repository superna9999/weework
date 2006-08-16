<?php

class part_user extends part
{
    function initPart($arg)
    {
        global $global;
        redirectFalse("/index", isset($global->login));
        redirectFalse("/index", $global->login);
    }

    function pageDefault($arg)
    {
       global $smarty;

       $smarty->display("user.tpl");
    }

    function pageLogout($arg)
    {
        userRedirect("/index");
    }
}

?>

