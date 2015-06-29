<?php
   session_start();
    require_once("scripts/config.php");
    require_once("scripts/dll.php");
    header("Content-type: text/html; charset=utf-8");
    mb_internal_encoding("UTF-8");
    
    $q = @$_POST['q'];
    switch ($q) {
        case "captch"       :   require_once("scripts/ajax/ajax_captch.php"); break;
        case "galery"       :   require_once("scripts/ajax/ajax_galery.php"); break;
        default: echo "error";
    }
?>