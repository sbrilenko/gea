<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root."/lib/include.php";
$db = db :: getInstance();



    $name = htmlspecialchars(strip_tags($_POST['name']));
    $link = $_POST['link'];
    echo '<div class="down">';
    if ($_POST['id'])
    {
        if (mysql_query("UPDATE  `video` SET `name` = '{$name}', `link` = '{$link}' WHERE id = {$_POST['id']}")) echo '<span class="green">Видео было записано успешно.</span><br />'; 
        else echo '<span class="red">Error. Видео не было сохранено!</span>';            
    }
    else
    {
        $is = mysql_fetch_array(mysql_query("select * from video where link = '{$link}'"));
        if (!$is)
        {
        if (mysql_query("INSERT INTO  `video` (`name`, `link`) VALUES ('{$name}', '{$link}')")) echo '<span class="green">Новое Видео было записано успешно.</span><br />'; 
        else echo '<span class="red">Error. Видео не было сохранено!</span>';            
        }
    }
    echo '</div>';
?>