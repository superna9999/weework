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

    /* Various */
    
    function sessionDestroy()
    {
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time()-42000, '/');
        }
        session_destroy();
    }

    function userRedirect($path, $base = true)
    {   
        if($base)
        {
            $loc = $GLOBALS["BASE_HREF"].$path;
            header("Location: $loc");
        }
        else
            header("Location: $path");
        exit();
    }

    function metaRedirect($path, $base = true)
    {
        if($base)
            $loc = $GLOBALS["BASE_HREF"].$path;
        else
            $loc = $path;

        echo "<html><head><title>Redirect</title><meta http-equiv=\"refresh\" content=\"0;url=$loc\"></head><body><a href=\"$loc\">Redirection</a></body></html>";
        exit();
    }

    function redirectTrue($path, $bool)
    {
        if($bool)
            userRedirect($path);
    }
    
    function redirectFalse($path, $bool)
    {
        if(!$bool)
            userRedirect($path);
    }

    /* Plugins System */

    function loadPlugin($name, $plugin_path = PLUGINS_PATH)
    {    

        $filename = $plugin_path . "/" . $name . PLUGIN_NAME;
        $initfunc = $name . PLUGIN_INIT;

        if(file_exists($filename))
        {
            require $filename;

            if(function_exists($initfunc))
                $initfunc();
            else
                echo "Failed to init Plugin $name";
        }
        else
            die("Failed to Load Plugin $name");

    }
?>
