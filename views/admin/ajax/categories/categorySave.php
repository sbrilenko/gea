<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root."/lib/include.php";
$db = db :: getInstance();



    $caption = htmlspecialchars($_POST['caption']);
    $link = htmlspecialchars($_POST['link']);
    $parent = $_POST['parent'];
    $num = $_POST['num'];
    $show = ($_POST['show']) ? 1 : 0;
    echo '<div class="down">';
    if ($_POST['id'])
    {
        if ($db->query("UPDATE  `menu` SET `caption` = '{$caption}', `parentId` = {$parent}, `num` = {$num}, `visibility` = {$show}, `link` = '{$link}' WHERE id = {$_POST['id']}")) echo '<span class="green">Раздел был успешно изменен.</span><br />'; 
        else echo '<span class="red">Error. Раздел не был сохранен!</span>';            
    }
    else
    {
        
        if ($db->query("INSERT INTO  `mennu` (`caption`, `link`, `parentId`, `num`, `visibility`) VALUES ('{$caption}', '{$link}', {$parent}, {$num}, {$show}')")) echo '<span class="green">Новое Видео было записано успешно.</span><br />'; 
        else echo '<span class="red">Error. Видео не было сохранено!</span>';            

    }
    echo '</div>';
?>