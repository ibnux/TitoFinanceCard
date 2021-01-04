<?php
include "vendor/autoload.php";

$text = strtoupper(preg_replace("/[^a-zA-Z0-9 ]+/", "",urldecode($_GET['nama'])));
$kartu = strtoupper(preg_replace("/[^a-zA-Z0-9 ]+/", "",urldecode($_GET['kartu'])));
$tipe = strtoupper(preg_replace("/[^a-zA-Z0-9 ]+/", "",urldecode($_GET['tipe'])))*1;
if(strlen($text)>24)
    $text = substr($text,0,24);

$md5 = md5(strtoupper($text.$kartu.$tipe));
$path = "images/$md5.jpg";
$save = true;

if(empty($kartu)){
    $generator = new Plansky\CreditCard\Generator();
    $nomor = $generator->single(5409, 20);
    $kartu = substr($nomor,0,4).' '.substr($nomor,4,4).' '.substr($nomor,8,4).' '.substr($nomor,12,4);
}
// }else{
//     $save = false;
// }


if (isset($_GET['dl'])) {
    if($tipe==5){
        $namaTipe = 'uranium';
    }else if($tipe==4){
        $namaTipe = 'plutonium';
    }else if($tipe==3){
        $namaTipe = 'platinum';
    }else if($tipe==2){
        $namaTipe = 'neo_diamond';
    }else{
        $namaTipe = 'red_diamond';
    }
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=tito_finance_'.$namaTipe.'_untuk_'.strtolower(preg_replace("/[^a-zA-Z0-9]+/", "_", $text." ".$kartu)). ".jpg");
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

if (!file_exists($path) || !$save) {
    if($tipe==5){
        $image1 = imagecreatefromjpeg('template/uranium.jpg');
    }else if($tipe==4){
        $image1 = imagecreatefromjpeg('template/plutonium.jpg');
    }else if($tipe==3){
        $image1 = imagecreatefromjpeg('template/platinum.jpg');
    }else if($tipe==2){
        $image1 = imagecreatefromjpeg('template/neo_diamond.jpg');
    }else{
        $image1 = imagecreatefromjpeg('template/red_diamond.jpg');
    }
    $font_size_nama = 50;
    $font_file_nama = './template/FuturaMediumBT.ttf';
    $type_space_nama = imagettfbbox($font_size_nama, 0, $font_file_nama, $text);
    $text_width_nama= abs($type_space_nama[4] - $type_space_nama[0]);
    $text_height_nama = abs($type_space_nama[5] - $type_space_nama[1]);

    $font_size_nomor = 73;
    $font_file_nomor = './template/digital7.ttf';
    $type_space_nomor = imagettfbbox($font_size_nomor, 0, $font_file_nomor, $text);
    $text_width_nomor= abs($type_space_nomor[4] - $type_space_nomor[0]);
    $text_height_nomor = abs($type_space_nomor[5] - $type_space_nomor[1]);

    $text_color = imagecolorallocate($image1, 255, 255, 255);
    $text_colorb = imagecolorallocate($image1, 0, 0, 0);
    $text_colorr = imagecolorallocate($image1, 255, 0, 0);

    $width = ImageSX($image1);
    $height = ImageSY($image1);


    $x = 50;
    $y = 700;
    //255, 29, 800, 450, 527.5, 239.5
    //echo "$text_width, $text_height_nama, $width, $height, $x, $y";
    //imagettftext($image1, $font_size_nama, 0, $x, $y, $text_color, $font_file_nama, $text);
    imagettftext($image1, $font_size_nama, 0, $x+2, $y+2 , $text_colorb, $font_file_nama, $text);
    imagettftext($image1, $font_size_nama, 0, $x, $y , $text_color, $font_file_nama, $text);

    //imagettftext($image1, $font_size_nomor, 0, 402, 300 , $text_colorr, $font_file_nomor,$kartu);
    imagettftext($image1, $font_size_nomor, 0, 400, 335, $text_color, $font_file_nomor,$kartu);

    imagejpeg($image1, $path, 100);
    imagedestroy($image1);
}
header('Content-Length: ' . filesize($path));
readfile($path);
