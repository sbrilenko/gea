<?php
    session_start();
    require_once("config.php");
    require_once("dll.php");
    
    $email = "biznes@gealtd.org";
    
    function mail_utf8($to, $subject = '(No subject)', $message = '', $header = '') { 
      $header_ = 'MIME-Version: 1.0' . "\r\n" . 'Content-type: text/plain; charset=UTF-8' . "\r\n"; 
      mail($to, '=?UTF-8?B?'.base64_encode($subject).'?=', $message, $header_ . $header); 
    }
    
    $type = $_POST[type];
	/*this is old send*/
    if ($type=="question"){
        if ($_SESSION[captcha_keystring]==$_POST[captch]){
            $subject = "Вопрос - {$_POST[fio]}";
            $message = "ФИО: {$_POST[fio]}\nКонтактный e-mail: {$_POST[email]}\nКонтактный телефон: {$_POST[phone]}\n\nТема: {$_POST[theme]}\nВопрос: {$_POST[question]}";
            mail_utf8($email,$subject,$message);
        }
    }
	/*this is new send*/
    if ($type=="sending"){
            $subject = "Вопрос/пожелание - {$_POST[fio]}";
            $message = "ФИО: {$_POST[fio]}\nКоординаты (e-mail, телефон.): {$_POST[email]}\nВопрос: {$_POST[question]}";
            mail_utf8($email,$subject,$message);
    }
        
    // переадресация на предыдущую страницу
    $referer=$_SERVER['HTTP_REFERER'];
    if (empty($referer)) $referer="index.php";
    header("Location: $referer");
?>
