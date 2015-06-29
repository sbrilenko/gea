<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root."/lib/include.php";
$db = db :: getInstance();
$pathToSaveImg = $root.'/img/prod/';

if($_POST['imgToDel']){
	$img = $_POST['imgToDel'];
	echo $pathToSaveImg.$img.'.jpg';
	unlink($pathToSaveImg.$img.'.jpg');
	unlink($pathToSaveImg.$img.'_small.jpg');
	unlink($pathToSaveImg.$img.'_site.jpg');
	unlink($pathToSaveImg.$img.'_big.jpg');
	unlink($pathToSaveImg.$img.'_mid.jpg');

}




?>