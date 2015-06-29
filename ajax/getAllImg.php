<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root."/lib/include.php";
$db = db :: getInstance();

function cmp($a, $b)
{
    $a2=explode('.',$a);
    $a=$a2[0];
    
    $b2=explode('.',$b);
    $b=$b2[0];
    
    if ($a == $b) {
        return 0;
    }
    return ($a < $b) ? -1 : 1;
}
$db->query("SELECT * FROM galery_folders WHERE id = {$_POST['folder']}");
$folder = $db->getRow();
$titleAlbom = $folder['name'];
$dir = $_SERVER['DOCUMENT_ROOT']."/img/g/".$_POST['folder']."/";
$dir_file = opendir($dir);
while ($file = readdir($dir_file)) 
    if (ereg("(.)+\\.(jpg)", $file) and $file!='ava.jpg') 
        $array[]=$file;
    usort($array, "cmp");
    //@sort($array);
    foreach($array as $i=> $oneImg)
    {
        list($w,$h) = getimagesize($_SERVER['DOCUMENT_ROOT'].'/img/g/'.$_POST['folder'].'/'.$oneImg);
        $width = ($w > $h) ? 'width:32%' : 'width:24%';
        //$margin = ($w > $h) ? '' : 'margin-bottom:-1px';
        $imgs = '<div class="imgInside" style="'.$width.'; max-height:150px"><img class="lazy" data-original="/img/g/'.$_POST['folder'].'/'.$oneImg.'"  width="100%"  align="left" style="'.$margin.'" data-id="'.$i.'" alt=" "/></div>';//Компания GEA Group фотогалерея "'.$titleAlbom.'", фото №'.$i.'
        if ($w > $h) 
        {
            $vImg .= $imgs; 
            $vImgC++;
        }
        else
        {
            $hImg .= $imgs; 
            $hImgC++;
        }
//echo $hImgC;
        if ($vImgC == 3) 
        {
            echo $vImg.'<div style="clear: both;"></div>';
            $vImg = '';
            $vImgC = 0;
        }

        if ($hImgC == 4) 
        {
            echo $hImg.'<div style="clear: both;"></div>';
            $hImg = '';
            $hImgC = 0;
        }
        
    }
    echo '<div style="clear: both;"></div>'.$hImg.$vImg;
?>