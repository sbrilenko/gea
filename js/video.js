/*function changeVideoQuality(){
    if (!($(this).hasClass('hd-360-selected') || $(this).hasClass('hd-480-selected'))){
        quality = ($(this).hasClass('hd-360-select')) ? 360 : 480;
        qualitySiblings = (quality == 360) ? 480 : 360;
        $('.video').hide();
        $('.hd-'+quality).show();
        $(this).siblings().removeClass().addClass('hd-'+qualitySiblings+'-select');
        $(this).removeClass().addClass('hd-'+quality+'-select').addClass('hd-'+quality+'-selected');
    }
}

 
function correctFlash(){
    $('object').attr('classid','clsid:d27cdb6e-ae6d-11cf-96b8-444553540000')
               .attr('codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10,0,0,0');
}

$(function(){
   if ($.browser.ie) {
       correctFlash();
   }
   $(".hd-360-select, .hd-480-select").bind("click",changeVideoQuality);
});*/
     
$(document).ready(function(){

    $('.e-title').live('click',function(){
    if ($(this).find('a').is('.open'))
        {
            $(this).prev('.look-video').text('Смотреть');
            $(this).children().toggleClass('e-title-a').toggleClass('open');
            $(this).next('.hidden').slideUp("fast",function(){})
        }
        else
        {
            $(this).prev('.look-video').text('Свернуть');
            $(this).children().toggleClass('e-title-a').toggleClass('open');
            $(this).next('.hidden').slideDown("fast");  
        }   
    })
    $('.look-video').live('click',function(){
        $(this).next().find('a').trigger('click');
    })

    $('.show-more').live('click',function(){
        var i = $(this).attr('id');
        $.post('/ajax/getMoreVideo.php',{i:i},function(result){
            $('.show-more').after(result).remove()
        })
    })
    
    //$('.e-title').hover(function(){$(this).find('a').css('border-bottom-color','#FFF');$(this).prev('.look-video').css('background','#EBEBEB')},function(){$(this).find('a').css('border-bottom-color','#1A80C1');$(this).prev('.look-video').css('background','')})
    //$('.look-video').hover(function(){$(this).next().find('a').css('border-bottom-color','#FFF');},function(){$(this).next().find('a').css('border-bottom-color','#1A80C1');})
})
     