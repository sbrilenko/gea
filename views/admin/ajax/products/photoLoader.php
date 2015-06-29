<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root."/lib/include.php";
$db = db :: getInstance();
$pathToSaveImg = $root.'/catalog/img/prod/';

        $foo = new Upload($_FILES['photo']);
        if ($foo -> uploaded) 
        {  
            $uniq = uniqid();
            $foo -> file_new_name_body = $uniq;
            $foo -> Process($pathToSaveImg);
            if (!$foo -> processed) echo 'Картинка на была загружена <br />error : ' . $foo -> error;
            
            // для сайта
            $foo -> file_new_name_body = $uniq.'_site';            
            $foo -> image_x = 322;
            $foo -> image_ratio_y = true;        
            $foo -> image_resize = true;                        
            $foo -> Process($pathToSaveImg);

            // для страницы товара
            $foo -> file_new_name_body = $uniq.'_big';            
            $foo -> image_x = 333;
            $foo -> image_ratio_y = true;
            $foo -> image_resize = true;            
            $foo -> Process($pathToSaveImg);

			// для меню
            $foo -> file_new_name_body = $uniq.'_mid';            
            $foo -> image_x = 142;
            $foo -> image_ratio_y = true;
            $foo -> image_resize = true;            
            $foo -> Process($pathToSaveImg);

            // для топ товаров
            $foo -> file_new_name_body = $uniq.'_small';            
            $foo -> image_x = 71;
            $foo -> image_ratio_y = true;
            $foo -> image_resize = true;            
            $foo -> Process($pathToSaveImg);            
        }
        echo $uniq;   

?>
 
