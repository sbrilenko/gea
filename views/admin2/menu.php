<?php
session_start();
$root=$_SERVER['DOCUMENT_ROOT'];
if ($_SESSION['authorized']!='ok') header("Location: http://".$_SERVER['HTTP_HOST']."/editor");
else
require_once 'head.php';
//print_r(($_SESSION)); 
//session_unset();
//session_destroy();   
//if (on_line()>1) $_SESSION['authorized']='';
?>
<div class="main_menu">
<a class="<?php if((nof()=='prodview'))echo 'sel'?>" href="prodview.php">Продукция</a> |
<a class="<?php if((nof()=='webinar'))echo 'sel'?>" href="webinar.php">Вебинары</a> |
<a class="<?php if((nof()=='event'))echo 'sel'?>" href="event.php">События</a> |
<a class="<?php if((nof()=='video'))echo 'sel'?>" href="video.php">Видео</a> |
<!--<a class="<?php if(nof()=='size')echo 'sel'?>" href="/admin/page/size/size.php">Размеры</a> |
<a class="<?php if(nof()=='category')echo 'sel'?>" href="/admin/page/category/category.php">Категории</a> |
<a class="<?php if((nof()=='product')or(nof()=='add')or(nof()=='edit')) echo 'sel'?>" href="/admin/page/product/product.php?view=<?php echo $_SESSION['view']?>&group=<?php echo $_SESSION['g']?>">Товары</a> |
--><a class="" href=<?php $root?>"/editor/index.php?exit=1">Выход</a>
</div>