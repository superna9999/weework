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

define("LIB_PATH", "../");

define("SMARTY_PATH", LIB_PATH . "smarty/");
define("ADODBLITE_PATH", LIB_PATH . "adodb_lite/");
define("WEEWORK_PATH", LIB_PATH . "weework/");
define("WIKI_PATH", LIB_PATH . "wikirenderer/");

define("WEEWORK_DEBUG", true);

/* AdoDB Lite - mysql */
define("DB_TYPE", "mysql");
//define("DB_TYPE", "postgres");
//define("DB_TYPE", "sqlite");

/* Database Settings */
define("DB_USER", "superna");
define("DB_PASS", "superna");
define("DB_DATABASE", "demo");
define("DB_HOST", "localhost");

require_once WEEWORK_PATH . "weework.inc.php";
require_once "includes.php";

$wee = new wee();
$wee->weeRun();

