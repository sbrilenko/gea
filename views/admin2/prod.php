<?php require_once 'menu.php';?>
<?php require_once 'prodmenu.php';?>
<?php //print_r($_ENV)?>
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
function insert_text_cursor(_obj_name, _text)
// _obj_name - name объекта - как правило, textarea, но при желании можно сделать любой
// указываем именно NAME, так как согласно стандартам DOCTYPE HTML 4.01 strict и выше
// свойство ID у объектов ввода является не приемлемым и требуется обращаться только name
// _text - текст, который требуется вставить в том место, где сейчас находится курсор
{
// берем объект
var area=document.getElementsByName(_obj_name).item(0);

// Mozilla и другие НОРМАЛЬНЫЕ браузеры
if ((area.selectionStart)||(area.selectionStart=='0'))
{ // определяем, где начало выделения, если оно существует
  var p_start=area.selectionStart;

  // определяем, где заканчивается выдедение, если оно существует
  var p_end=area.selectionEnd;

  // вставляем соответствующий текст в указанное место
  area.value=area.value.substring(0,p_start)+_text+area.value.substring(p_end,area.value.length);
}

// Исправляем очередной геморрой с Internet Explorer
// единственный НЕ человеческий браузер
if (document.selection)// если объект может иметь выделения
{ // передаем фокус ввода на нужный нам объект
  area.focus();

  // узнаем выделение, если оно существует 
  sel=document.selection.createRange();

  // вставляет текст в указанное место
  sel.text=_text;
}
}// end function
$(".l").live('click',function(){
var y=prompt('Введите URL','http://');
if (y.substr(8,1))
{
   y2=y.substr(7);
    insert_text_cursor('t_'+$(this).attr('id').split('_')[1], ' <a href="'+y+'">'+y2+'</a> ');
}

return false;
})

var m=0;
if ($('#number_of_des').val()>0) m=$('#number_of_des').val();
$('#add_sub').live('click',function(){
    m++;
    $("tr:last").after("<tr> <td>Заголовок</td> <td><input class='min_des' id='name_"+m+"' name='name_"+m+"' type='text' /></td> </tr><tr> <td>Текст</td> <td><button id='i_"+m+"' class='i' title='Курсив'><i style='font-family: times new roman;'>I</i></button><button id='b_"+m+"' class='b' title='Жирный'><b>B</b></button> <button id='l_"+m+"' class='l' title='Cсылка'>URL</button> <br /><textarea class='min_des_text' id='t_"+m+"' name='t_"+m+"' type='text' rows='10' cols='52'></textarea></td> </tr>");
   $('html, body').animate({scrollTop: $('#content').height()+'px'}, 1000);
   $('#number_of_des').val(m);
    return false;
})


$('#save').live('click',function(){//alert ($('.min_des').size());
    if ($('select[name="razd"]').val()==0) {$('select[name="razd"]').css('border','solid red 2px');$('html, body').animate({scrollTop: 0}, 1000);}
        else {$('select[name="razd"]').css('border','');
            if ($('input[name="name"]').val()=='') {$('input[name="name"]').css('border','solid red 2px');$('html, body').animate({scrollTop: 0}, 1000);}
                else {$('input[name="name"]').css('border','');
                   // if ($('input[name="price"]').val()=='') {$('input[name="price"]').css('border','solid red 2px');$('html, body').animate({scrollTop: 0}, 1000);}
                     //   else {$('input[name="price"]').css('border','');
                            if (($('input[name="photo"]').val()=='')&&($('.image').size()==0)) {$('input[name="photo"]').css('color','red');$('html, body').animate({scrollTop: 0}, 1000);}
                                else {$('input[name="photo"]').css('color','black');                    
                                    if ($('textarea[name="t_0"]').val()=='') {$('textarea[name="t_0"]').css('border','solid red 2px');$('html, body').animate({scrollTop: 0}, 1000);}
                                        else {$('textarea[name="t_0"]').css('border','');                        
                                            //if ($('.min_des').size()<1) {$('#add_sub').css('color','red');$('html, body').animate({scrollTop: 0}, 1000);}
                                              //  else {$('#add_sub').css('color','black');
                                                    //if ($('.min_des:first').val()=='') {$('.min_des:first').css('border','solid red 2px');$('html, body').animate({scrollTop: 0}, 1000);}
                                                      //  else {$('.min_des:first').css('border','');                                
                                                       //     if ($('textarea.min_des_text:first').val()=='') {$('textarea.min_des_text:first').css('border','solid red 2px');$('html, body').animate({scrollTop: 0}, 1000);}
                                                         //       else {$('textarea.min_des_text:first').css('border','');//alert('OK!');
                                                                $('*').css('cursor','pointer');
                                                                $('button, input, select').css('background-color','silver');
                                                                $("#form").ajaxForm(function()
                                                                            { 
                                                                                //alert('OK!');
                                                                               // $('#action').val('');
                                                                                //$('button, input, select').css('background-color',''); 
                                                                               // $('#action').val('');
                                                                                //$('.res b').html('');
                                                                                location.href='prodview.php';   
                                                                            }).submit();
                                                                            
                                                                }}}}//}}}}
                                                                return false;
})



