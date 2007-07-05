<?php
/*
	Published by Pavlos Stamboulides under GPL2
	pavlos@psychology.deletethis.gr
*/

require_once('captcha.class.php');


function smarty_function_captcha($params, &$smarty){ 
	$length = ((int)$params['length'])? (int)$params['length']: 4;
	$name = ($params['name'])? $params['name'] : 'captcha';
    $salt = ($params['salt'])? $params['salt'] : 'salt';

	$tempfolder = "captcha"; // Might want to think about putting this in the OSs tmp folder.. On linux it'll automatically delete the image
                            // On windows it won't though.
	
	$c = new Captcha($length);
	$code = $c->GenStr();
    $c->fontdir = realpath ($smarty->template_dir);
    $salted = md5(strtoupper($code) . $salt . 'salt' . strtoupper($code) . $salt . 'salt');
	
	$code = $c->Generate("$tempfolder/$salted.png");
	return '<img src="captcha.php?cap='.$salted.'" id="captcha" /><input type="hidden" name="'.$name.'" value="'.$salted.'" />';

}


?>
