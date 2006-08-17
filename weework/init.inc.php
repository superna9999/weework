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

class wee
{
    function weeRun()
    {
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