$("#razd [value='"+$('#razd_sel').val()+"']").attr("selected", "selected");
})
 
    </script>

<?php
if ($_GET['editid']>0)
{
    $prod=mysql_fetch_array(mysql_query("select * from gea.prod where id=".$_GET['editid']));
    //print_r($prods);    
}
?>

<form id="form" method="post" enctype="multipart/form-data" action='prodhandler.php'>
<table style="" cellspacing="1" align="center">
<tr>
<td>Показывать товар:<br /><span class="help">Если убрать галочку товар на сайте отображаться не будет.</span></td> 
<td><input type="checkbox" id="showProd" name="showProd" <?php if ($prod['showProd']) echo 'checked="checked"'?> /></td>
</tr>
<tr>
<td>ID 1C</td> 
<td><input type="text" id="id1c" name="id1c" value="<?php echo $prod['id1c']?>" /></td>
</tr>
<tr>
<td>Раздел</td>
<td>
<select name="razd" id="razd">
    <option value="0">Выберите раздел</option>
    <?php
    $q=mysql_query("SELECT * FROM  `menu` where parentId=2 and id!=25");
    while($item=mysql_fetch_array($q))
    echo "<option value='".$item['id']."'>".$item['caption']."</option>";
    ?>
</select>
<input type="hidden" id="razd_sel" value="<?php echo $prod['id_razd']?>"/>
</td>
</tr>

<tr>
<td>Название</td> 
<td><input type="text" id="name" name="name" value="<?php echo $prod['name']?>"/></td>
</tr>

<tr>
<td>Цена <br /></td>
<td><input type="text" name="price" value="<?php echo $prod['price']?>"/></td>
</tr>

<tr>
<td>Документы <br /><span class="help">Только цифры!<br />Через пробел</span></td>
<td><input type="text" name="doc" value="<?php echo $prod['doc']?>"/></td>
</tr>

<tr>
<td>
    Фото <span class="help">(322x348px)</span>
</td>
<td>
    <?php
    if ($prod['img']) {echo '<img class="image" src="/img/prod/'.$prod['img'].'" width="100px"/>';
    echo '<span class="help">При выборе нового фото старое удалиться.</span><br />';}
    ?>
    <input type="file" name="photo" accept="image/png"/>
    </td>
</tr>

<tr>
<td>Краткое описание</td>
<td>
<button id="i_0" class="i" title="Курсив"><i style="font-family: times new roman;">I</i></button>
<button id="b_0" class="b" title="Жирный"><b>B</b></button> 
<button id="l_0" class="l" title="Cсылка">URL</button>
<span class="help">Один Enter новая строка, два - новый абзац.</span>
<br />
<textarea id="t_0" name="t_0" rows="10" cols="52"><?php echo $prod['desc']?></textarea>
</td>
</tr>

<tr>
<td>Description<br /><span class="help">Для поисковика</span></td>
<td>
<textarea id="t_0" name="description" rows="10" cols="52"><?php echo $prod['description']?></textarea>
</td>
</tr>

<tr>
<td colspan="2" style="text-align: center;">
<b>Полное описвание</b>
<button id="add_sub" style="width: 200px;height:30px;margin: 0 20px"><b>Добавить подпункт</b></button><br />
<span class='help' style="float: left;">Для удаления очистите поля и сохраните.</span>
</td>
</tr>
<?php
$j=0;
if ($_GET['editid']>0)
{
    $q2=mysql_query("select * from gea.prod_des where id_prod='".$_GET['editid']."'");
    while($des=mysql_fetch_array($q2))
    {
        $j++;
        echo "
        <tr> 
            <td>Заголовок</td> 
            <td><input class='min_des' id='name_".$j."' name='name_".$j."' type='text' value='".$des['title']."'/></td> 
        </tr>
        <tr> 
            <td>Текст</td> 
            <td>
                <button id='i_".$j."' class='i' title='Курсив'><i style='font-family: times new roman;'>I</i></button>
                <button id='b_".$j."' class='b' title='Жирный'><b>B</b></button> 
                <button id='l_".$j."' class='l' title='Cсылка'>URL</button> 
                <span class='help'>Один Enter новая строка, два - новый абзац.</span>
                <br />
                <textarea class='min_des_text' id='t_".$j."' name='t_".$j."' type='text' rows='10' cols='52'>".$des['text']."</textarea>
            </td> 
        </tr>";
    }
    echo "<input id='number_of_des' name='number_of_des' type='hidden' value='".$j."'>";
}
?>


</table>
<input type="hidden" value="<?php echo $prod['id']?>" name="editid"/>
</form>
<div style="text-align: center;border: dotted gray 1px;padding: 5px;width: 888px;margin:10px auto">
    
        <button id="save" style="width: 200px;height:30px;margin-left:20px"><b>Сохранить товар</b></button>
    
</div>


<?php require_once 'foot.php';?>