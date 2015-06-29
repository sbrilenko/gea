<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root."/lib/include.php";
$db = db :: getInstance();

unlink($root."/img/g/1000/".$_POST['f_id'].'/'.$_POST['id']);
unlink($root."/img/g/1240/".$_POST['f_id'].'/'.$_POST['id']);
unlink($root."/img/g/1320/".$_POST['f_id'].'/'.$_POST['id']);
unlink($root."/img/g/1400/".$_POST['f_id'].'/'.$_POST['id']);
unlink($root."/img/g/".$_POST['f_id'].'/'.$_POST['id']);

?>