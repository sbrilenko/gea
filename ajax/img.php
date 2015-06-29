<?php
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
$root = $_SERVER['DOCUMENT_ROOT'];	
//require_once $root."/lib/class.invis.db.php";
//$db = db :: getInstance();		
$elements;
$array;
$count=0;
$number=0;
$dir='';
$element_alt_img;
 
	$elements = "pictures=[";
 
 
 
 
	
	$array=null;
    $dir = $_SERVER['DOCUMENT_ROOT']."/img/g/".$_POST['folder']."/";
    if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
           // echo "файл: $file : тип: " . filetype($dir . $file) . "";
            if((substr(strrchr($file, '.'), 1)=='jpg')and substr($file,0,3)!='ava')
			{
				 $array[]=$file;
				 /*$elements .= '"'.$file.'"';
           		 if ($count!=$number) $elements .= ",";
				 $number++;*/
			}	
        } 
    }
}
//@sort($array);
usort($array, "cmp");
for($i=0;$i<count($array);$i++)
{
	 $elements .= '"'.$array[$i].'"';
     if ($i+1!=count($array)) $elements .= ",";
}
closedir($dh);


print  $elements."];";

 
?>