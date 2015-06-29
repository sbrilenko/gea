<div style="text-align: center;cursor:default;"><a href='/admin/in' title='выход'>Выход</a></div>

<div class='bottom_menu'>
    <?php  if($controller->is('index')) header('location: /admin/menu');?>
    <?php echo ($tut == 'index')? "<span style='cursor:default;'": "<a";?>
    style='line-height:20px' href='/admin/index' title='Товары' <?php  echo ($tut == 'index') ? "class='tut'" : ""; ?> >Продукция
    <?php echo ($tut=='index') ? "</span>" : "</a>";?>  |
    <?php echo ($tut == 'category')? "<span style='cursor:default;'": "<a";?>
    style='line-height:20px' href='/admin/category' title='Разделы' <?php  echo ($tut == 'category') ? "class='tut'" : ""; ?> >Разделы
    <?php echo ($tut=='category') ? "</span>" : "</a>";?>  |
    <?php echo ($tut == 'webinar')? "<span style='cursor:default;'": "<a";?>
    style='line-height:20px' href='/admin/webinar' title='Вебинары' <?php  echo ($tut == 'webinar') ? "class='tut'" : ""; ?> >Вебинары
    <?php echo ($tut=='webinar') ? "</span>" : "</a>";?>  |
    <?php echo ($tut == 'event')? "<span style='cursor:default;'": "<a";?>
    style='line-height:20px' href='/admin/event' title='События' <?php  echo ($tut == 'event') ? "class='tut'" : ""; ?> >События
    <?php echo ($tut=='event') ? "</span>" : "</a>";?>  |
    <?php echo ($tut == 'video')? "<span style='cursor:default;'": "<a";?>
    style='line-height:20px' href='/admin/video' title='События' <?php  echo ($tut == 'video') ? "class='tut'" : ""; ?> >Видео
    <?php echo ($tut=='video') ? "</span>" : "</a>";?>  |
    <?php echo ($tut == 'galery')? "<span style='cursor:default;'": "<a";?>
    style='line-height:20px' href='/admin/galery' title='Фото-галерея' <?php  echo ($tut == 'galery') ? "class='tut'" : ""; ?> >Фото-галерея
    <?php echo ($tut=='galery') ? "</span>" : "</a>";?>  |
    <?php echo ($tut == 'results')? "<span style='cursor:default;'": "<a";?>
    style='line-height:20px' href='/admin/results' title='Фото-галерея' <?php  echo ($tut == 'results') ? "class='tut'" : ""; ?> >Результаты
    <?php echo ($tut=='results') ? "</span>" : "</a>";?>
</div>