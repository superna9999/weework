<?php

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
        echo $GLOBALS["BASE_HREF"];
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
}

?>

