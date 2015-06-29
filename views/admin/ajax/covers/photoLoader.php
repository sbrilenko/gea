<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root."/lib/include.php";
$db = db :: getInstance();
$pathToSaveImg = $root.'/catalog/img/';
if($_POST['type'] == 'el'){
        echo 'el';
        $foo = new Upload($_FILES['el']);
        if ($foo -> uploaded) 
        {  
            $uniq = uniqid();
            $foo -> file_new_name_body = $uniq;
            $foo -> Process($pathToSaveImg);
            if (!$foo -> processed) echo 'Картинка на была загружена <br />error : ' . $foo -> error;   
        }
        echo $uniq;        
    }

if($_POST['type'] == 'pdf'){
        echo 'pdf';
        $foo = new Upload($_FILES['pdf']);
        if ($foo -> uploaded) 
        {  
            $uniq = uniqid();
            $foo -> file_new_name_body = $uniq;
            $foo -> Process($pathToSaveImg);
            if (!$foo -> processed) echo 'Картинка на была загружена <br />error : ' . $foo -> error;
            
            // для просмотра
            $foo -> file_new_name_body = $uniq.'_s';            
            $foo -> image_x = 1123;
            $foo -> image_ratio_y = true;        
            $foo -> image_resize = true;                        
            $foo -> Process($pathToSaveImg);         
        }
        echo $uniq;   
    }    

?>
 
