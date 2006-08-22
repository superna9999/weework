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
        echo $GLOBALS["BASE_HREEF"];
    }

    function pageSql($arg)
    {
        $arr = db_fetch_rows("SELECT * from users");
        $arr1 = db_fetch_one("SELECT * from users");
        $c = db_fetch_one_cell("SELECT count(id) from users");
        $e = db_fetch_one_cell("SELECT name from users where id=1");

        echo "<pre>";
        print_r($arr);
        print_r($arr1);
        print_r($c);
        print_r($e);
        echo "</pre>";
    }

    function pageWiki($arg)
    {
        echo wiki_parse("*test\n");
    }
}


