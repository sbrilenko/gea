<?php require_once 'menu.php';?>
<?php require_once 'prodmenu.php';?>
<?php
if($_GET['delid']>0)
{
    $ddeell=mysql_fetch_array(mysql_query("SELECT * FROM prod_doc where id='".$_GET['delid']."'"));
    @unlink($_SERVER['DOCUMENT_ROOT'].'/img/prod_doc/b-'.$ddeell['name']);
    @unlink($_SERVER['DOCUMENT_ROOT'].'/img/prod_doc/s-'.$ddeell['name']);
    mysql_query("delete from prod_doc where id=".$_GET['delid']);
    header('Location: proddoc.php?id='.$_GET['id']);
}
?>
<script>
 $(document).ready(function() {

(function($) {
  $.fn.wrapSelected = function(open, close) {
    return this.each(function() {
      var textarea = $(this);
      var value = textarea.val();
      var start = textarea[0].selectionStart;
      var end = textarea[0].selectionEnd;
      if (value.substring(start, end)!=0)
      textarea.val(
        value.substr(0, start) + 
        open + value.substring(start, end) + close + 
        value.substring(end, value.length)
      );
    });
  };
})(jQuery);



$(".b").live('click',function(){$("textarea#t_"+$(this).attr('id').split('_')[1]).wrapSelected("<b>", "</b>");return false;})
$(".i").live('click',function(){$("textarea#t_"+$(this).attr('id').split('_')[1]).wrapSelected("<i>", "</i>");return false;})



//загрузка документов
 
$('#doc').live('change', function() { 
    $("#preview").html(''); 
    $("#preview").html('Загрузка изображения...'); 
    $("#doc-load").ajaxForm(function(data){$("#preview").html(data);}).submit();
});

})
 
    </script>
    

    
<div style="text-align: center;border: dotted gray 1px;padding: 5px;width: 888px;margin:10px auto">
    Докуненты:
    <form id="doc-load" method="post" enctype="multipart/form-data" action='prodhandler.php'>
        Выберите документ: <input type="file" name="doc" id="doc" />
        <div id="preview">
        <?php
         $q=mysql_query("SELECT * FROM prod_doc where id_prod='".$_GET['id']."'");
                while($doc=mysql_fetch_array($q))
                {echo '<div style="clear:both"></div><br />';
                echo "<a target='_blank' href='/img/prod_doc/b-".$doc['name']."'><img src='/img/prod_doc/s-".$doc['name']."'  style='float:left'></a>"; 
                echo '<a style="float:left;padding-left:17px" href="proddoc.php?delid='.$doc['id'].'&id='.$doc['id_prod'].'">удалить</a>';
                echo '<input type="text" name="title[]" id="title_'.$doc['id'].'" value="'.$doc['title'].'"/>';
                echo '<textarea style="height:100px" name="desc[]" id="desc_'.$doc['id'].'" />'.$doc['desc'].'</textarea>';
                echo '<div style="clear:both"></div><br />';
                }
        ?>
        </div>
        <input type="hidden" id="action" name="action" value="doc-load" accept="image/jpeg"/>
        <input type="hidden" id="id" name="id" value="<?php echo $_GET['id']?>" accept="image/jpeg"/>
    </form>
</div>
<div style="text-align: center;border: dotted gray 1px;padding: 5px;width: 888px;margin:10px auto">
    
        <button id="save" style="width: 200px;height:30px;margin-left:20px"><b>Сохранить</b></button>
    
</div>


<?php require_once 'foot.php';?>