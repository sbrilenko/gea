<?php
//...............................
function datefromsql($str)
	{
        return substr($str, -2).'.'.substr($str, -5, 2).'.'.substr($str, 0, 4);
	}
    
//...............................	
function datetosql($str)
	{
        return substr($str, -4).'-'.substr($str, -7, 2).'-'.substr($str, 0, 2);
	}
    
//...............................(NAME OF FILE)Возвращает имя файла без разрешения, либо последнее слово в адресной строке	
function nof() 
    {
        foreach (explode('/',$_SERVER['REQUEST_URI']) as $item) {$w=explode('.',$item);$script=$w[0];}
        return $script;
    }
    
//...............................(ACTIVE LINK ON SITE)Возвращает ссылку из текста обрамляя тегами <A> делая её активной	c id='alis' Если второй параетр 1 то открываеться в новом окне
function alis($link, $target_blank) 
    {
        if ($target_blank==1)
            return ereg_replace("[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]", "<a id='alis' target='_blank' href=\"\\0\">\\0</a>", $link);
        else
            return ereg_replace("[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]", "<a id='alis' href=\"\\0\">\\0</a>", $link);
    }   
//...............................Ресайз фото    
function resize($file_input, $file_output, $w_o, $h_o, $percent = false) {
	list($w_i, $h_i, $type) = getimagesize($file_input);
	if (!$w_i || !$h_i) {
		echo 'Невозможно получить длину и ширину изображения';
		return;
    }
    $types = array('','gif','jpeg','png');
    $ext = $types[$type];
    if ($ext) {
    	$func = 'imagecreatefrom'.$ext;
    	$img = $func($file_input);
    } else {
    	echo 'Некорректный формат файла';
		return;
    }
	if ($percent) {
		$w_o *= $w_i / 100;
		$h_o *= $h_i / 100;
	}
	if (!$h_o) $h_o = $w_o/($w_i/$h_i);
	if (!$w_o) $w_o = $h_o/($h_i/$w_i);
	$img_o = imagecreatetruecolor($w_o, $h_o);
	imagecopyresampled($img_o, $img, 0, 0, 0, 0, $w_o, $h_o, $w_i, $h_i);
	if ($type == 2) {
		return imagejpeg($img_o,$file_output,100);
	} else {
		$func = 'image'.$ext;
		return $func($img_o,$file_output);
	}
} 
?>