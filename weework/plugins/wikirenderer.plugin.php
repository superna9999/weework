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

    $Id:$
 */

/* wiki parsing plugin */

if(!defined("WIKI_PATH"))
	define("WIKI_PATH", WEEWORK_PATH . "wikirenderer/");

if(!defined("WIKI_DEBUG"))
	define("WIKI_DEBUG", true);

require_once WIKI_PATH . 'WikiRenderer.lib.php';

$Entity = array(); 
$FlgChr = chr(255);

function wikirenderer_plugin_init()
{
    // Nothing to Do
}

function wiki_parse($text)
{
    $output = "";

    $ctr = new WikiRenderer();
    $output = $ctr->render($text);

    if($ctr->errors && WIKI_DEBUG)
    {
        echo '<p style="color:red;">Warning: ';
        if(count($ctr->errors)>1)
            echo 'errors at lines : ',implode(',',array_keys($ctr->errors)),'</p>' ;
        else
        {
            list($num,$l)=each($ctr->errors);
            echo 'error at line ', $num,'</p>';
        }
    }
    return $output;
}
