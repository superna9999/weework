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

    Captcha Implementation

    Usage:
    $length = 4;
    $c = new Captcha($length, "../fonts");
    $code = $c->GenStr();
    $c->Generate("tmp/captcha.png");
    $global->captcha = $code;
    echo "<img src=\"tmp/captcha.png\">";

    Changelog : 
     * It has slight modifications to cover the needs 
    of generating the code before making the captcha.
    It also allows to modify the font location.

    Modified by Pavlos Stamboulides under the same license
    pavlos@psychology.deletethis.gr

    Modified by Andrew Fenn on 27 June 2007 
    under the GPL 2 or Later license
    
    andrewfenn[.at.]gmail[.dot.]com

     * Changed and corrected this code for integration in WeeWork.

 */

class Captcha
{
    var $strCheck;
    var $strLength;
    var $img;
    var $font;
    var $colorBg;
    var $colorTxt = array();
    var $colorLine;
    var $colorR;
    var $colorG;
    var $colorG2;
    var $colorB;
    var $colorB2;
    var $fontDir;
    var $imgWidth;
    var $imgHeight;

    function Captcha($length, $width = 200, $height = 50, $fontDir = './')
    {
        $this->strLength = $length;
        $this->fontDir = $fontDir;
        $this->imgWidth = $width;
        $this->imgHeight =  $height;
    }

    /* Generates the Image to the file and returns the string to verify */
    function Generate($imgName, $withEllipses = false)
    {
        $this->img = imageCreate($this->imgWidth, $this->imgHeight);
        $this->GenColors();
        if ($withEllipses)
        {
            $this->PutEllipses();
            $this->PutSimpleLines();
        }
        else
        {
            $this->PutLines();
        }
        $this->PutLetters();
        imagePNG($this->img, $imgName);
        return $this->strCheck;
    }

    function GenStr()
    {
        $this->strCheck = "";

        for($i=0 ; $i < $this->strLength ; $i++)
        {
            $textornumber = rand(1,3);
            if($textornumber == 1)
            {
                $this->strCheck .= chr(rand(49,57));
            }
            else if($textornumber == 2)
            {
                $this->strCheck .= chr(rand(65,78));
            }
            else if($textornumber == 3)
            {
                $this->strCheck .= chr(rand(80,90));
            }
        }

        return $this->strCheck;
    }

    function GenColors()
    {
        srand(rand());

        $this->colorR = rand(100,230);
        $this->colorG = rand(100,230);
        $this->colorB = rand(100,230);

        $this->colorG2 = (rand(100,230) + $this->colorG)/2;
        $this->colorB2 = (rand(100,230) + $this->colorB)/2;

        srand(rand());

        $this->colorBg = imageColorAllocate($this->img, $this->colorR, $this->colorG, $this->colorB);
        $this->colorTxt[0] = imageColorAllocate($this->img, ($this->colorR - 80), ($this->colorG2 - 70), ($this->colorB - 80));
        $this->colorTxt[1] = imageColorAllocate($this->img, ($this->colorR - 70), ($this->colorG - 80), ($this->colorB2 - 70));
        $this->colorLine = imageColorAllocate($this->img, ($this->colorR - rand(5,10)), ($this->colorG2 - rand(5,10)), ($this->colorB2 - rand(5,10)));
    }

    function PutLetters()
    {
        srand(rand()); 

        $place = 0;
        $range = ($this->imgWidth / ($this->strLength + 1));
        for($i = 0 ; $i < $this->strLength ; $i++)
        {
            $rotangle = rand(-40, 40);
            $font_size = rand(16, 19);

            do 
            {
                $temp_place = $range*($i + 1) + 
                              rand(1 ,$range / 2) - 
                              rand(1, $range / 2);
            } while ($place + ($font_size + 10) > $temp_place);

            $font = $this->fontDir.'/'.rand(1, 4).'.ttf';
            $place = $temp_place;
            imagettftext($this->img, $font_size, $rotangle, $place, 30,
                         $this->colorTxt[$i%2], $font, 
                         substr($this->strCheck, $i, 1) );
        }
    }

    function PutEllipses()
    {
        for($i=0 ; $i<4 ; $i++)
        {
            imageellipse($this->img, rand(1,200), rand(1,50), 
                         rand(50,100), rand(12,25), $this->colorLine);
        }
        for($i=0 ; $i<4 ; $i++)
        {
            imageellipse($this->img, rand(1,200), rand(1,50), 
                         rand(50,100), rand(12,25), $this->colorLine);
        }
    }

    function PutSimpleLines()
    {
        for($i = 0 ; $i < 8 ; $i++)
        {
            imageline($this->img, rand(1,200), rand(1,50),
                      rand(50,100), rand(12,25), $this->colorLine);
        }
    }

    function PutLines()
    {

        srand(rand());

        $temp_y = 0;
        $temp_x = 0;
        for($i = 0 ; $i < 5 ; $i++)
        {
            for ($x = 0; $x < 15; $x++) 
            {
                $min_x = $temp_x;
                $temp_x = rand(-20, 15) + ($x * rand(10,20));
                $min_y = $temp_y;
                $temp_y = rand(-15, 10) + ($i * rand(-4,9));
                $color = imageColorAllocate($this->img, 
                        ($this->colorR - rand(-15,15)), 
                        ($this->colorG - rand(-15,15)), 
                        ($this->colorB - rand(-15,15)));

                $this->drawRoundRectangle($this->img, $min_x , $min_y,
                       $temp_x, $temp_y, rand(1, 30), $color); 
            }
        }
    }

    function drawRoundRectangle($img, $x1, $y1, $x2, $y2, $radius, $color)
    {
        imagefilledrectangle($img, $x1 + $radius, $y1, 
                             $x2 - $radius, $y2, $color);
        imagefilledrectangle($img, $x1, $y1 + $radius, 
                             $x1 + $radius-1, $y2 - $radius, $color);
        imagefilledrectangle($img, $x2 - $radius+1, $y1 + $radius,
                             $x2, $y2-$radius, $color);

        imagefilledarc($img, $x1 + $radius, $y1 + $radius, $radius * 2,
                       $radius * 2, 180 , 270, $color, IMG_ARC_PIE);
        imagefilledarc($img, $x2 - $radius, $y1 + $radius, $radius * 2,
                       $radius * 2, 270 , 360, $color, IMG_ARC_PIE);
        imagefilledarc($img, $x1 + $radius, $y2 - $radius, $radius * 2,
                       $radius * 2, 90 , 180, $color, IMG_ARC_PIE);
        imagefilledarc($img, $x2 - $radius, $y2 - $radius, $radius * 2,
                       $radius * 2, 360 , 90, $color, IMG_ARC_PIE);
    }

}

