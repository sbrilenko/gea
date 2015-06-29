
(function($) {
	$.fn.bron = function(options){
	   var istouch;
       var total=0,totaldeliv=0
       if((!!('ontouchstart' in window)))
       {
            istouch='touchend';
       }
       else
       {
            istouch='click';
       }
		this.each(function(){
			var settings = {};
             		
		});
        $('.bron').on(istouch,function()
        {
            if($(this).hasClass('king'))
            {
                if($('input[name="standart"]').is(":checked"))
                {
                     $('.hotel-type-room input:radio').removeAttr('checked')
                     $('input[name="king"]').attr('checked',true)
                }
                var numbers=$('input[name="col"]').val()
                var nomer=$('.hotel-type-room input:checked').attr('name');
                var days=$('input[name="days"]').val()
                if(days=='') {days=1;$('input[name="days"]').val(days)}
                if(numbers=='') {numbers=1;$('input[name="col"]').val(numbers)}
                
                $('.bron-itogo').html(' <span class="text">Итого: </span>'+total_(numbers,nomer,days)+' грн')
               
            }
            else
            {
                if($('input[name="king"]').is(":checked"))
                {
                     $('.hotel-type-room input:radio').removeAttr('checked')
                     $('input[name="standart"]').attr('checked',true)
                }
                var numbers=$('input[name="col"]').val()
                var nomer=$('.hotel-type-room input:checked').attr('name');
                var days=$('input[name="days"]').val()
                if(days=='') {days=1;$('input[name="days"]').val(days)}
                if(numbers=='') {numbers=1;$('input[name="col"]').val(numbers)}
                
                $('.bron-itogo').html(' <span class="text">Итого: </span>'+total_(numbers,nomer,days)+' грн')
            }
        })
        
        $('.delete').on(istouch,function()
        {
            $('.date').val('')
            $(this).addClass('display-none');
            return false;
        })
        
        $('.hotel-type-room input:radio').on('click',function()
        {
            if($(this).is(":checked"))
            {
                 $('.hotel-type-room input:radio').removeAttr('checked')
                 $(this).attr('checked',true)
            }
            var numbers=$('input[name="col"]').val()
            var nomer=$('.hotel-type-room input:checked').attr('name');
            var days=$('input[name="days"]').val()
            if(days=='') {days=1;$('input[name="days"]').val(days)}
            if(numbers=='') {numbers=1;$('input[name="col"]').val(numbers)}
        
           $('.bron-itogo').html(' <span class="text">Итого: </span>'+total_(numbers,nomer,days)+' грн')

        })
        function total_(col,nomer,days)
        {
            var trans=0
            if($('.transferradio input').is(':checked'))
            {
                trans=100
            }
            var price
            if(nomer=='standart') {price=800;
                if(col<2) nomer=1
                else nomer=2
            }
            else {price=1200;
                if(col<2) nomer=1
                else nomer=3
            }
            return Math.abs(Math.ceil(col/nomer)*price*days)+trans;
        }
        $('.transferradio input:radio').on('click',function()
        {
            if (this.previous) {
                this.checked = false;
            }
            this.previous = this.checked;
            var numbers=$('input[name="col"]').val()
            var nomer=$('.hotel-type-room input:checked').attr('name');
            var days=$('input[name="days"]').val()
            if(days=='') {days=1;$('input[name="days"]').val(days)}
            if(numbers=='') {numbers=1;$('input[name="col"]').val(numbers)}
            $('.bron-itogo').html(' <span class="text">Итого: </span>'+total_(numbers,nomer,days)+' грн')      
                     
           
        })
        $('input[name="col"]').on('keydown',function(ev)
        {
            if(ev.keyCode!=37 && ev.keyCode!=38 && ev.keyCode!=40 && ev.keyCode!=39)
            {
                var numbers = $(this).val().replace(/[^\d]/g, "");
                
                if(numbers>9)
                {
                    $(this).val('10');
                    numbers=9 
                }
                else
                {
                    if(numbers==0)
                    {
                         $(this).val('');
                    }
                    else $(this).val(numbers);
                }
                
            }
        })
        $('input[name="col"]').on('keyup',function(ev)
        {
            if(ev.keyCode!=37 && ev.keyCode!=38 && ev.keyCode!=40 && ev.keyCode!=39)
            {
                var numbers = $(this).val().replace(/[^\d]/g, "");
                
                if(numbers>9)
                {
                    $(this).val('10');
                    numbers=10
                }
                else
                {
                    if(numbers==0)
                    {
                         $(this).val('');
                    }
                    else $(this).val(numbers);
                }
                var nomer=$('.hotel-type-room input:checked').attr('name');
                var days=$('input[name="days"]').val()
                if(days=='') {days=1;$('input[name="days"]').val(days)}
               $('.bron-itogo').html(' <span class="text">Итого: </span>'+total_(numbers,nomer,days)+' грн')
            }
        })
        /*days*/
        $('input[name="days"]').on('keydown',function(ev)
        {
            if(ev.keyCode!=37 && ev.keyCode!=38 && ev.keyCode!=40 && ev.keyCode!=39)
            {
                var numbers = $(this).val().replace(/[^\d]/g, "");
                
                if(numbers>365)
                {
                    $(this).val('365');
                    numbers=365
                }
                else
                {
                    if(numbers==0)
                    {
                         $(this).val('');
                    }
                    else $(this).val(numbers);
                }
                
            }
        })
        $('input[name="days"]').on('keyup',function(ev)
        {
            if(ev.keyCode!=37 && ev.keyCode!=38 && ev.keyCode!=40 && ev.keyCode!=39)
            {
                var numbers = $(this).val().replace(/[^\d]/g, "");
                
                if(numbers>365)
                {
                    $(this).val('365');
                    numbers=365
                }
                else
                {
                    if(numbers==0)
                    {
                         $(this).val('');
                    }
                    else $(this).val(numbers);
                }
              var nomer=$('.hotel-type-room input:checked').attr('name');
              var days=$('input[name="col"]').val()
              if(days=='') {days=1;$('input[name="col"]').val(days)}
              
            
               $('.bron-itogo').html(' <span class="text">Итого: </span>'+total_(days,nomer,numbers)+' грн')
            }
        })
        /*phone*/
        $('input[name="phone"]').on('keydown',function(ev)
        {
            phone(ev,$(this))
        })
        $('input[name="phone"]').on('keyup',function(ev)
        {
            phone(ev,$(this))
        }).on('contextmenu',function()
        {
            return false;
        })
        function phone(ev,th)
        {
            if(ev.keyCode!=37 && ev.keyCode!=38 && ev.keyCode!=40 && ev.keyCode!=39)
            {
                var numbers = th.val().replace(/[^\d]/g, "");
                th.val(numbers)
                if(numbers.length<1) th.val('+')
                if(numbers.indexOf('+')==-1)
                {
                    th.val('+'+numbers)
                }
                 var max='+'+numbers;
                if(max.length>16)
                {
                    th.val(max.substring(0, 17))
                }
            }
        }
        $('form').on('submit',function()
        {
            var loadp = 
            {
                url:'../lib/bron.php',
                beforeSubmit: function(jqForm) 
                {
                    //var o=new Object();o.name='order';o.value=1;jqForm.push(o)
                    $('.bron-sub').attr('disabled',true)
                    $('<div id="alert">Подождите, заявка обрабатывается</div>').dialog({modal:true,resizable:false,draggable:false,width:'250'})
                },
                success: function(responseText) 
                { 
                    if(responseText.indexOf('error')==-1)
                    {
                        $('.oform input:not(input[type="submit"],input[type="radio"]),.oform textarea').val('')
                        $('.oform input[type="radio"]').attr('checked',false)
                        $('.oform input[name="standart"]').attr('checked',true)
                        $('.oform input[name="days"],.oform input[name="col"]').val('1')
                        $(".oform select :nth-child(1)").attr("selected", "selected");
                        $('.oform input[name="phone"]').val('+')
                        var today = new Date();
                        var dd = today.getDate();
                        var mm = today.getMonth()+1; //January is 0!
                        
                        var yyyy = today.getFullYear();
                        if(dd<10){dd='0'+dd} if(mm<10){mm='0'+mm} today = dd+'.'+mm+'.'+yyyy;
                        $('input[name="data"]').val(today);
                        $('.bron-itogo').html(' <span class="text">Итого: </span>800 грн')
                        $('#alert').empty();
                        $('#alert').append('Ваша предварительная бронь принята<br />Мы свяжемся с вами в ближайшее время').dialog({modal:true,resizable:false,draggable:false,width:'250',buttons:[{text:'OK',click:function() { $( this ).remove();} }], close: function( event, ui ) {$( this ).remove();} })
                        $('.bron-sub').attr('disabled',false)
                        
                    }
                    else
                    {
                        //alert(responseText.replace(/<.*?>/g, ''));
                        $('#alert').empty();
                        $('#alert').append(responseText).dialog({modal:true,resizable:false,draggable:false,width:'250',buttons:[{text:'OK',click:function() { $( this ).remove();} }], close: function( event, ui ) {$( this ).remove();} })
                        $('.bron-sub').attr('disabled',false)
                    }
                }
            };
            $(this).ajaxSubmit(loadp); 
            return false
        })
	}
}
)(jQuery);
$(function()
{
	$(document).bron();
})


