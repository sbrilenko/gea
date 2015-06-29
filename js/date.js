$(document).ready(function(){
		$.datepicker.regional['ru'] = {
		closeText: 'Закрыть',
		prevText: 'Пред',
		nextText: 'След',
		currentText: 'Сегодня',
		monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь',
		'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
		monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн',
		'Июл','Авг','Сен','Окт','Ноя','Дек'],
		dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
		dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
		dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
		weekHeader: 'Не',
		dateFormat: 'dd.mm.yy',
		firstDay: 1,
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: ''};
	    $.datepicker.setDefaults($.datepicker.regional['ru']);
        $(".date").datepicker();
        var istouch;
        if((!!('ontouchstart' in window)))
           {
                istouch='touchend';
           }
           else
           {
                istouch='click';
           }
        $('.calend').on(istouch,function()
        {
            $('.date').datepicker('show')
        })
        
        
        

    
function parseDate(value) {
	var tmp = value.split(".");
	return { day: tmp[0], month: tmp[1], year: tmp[2] };
}

$('.date').on('change', function(){
    
            //var a = $(this).parent().parent().prev().children('.mar_top_15_1').children('input');
            var t = $(this).val();
            console.log(t)
            //var n = a.val();
            //var date_start = new Date(parseDate(n).year,parseDate(n).month - 1,parseDate(n).day);
            var date_in = new Date(parseDate(t).year,parseDate(t).month - 1,parseDate(t).day);
            var now = new Date();
            //var begin = date_start.getTime();
            var incoming = date_in.getTime();
            var today = now.getTime();
            var day = now.getDate()<10?'0'+now.getDate():now.getDate();
            var month = parseInt(now.getMonth())+1;
            var month = month<10?'0'+month:month;
            var year = now.getFullYear();
           
            if(incoming<today){
                $(this).val(day+'.'+month+'.'+year);
            }
          
        })



    $('.mainname').each(function(){
        if($('ul', $(this)).length == 0){
            $(this).hide();
        }
    })
    
    $('.submainname').each(function(){
        if($('ul', $(this)).length == 0){
            $(this).hide();
        }
    })


        
})
$(window).resize(function()
  {
     $('.date').datepicker('hide')
  })
