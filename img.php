<?php
include "vendor/autoload.php";

$text = strtoupper(preg_replace("/[^a-zA-Z0-9 ]+/", "",urldecode($_GET['nama'])));
if(strlen($text)>24)
    $text = substr($text,0,24);
$md5 = md5($text);
$path = "images/$md5.jpg";

if (isset($_GET['dl'])) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=sertifikate_tolol_untuk_'.strtolower(preg_replace("/[^a-zA-Z0-9]+/", "_", $text)). ".jpg");
    header('Content-Transfer-Encoding: binary');
    header('Connection: Keep-Alive');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
} else {
    header('Pragma: public');
    header('Cache-Control: max-age=86400');
    header('Expires: ' . gmdate('D, d M Y H:i:s \G\M\T', time() + 86400));
    header('Content-Type: image/jpeg');
}

if (!file_exists($path)) {

    $image1 = imagecreatefromjpeg('template.jpg');

    $font_size = 50;
    $font_file = './HelveticaNeueMed.ttf';
    $type_space = imagettfbbox($font_size, 0, $font_file, $text);
    $text_width = abs($type_space[4] - $type_space[0]);
    $text_height = abs($type_space[5] - $type_space[1]);

    $text_color = imagecolorallocate($image1, 255, 255, 255);
    $text_colorb = imagecolorallocate($image1, 0, 0, 0);
    $text_colorr = imagecolorallocate($image1, 255, 0, 0);

    $width = ImageSX($image1);
    $height = ImageSY($image1);


    $x = (($width - $text_width) / 2);
    $y = $height - ($text_height *3);
    //255, 29, 800, 450, 527.5, 239.5
    //echo "$text_width, $text_height, $width, $height, $x, $y";
    //imagettftext($image1, $font_size, 0, $x, $y, $text_color, $font_file, $text);
    imagettftext($image1, $font_size, 0, 77, $y+2 , $text_colorb, $font_file, $text);
    imagettftext($image1, $font_size, 0, 75, $y , $text_color, $font_file, $text);
    $generator = new Plansky\CreditCard\Generator();
    $nomor = $generator->single(5409, 20);
    $nomor = substr($nomor,0,4).' '.substr($nomor,4,4).' '.substr($nomor,8,4).' '.substr($nomor,12,4);
    imagettftext($image1, 60, 0, 402, (($height/2)-$text_height-20)+2 , $text_colorr, $font_file,$nomor);
    imagettftext($image1, 60, 0, 400, (($height/2)-$text_height-20) , $text_color, $font_file,$nomor);

    imagejpeg($image1, $path, 100);
    imagedestroy($image1);
}
header('Content-Length: ' . filesize($path));
readfile($path);
