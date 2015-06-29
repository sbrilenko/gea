<?php
    if ($control->params[0]=="full"){
         $page->title="GEA / Продукция / Капсулы";
         $q = mysql_query("SELECT count(*) AS total FROM catalogue WHERE id='{$control->params[1]}'");
         $row = mysql_fetch_assoc($q);
         if ($row[total]==0){
             $page->redirect = "/";
         } else {
             require_once("scripts/products/full_{$control->params[1]}.php");
         }
    } else{
        $page->title="GEA / Продукция / Капсулы";
         
        $link = "/products/capsules";     // начало ссылки для полной информации
        $productId = array(2,3,5,6,1,7,8,9,10,11,12,13,14,15,16,4);            // пока только id=1

        foreach ($productId as $key => $value)
            require_once("scripts/products/short_$value.php");
            
        echo "<div>* бб - бизнес балл<br />** 1балл = 1,09 у.е. по внутреннему курсу компании</div>";
    }
?>
