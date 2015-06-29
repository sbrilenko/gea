<?php
 if($_POST['print'])
    {
        $message = $_POST['data']; 
        if(!empty($_POST['email'])){
            foreach($_POST['email'] as $key => $val){
                //$mails = implode(',',$_POST['email']);
                
                $header.="Content-type: text/html; charset=\"utf-8\"";
                //$message = '=?utf-8?B?'.base64_encode($message).'?=';
                $subject = '=?utf-8?B?'.base64_encode("Заказ с сайта «Люфари»").'?=';
                $headers = "From: ".$subject." mail ".$to." \n";
                mail($val, $subject, $message, $header);
            }
        }
        
    }
?>
