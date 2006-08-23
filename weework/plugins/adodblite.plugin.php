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
require_once ADODBLITE_PATH . "adodb-errorhandler.inc.php";

function adodblite_plugin_init()
{
    $GLOBALS["db"] = ADONewConnection(DB_TYPE);

    $GLOBALS["db"]->debug = DB_DEBUG;

}

function db_connect($host=DB_HOST, $user=DB_USER, $pass=DB_PASS, $database=DB_DATABASE)
{
    global $db;
    
    return $db->PConnect($host, $user, $pass, $database);
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


