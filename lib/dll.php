<?php
    function getMenu(){   // возвращает меню 
        global $controller;  // контроллер
        $result = "<div id='menu'><!-- menu-start -->
        <ul>";
        $q = mysql_query("SELECT * FROM menu WHERE parentId = '0' AND visibility='1' ORDER BY num, id");
        while ($row = mysql_fetch_assoc($q)){
        	
            if ($row['link']==$controller -> getController()){
            	$act=$controller -> getAction();
                if (empty($act)) $result .= "<li class='selected'><span style='color:#B71807;border-bottom:none;'>{$row[caption]}</span>";
                else {
                    $result .= "<li class='selected'><a style='color:#B71807;border-bottom:none;' href='/{$row[link]}/'>{$row[caption]}</a>";
                }
                if ($row[type]==1){
                    $result.="<div class='clear'></div>".getSubMenu();
                }
                $result .= "</li>";
            } else {
            	if($row['id'] == 42){
            		$result .= "<li><a  target='_blank' href='{$row[link]}/'>{$row[caption]}</a></li>";
            	}else{
				 $result .= "<li><a href='/{$row[link]}/'>{$row[caption]}</a></li>";
				}
            }        
        } 
        $result .= "     </ul>
        </div>";
        
        $result .= "<div id='main'><!-- main -->";
        return $result;
    }
    
    function getSubMenu(){
        global $controller;
        
        // получаем ссылку родительского элемента
        $parent = $controller -> getController();
        $q = mysql_query("SELECT id FROM menu WHERE link = '{$controller->getController()}'");
        $row = mysql_fetch_assoc($q);
        $result = "<ul class='submenu'>";
        if($row['id'] == 32 ){
            $q = mysql_query("SELECT * FROM menu WHERE parentId = 32 AND visibility='1' ORDER BY id DESC");
        }else{
        $q = mysql_query("SELECT * FROM menu WHERE parentId = '{$row[id]}' AND visibility='1' ORDER BY num,id");
        }
        while ($row = mysql_fetch_assoc($q)){
            if (($row[link]==$controller->getAction()) or ($row[link]==$controller->getAction().'/'.$controller->getParam(1))){
                $result .= "<li class='selected'><span>{$row[caption]}</span></li>";
            } else if ($row[parentId] == 2) {            	
            	$result .= "<li><a href='/$parent/category/filter/{$row[id]}/'>{$row[caption]}</a></li>";
            }else{            	
                $result .= "<li><a href='/$parent/{$row[link]}/'>{$row[caption]}</a></li>";
            }               
        }
        $result .="</ul>";
        
        return $result;
    }
    /*Меню для главной*/
    function getMenu_main(){   // возвращает меню 
        global $control;  // контроллер
        $result = "<div id='menu_main'><!-- menu-start -->
        <ul>";
        $q = mysql_query("SELECT * FROM menu WHERE parentId = '0' AND visibility='1' ORDER BY num, id");
        while ($row = mysql_fetch_assoc($q)){
            if ($row[id]==$control->get[0]){
                if (empty($control->get[1])) $result .= "<li class='selected'><span style='color:#B71807;border-bottom:none;'>{$row[caption]}</span>";
                else {
                    $result .= "<li class='selected'><a style='color:#B71807;border-bottom:none;' href='/{$row[link]}'>{$row[caption]}</a>";
                }
                if ($row[type]==1){
                    $result.="<div class='clear'></div>".getSubMenu_main();
                }
                $result .= "</li>";
            } else {
				if($row['id'] == 42){
            		$result .= "<li><a target='_blank' href='{$row[link]}/'>{$row[caption]}</a></li>";
            	}else{
				 $result .= "<li><a href='/{$row[link]}/'>{$row[caption]}</a></li>";
				}
            }        
        } 
        $result .= "     </ul>
        </div>";
        
        return $result;
    }
    
    function getSubMenu_main(){
        global $control;
        
        // получаем ссылку родительского элемента
        $q = mysql_query("SELECT link FROM menu WHERE id='{$control->get[0]}'");
        $row = mysql_fetch_assoc($q);
        $parent = $row[link];
        
        $result = "<ul class='submenu'>";
        $q = mysql_query("SELECT * FROM menu WHERE parentId = '{$control->get[0]}' AND visibility='1' ORDER BY num,id");
        while ($row = mysql_fetch_assoc($q)){
            if ($row[id]==$control->get[1]){
                $result .= "<li class='selected'><span>{$row[caption]}</span></li>";
            } else {
            	if($row[caption]=='Престиж Клуб')
				{
					$result .= "<li><a target='_blank' href='{$row[link]}'>{$row[caption]}</a></li>";
				}
				else
                $result .= "<li><a href='/$parent/{$row[link]}/'>{$row[caption]}</a></li>";
            }               
        }
        $result .="</ul>";
        
        return $result;
    }
    /**
    * СОБЫТИЯ
    */
    function getParagraph($text,$class="",$tag="p"){
        if (!empty($class)){
            $class = "class='$class'";
        } else {
            $class="";   
        }
        $text=stripslashes($text);
        $text=str_replace("<абз>","</$tag><$tag $class>",$text);    // замена переводов каретки на параграфы
        $text=str_replace("<стр>","<br />",$text);    // замена переводов каретки на параграфы
        $text="<$tag $class>".$text."</$tag>";
        
        return $text;
    }
    
    function getNormalDate($sql_datetime){    // получает datetime из mysql и преобразовывает к виду "24 июля 2009 г."
        $monthes = array("","января","февраля","марта","апреля","мая","июня","июля","августа","сентября","октября","ноября","декабря");
        return substr($sql_datetime,8,2)." ".$monthes[(int)substr($sql_datetime,5,2)]." ".substr($sql_datetime,0,4)." г.";
    }
    
    function getEvents(){
        $q = mysql_query("SELECT * FROM events ORDER BY event_date DESC, id limit 1");
        while ($row=mysql_fetch_assoc($q)){
            $result .= "<div class='event' id='e-{$row[id]}'>
                            <div class='productCaption fRight'>".getNormalDate($row[event_date])."</div>";
            if (!empty($row[photo])){
                $result .= "<span class='imgTL fRight'><span class='imgBR'><img src='img/events/{$row[photo]}' alt='president' /></span></span>";
            }
            $text = file_get_contents("scripts/events/event_$row[id].php");
            $result .= stripslashes($text);
           /* $q_count = mysql_query("SELECT count(*) AS total FROM events_photo WHERE event_id = '{$row[id]}'");
            $row_count = mysql_fetch_assoc($q_count);
            $count = $row_count[total];*/
            if ($row[hasPhoto]==1) {
                $result.="  <div class='photoButtonBlock'>
                                <a class='photoButton' rel='{$row[id]}'><span>Фотоотчет</span></a>
                                <div class='clear'></div>
                            </div>";
            }
            $result.="</div>";  // event
        }
        return $result;
    }
    
    /*
	 * Возвращает нужный сертификат по его ID - уже html-представление
	 */
    function getCertificate($id){
    	$q = mysql_query("SELECT * FROM certificates WHERE id = '$id'");
		$row = mysql_fetch_assoc($q);
		
    	$result = "<div class='cert-container'>
						<div class='cert-photo-wrapper'>
							<img src='img/certificates/thumb_{$row[picture]}' alt='certificate' />
						</div>
						<div class='cert-info-container'>
							<div class='cert-title'>{$row[title]}</div>
							<div class='cert-info'>{$row[description]}</div>
							<a class='cert-more' href='img/certificates/{$row[picture]}' target='_blank'><span>Подробнее</span></a>
						</div>
					</div>
					<!--<div class='clear'></div>-->";
		
		return $result;
	}
	/*
	 * Функция возвращает сертификаты (их id) по id продукта
	 */
	 function getCertificatesByProduct($id_product){
	 	$result_array = array();
		
		// добавляем сертификаты продукта
	 	$q = mysql_query("SELECT * FROM cert_products WHERE id='$id_product'");
		$row = mysql_fetch_assoc($q);
		if ($row['certificates']!=NULL) {
			$result_array = array_merge($result_array,explode(",",$row['certificates']));
		}
		
		// добавляем сертификаты группы, в которую входит товар
		if ($row['group_id']!=NULL){
			$q_group = mysql_query("SELECT certificates FROM cert_groups WHERE id = '{$row[group_id]}'");
			$row_group = mysql_fetch_assoc($q_group);
			if ($row_group['certificates']!=NULL){
				$result_array = array_merge($result_array,explode(",",$row_group['certificates']));	
			}
		}
		
		// добавляем сертификаты производителя товара
		$q_producer = mysql_query("SELECT certificates FROM cert_producers WHERE id = '{$row[producer_id]}'");
		$row_producer = mysql_fetch_assoc($q_producer);
		if ($row_producer['certificates']!=NULL){
			$result_array = array_merge($result_array,explode(",",$row_producer['certificates']));	
		}
		
		// убираем повторяющиеся сертификаты (если вдруг будут такие)
		$result_array = array_unique($result_array);
		
		// проверяем полученный массив сертификатов на наличие хоть одного сертификата
		if (!empty($result_array)){
			for ($i = 0; $i<count($result_array); $i++){
				$result.=getCertificate($result_array[$i]);
			}	
		}
		return $result;
	 }

	/*
	 * Функция возвращает id-сертификатов по их группе
	 */
	 function getCertificatesByGroup($id_group){
	 	$result_array = array();
		
		// добавляем сертификаты группы
		$q_group = mysql_query("SELECT certificates FROM cert_groups WHERE id='$id_group'");
		$row_group = mysql_fetch_assoc($q_group);
		if ($row_group['certificates']!=NULL){
			$result_array = array_merge($result_array,explode(",",$row_group['certificates']));	
		}
		
		// добавляем сертификаты товаров, входящих в группу
		$q_products = mysql_query("SELECT producer_id, certificates FROM cert_products WHERE group_id='$id_group'");
		if (@mysql_num_rows($q_products)>0){
			$producers_id = array();	// здесь будем хранить id производителей товаров, которые входят в данную группу
			while ($row_products = mysql_fetch_assoc($q_products)){
				array_push($producers_id,$row_products['producer_id']);
				if ($row_products['certificates']!=NULL){
					$result_array = array_merge($result_array,explode(",",$row_products['certificates']));
				}
			}
			
			// удаляем из массива производителей все повторяющиеся id
			$producers_id = array_unique($producers_id);
						
			// добавляем сертификаты производителей товаров, входящих в группу
			$id = implode(",",$producers_id);	// преобразовываем в строку для запроса
			$q_producers = mysql_query("SELECT certificates FROM cert_producers WHERE id IN ($id)");
			while ($row_producers = mysql_fetch_assoc($q_producers)){
				if ($row_producers['certificates']!=NULL){
					$result_array = array_merge($result_array,explode(",",$row_producers['certificates']));
				}
			}
		}

		// убираем повторяющиеся сертификаты (если вдруг будут такие)
		$result_array = array_unique($result_array);
		
		// проверяем полученный массив сертификатов на наличие хоть одного сертификата
		if (!empty($result_array)){
			for ($i = 0; $i<count($result_array); $i++){
				$result.=getCertificate($result_array[$i]);
			}	
		}
		return $result;
	 }
	
	/*
	 * Функция выводит все сертификаты, которые есть в наличии
	 */
	 function getAllCertificates(){
	 	$result = "<script type='text/javascript'>hideBack();</script>";	// прячем кнопку НАЗАД К ТОВАРУ
	 	$q = mysql_query("SELECT id FROM certificates ORDER BY id");
		while ($row = mysql_fetch_assoc($q)){
			$result.=getCertificate($row['id']);
		}
		return $result;
	 }
	 
	 /*
	  * Функция проверяет, является ли введенный id продуктом (есть ли он в базе)
	  */
	 function isProductId($id){
	 	$q = mysql_query("SELECT count(*) AS total FROM cert_products WHERE id='$id'");
		$row = mysql_fetch_assoc($q);
		return ($row['total']!=0);
	 }
	 
	 /*
	  * Функция проверяет, является ли введенный id группой продуктов (есть ли он в базе)
	  */
	 function isGroupId($id){
	 	$q = mysql_query("SELECT count(*) AS total FROM cert_groups WHERE id='$id'");
		$row = mysql_fetch_assoc($q);
		return ($row['total']!=0);
	 }

	 //...............................
	function datefromsql($str)
		{
	        return substr($str, -2).'.'.substr($str, -5, 2).'.'.substr($str, 0, 4);
		}
	    
	//...............................	
	function datetosql($str)
		{
	        return substr($str, -4).'-'.substr($str, -7, 2).'-'.substr($str, 0, 2);
		}
	    
	//...............................(NAME OF FILE)Возвращает имя файла без разрешения, либо последнее слово в адресной строке	
	function nof() 
	    {
	        foreach (explode('/',$_SERVER['REQUEST_URI']) as $item) {$w=explode('.',$item);$script=$w[0];}
	        return $script;
	    }
	    
	//...............................(ACTIVE LINK ON SITE)Возвращает ссылку из текста обрамляя тегами <A> делая её активной	c id='alis' Если второй параетр 1 то открываеться в новом окне
	function alis($link, $target_blank) 
	    {
	        if ($target_blank==1)
	            return ereg_replace("[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]", "<a id='alis' target='_blank' href=\"\\0\">\\0</a>", $link);
	        else
	            return ereg_replace("[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]", "<a id='alis' href=\"\\0\">\\0</a>", $link);
	    }   
	//...............................Ресайз фото    
	function resize($file_input, $file_output, $w_o, $h_o, $percent = false) {
		list($w_i, $h_i, $type) = getimagesize($file_input);
		if (!$w_i || !$h_i) {
			echo 'Невозможно получить длину и ширину изображения';
			return;
	    }
	    $types = array('','gif','jpeg','png');
	    $ext = $types[$type];
	    if ($ext) {
	    	$func = 'imagecreatefrom'.$ext;
	    	$img = $func($file_input);
	    } else {
	    	echo 'Некорректный формат файла';
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
