<?php
$id=explode('full=',$_SERVER['REQUEST_URI']);
$good=mysql_fetch_array(mysql_query("select * from gea.prod where showProd=1 and id=".$id[1]));

$normalname = mb_strtoupper(mb_substr(mb_strtolower($good['name']),0,1)).mb_substr(mb_strtolower($good['name']),1,mb_strlen($good['name'])-2);

  $page -> title = $normalname." - Продукция - GEA ";
  $page -> keywords =  "купить ".$normalname." каталог продукции gea";
  if ($good['description']) $page -> description = $good['description'];
  
?>

<script type="text/javascript" src="/js/scrollTo.js"></script>

<script>
$(document).ready(function(){
    var id=0;
    $('.show').live('click',function(){
        id=$(this).attr('id').split('_')[1];
        if ($('#d_'+id).css('display')=='none')
        {
            $('#d_'+id).slideDown('normal',function(){$.scrollTo('#t_'+id, 1000);});
            $(this).find('div').css('background-position','-18px 0px');
            $('.show#t_'+id).css('color','#DC0000');
        }
        else
        {
            $('#d_'+id).slideUp('normal',function(){$.scrollTo('.show:first', 1000);});
            $(this).find('div').css('background-position','0px 0px');
            $('.show#t_'+id).css('color','#000');
        }
        })
        
        $('.show').live('mouseover',function(){id=$(this).attr('id').split('_')[1];if ($('#d_'+id).css('display')=='none')$(this).css('color','#DC0000');})
        $('.show').live('mouseout',function(){id=$(this).attr('id').split('_')[1];if ($('#d_'+id).css('display')=='none')$(this).css('color','#000');})
        
        
        $('.good').each(function(){
            //console.log($(this).find('.height').height());
            if ($(this).find('.height').height()>25)
            {
                h=$(this).find('.height').height();
                dataClass=$(this).find('.height').attr('data-class');//alert(dataClass);
                $('span[data-class="'+dataClass+'"]').height(h);
                //num=$(this).attr('id').split('_')[1];
                //alert(num);
                //if (num%2!=0) $(this).next().find('.height').height(h);
                //else $(this).prev().find('.height').height(h);
                //$(this).parent().parent().findNext('.height').height(h);
            } 
        })
})

</script>

