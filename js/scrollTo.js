/**
Быстрый старт

Подключаем библиотеки:

HTML
1
<script type="text/javascript" src="js/jquery-1.6.2.min.js" ></script>
2
<script type="text/javascript" src="js/jquery.scrollTo-min.js"></script>
Прописываем в HTML кому-нибудь id — будем перематывать окно до этого элемента:

HTML
1
<h2 id="target-el">
2
    Важный заголовок
3
</h2>
Задаем кнопку управления:

HTML
1
<button>Перемотать на важный заголовок</button>
При клике по кнопке включаем перемотку:

Javascript
1
<script type="text/javascript">
2
jQuery(document).ready(function(){
3
    jQuery('button').click(function() {
4
        jQuery.scrollTo('#target-el');
5
    });
6
});
7
</script>
А теперь подробнее

Команда jQuery.scrollTo() будет перематывать главный скрорлл. Если нужно перемотать скролл какого-нибудь элемента, используем запись вида jQuery('селектор').scrollTo(), например:

Javascript
1
jQuery('div.pane').scrollTo('#target-el');
Прараметры scrollTo()

Ну и как обычно, вся магия — в парметрах:

Название параметра	Описание
axis	Ось, которая будет прокручиваться, 'x', 'y', 'xy' или 'yx'. 'xy' — значение по умолчанию
duration	Длительность анимации.
easing	Название уравнения easing.
margin	Если true, целевые границы и margin вычитаются.
offset	Чилсо или хэш {left: x, top:y }. Это значение будет добавлено к окончательной позиции (может быть отрицательным)
over	Добавить часть высоты/ ширины элемента (также может быть отрицательным).
queue	Если true, и обе оси прокручиваться, то сначала анимируется прокрутка на одной оси, а затем на другой. Порядок задает паравитр axis ('xy' или 'yx')
onAfterFirst	Если queue=true, функция выполнится после прокрутки первой оси.
onAfter	Функция, которая вызывается после того, как закончится вся анимация.
Подробнее про вызов scrollTo()

При вызове scrollTo() передается три вида параметров — цель, продолжительность, настройки (порядок имеет значение).

цель — куда именно перематывать (подробнее см. ниже);
продолжительность — параметр duration из таблички выше;
настройки — остальные параметры из таблички выше.
В качестве цели можно использовать:

Просто число
Строку ('44', '100px', '+=30px', и т.д.)
Элемент DOM (дочерний для прокручиваемого элемента)
Селектор
Строка 'max' для прокрутки в конец
Строка, определяющая процент, чтобы перейти к части контейнера (например: 50% переходит в середину)
Хеш { top:x, left:y }, x и y может быть любое число/строка из описанных выше.
Примеры вызова с параметрами:

Javascript
1
jQuery('div').scrollTo('#target-el', 1000, {margin:true});
2
 
3
jQuery('div').scrollTo('520px', 800);
4
 
5
jQuery('div').scrollTo('#target-el', 1000, {axis:'x'});
6
 
7
jQuery('div').scrollTo({top:'-=100px', left:'+=100'}, 800);
8
 
9
jQuery('div').scrollTo( '#target-el', 1600, {queue:true, onAfterFirst:function(){ } } );
Пример перемотки к элементу, заданному атрибутом

Конечно, прописывать в скрипте, например, id конкретного элемента не очень удобно. Лучше будет сделать более универсальное решение. Например, задать цель перемотки, как какой-либо атрибут у кнопки управления. Допустим, так:

HTML
1
<button value="target-id">Перемотать на важный заголовок</button>
Javascript
1
<script type="text/javascript">
2
jQuery('button').click(function() {
3
    str = jQuery(this).val();
4
    jQuery.scrollTo("#"+str);
5
});
6
</script>

 *
 * http://flesler.blogspot.com/2007/10/jqueryscrollto.html
 */
;(function(d){var k=d.scrollTo=function(a,i,e){d(window).scrollTo(a,i,e)};k.defaults={axis:'xy',duration:parseFloat(d.fn.jquery)>=1.3?0:1};k.window=function(a){return d(window)._scrollable()};d.fn._scrollable=function(){return this.map(function(){var a=this,i=!a.nodeName||d.inArray(a.nodeName.toLowerCase(),['iframe','#document','html','body'])!=-1;if(!i)return a;var e=(a.contentWindow||a).document||a.ownerDocument||a;return d.browser.safari||e.compatMode=='BackCompat'?e.body:e.documentElement})};d.fn.scrollTo=function(n,j,b){if(typeof j=='object'){b=j;j=0}if(typeof b=='function')b={onAfter:b};if(n=='max')n=9e9;b=d.extend({},k.defaults,b);j=j||b.speed||b.duration;b.queue=b.queue&&b.axis.length>1;if(b.queue)j/=2;b.offset=p(b.offset);b.over=p(b.over);return this._scrollable().each(function(){var q=this,r=d(q),f=n,s,g={},u=r.is('html,body');switch(typeof f){case'number':case'string':if(/^([+-]=)?\d+(\.\d+)?(px|%)?$/.test(f)){f=p(f);break}f=d(f,this);case'object':if(f.is||f.style)s=(f=d(f)).offset()}d.each(b.axis.split(''),function(a,i){var e=i=='x'?'Left':'Top',h=e.toLowerCase(),c='scroll'+e,l=q[c],m=k.max(q,i);if(s){g[c]=s[h]+(u?0:l-r.offset()[h]);if(b.margin){g[c]-=parseInt(f.css('margin'+e))||0;g[c]-=parseInt(f.css('border'+e+'Width'))||0}g[c]+=b.offset[h]||0;if(b.over[h])g[c]+=f[i=='x'?'width':'height']()*b.over[h]}else{var o=f[h];g[c]=o.slice&&o.slice(-1)=='%'?parseFloat(o)/100*m:o}if(/^\d+$/.test(g[c]))g[c]=g[c]<=0?0:Math.min(g[c],m);if(!a&&b.queue){if(l!=g[c])t(b.onAfterFirst);delete g[c]}});t(b.onAfter);function t(a){r.animate(g,j,b.easing,a&&function(){a.call(this,n,b)})}}).end()};k.max=function(a,i){var e=i=='x'?'Width':'Height',h='scroll'+e;if(!d(a).is('html,body'))return a[h]-d(a)[e.toLowerCase()]();var c='client'+e,l=a.ownerDocument.documentElement,m=a.ownerDocument.body;return Math.max(l[h],m[h])-Math.min(l[c],m[c])};function p(a){return typeof a=='object'?a:{top:a,left:a}}})(jQuery);