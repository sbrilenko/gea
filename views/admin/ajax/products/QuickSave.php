<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root."/lib/include.php";
$db = db :: getInstance();
$SP = $_POST['showSite'];
$SC = $_POST['showCat'];
$id = $_POST['id'];
$db -> query("UPDATE prod SET showProd = {$SP}, showCat = {$SC} WHERE id = {$id}");

?>