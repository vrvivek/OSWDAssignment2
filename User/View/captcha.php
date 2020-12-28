<?php
header("Content-type: image/png");
session_start();
$_SESSION['code']=rand(1,50000);
$im = @imagecreate(100, 30)	or die("Cannot Initialize new GD image stream");

//$im = @imagecreate(30, 250) or die("Cannot Initialize new GD image stream");

$background_color = imagecolorallocate($im, 255, 255, 255);
$text_color = imagecolorallocate($im, 233, 14, 91);
imagestring($im, 5, 5, 5,  $_SESSION['code'],$text_color); // write string horizontally

//imagestringup($im, 5, 5, 200,  "A Simple Text String", $text_color); // write string vertically
imagepng($im);
imagedestroy($im);
?>   