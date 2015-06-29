<?php
session_start();
$root = $_SERVER['DOCUMENT_ROOT'];
require_once($root."/lib/class.invis.db.php");
require_once($root."/lib/class.sms.php");
 $db=db :: getInstance();
if($_POST['rest'] OR $_POST['deliv'])
{
    if(trim($_POST['phone'])!='')
    {
        $name=base64_encode(trim($_POST['name']));
        $event=base64_encode(trim($_POST['event']));
        $col=$_POST['col'];
        $address=base64_encode(trim($_POST['address']));
        $comm=base64_encode(trim($_POST['comm']));
        $dataprov=explode('.',$_POST['data']);
        $dataprov=$dataprov[2].'-'.$dataprov[1].'-'.$dataprov[0].' '.$_POST['hour'].':'.$_POST['min'].':00';
        $smsid='';
        $total=0;
        if($_SESSION['z'])
        {
            $message_head = '<table style="margin:10px auto 10px auto; background:#fff;" width="662" cellpadding="10" cellspacing="0" class="mail_to">
    <tbody><tr>
        <td>
        <table border="0" cellpadding="0" cellspacing="0" width="600" style="0px solid transparent;">
            <tbody><tr>    
                    <td align="left" style="padding-bottom:15px;">
                       <a href="#"><img src="../img/p-l.jpg" ></a>
                  </td>  
                   <td valign="top" align="right" nowrap="" style="line-height: 12px;font-family:Arial;font-size:12px;color:#b4afa1;">
                        <table>
                            <tr>
                                <td style="line-height: 12px;font-family:Arial;font-size:12px;color:#b4afa1;text-align: right;">Гостинично - ресторанный комплекс «Люфари»</td>
                            </tr>
                            <tr>
                                <td style="line-height: 14px;font-family:Times New Roman;font-size:14px;color:#736655;text-align: right;">Донецк, ул. Калинина, 118</td>
                            </tr>
                            <tr>
                                <td style="line-height: 14px;font-family:Times New Roman;font-size:14px;color:#736655;text-align: right;">(095)&nbsp;172&nbsp;72&nbsp;72</td>
                            </tr>
                            <tr>
                                <td style="line-height: 12px;font-family:Georgia;font-size:12px;color:#736655;text-align: right;"><a style="color:#736655;" href="html://lyufari.com">lyufari.com</a></td>
                            </tr>
                        </table>
                        
                        
                  </td>
                 
            </tr>';
            $order ='<tr>
                <td colspan="2" align="middle" style="padding:15px 0 30px 0;font-size:24px;line-height:24px;font-family:Georgia;color:#5e4731;">
                       Оформление заказа
                  </td>
            </tr>
            <tr>
                <td colspan="2" style="border-collapse: separate;">';

    $order.='<table border="0" cellpadding="0" cellspacing="0" style="width:600px; border-bottom: 1px solid #EEECEC"><tbody><tr align="left" style="font-family:tahoma;font-size:12px;color:#9b9b9b;border-bottom: 1px solid #EEECEC;"><th style="border-bottom: 1px solid #EEECEC;">&nbsp;&nbsp;</th><th style="border-bottom: 1px solid #EEECEC;width:275px;">Наименование</th><th style="border-bottom: 1px solid #EEECEC;width:92px;">Выход</th><th style="border-bottom: 1px solid #EEECEC;width:72px;">Цена</th><th style="border-bottom: 1px solid #EEECEC;width:72px;">Кол-во</th><th style="border-bottom: 1px solid #EEECEC;width:65px;">Стоимость</th></tr><tr><td></td></tr>';
    

    foreach($_SESSION['z'] as $index => $val)
    {
        $sql="SELECT * FROM menu_m WHERE id='".$val['id']."'";
        $db->query($sql);
        if($db->getCount()>0)
        {
            //echo $arritem[0]['price'];
            $arritem=$db->getArray();
            $total += $val['col']*$arritem[0]['price'];
            $order.='<tr valign="top" style="border-collapse: collapse;border:0px solid transparent;line-height: 22px;font-family:tahoma;font-size:12px;color:#303030;"><td style="padding: 5px 0;width: 25px;text-align:center;">'.($index+1).'</td><td style="padding: 5px 0;">'.$arritem[0]['name'].'</td><td style="padding: 5px 0;">'.$arritem[0]['weight'].'</td><td style="padding: 5px 0;">'.$arritem[0]['price'].'&nbsp;грн.</td><td style="padding: 5px 0; text-align:center;">'.$val['col'].'</td><td style="padding: 5px 0;">'.($arritem[0]['price']*$val['col']).' грн</td></tr>';
           
        }
    }
       
    $order.='</tbody></table></td></tr>';
                                $sql="SELECT date FROM actual_date_price";
                                $db->query($sql);
                                if($db->getCount()>0)
                                {
                                    $date_price=$db->getValue();
                                    $date_price=explode('-',$date_price);
                                }


                $message_foot =' <tr>
                <td colspan="2">
                <table style="margin-top: 25px;width:100%;">
                    <tr>
                         <td align="left" style="color: #7b797c;font: 14px/14px Arial;">
                                Цены в грн.&nbsp;на&nbsp;'.$date_price[2].'.'.$date_price[1].'.'.$date_price[0].'                
                         </td>
                         <td align="right" style="color: #3d3828;font: 18px/18px Arial;text-align:right;">
                                Общая стоимость заказа: '.$total.'&nbsp;грн
                         </td>
                    </tr>
                </table>
               </td>
                
            </tr>';
        }
       
        $sql="SELECT count(id) FROM orderd WHERE YEAR(data_create)='".date('Y')."' AND MONTH(data_create)='".date('m')."' AND DAY(data_create)='".date('d')."'";
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
                $sms->sendsms('lyufari',$phone_who,"Спасибо. Заказ #".$uid."\nМы свяжемся с вами в ближайшее время.");
            }
            else
            {
                if(date('G')>=5 AND date('G')<=10)
                {
                    $sms->sendsms('lyufari',$phone_who,"Спасибо. Заказ #".$uid."\nМы свяжемся с вами после 10:00.");
                }
                else
                {
                    $sms->sendsms('lyufari',$phone_who,"Спасибо. Заказ #".$uid."\nМы свяжемся с вами завтра после 10:00.");
                }
                
            }
           $sms->sendsms('lyufari','+380954570088',"Заказ с сайта #".$uid." на сумму ".$total);
           $sms->sendsms('lyufari','+380508482849',"Заказ с сайта #".$uid." на сумму ".$total);
           $smsid=$sms->smsresultbynumb(1);//id
        }
        $sql="INSERT INTO orderd (uid,smsid,data_create,date,name,phone,nameevent,peoplecount,comment,address,zakaz) VALUES('%s','%s','".date('Y-m-d H:i:s')."','%s','%s','".$_POST['phone']."','%s',%d,'%s','%s','%s')";
        //$sql = "SELECT * FROM `user` WHERE `login`='%s' AND `password`='%d'";
        $query = sprintf($sql, $uid, $smsid,$dataprov,$name,$event,$col,$comm,$address,$order);
        $db->query($query);
        
        //отправляем на почту
        
        $dan_f="<br /><br /><tr><td colspan='2'><table>";
        if($_POST['rest']) $dan_f.="<tr style='line-height:25px;'><td style='width:130px;font-family:tahoma;font-size:12px;color:#303030;text-align:right;padding-right:10px;'>Место проведения</td><td style='font-family:tahoma;font-size:12px;color:#303030;text-align:left;'>Ресторан</td></tr>";
        if($_POST['deliv']) $dan_f.="<tr style='line-height:25px;'><td style='width:130px;font-family:tahoma;font-size:12px;color:#303030;text-align:right;padding-right:10px;'></td><td style='font-family:tahoma;font-size:12px;color:#303030;text-align:left;'>Доставка</td></tr>";
        
        if(!empty($_POST['data']))
        {
          $dan_f.="<tr style='line-height:25px;'><td style='width:130px;font-family:tahoma;font-size:12px;color:#303030;text-align:right;padding-right:10px;'>Дата проведения</td><td style='font-family:tahoma;font-size:12px;color:#303030;text-align:left;'>".$_POST['data']."</td></tr>";
        }
        if($_POST['hour']!='noselect')
        {
            $dan_f.="<tr style='line-height:25px;'><td style='width:130px;font-family:tahoma;font-size:12px;color:#303030;text-align:right;padding-right:10px;'>Время проведения</td><td style='font-family:tahoma;font-size:12px;color:#303030;text-align:left;'>".$_POST['hour'];
            if(!empty($_POST['min']))
            {
                $dan_f.=":".$_POST['min'];
            }
            else
            {
                $dan_f.=":00";
            }
            $dan_f.="</td></tr>";
        }
        $_POST['name']=preg_replace("/'/",'"',$_POST['name']);
        if(!empty($_POST['name']))
        {
            $dan_f.="<tr style='line-height:25px;'><td style='width:130px;font-family:tahoma;font-size:12px;color:#303030;text-align:right;padding-right:10px;'>Имя/организация</td><td style='font-family:tahoma;font-size:12px;color:#303030;text-align:left;'>".$_POST['name']."</td></tr>";
        }
        
        $_POST['event']=preg_replace("/'/",'"',$_POST['event']);
        if(!empty($_POST['event']))
        {
            $dan_f.="<tr style='line-height:25px;'><td style='width:130px;font-family:tahoma;font-size:12px;color:#303030;text-align:right;padding-right:10px;'>Событие</td><td style='font-family:tahoma;font-size:12px;color:#303030;text-align:left;'>".$_POST['event']."</td></tr>";
        }
        $dan_f.="<tr style='line-height:25px;'><td style='width:130px;font-family:tahoma;font-size:12px;color:#303030;text-align:right;padding-right:10px;'>Контактный телефон</td><td style='font-family:tahoma;font-size:12px;color:#303030;text-align:left;'>".$_POST['phone']."</td></tr>";
        
        if(!empty($_POST['col']) AND is_numeric($_POST['col']) AND (int)$_POST['col']>0)
        {
            $dan_f.="<tr style='line-height:25px;'><td style='width:130px;font-family:tahoma;font-size:12px;color:#303030;text-align:right;padding-right:10px;'>Количество человек</td><td style='font-family:tahoma;font-size:12px;color:#303030;text-align:left;'>".$_POST['col']."</td></tr>";
        }
        else
        {
            $_POST['col']=0;
        }
        $_POST['address']=preg_replace("/'/",'"',$_POST['address']);
        if(!empty($_POST['address']))
        {
            $dan_f.="<tr style='line-height:25px;'><td style='width:130px;font-family:tahoma;font-size:12px;color:#303030;text-align:right;padding-right:10px;'>Адресс доставки</td><td style='font-family:tahoma;font-size:12px;color:#303030;text-align:left;'>".$_POST['address']."</td></tr>";
        }
        $_POST['comm']=preg_replace("/'/",'"',$_POST['comm']);
        if(!empty($_POST['comm']))
        {
            $dan_f.="<tr style='line-height:25px;'><td style='width:130px;font-family:tahoma;font-size:12px;color:#303030;text-align:right;padding-right:10px;'>Комментарии</td><td style='font-family:tahoma;font-size:12px;color:#303030;text-align:left;'>".$_POST['comm']."</td></tr>";
        }
        $dan_f .="</table></td></tr>";
        $dan_foot ='<tr>
                <td colspan="2"><img style="margin-top:23px;" src="../img/p-f.jpg"/></td>
            </tr>
            <tr>
                <td colspan="2" height="44"></td>
            </tr>
        </tbody>
        </table>';
        if(!empty($order))
        {
            $message = $message_head.$order.$message_foot.$dan_f.$dan_foot; 
        }
        else
        {
            $message = $message_head.$dan_f.$dan_foot; 
        }
        $header="Content-type: text/html; charset=\"utf-8\"";
        $subject = '=?utf-8?B?'.base64_encode("Заказ с сайта «Люфари»").'?=';
        $headers = "From:".'=?utf-8?B?'.base64_encode("Люфари ").'?='.'<reception@lyufari.com>'."\r \n";
        mail('tulupovayana@mail.ru, abz@inbox.ru', $subject, $message, $header);
    }
    else
    {
        echo "<div class='error'>Контактный телефон - обязательное поле</div>";
        exit;
    }
}
else
{
    echo "<div class='error'>Укажите место проведения</div>";
}

?>