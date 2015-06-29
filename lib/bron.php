<?php
session_start();
$root = $_SERVER['DOCUMENT_ROOT'];
require_once($root."/lib/class.invis.db.php");
require_once($root."/lib/class.sms.php");
 $db=db :: getInstance();
if($_POST['name'] AND $_POST['phone'])
{
    if(trim($_POST['name'])!='' AND strlen(trim($_POST['phone']))>=11)
    {
        $dataprov=explode('.',$_POST['data']);
        $dataprov=$dataprov[2].'-'.$dataprov[1].'-'.$dataprov[0].' '.$_POST['hour'].':'.$_POST['min'].':00';
        $name=base64_encode(trim($_POST['name']));
        $days=base64_encode(trim($_POST['days']));
        $col=$_POST['col'];
        if(empty($col)) $col=1;
        $nomer=1;
        $price=800;
        if($_POST['standart'])
        {
            $typenomer='standart';
            $price=800;
            if($col<2) $nomer=1;
            else $nomer=2;
            $typenomertext="Тип номера - стандарт<br />";
        }
        else
        {
            $price=1200;
            $typenomer='king';
            if($col<2) $nomer=1;
            else $nomer=3;
            $typenomertext="Тип номера - апартаменты<br />";
        }
        if(empty($_POST['days'])) $_POST['days']=1;
        
        $itogo=abs(ceil($col/$nomer)*$price*$_POST['days']);
        $phone=trim($_POST['phone']);
        $transfer=($_POST['transfer'])?1:0;
        if($transfer==1)
        {
            $itogo+=100;
        }
        $comm=base64_encode(trim($_POST['comm']));
        
        $smsid='';
        $total=0;
        $sql="SELECT count(id) FROM bron WHERE YEAR(data_create)='".date('Y')."' AND MONTH(data_create)='".date('m')."' AND DAY(data_create)='".date('d')."'";
        $db->query($sql);
        $val=$db->getValue();
       
        if($val+1<10)
        {
         $dopol='00';
        }
        else if($val+1>=10 AND $val+1<100)
        {
         $dopol='0';
        }
        else
        {
           $dopol='';
        }
        $uid=date('ymd').$dopol.$val+1;
        $sms=new sms();
        $sms->setLogin('lyufari');
        $sms->setPass('zayaccool');
        if($sms->auth())
        {
           $phone_who=preg_replace('/[\s()]/','',$_POST['phone']);
           if(date('G')>=10 AND date('G')<=23)
            {
                $sms->sendsms('lyufari',$phone_who,"Спасибо. Бронь #".$uid."\nМы свяжемся с вами в ближайшее время.");
            }
            else
            {
                if(date('G')>=5 AND date('G')<=10)
                {
                    $sms->sendsms('lyufari',$phone_who,"Спасибо. Бронь #".$uid."\nМы свяжемся с вами после 10:00.");
                }
                else
                {
                    $sms->sendsms('lyufari',$phone_who,"Спасибо. Бронь #".$uid."\nМы свяжемся с вами завтра после 10:00.");
                }
                
            }
            $sms->sendsms('lyufari','+380508482849',"Бронь с сайта #".$uid." на сумму ".$itogo);
            $sms->sendsms('lyufari','+380954570088',"Бронь с сайта #".$uid." на сумму ".$itogo);
            //$sms->sendsms('lyufari',$phone_who,"Спасибо. Бронь #".$uid."\nМы свяжемся с вами в ближайшее время.");
            $smsid=$sms->smsresultbynumb(1);//id
        }
        $sql="INSERT INTO bron (uid,smsid,data_create,date,name,phone,days,peoplecount,comment,transfer,typenomer,itogo) VALUES('%s','%s','".date('Y-m-d H:i:s')."','%s','%s','".$_POST['phone']."','%d',%d,'%s','%d','%s','%d')";
        $query = sprintf($sql, $uid,$smsid, $dataprov,$name,$days,$col,$comm,$transfer,$typenomer,$itogo);
       $db->query($query);
        
        //отправляем на почту
        
       if(!empty($_POST['data']))
        {
          $dan_f.="Дата вьезда - ".$_POST['data']." ";
          if($_POST['hour']!='noselect')
            {
                $dan_f.= $_POST['hour'];
                if(!empty($_POST['min']))
                {
                    $dan_f.=":".$_POST['min'];
                }
                else
                {
                    $dan_f.=":00";
                }
            }
            $dan_f.="<br />";
        }
        
        if(!empty($_POST['days']) AND is_numeric($_POST['days']) AND (int)$_POST['days']>0)
        {
            $dan_f.="Количество дней - ".$_POST['days']."<br />";
        }
        else
        {
            $dan_f.="Количество человек - 1<br />";
        }
        if(!empty($_POST['col']) AND is_numeric($_POST['col']) AND (int)$_POST['col']>0)
        {
            $dan_f.="Количество человек - ".$_POST['col']."<br />";
        }
        else
        {
            $dan_f.="Количество человек - 1<br />";
        }
        $dan_f.=$typenomertext;
        if($transfer==1)
        {
             $dan_f.="Трансфер - да<br />";
        }
        else
        {
            $dan_f.="Трансфер - нет<br />";
        }
        $_POST['name']=preg_replace("/'/",'"',$_POST['name']);
        if(!empty($_POST['name']))
        {
            $dan_f.="ФИО (как к вам обращаться) - ".$_POST['name']."<br />";
        }
        $dan_f.="Контактный телефон - ".$_POST['phone']."<br />";
        
        $_POST['comm']=preg_replace("/'/",'"',$_POST['comm']);
        if(!empty($_POST['comm']))
        {
            $dan_f.="Комментарии - ".$_POST['comm']."<br />";
        }
        $dan_f.="Итого - ".$itogo."<br />";
        $message = $dan_f."<br />"; 
        
        $header="Content-type: text/html; charset=\"utf-8\"";
        $subject = '=?utf-8?B?'.base64_encode("Предварительное бронирование с сайта «Люфари»").'?=';
        $headers = "From: ".$subject." mail ".$to." \n";
        mail('abz@inbox.ru, tulupovayana@mail.ru', $subject, $message, $header);
    }
    else
    {
        if(strlen(trim($_POST['phone']))<11)
        {
            echo "<div class='error'>Введите номер телефона в международном формате <br />Например: +3801234567890</div>";
            exit;
        }
        if(trim($_POST['phone'])=='')
        {
            echo "<div class='error'>Укажите ваш контактный номер телефона</div>";
            exit;
        }
        
    }
}
else
{
    if(!$_POST['name'])
    {
        echo "<span class='error'>Укажите ФИО (как к вам обращаться)<span>";
        die();
    }
    if(!$_POST['phone'])
    {
        echo "<span class='error'>Укажите ваш контактный номер телефона<span>";
        die();
    }
    
}

?>