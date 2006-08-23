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
        global $global;
        if(file_exists("text/login.txt"))
            $smarty->assign("text", wiki_parse(file_get_contents("text/login.txt")));
        $c = new Captcha(4);
        $c->Generate("temp.png");
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