<?php if (($_SERVER['REQUEST_URI']==='/products/')or(($_SERVER['REQUEST_URI']==='/products'))){?>

<div class='productCaption'>Продукция</div>
<?php
$q=mysql_query("select * from prod where showProd=1 order by RAND()");
$j=0;
while($good=mysql_fetch_array($q))
{
    $i++;
  //if ($_SESSION['authorized']==='ok') echo '&nbsp;&nbsp;&nbsp;<a target="_blank" href="http://gea.net.ua/editor/prod.php?editid='.$good['id'].'" style="color:red">Edit</a>';
    echo '
    <div class="good" id="num_'.$i.'" ';if(!$good['doc']) echo 'style="text-align:left"';echo'>
        <a data-class="'.$j.'" class="productCaption productCaptionCatalogue" href="'.$_SERVER['REQUEST_URI'].'full='.$good['id'].'"><span data-class="'.$j.'" class="height">'.$good['name'].'</span>';echo'
        <span style="display:block;width:322px; max-height:348px;height:348px;margin: 20px auto 0;"><img style="float: left;margin-bottom:20px" src="img/prod/'.$good['img'].'" alt="'.$good['name'].'" title="'.$good['name'].'" width="322px" /></span></a>';
        echo '<a class="links" ';if(!$good['doc']) echo 'style="margin-left:46px"';echo' href="'.$_SERVER['REQUEST_URI'].'full='.$good['id'].'">&nbsp;&nbsp;Подробнее&nbsp;&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        if ($good['doc']){echo '<a class="links" href="'.$_SERVER['REQUEST_URI'].'doc='.$good['id'].'">Документация&nbsp;</a>';}
        echo '</div>';   
    if (!($i%3))
    {
        echo '<span class="remove_for_two"><div style="clear: both;"></div><div class="bolshoy-plus"></div><div class="bolshoy-plus2"></div><div style="clear: both;"></div></span>';
        $j++;
    }
    if (!($i%2)) echo '<span class="add_for_two" style="display:none"><div style="clear: both;"></div><div class="bolshoy-plus"></div><div style="clear: both;"></div></span>';
}
if ($idcat) $num=mysql_num_rows(mysql_query("select * from prod where id_razd=".$idcat));
if (!($num%3)) {echo '<div style="width: 10px;height: 40px;margin:-50px auto 0 ;background: #fff;"></div>';}
?>
<!--<p class='bold'>Друзья и коллеги!</p>
<p>В настоящее время люди всё яснее понимают, что в условиях тотального загрязнения окружающей среды состояние здоровья человека катастрофически ухудшается. В водопроводных трубах течёт техническая вода, которой даже мыться нельзя, в воздухе - смог, в продуктах - практически полное отсутствие полезных веществ, зато полное присутствие вредных (красители, консерванты, ГМО, стимуляторы роста, антибиотики и многое другое, о чём мы просто не знаем или предпочитаем не знать).</p>
<p>Современный фармакологический бизнес и множество аптек никак не способствуют уменьшению количества больных.</p>
<p>А ведь человек может жить долго и счастливо, используя то, что ему даёт природа в виде натуральных фитокомплексов, рецепты приготовления, которых зачастую пришли к нам из глубины веков.</p>
<p>В странах Европы, Японии, Америке уже много десятилетий люди пользуются натуральными оздоровительными комплексами, так называемыми БАДами. И в отличие от наших соотечественников, живут на 15-20 лет дольше.</p>
<p>А инновационные технологии позволяют защитить наш организм от отрицательного внешнего энергетического смога.</p>
<p>Именно поэтому, подбирая продукцию для всех нас, мы опирались на необходимость создания системы восстановления здоровья человека, начиная от очищения, восстановления энергетического потенциала, заканчивая восполнением дефицита витаминов, микроэлементов, биологически активных веществ, без которых невозможна нормальная работа всех органов и систем организма.</p>
<p>С удовольствием представляем Вашему вниманию замечательную продукцию, которая, безусловно, поможет Вам быть молодыми, здоровыми и красивыми так долго, как Вам этого хочется.</p>
-->
<?php }else{?>
<?php if ((stristr($_SERVER['REQUEST_URI'],'full=')) or (stristr($_SERVER['REQUEST_URI'],'doc='))){

if (stristr($_SERVER['REQUEST_URI'],'full='))
{
    $id=explode('full=',$_SERVER['REQUEST_URI']);
    if(preg_match( '/[^\d]/i', $id[1])) {header('Location: /404');}
    $good=mysql_fetch_array(mysql_query("select * from gea.prod where showProd=1 and id=".$id[1]));
    if (!$good['id']) {header('Location: /404');}
    if ($idcat) $cat=mysql_fetch_array(mysql_query("select * from gea.menu where id=".$idcat));
    echo '<div class="nav"><a href="/products/">Продукция</a>';if ($cat['link']) echo' / <a href="/products/'.$cat['link'].'/">'.$cat['caption'].'</a>';echo'</div>';
    echo '<div class="productCaption">'.$good['name'].'</div>';if ($_SESSION['authorized']==='ok') echo '<a target="_blank" href="http://gea.net.ua/editor/prod.php?editid='.$good['id'].'" style="color:red;position: absolute;">Edit</a>';
    echo '<img style="';if ($good['price']) echo 'margin:0 20px 60px 0'; else echo 'margin:0 20px 20px 0'; echo'" src="img/prod/'.$good['img'].'" align="left" width="322px" >';
    if ($good['price']!='') 
    {
        $highlight = preg_replace('/[0-9]/i', '<span class="highlight">\\0</span>', $good['price']);
        $highlight = preg_replace('/ББ/i', '<span class="BB">\\0</span>', $highlight);
        $highlight = preg_replace('/(Нет в наличии)/i', '<span class="no-be">\\0</span>', $highlight);
        $highlight = preg_replace('/(Нет в продаже)/i', '<span class="no-be">\\0</span>', $highlight);
        $highlight = preg_replace('/(Нет на складе)/i', '<span class="no-be">\\0</span>', $highlight);
        echo '<div class="prices">'.$highlight.'</div>';
    }

    $text ='<p>'.str_replace("\r\n\r\n", '</p><p>', $good['desc']).'</p>';
    $text =str_replace("\r\n", '<br />', $text);
	
	$text ='<p>'.str_replace("\n\n", '</p><p>', $text).'</p>';
    $text =str_replace("\n", '<br />', $text);
		
    echo $text;
    echo '<div style="clear:both"></div><br />';
    $q=mysql_query("select * from gea.prod_des where id_prod=".$good['id']." order by title ASC");
    while($des=@mysql_fetch_array($q))
    {
        $descr = preg_replace('/\n{3,}/','', $des['text']);
        $descr =str_replace("\n", '<br />',  $descr);        
        $descr ='<p>'.str_replace("<br /><br />", '</p><p>',$descr).'</p>';
        $descr ='<p>'.str_replace("\n\n", '</p><p>', $descr).'</p>';
		// $descr =str_replace("\n", '<br />', $descr);
        
		
        echo '<div class="textHeader show" id="t_'.$des['id'].'" style="margin: 10px 0 0 0;"><div class="pl-mi"></div>'.$des['title'].'</div>';
        echo '<div class="redBlockOuter" id="d_'.$des['id'].'" style="margin:30px 0 50px;padding:30px 20px 14px 30px; border-radius: 25px;display:none">'.$descr.'</div>';
    }
    echo '<br />';
}

if (stristr($_SERVER['REQUEST_URI'],'doc='))
{
    if ($idcat)$cat=mysql_fetch_array(mysql_query("select * from gea.menu where id=".$idcat));
    echo '<div class="nav"><a href="/products/">Продукция</a> ';if ($cat['link']) echo' / <a href="/products/'.$cat['link'].'/">'.$cat['caption'].'</a>';echo'</div>';
    $id=explode('doc=',$_SERVER['REQUEST_URI']);
    if(preg_match( '/[^\d]/i', $id[1])) {header('Location: /404');}
    $docs=mysql_fetch_row(mysql_query("select `doc` from gea.prod where id=".$id[1]));
    if (!$docs[0]) {header('Location: /404');}
    $docs=explode(' ',$docs[0]);
    echo '<div style="margin:10px 0 0 0;height:25px"><a class="cert-back" href="#" style="border-radius: 6px;"><span>Вернуться к назад</span></a></div>';
    foreach($docs as $iddoc)
    {
    $doc=mysql_fetch_array(mysql_query("select * from gea.certificates where id=".$iddoc));
    echo '
    <div class="cert-container">
						<div class="cert-photo-wrapper">
							<img src="img/certificates/thumb_'.$doc['picture'].'" alt="certificate">
						</div>
						<div class="cert-info-container">
							<div class="cert-title">'.$doc['title'].'</div>
							<div class="cert-info">'.$doc['description'].'</div>
							<a class="cert-more" href="img/certificates/'.$doc['picture'].'" target="_blank" style="border-top-left-radius: 6px; border-top-right-radius: 6px; border-bottom-left-radius: 6px; border-bottom-right-radius: 6px; "><span>Подробнее</span></a>
						</div>
					</div>
    ';
    }
}
?>
<?php }else{?>
<?php

$tit=mysql_fetch_array(mysql_query("SELECT * FROM  `menu` where id=".$idcat));
?>
<div class="nav"><a href="/products/">Продукция</a></div>
<div class="productCaption"><?php echo $tit['caption']?></div>

<?php
$q=mysql_query("select * from prod where showProd=1 and id_razd=".$idcat);
while($good=mysql_fetch_array($q))
{
    $i++;
   // print_r($good);if ($_SESSION['authorized']==='ok') echo '&nbsp;&nbsp;&nbsp;<a target="_blank" href="http://gea.net.ua/editor/prod.php?editid='.$good['id'].'" style="color:red">Edit</a>';
    echo '
    <div class="good" id="num_'.$i.'" ';if(!$good['doc']) echo 'style="text-align:left"';echo'>
        <a  class="productCaption productCaptionCatalogue"  href="'.$_SERVER['REQUEST_URI'].'full='.$good['id'].'"><span data-class="'.$j.'" class="height">'.$good['name'].'</span>';echo'
        <span style="display:block;width:322px; height:348px;margin: 20px auto 0;"><img style="float: left;margin-bottom:20px" src="img/prod/'.$good['img'].'" alt="'.$good['name'].'" title="'.$good['name'].'" width="322px" /></span></a>';
        echo '<a class="links" ';if(!$good['doc']) echo 'style="margin-left:46px"';echo' href="'.$_SERVER['REQUEST_URI'].'full='.$good['id'].'">&nbsp;&nbsp;Подробнее&nbsp;&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
        if ($good['doc']){echo '<a class="links" href="'.$_SERVER['REQUEST_URI'].'doc='.$good['id'].'">Документация&nbsp;</a>';}
        echo '</div>';   
    if (!($i%3))
    {
        echo '<span class="remove_for_two"><div style="clear: both;"></div><div class="bolshoy-plus"></div><div class="bolshoy-plus2"></div><div style="clear: both;"></div></span>';
        $j++;
    }
    if (!($i%2)) echo '<span class="add_for_two" style="display:none"><div style="clear: both;"></div><div class="bolshoy-plus"></div><div style="clear: both;"></div></span>';
}
$num=mysql_num_rows(mysql_query("select * from prod where id_razd=".$idcat));
if (!($num%2)) echo '<div style="width: 10px;height: 40px;margin:-50px auto 0 ;background: #fff;"></div>';
?>


<?php }}?>
<div style="clear: both;" ></div>