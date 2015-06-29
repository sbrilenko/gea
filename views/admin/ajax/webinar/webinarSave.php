<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root."/lib/include.php";
$db = db :: getInstance();

    $_POST['info']=htmlspecialchars($_POST['info']);
    $_POST['info'] = str_replace("&lt;", "<", $_POST['info']);
    $_POST['info'] = str_replace("&gt;", ">", $_POST['info']);
    
    $db->query('UPDATE  `gealtd`.`webinar` SET info="'.$_POST['info'].'"');

?>