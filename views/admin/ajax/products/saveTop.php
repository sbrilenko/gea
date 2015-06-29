<?php
	if($_POST){
	$root = $_SERVER['DOCUMENT_ROOT'];
	require_once $root."/lib/include.php";
	$db = db :: getInstance();			
		for ($i = 1; $i<12; $i++){
			print_r($_POST);
			$prod = $_POST[$i];
			echo $prod;
			$a = 'UPDATE top_prods SET `prod_id` = '.$prod.' WHERE `id` = '.$i;
			echo $a;			
			$db->query('UPDATE top_prods SET `prod_id` = '.$prod.' WHERE `id` = '.$i);
		}
		echo 'success';
	}
	

?>