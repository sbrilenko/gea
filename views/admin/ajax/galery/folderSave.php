<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root."/lib/include.php";
$db = db :: getInstance();

    if($_POST){
        if($_POST['id']){
            $db->query("UPDATE galery_folders SET name = '{$_POST['name']}', gal_id = {$_POST['gal_id']} WHERE id={$_POST['id']}");
        }else{
            $query = "INSERT INTO galery_folders (name, gal_id) VALUES ('{$_POST['name']}',{$_POST['gal_id']})";
            echo $query;
            $db->query($query);
        }
    }
    header("location: http://gea.net.ua/admin/galery");

?>