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


