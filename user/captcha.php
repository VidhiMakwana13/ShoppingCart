<?php
session_start();
header("Content-type: image/png");
$captcha_text = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, 5);
$_SESSION['captcha'] = $captcha_text;

$image = imagecreate(70, 30);
$bg_color = imagecolorallocate($image, 255, 255, 255);
$text_color = imagecolorallocate($image, 0, 0, 0);

imagestring($image, 5, 5, 5, $captcha_text, $text_color);
imagepng($image);
imagedestroy($image);
?>
