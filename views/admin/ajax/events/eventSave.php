<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root."/lib/include.php";
$db = db :: getInstance();

    echo '<div class="down">';
    if ($_POST['id'])
    {
            $img=mysql_fetch_array(mysql_query("select img from event where id={$_POST['id']}"));
            
            $_POST['desc'] = str_replace("'", "\'", $_POST['desc']);
            $_POST['desc'] = str_replace("`", "&lsquo;", $_POST['desc']);
            $_POST['desc'] = str_replace('"', "\"", $_POST['desc']);
            
            if (mysql_query("update event set date='".$_POST['date']."', title='".$_POST['title']."', `desc`='".$_POST['desc']."' where id=".$_POST['id'])) echo '<span class="green">Событие успешно изменено.</span><br />'; 
                else echo '<span class="red">Error. Событие не было измененно!</span><br />';
                
            if ($_FILES['img']['tmp_name'])
            {
                $imginfo=getimagesize($_FILES['img']['tmp_name']);
               // print_r($imginfo);
                if ($imginfo[0]<100) {echo '<span class="red">Error. Картинка меньше 100px по ширине!</span><br />';}
                else 
                {
                    if (!$img['img']) 
                    {
                        $imgname=uniqid().'.jpg';
                        mysql_query("update event set `img`='".$imgname."' where id={$_POST['id']}");
                        $img=mysql_fetch_array(mysql_query("select img from event where id={$_POST['id']}"));
                    }
                    if (!(move_uploaded_file($_FILES['img']['tmp_name'], $root.'/img/event/'.$img['img'])))
                        {echo '<span class="red">Error. Картинка не загружена!</span><br />';}
                    else {echo '<span class="green">Картинка загружена успешно.</span><br />'; }
                    
                    if ($imginfo[0]>=351)
                    {
                        echo '<span class="green"> Картинка была уменьшена до 350px по ширине!</span><br />';
                        resize($root.'/img/event/'.$img['img'], $root.'/img/event/'.$img['img'], 350, false);
                    }
            
                }
                
            }
    }
    else
    {
     //   print_r($_POST);
   // print_r($_FILES['img']);
        $imgname=uniqid().'.jpg';
        if ($_FILES['img']['tmp_name'])
        {
            $imginfo=getimagesize($_FILES['img']['tmp_name']);
            if ($imginfo[0]<100) {echo '<span class="red">Error. Картинка меньше 100px по ширине!</span><br />';}
            else
            {
                if (!(move_uploaded_file($_FILES['img']['tmp_name'], $root.'/img/event/'.$imgname)))
                {     
                    echo '<span class="red">Error. Картинка не загружена!</span>';
                }
                else 
                {
                    if ($imginfo[0]>=760)
                    {
                        echo '<span class="green">Картинка была уменьшена до 700px по ширине!</span><br />';
                        resize($root.'/img/event/'.$imgname, $root.'/img/event/'.$imgname, 700, false);
                    }
                    echo '<span class="green">Картинка загружена успешно.</span>'; 
                }
                
            }
         }
         $_POST['desc'] = str_replace("'", "\'", $_POST['desc']);
         //$_POST['desc'] = str_replace("`", "&lsquo;", $_POST['desc']);
         $_POST['desc'] = str_replace('"', "\"", $_POST['desc']);
         if ($_FILES['img']['tmp_name'])
            {if (mysql_query("INSERT INTO  `event` (`date`, `title` ,`desc`, `img`) VALUES ('{$_POST['date']}', '{$_POST['title']}', '{$_POST['desc']}', '{$imgname}')")) echo '<span class="green">Новое событие было записано успешно.</span><br />'; 
            else echo '<span class="red">Error. Событие не было сохранено!</span>';}
            else
            {if (mysql_query("INSERT INTO  `event` (`date`, `title` ,`desc`) VALUES ('{$_POST['date']}', '{$_POST['title']}', '{$_POST['desc']}')")) echo '<span class="green">Новое событие было записано успешно.</span><br />'; 
            else echo '<span class="red">Error. Событие не было сохранено!</span>';}           
        
    }
    echo '</div>';










?>