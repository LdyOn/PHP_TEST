<?php
header('Content-type: image/jpeg');
putenv('GDFONTPATH=' . realpath('.'));
$font = 'simkai'; //楷体
$im = imagecreatetruecolor(800, 1000);
$white = imagecolorallocate($im, 255,255,255);
$black = imagecolorallocate($im, 0, 0, 0);

imagefill($im, 0, 0, $white);
//imagestring($im, 5, 300, 50, 'HelloWorld', $black);
$position = imagettfbbox(20, 0, $font, '共产主义接班人');
imagettftext($im, 20, 0, (800-$position[4])/2, 60, $black, $font, '共产主义接班人');
imagejpeg($im);