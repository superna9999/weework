<?php

/* AdodbLite plugin */

if(!defined("ADODBLITE_PATH"))
	define("ADODBLITE_PATH", WEEWORK_PATH . "adodb_lite/");

if(!defined("DB_TYPE"))
    define("DB_TYPE", "mysql");

if(!defined("DB_DEBUG"))
    define("DB_DEBUG", false);
if(!defined("DB_USER"))
    define("DB_USER", "root");
if(!defined("DB_PASS"))
    define("DB_PASS", "");
if(!defined("DB_DATABASE"))
    define("DB_DATABASE", "demo");
if(!defined("DB_HOST"))
    define("DB_HOST", "localhost");

require_once ADODBLITE_PATH . "adodb.inc.php";

function adodblite_plugin_init()
{
    $GLOBALS["db"] = ADONewConnection(DB_TYPE);

    $GLOBALS["db"]->debug = DB_DEBUG;

}

function db_connect($host=DB_HOST, $user=DB_USER, $pass=DB_PASS, $database=DB_DATABASE)
{
    global $db;
    
    $db->PConnect($host, $user, $pass, $database) or die("Unable to Connect to database");
}

function db_disconnect()
{
    global $db;

    $db->Disconnect();
}

function db_query($sql)
{
    global $db;

    if(!$db->IsConnected())
        db_connect();

    return $db->Execute($sql);
}

function db_fetch_one($sql)
{
    global $db;

    if(!$db->IsConnected())
        db_connect();

    $result = $db->Execute($sql);
    if($result)
    {   
        $arr = $result->GetRows(1);
        if(isset($arr[0]))
            return $arr[0];
    }
    
    return array();
}

function db_fetch_rows($sql)
{
    global $db;

    if(!$db->IsConnected())
        db_connect();

    return $db->GetAll($sql);
}

function db_fetch_one_cell($sql)
{
    $arr = db_fetch_one($sql);
    if(isset($arr[0]))
    {
        return $arr[0];
    }
    else
        return NULL;
}

?>
