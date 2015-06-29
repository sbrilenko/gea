<?php
require_once '../scripts/config.php';

 
if ($_FILES['photo']['tmp_name'])
{
    $imginfo=getimagesize($_FILES['photo']['tmp_name']);$img=uniqid().'.png';
    if(TRUE)//($imginfo[1]==348)and($imginfo[0]==322)
    {
       
        if(move_uploaded_file($_FILES['photo']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/img/prod/'.$img)) // ��������� ���� � tmp � ��� �������
        {
            //resize($_SERVER['DOCUMENT_ROOT'].'/img/prod/'.$img, $_SERVER['DOCUMENT_ROOT'].'/img/prod/'.$img, 322, 348);
            if ($_POST['editid'])
            {
                mysql_query("UPDATE  `gea`.`prod` SET  `img`='".$img."' WHERE  `prod`.`id` ='".$_POST['editid']."'");
            }
            
            else 
            {
                $_POST['t_0']=str_replace('\'',"\\'",$_POST['t_0']);
                $_POST['t_0']=str_replace("\"",'\\"',$_POST['t_0']);
                mysql_query("INSERT INTO  `gea`.`prod` (`id1c`, `id_razd` ,`name` ,`desc` ,`price` ,`img`,`doc`, `description`) VALUES ('".$_POST['id1c']."','".$_POST['razd']."',  '".$_POST['name']."',  '".$_POST['t_0']."',  '".$_POST['price']."',  '".$img."',  '".$_POST['doc']."', '".$_POST['description']."')");
                $lastid=mysql_fetch_array(mysql_query("SELECT last_insert_id() FROM `gea`.`prod`"));
                $key=true;
                $i=0;
                while($key)
                {
                    ++$i;
                    if (($_POST['t_'.$i])and($_POST['name_'.$i])) 
                        {
                            $_POST['t_'.$i]=str_replace('\'',"\\'",$_POST['t_'.$i]);
                            $_POST['t_'.$i]=str_replace("\"",'\\"',$_POST['t_'.$i]);
                            mysql_query("INSERT INTO  `gea`.`prod_des` (`id_prod` ,`title` ,`text`) VALUES ('".$lastid[0]."',  '".$_POST['name_'.$i]."',  '".$_POST['t_'.$i]."')");
                        }
                        else {$key=false;}
                    
                }
            }
        }
    }
}
//if ($_POST['editid']>0){mysql_query("UPDATE  `gea`.`prod` SET `name`='1' WHERE  `prod`.`id` ='".$_POST['editid']."'");}
if ($_POST['editid']>0)
{
    $_POST['t_0']=str_replace('\'',"\\'",$_POST['t_0']);
    $_POST['t_0']=str_replace("\"",'\\"',$_POST['t_0']);
    if ($_POST['showProd']) $showProd=1;
    else $showProd=0;
    mysql_query("UPDATE  `gea`.`prod` SET  `id1c`='".$_POST['id1c']."', `id_razd`='".$_POST['razd']."' , `name`='".$_POST['name']."' , `desc`='".$_POST['t_0']."' , `price`='".$_POST['price']."', `doc`='".$_POST['doc']."', `showProd`='".$showProd."', `description`='".$_POST['description']."' WHERE  `prod`.`id` ='".$_POST['editid']."'");
    mysql_query("delete from `gea`.`prod_des` where id_prod=".$_POST['editid']);
    $key=true;
    $i=0;
    //while($key)
    for ($i=1;$i<=$_POST['number_of_des'];$i++)
    {
        //++$i;
        if (($_POST['t_'.$i])and($_POST['name_'.$i])) 
        {
            $_POST['t_'.$i]=str_replace('\'',"\\'",$_POST['t_'.$i]);
            $_POST['t_'.$i]=str_replace("\"",'\\"',$_POST['t_'.$i]);
            mysql_query("INSERT INTO  `gea`.`prod_des` (`id_prod` ,`title` ,`text`) VALUES ('".$_POST['editid']."',  '".$_POST['name_'.$i]."',  '".$_POST['t_'.$i]."')");
            //mysql_query("UPDATE  `gea`.`prod_des` SET `id_prod`='".$_POST['editid']."', `title`='".$_POST['name_'.$i]."', `text`='".$_POST['t_'.$i]."'");
        }
       // else 
       // {
       //     $key=false;
       // }              
    }
}


if ($_POST['action']=='doc-load')
{
    $name = $_FILES['doc']['name']; // ��� �����
    $size = $_FILES['doc']['size']; // ������ �����
    if(strlen($name))
    {
       // list($txt, $ext) = explode(".", $name); // ��������� �� ��� � ������
       // if(in_array($ext,$valid_formats))    // ������� ������ ����� ��� �� ���������?!
        //{
           // if($size<(1024*1024)) // ������������ ������ ����� � 1 ��
            // {
             $image_name = uniqid().".jpg"; // ������ ���������� ��� �������
             $tmp = $_FILES['doc']['tmp_name'];
            if(move_uploaded_file($tmp, $_SERVER['DOCUMENT_ROOT'].'/img/prod_doc/'.$image_name)) 
             {
                resize($_SERVER['DOCUMENT_ROOT'].'/img/prod_doc/'.$image_name, $_SERVER['DOCUMENT_ROOT'].'/img/prod_doc/b-'.$image_name, 750, 1030);
                resize($_SERVER['DOCUMENT_ROOT'].'/img/prod_doc/'.$image_name, $_SERVER['DOCUMENT_ROOT'].'/img/prod_doc/s-'.$image_name, 150, 205);
                @unlink($_SERVER['DOCUMENT_ROOT'].'/img/prod_doc/'.$image_name);
                mysql_query("insert into prod_doc (`name`, `id_prod`)VALUES ('".$image_name."', '".$_POST['id']."')");
                $q=mysql_query("SELECT * FROM prod_doc where id_prod='".$_POST['id']."'");
                while($doc=mysql_fetch_array($q))
                {
                echo '<div style="clear:both"></div><br />';
                echo "<a target='_blank' href='/img/prod_doc/b-".$doc['name']."'><img src='/img/prod_doc/s-".$doc['name']."' class='preview' style='float:left'></a>"; 
                echo '<a style="float:left;padding-left:17px" href="proddoc.php?delid='.$doc['id'].'&id='.$doc['id_prod'].'">�������</a>';
                echo '<input type="text" name="title[]" id="title_'.$doc['id'].'" class=""/>';
                echo '<textarea style="height:100px" name="desc[]" id="desc_'.$doc['id'].'" /></textarea>';
                echo '<div style="clear:both"></div><br />';
                }
             }
            else echo "Error!";
            // }
            //else echo "������ ����� ������ ������ ��"; 
        //}
        //else echo "������ �� ��������."; 
    }
    else echo "���������� �������� �����������!";
}
//echo $_SERVER['DOCUMENT_ROOT'].'/img/prod/'.$img;

















//...............................������ ����    
function resize($file_input, $file_output, $w_o, $h_o, $percent = false) {
	list($w_i, $h_i, $type) = getimagesize($file_input);
	if (!$w_i || !$h_i) {
		echo '���������� �������� ����� � ������ �����������';
		return;
    }
    $types = array('','gif','jpeg','png','JPG','JPEG','png');
    $ext = $types[$type];
    if ($ext) {
    	$func = 'imagecreatefrom'.$ext;
    	$img = $func($file_input);
    } else {
    	echo '������������ ������ �����';
		return;
    }
	if ($percent) {
		$w_o *= $w_i / 100;
		$h_o *= $h_i / 100;
	}
	if (!$h_o) $h_o = $w_o/($w_i/$h_i);
	if (!$w_o) $w_o = $h_o/($h_i/$w_i);
	$img_o = imagecreatetruecolor($w_o, $h_o);
	imagecopyresampled($img_o, $img, 0, 0, 0, 0, $w_o, $h_o, $w_i, $h_i);
	if ($type == 2) {
		return imagejpeg($img_o,$file_output,100);
	} else {
		$func = 'image'.$ext;
		return $func($img_o,$file_output);
	}
} 
?>