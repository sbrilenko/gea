<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root."/lib/include.php";
$db = db :: getInstance();

    echo '<div class="down">';
    if ($_POST['id'])
    {
            $img=mysql_fetch_array(mysql_query("select img from results where id={$_POST['id']}"));

            $des = str_replace("'", "\'", $_POST['des']);
            $des = str_replace("`", "&lsquo;", $des);
            $des = str_replace('"', "\"", $des);
//            $des = mysql_real_escape_string($_POST['des']);
//        echo $des;
            $i = 2;
            $list = '';
            if($_POST['list_1'] and $_POST['list_1']!=0) $list=$_POST['list_1'];
            while($_POST['list_'.$i]){
                if($_POST['list_'.$i]!=0) $list .=';'.$_POST['list_'.$i];
                $i++;
            }
            $date = date_create_from_format('d.m.Y', $_POST['date']);
            $date = date_format($date, 'Y-m-d');
            if (mysql_query("update results set name='".$_POST['name']."', des='".$des."', `author_name`='".$_POST['author_name']."', prof='".$_POST['prof']."',list='".$list."', date ='".$date."'  where id=".$_POST['id'])) echo '<span class="green">Результат успешно изменен.</span><br />';
                else echo '<span class="red">Error. Данные не были изменены!</span><br />';

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
                        mysql_query("update results set `img`='".$imgname."' where id={$_POST['id']}");
                        $img=mysql_fetch_array(mysql_query("select img from results where id={$_POST['id']}"));
                    }
                    if (!(move_uploaded_file($_FILES['img']['tmp_name'], $root.'/img/results/'.$img['img'])))
                        {echo '<span class="red">Error. Картинка не загружена!</span><br />';}
                    else {echo '<span class="green">Картинка загружена успешно.</span><br />'; }

                    if (($imginfo[0]<$imginfo[1]) and ($imginfo[0]>=751))
                    {
                        echo '<span class="green"> Картинка была уменьшена до 750px по ширине!</span><br />';
                        resize($root.'/img/results/'.$img['img'], $root.'/img/results/'.$img['img'], 750, false);
                    }
                    if (($imginfo[0]>$imginfo[1]) and ($imginfo[1]>=751))
                    {
                        echo '<span class="green"> Картинка была уменьшена до 750px по высоте!</span><br />';
                        resize($root.'/img/results/'.$img['img'], $root.'/img/results/'.$img['img'], false, 750);
                    }
                    $value = $root.'/img/results/'.$img['img'];
                    $thumb = $root.'/img/results/m_'.$img['img'];
                    resize($value, $thumb, 156, false);
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
                if (!(move_uploaded_file($_FILES['img']['tmp_name'], $root.'/img/results/'.$imgname)))
                {
                    echo '<span class="red">Error. Картинка не загружена!</span>';
                }
                else
                {
                    if (($imginfo[0]<$imginfo[1]) and ($imginfo[0]>=751))
                    {
                        echo '<span class="green"> Картинка была уменьшена до 750px по ширине!</span><br />';
                        resize($root.'/img/results/'.$imgname, $root.'/img/results/'.$imgname, 750, false);
                    }
                    if (($imginfo[0]>$imginfo[1]) and ($imginfo[1]>=751))
                    {
                        echo '<span class="green"> Картинка была уменьшена до 750px по высоте!</span><br />';
                        resize($root.'/img/results/'.$imgname, $root.'/img/results/'.$imgname, false, 750);
                    }
                    resize($root.'/img/results/'.$imgname, $root.'/img/results/m_'.$imgname, 156, false);
                    echo '<span class="green">Картинка загружена успешно.</span>';
                }

            }
         }
         $des = str_replace("'", "\'", $_POST['des']);
         //$_POST['desc'] = str_replace("`", "&lsquo;", $_POST['desc']);
         $des = str_replace('"', "\"", $des);
        $i = 2;
        $list = '';
        if($_POST['list_1'] and $_POST['list_1']!=0) $list=$_POST['list_1'];
            while($_POST['list_'.$i]!=''){
                if($_POST['list_'.$i]!=0) $list .=';'.$_POST['list_'.$i];
                $i++;
            }
        $date = date_create_from_format('d.m.Y', $_POST['date']);
        $date = date_format($date, 'Y-m-d');
            if (mysql_query("INSERT INTO  `results` (`name`, `des` ,`author_name`,`prof`,`list`, `img`, `date`) VALUES ('{$_POST['name']}', '{$des}', '{$_POST['author_name']}', '{$_POST['prof']}', '{$list}','{$imgname}', '{$date}')")) echo '<span class="green">Результат был записан успешно.</span><br />';
            else echo '<span class="red">Error. Данные не были сохранены!</span>';

    }
    echo '</div>';










?>