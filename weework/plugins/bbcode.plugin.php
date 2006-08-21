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

    Usage:
    echo bbcodeConvert("[b]Bold ![/b]");

 */

// Syntax:
// --------------
// [img]http://elouai.com/images/star.gif[/img]
// [url="http://elouai.com"]eLouai[/url]
// [mail="webmaster@elouai.com"]Webmaster[/mail]
// [size="25"]HUGE[/size]
// [color="red"]RED[/color]
// [b]bold[/b]
// [i]italic[/i]
// [u]underline[/u]
// [list][*]item[*]item[*]item[/list]
// [code]value="123";[/code]
// [quote]John said yadda yadda yadda[/quote]
// ----

function bbcode_plugin_init()
{
    // Nothing to do
}


function bbcodeConvert($text)
{
    $bbcode = array("<", ">", "----",
            "[list]", "[*]", "[/list]", 
            "[img]", "[/img]", 
            "[b]", "[/b]", 
            "[u]", "[/u]", 
            "[i]", "[/i]",
            '[color="', "[/color]",
            "[size=\"", "[/size]",
            '[url="', "[/url]",
            "[mail=\"", "[/mail]",
            "[code]", "[/code]",
            "[quote]", "[/quote]",
            '"]');
    $htmlcode = array("&lt;", "&gt;", "<hr>",
            "<ul>", "<li>", "</ul>", 
            "<img src=\"", "\">", 
            "<b>", "</b>", 
            "<u>", "</u>", 
            "<i>", "</i>",
            "<span style=\"color:", "</span>",
            "<span style=\"font-size:", "</span>",
            '<a href="', "</a>",
            "<a href=\"mailto:", "</a>",
            "<code>", "</code>",
            "<table width=100% bgcolor=lightgray><tr><td bgcolor=white>", "</td></tr></table>",
            '">');
    $newtext = str_replace($bbcode, $htmlcode, $text);
    $newtext = nl2br($newtext);//second pass
    return $newtext;
}

