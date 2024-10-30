<?php

	//This page produce a randim catpcha value image

	session_start();

	$random_txt = md5(microtime());
	$random_txt = substr($random_txt, 0, 5);

	$_SESSION['bwhd_captcha_newticket'] = $random_txt;

	$im = imagecreate(120, 40); 
	$white = imagecolorallocate($im, 255, 255, 255); 
	$black = imagecolorallocate($im, 0, 0, 0); 
	imagestring($im, 10, 30, 10, $random_txt, $black); 

	header("Content-type: image/jpeg"); 
	imagejpeg($im); 
	imagedestroy($im);

?>