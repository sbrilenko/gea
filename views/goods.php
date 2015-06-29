<?php
  $page->title="GEA | Продукция";
  $page -> keywords = "каталог gea продукция геа восстановление здоровья";
?>

<script type="text/javascript" src="/js/scrollTo.js"></script>
<?php
if (stripos($_SERVER['REQUEST_URI'],'cat-1')){$idcat=7;}
if (stripos($_SERVER['REQUEST_URI'],'cat-2')){$idcat=8;}   
if (stripos($_SERVER['REQUEST_URI'],'cat-3')){$idcat=9;}  
if (stripos($_SERVER['REQUEST_URI'],'cat-4')){$idcat=10;}  
if (stripos($_SERVER['REQUEST_URI'],'cat-5')){$idcat=17;}  
if (stripos($_SERVER['REQUEST_URI'],'cat-6')){$idcat=18;}  
if (stripos($_SERVER['REQUEST_URI'],'cat-7')){$idcat=19;}  
if (stripos($_SERVER['REQUEST_URI'],'cat-8')){$idcat=20;}  
if (stripos($_SERVER['REQUEST_URI'],'cat-9')){$idcat=21;}  
if (stripos($_SERVER['REQUEST_URI'],'cat-10')){$idcat=16;}  
if (stripos($_SERVER['REQUEST_URI'],'cat-11')){$idcat=23;}  
if (stripos($_SERVER['REQUEST_URI'],'cat-12')){$idcat=27;}  
if (stripos($_SERVER['REQUEST_URI'],'/goods/http://prestigeclub.com.ua/')){$idcat=25;} 

?>


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
            if ($(this).find('.productCaptionCatalogue').height()>20)
            {
                h=$(this).find('.productCaptionCatalogue').height();
                num=$(this).attr('id').split('_')[1];
                //alert(num);
                if (num%2!=0) $(this).next().find('.productCaptionCatalogue').height(h);
                else $(this).prev().find('.productCaptionCatalogue').height(h);
                //$(this).parent().parent().findNext('.productCaptionCatalogue').height(h);
            } 
        })
       
})

