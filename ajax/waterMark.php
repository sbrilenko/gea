<?php
$root = $_SERVER['DOCUMENT_ROOT'];
$value = $root.'/img/results/'.$_GET['img'];
//echo $value;
$znak_hw = getimagesize($root.'/img/gea_water_mark.png');
$foto_hw = getimagesize($value);

$znak = imagecreatefrompng  ($root.'/img/gea_water_mark.png');
$foto = imagecreatefromjpeg ($value);

imagecopy ($foto,
    $znak,
    $foto_hw[0] - $znak_hw[0],
    $foto_hw[1] - $znak_hw[1],
    0,
    0,
    $znak_hw[0],
    $znak_hw[1]);



imagejpeg ($foto, $root.'/img/results/photo.jpg', "100");
header('location: /img/results/photo.jpg');
?>