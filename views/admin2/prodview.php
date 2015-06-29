<?php require_once 'menu.php';?>
<?php require_once 'prodmenu.php';?>
<script>

</script>

<?php
if ($_GET['delid']>0)
{
    $im=mysql_fetch_array(mysql_query("select img from gea.prod where id =".$_GET['delid']));
    @unlink($_SERVER['DOCUMENT_ROOT'].'/img/prod/'.$im['img']);
    mysql_query("delete from gea.prod where id =".$_GET['delid']);
    mysql_query("delete from gea.prod_des where id_prod =".$_GET['delid']);
   //echo $_SERVER['DOCUMENT_ROOT'].'/img/prod/'.$im['img'];
}

?>

<table style="" cellspacing="1" align="center">
<?php
$n=0;
$q=mysql_query("select * from `gea`.`prod` order by id DESC");
while($prods=mysql_fetch_array($q))
{
$n++;
echo '
<tr>
    <td style="width:100px;"><img src="/img/prod/'.$prods['img'].'" width="100px"/></td> 
    <td style="vertical-align: top;">
        <div style="float:right;text-align: right;"><a href="prod.php?editid='.$prods['id'].'">редактировать</a> | <a href="prodview.php?delid='.$prods['id'].'">удалить</a><!--<br /><a href="proddoc.php?id='.$prods['id'].'">добавить документы</a>--></div>
        Имя: <b>'.$prods['name'].'</b><br />';
        if ($prods['price']) echo 'Цена: <b>'.$prods['price'].'</b><br />';
        if ($prods['id1c'])echo '
        ID 1C: <b>'.$prods['id1c'].'</b><br />';
        echo'
        Описание: <b>'.mb_substr($prods['desc'],0,200,'utf-8').'... </b><br />
    </td>
</tr>';
}
?>


</table>


<?php if (!$n){echo '<div style="text-align: center;border: dotted gray 1px;padding: 5px;width: 888px;margin:10px auto">Товаров нет!</div>';}?>


<?php require_once 'foot.php';?>