</script>
<style>
.good{width:350px;float: left;min-height:420px}
a.links{color: #171717;background: #BDBDBD;border-radius:5px;padding:4px 10px 6px 13px;text-decoration: none;font: 12px Verdana, serif;margin-left: 26px;}
a.links:hover{background: #E9E9E9;}

.bolshoy-plus{width:auto;height:82px;background: url('/img/+.png')288px 0 no-repeat;}
.perevernutay-T{width:auto;height:82px;background: url('/img/T.png')288px 0 no-repeat;}
.show{cursor:pointer;color:#000}
.pl-mi{width:18px; height:18px; background: url('/img/pl-mi.png');float:left;margin: 8px 10px 0 0;}

.prices{margin: 384px 0 0 0;position:absolute;font-size: 12px;width:322px;text-align: center;}
.highlight{font-size: 26px; color:#1BC80D;}
.BB{font-size: 18px;}
.no-be{font: bold 16px Verdana, serif;color:#B71807}
</style>

<?php if ($_SERVER['REQUEST_URI']==='/goods'){?>
<div class='productCaption'>Продукция</div>
<p class='bold'>Друзья и коллеги!</p>
<p>В настоящее время люди всё яснее понимают, что в условиях тотального загрязнения окружающей среды состояние здоровья человека катастрофически ухудшается. В водопроводных трубах течёт техническая вода, которой даже мыться нельзя, в воздухе - смог, в продуктах - практически полное отсутствие полезных веществ, зато полное присутствие вредных (красители, консерванты, ГМО, стимуляторы роста, антибиотики и многое другое, о чём мы просто не знаем или предпочитаем не знать).</p>
<p>Современный фармакологический бизнес и множество аптек никак не способствуют уменьшению количества больных.</p>
<p>А ведь человек может жить долго и счастливо, используя то, что ему даёт природа в виде натуральных фитокомплексов, рецепты приготовления, которых зачастую пришли к нам из глубины веков.</p>
<p>В странах Европы, Японии, Америке уже много десятилетий люди пользуются натуральными оздоровительными комплексами, так называемыми БАДами. И в отличие от наших соотечественников, живут на 15-20 лет дольше.</p>
<p>А инновационные технологии позволяют защитить наш организм от отрицательного внешнего энергетического смога.</p>
<p>Именно поэтому, подбирая продукцию для всех нас, мы опирались на необходимость создания системы восстановления здоровья человека, начиная от очищения, восстановления энергетического потенциала, заканчивая восполнением дефицита витаминов, микроэлементов, биологически активных веществ, без которых невозможна нормальная работа всех органов и систем организма.</p>
<p>С удовольствием представляем Вашему вниманию замечательную продукцию, которая, безусловно, поможет Вам быть молодыми, здоровыми и красивыми так долго, как Вам этого хочется.</p>

<?php }else{?>
<?php if ((stristr($_SERVER['REQUEST_URI'],'full')) or (stristr($_SERVER['REQUEST_URI'],'doc'))){

if (stristr($_SERVER['REQUEST_URI'],'full'))
{
    $id=explode('full=',$_SERVER['REQUEST_URI']);
    $good=mysql_fetch_array(mysql_query("select * from gea.prod where id=".$id[1]));
    $cat=mysql_fetch_array(mysql_query("select * from gea.menu where id=".$idcat));
    echo '<div class="nav"><a href="/goods">Продукция</a> / <a href="/goods/'.$cat['link'].'">'.$cat['caption'].'</a></div>';
    echo '<div class="productCaption">'.$good['name'].'</div>';
    echo'<img style="';if ($good['price']) echo 'margin:0 20px 60px 0'; else echo 'margin:0 20px 20px 0'; echo'" src="img/prod/'.$good['img'].'" align="left" width="322px" height="348px">';
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

    echo $text;
    echo '<div style="clear:both"></div><br />';
    $q=mysql_query("select * from gea.prod_des where id_prod=".$good['id']);
    while($des=@mysql_fetch_array($q))
    {
        $descr =str_replace("\r\n", '<br />',  $des['text']);
        $descr ='<p>'.str_replace("<br /><br />", '</p><p>',$descr).'</p>';
        
        echo '<div class="textHeader show" id="t_'.$des['id'].'" style="margin: 10px 0 0 0;"><div class="pl-mi"></div>'.$des['title'].'</div>';
        echo '<div class="redBlockOuter" id="d_'.$des['id'].'" style="margin:30px 0 50px;padding:30px 20px 14px 30px; border-radius: 25px;display:none">'.$descr.'</div>';
    }
    echo '<br />';
}

if (stristr($_SERVER['REQUEST_URI'],'doc'))
{
    $cat=mysql_fetch_array(mysql_query("select * from gea.menu where id=".$idcat));
    echo '<div class="nav"><a href="/goods">Продукция</a> / <a href="/goods/'.$cat['link'].'">'.$cat['caption'].'</a></div>';
    $id=explode('doc=',$_SERVER['REQUEST_URI']);
    $docs=mysql_fetch_row(mysql_query("select `doc` from gea.prod where id=".$id[1]));
    $docs=explode(' ',$docs[0]);
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

$tit=@mysql_fetch_array(mysql_query("SELECT * FROM  `gea`.`menu` where id=".$idcat));
?>
<div class="nav"><a href="/goods">Продукция</a></div>
<div class="productCaption"><?php echo $tit['caption']?></div>

<?php
$q=mysql_query("select * from prod where id_razd=".$idcat);
while($good=@mysql_fetch_array($q))
{
    $i++;
   // print_r($good);
    echo '
    <div class="good" id="num_'.$i.'">
        <div class="productCaption productCaptionCatalogue">'.$good['name'].'</div>
        <img style="float: left;margin-bottom:20px" src="img/prod/'.$good['img'].'" alt="'.$good['name'].'" title="'.$good['name'].'" width="322px" height="348px"/>';
        echo '<a class="links" href="'.$_SERVER['REQUEST_URI'].'full='.$good['id'].'">&nbsp;&nbsp;Подробнее&nbsp;&nbsp;&nbsp;</a>';
        if ($good['doc']){echo '<a class="links" href="'.$_SERVER['REQUEST_URI'].'doc='.$good['id'].'">Документация&nbsp;</a>';}
        echo '</div>';
    if (!($i%2))
    {
        echo '<div style="clear: both;"></div><div class="bolshoy-plus" style="margin:20px 0 10px"></div><div style="clear: both;"></div>';
    }
}
$num=@mysql_num_rows(mysql_query("select * from prod where id_razd=".$idcat));
if (!($num%2)) echo '<div style="width: 10px;height: 40px;margin:-49px 0 0 327px ;background: #fff;"></div>';
?>


<?php }}?>
<div style="clear: both;" ></div>