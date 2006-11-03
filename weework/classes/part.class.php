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

class part
{
    function part()
    {
        //Must Find something to do
    }

    function lookUp($path)
    {
        $defpage = POST_PREFIX . DEFAULT_PAGENAME;
        
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
            if(isset($path["method"]) && $path["method"] === "POST")
            {
                $pagename = POST_PREFIX . $path["page"];

                if(method_exists($this, $pagename))
                    return $this->$pagename($args);
                if(method_exists($this, $defpage))
                    return $this->$defpage($args, $path);
            }

            $pagename = PAGE_PREFIX . $path["page"];

            if(method_exists($this, $pagename))
                return $this->$pagename($args);

            return $this->$defpage($args, $path);
        }

       return $this->$defpage($args);
                   
    }

    function initPart($arg)
    {
        //Should be Overridden
    }

    function pageDefault($arg, $path = array())
    {
        die("This should be overridden");
    }
}


