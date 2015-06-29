<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root."/lib/include.php";
$db = db :: getInstance();
print_r($_FILES);
//if($_POST['act']=='delp')
//{
//    $sql_s="SELECT * FROM menuphoto WHERE id=".$_POST['id'];
//    $db->query($sql_s);
//    if($db->getCount()>0)
//    {
//        $arr_p=$db->getArray();
//        if(file_exists($root."/img/menu/size1/".$arr_p[0]['name']."_".$arr_p[0]['id'].".jpg"))
//        {
//            unlink($root."/img/menu/size1/".$arr_p[0]['name']."_".$arr_p[0]['id'].".jpg");
//        }
//        if(file_exists($root."/img/menu/size2/".$arr_p[0]['name']."_".$arr_p[0]['id'].".jpg"))
//        {
//            unlink($root."/img/menu/size2/".$arr_p[0]['name']."_".$arr_p[0]['id'].".jpg");
//        }
//        if(file_exists($root."/img/menu/size3/".$arr_p[0]['name']."_".$arr_p[0]['id'].".jpg"))
//        {
//            unlink($root."/img/menu/size3/".$arr_p[0]['name']."_".$arr_p[0]['id'].".jpg");
//        }
//        $sql="DELETE FROM menuphoto WHERE id=".$_POST['id'];
//        $db->query($sql);
//    }
//
//    return false;
//}
//else
//{
//}
    if($_POST['last_id']){
        mkdir($_SERVER["DOCUMENT_ROOT"]."/img/g/1000/".$_POST['last_id']);
        chmod($_SERVER["DOCUMENT_ROOT"]."/img/g/1000/".$_POST['last_id'], 0777);
        mkdir($_SERVER["DOCUMENT_ROOT"]."/img/g/1240/".$_POST['last_id']);
        chmod($_SERVER["DOCUMENT_ROOT"]."/img/g/1240/".$_POST['last_id'], 0777);
        mkdir($_SERVER["DOCUMENT_ROOT"]."/img/g/1320/".$_POST['last_id']);
        chmod($_SERVER["DOCUMENT_ROOT"]."/img/g/1320/".$_POST['last_id'], 0777);
        mkdir($_SERVER["DOCUMENT_ROOT"]."/img/g/1400/".$_POST['last_id']);
        chmod($_SERVER["DOCUMENT_ROOT"]."/img/g/1400/".$_POST['last_id'], 0777);
        mkdir($_SERVER["DOCUMENT_ROOT"]."/img/g/".$_POST['last_id']);
        chmod($_SERVER["DOCUMENT_ROOT"]."/img/g/".$_POST['last_id'], 0777);
        $f_id = $_POST['last_id'];
        echo $f_id.'/';
    }

    if(empty($_FILES['photos']['tmp_name']))
    {
            echo '12';
    	   $err='Файлы отсутствует или возможно файлы слишком большие! Попробуйте загрузить фотографии меньшего объема';
    	  $arr=array();
          $arr=array_merge($arr,array('err'=>$err));
          echo json_encode($arr);
    	   return false;
    }
    else
    {
            $namephoto=$_POST['count']+1;
            $ava = true;
            for($i=0; $i<=count($_FILES['photos']['name']);$i++){
                echo count($_FILES['photos']);
            $handle = new Upload($_FILES['photos']['tmp_name'][$i]);
            if ($handle -> uploaded)
            {
                if($_FILES['photos']['type'][$i]!='image/jpeg')
                {
                    echo json_encode(array('err'=>'Картинка должна быть jpg'));
                    exit;
                }
                $size=getimagesize($_FILES['photos']['tmp_name'][$i]);

                if($size[1]<666)
                {
                    echo json_encode(array('err'=>'HEIGHT картинки должна быть не меньше 666'));
                    exit;
                }


                if (!$handle -> processed) echo 'Картинка не была загружена <br />error : ' . $handle -> error;

                //проверим нужно ли обрезать по ширине
                /*if($handle->image_src_y!=720)
                {
                    echo "<div class='error'>Высота должна быть 720</div>";
                    die();
                }
                if($handle->file_src_size>1500000)
                {
                    echo "<div class='error'>Загрузите фотографию меньшего размера</div>";
                    die();
                }*/

                $handle->file_new_name_body = $namephoto;
        		$handle->image_convert = "jpg";
        		$handle->image_resize          = true;
        		$handle->image_x = ($handle->image_src_x > $handle->image_src_y) ? 999 : 444;
                $handle->image_ratio_crop      = true;
        		$handle->image_y               = 666;
        		$handle->jpeg_quality = 100;
        		$handle->image_unsharp = false;
        		$handle->process($root.'/img/g/1400/'.$f_id);
                echo $root.'/img/g/1400/'.$f_id.'/'.$namephoto.'->';
                //1320

                $handle->file_new_name_body = $namephoto;
        		$handle->image_convert = "jpg";
         		$handle->image_resize          = true;
                $handle->image_x = ($handle->image_src_x > $handle->image_src_y) ? 882 : 392;
                $handle->image_ratio_crop      = true;
        		$handle->image_y               = 588;
        		$handle->jpeg_quality = 100;
        		$handle->image_unsharp = false;
        		$handle->process($root.'/img/g/1320/'.$f_id);
                echo $root.'/img/g/1320/'.$f_id.'/'.$namephoto.'->';
                //1240

                $handle->file_new_name_body = $namephoto;
        		$handle->image_convert = "jpg";
         		$handle->image_resize          = true;
                $handle->image_x = ($handle->image_src_x > $handle->image_src_y) ? 825 : 366;
                $handle->image_ratio_crop      = true;
        		$handle->image_y               = 550;
        		$handle->jpeg_quality = 100;
        		$handle->image_unsharp = false;
        		$handle->process($root.'/img/g/1240/'.$f_id);
                echo $root.'/img/g/1240/'.$f_id.'/'.$namephoto.'->';
                //1000
                $handle->file_new_name_body = $namephoto;
                $handle->image_convert = "jpg";
                $handle->image_resize          = true;
                $handle->image_x = ($handle->image_src_x > $handle->image_src_y) ? 687 : 306;
                $handle->image_ratio_crop      = true;
                $handle->image_y               = 458;
                $handle->jpeg_quality = 100;
                $handle->image_unsharp = false;
                $handle->process($root.'/img/g/1000/'.$f_id);
                echo $root.'/img/g/1000/'.$f_id.'/'.$namephoto.'->';

                // превью
                $handle->file_new_name_body = $namephoto;
                $handle->image_convert = "jpg";
                $handle->image_resize          = true;
                $handle->image_x = ($handle->image_src_x > $handle->image_src_y) ? 329 : 246;
                $handle->image_ratio_crop      = true;
                $handle->image_y = ($handle->image_src_x > $handle->image_src_y) ? 219 : 369;
                $handle->jpeg_quality = 100;
                $handle->image_unsharp = false;
                $handle->process($root.'/img/g/'.$f_id);
                echo $root.'/img/g/'.$f_id.'/'.$namephoto.'->';

                //ava
                if (($ava) and ($handle->image_src_x > $handle->image_src_y)){
                $handle->file_new_name_body = 'ava';
                $handle->image_convert = "jpg";
                $handle->image_resize          = true;
                $handle->image_x = 329;
                $handle->image_ratio_crop      = true;
                $handle->image_y = 219;
                $handle->jpeg_quality = 100;
                $handle->image_unsharp = false;
                $handle->process($root.'/img/g/'.$f_id);
                echo $root.'/img/g/'.$f_id.'/'.$namephoto.'->';
                    $ava = false;
                }
            }

//            if($_POST['id'])
//            {
//                $db -> query("INSERT INTO menuphoto SET dtcreate='".date('Y-m-d H:i:s')."', name = '".$namephoto."', temp = 0, parent = ".$_POST['id']);
//            }
//            else
//            {
//                $db -> query("INSERT INTO menuphoto SET dtcreate='".date('Y-m-d H:i:s')."', name = '".$namephoto."', temp = 0, parent = ".$_POST['id_code']);
//            }
//            $img=$namephoto_img;
//            $arr=array();
//            $arr=array_merge($arr,array('img'=>$img),array('id'=>$id));
//            echo json_encode($arr);
//            }
                $namephoto++;
            }
        echo 'Сохранено успешно';
    }
//}

?>
 
