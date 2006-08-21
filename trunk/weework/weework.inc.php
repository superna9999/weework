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

if(!defined("WEEWORK_PATH"))
    define("WEEWORK_PATH", dirname(__FILE__));

if(!defined("SMARTY_PATH"))
    define("SMARTY_PATH", WEEWORK_PATH . "smarty/");

define("PLUGINS_PATH", WEEWORK_PATH . "plugins");
define("CLASSES_PATH", WEEWORK_PATH . "classes/");

/* Wee Defines */

define("PAGE_PREFIX", "page");
define("POST_PREFIX", "post");
define("PART_PREFIX", "part_");
define("PLUGIN_NAME", ".plugin.php");
define("PLUGIN_INIT", "_plugin_init");

require WEEWORK_PATH . 'includes.inc.php';

