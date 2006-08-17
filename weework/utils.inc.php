<?php

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
