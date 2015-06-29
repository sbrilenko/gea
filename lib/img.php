<?php
$root = $_SERVER['DOCUMENT_ROOT'];	
require_once $root."/lib/class.invis.db.php";
$db = db :: getInstance();	

if($_POST['db'])
{
    $db->query("SELECT * FROM preview_photo WHERE preview_bool = 1 AND event_id =".$_POST['db']);
    if($db->getCount()>0){
        $elements='[';
        $arr_photos=$db->getArray();
        foreach($arr_photos as $index=>$val)
        {
            $prewiew[$index] = '"'.$val['md5_mictotime'].'_'.$val['id'].'.jpg"';
            //$elements .= '"'.$val['md5_mictotime'].'_'.$val['id'].'.jpg"';
            //if ($index+1!=count($arr_photos)) $elements .= ",";
            $current = $val['md5_mictotime'];
        }
        //$elements.="]";
        //echo $elements;
        for($i=0;$i<count($prewiew);$i++)
            {
            	 $elements .= $prewiew[$i];
                 if ($i+1!=count($prewiew)) $elements .= ",";
            }
        
    }
    //exit();
}else{
   $elements='[';
   $prewiew = null;
   $current = 0;
}	

if(!empty($_POST['dir']))
{
    //$elements='[';
    if($_POST['action']==-1)
    {
        //по всем папкам
    }
    else
    {
        
        $dir = $root."/".$_POST['dir']."size1";
        	$array=null;
            if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    $usl = $prewiew == null?0:substr($file,0,strpos($file,'_'));
                   // echo "файл: $file : тип: " . filetype($dir . $file) . "";
                    if((substr(strrchr($file, '.'), 1)=='jpg')&&($usl == $current))
        			{
        				 $array[]=$file;
        				 /*$elements .= '"'.$file.'"';
                   		 if ($count!=$number) $elements .= ",";
        				 $number++;*/
        			}	
                } 
            }
            if($prewiew == null){sort($array);}
            if((count($array)>count($prewiew))&&$prewiew != null){$elements .= ","; }
            for($i=0;$i<count($array);$i++)
            {
                if(!in_array('"'.$array[$i].'"',$prewiew)){
                   $elements .= '"'.$array[$i].'"';
                    if ($i+1!=count($array)) $elements .= ","; 
                }
            	 
            }
            closedir($dh);
        }
        $elements.="]";
        echo $elements;
    }

}

 
?>