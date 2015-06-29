<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root."/lib/include.php";
$db = db :: getInstance();
    if($_POST['id']!=0){
        $db->query("UPDATE menu SET caption = '{$_POST['caption']}' WHERE id = {$_POST['id']}");
        echo '2';
    }else{
        $db->query("INSERT INTO menu (parentId, caption, num,visibility) VALUES (32,'{$_POST['caption']}',110,0)");
        echo '1';
        $l_id = $db->last();
        $db->query("UPDATE menu SET link = 'show/{$l_id}' WHERE id = {$l_id}");
    }
?>