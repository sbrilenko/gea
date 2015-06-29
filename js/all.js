function resizer(){
    $("#main").css("width",($('#header').width()-290)+"px");
    if ($("#header").width() < 1340){
        //$("#main").css("left","25%");
        $('.bolshoy-plus2').hide();
        $('.remove_for_two').hide();
        $('.add_for_two').show();
        
    } else {
        //$("#main").css("left","27%");
        $('.bolshoy-plus2').show();
        $('.remove_for_two').show();
        $('.add_for_two').hide();
    }
    if ($('#header').width() > 1000){$('body').css('overflow-x','hidden')} else {$('body').css('overflow','auto')}
    //alert(location.href)
   //if (location.href.indexOf('events')>0) $("#main").css("width",($('#header').width()-600)+"px");
}    

function getCaptch(){
    var captch;
    $.ajax({
        type: "POST",
        url: "ajax.php",
        async: false,
        data: {q : "captch"},
        success: function (data){
            captch = data;
        }
    });
    return captch;
}

/*
 * Скрываем кнопку НАЗАД К ТОВАРУ
 */
function hideBack(){
	$(".cert-back").remove();
}

$(function(){
    resizer();
    
    $(window).resize(function(){    // отодвигает главную часть от меню
        resizer();
    });
    $('.redBlockOuter').each(function(){
        $(this).find('object').parent().parent().css('text-align','center');    
        $(this).find('iframe').parent().parent().css('text-align','center');   
    })   
    $('.cert-container:even').css('margin-right','30px');
    $(".price").corner("8px");    
    $(".redBlockOuter").corner("25px");
    $(".leftSide, .rightSide").corner("10px");
    $("#mainEventsBlock .more").corner("4px");
    $("#mainEventsBlock .mainEvent").corner("8px");
    $(".event .more").corner("6px");
     $(".more,.docs,.cert-more,.send-back,.cert-back,.photoButton").corner("6px");
  
    /**
    * Главное меню - ссылки и подмена фона    
    */
    $(".main a").hover(function(){
        var num = $(".main a").index($(this));
        var position = -473*num;
        $(".hover").css({backgroundPosition: "left "+position+"px"}).show();
    },function(){
        $(".hover").hide();
    });
    
    /*
     * Нажатие на кнопку НАЗАД К ТОВАРУ в сертификатах
     */
     $(".cert-back").bind("click",function(){
     	history.back();
     	return false;
     });
});