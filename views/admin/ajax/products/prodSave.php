<?php
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root."/lib/include.php";
$db = db :: getInstance();
		$id = $_POST['id'];
		$name = $_POST['name'];
		$link = $DLL -> linkInBD($name).'-'.$id.'.html';
		$category = $_POST['razd'];	
		$photo = $_POST['photo_url'];
		$s_des = $_POST['t_0'];
		$f_des = $_POST['t_1'];


	if($_POST['id']){		
		$db -> query("UPDATE prod SET name = '{$name}', `id_razd` = {$category}, img = '{$photo}_site.jpg', `desc` = '{$s_des}' WHERE id = {$id}");
		$db -> query("SELECT * FROM cat_prod_des WHERE prod_id = {$id}");
		$isId = $db -> getRow();		
		if ($isId){
			$query = "UPDATE cat_prod_des SET photo = '{$photo}', short_des = '{$s_des}', full_des = '{$f_des}', link = '{$link}' WHERE prod_id = {$id}";
			echo $query;
			$db -> query($query);
		}else{
			$query = "INSERT INTO cat_prod_des (`prod_id`, photo, short_des, full_des, link) VALUES ({$id}, '{$photo}', '{$s_des}', '{$f_des}','{$link}')";			
			$db -> query($query);
		}
		$db->query("DELETE FROM `prod_des` WHERE id_prod=".$id);
        $key=true;
        $i=1;
        while($key)
        {
            ++$i;
            if (($_POST['t_'.$i])and($_POST['name_'.$i])) 
                {
                    $_POST['t_'.$i]=str_replace('\'',"\\'",$_POST['t_'.$i]);
                    $_POST['t_'.$i]=str_replace("\"",'\\"',$_POST['t_'.$i]);
                    $db->query("INSERT INTO  .`prod_des` (`id_prod` ,`title` ,`text`) VALUES ('".$id."',  '".$_POST['name_'.$i]."',  '".$_POST['t_'.$i]."')");
                }
                else {$key=false;}
            
        }
		echo "done!";
	}else{	
				$db -> query("INSERT INTO `prod` (`name`, `id_razd`, `img`, `desc`) VALUES ('{$name}', {$category}, '{$photo}_site.jpg', '{$s_des}')");
				$id = $db -> last();
				$query = "INSERT INTO cat_prod_des (`prod_id`, photo, short_des, full_des, link) VALUES ({$id}, '{$photo}', '{$s_des}', '{$f_des}','{$link}')";
			$db -> query($query);

		$key=true;
        $i=1;
        while($key)
        {
            ++$i;
            if (($_POST['t_'.$i])and($_POST['name_'.$i])) 
                {
                    $_POST['t_'.$i]=str_replace('\'',"\\'",$_POST['t_'.$i]);
                    $_POST['t_'.$i]=str_replace("\"",'\\"',$_POST['t_'.$i]);
                    $db->query("INSERT INTO  `prod_des` (`id_prod` ,`title` ,`text`) VALUES ('".$id."',  '".$_POST['name_'.$i]."',  '".$_POST['t_'.$i]."')");
                }
                else {$key=false;}
            
        }


		echo "done!";
	}
?>