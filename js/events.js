// функции и переменные галереи

var pictures,       // переменная, которая будет содержать набор фоток в галерее
    galerySize,     // переменная, в которой будет храниться размер галереи 
    current,        // текущее изображение (его порядок в массиве)
    nextImg,        // следующее изображение
    prevImg,        // предыдущее изображение 
    isAnimated = false;     // флаг - анимируется ли что-то в данный момент    

function getImageList(eventId){
    $.ajax({
        url: "ajax.php",
        type: "post",
        async: false,
        data: {q : "galery", type : "events", eventId : eventId},
        success: function(data){
            eval(data);
        }    
    }); 
}
/**
* загружает два изображения - предыдущее и следущее
*/
function preload(i){
    var next = i+1;
    if (next == galerySize) next = 0;
    
    var prev = i-1;
    if (prev < 0) prev = galerySize-1;
    
    nextImg = pictures[next];
    prevImg = pictures[prev];
    
    var preloadImgNext = new Image();
    preloadImgNext.src = nextImg;
    
    var preloadImgPrev = new Image();
    preloadImgPrev.src = prevImg;
}

/**
* Анимация next
*/
function animateNext(){
    if (!isAnimated){
        isAnimated = true;
        // добавляем фото
        $tempImg = $("<img />",{id : "tempImg", alt: "temp", src: nextImg});
        $tempImg.css({position: "absolute", marginLeft: "-652px"}); 
        $("#photo-wrapper").append($tempImg);
        // движение
        $("#mainImg").animate({marginLeft: 652}, "normal");
        $("#tempImg").animate({marginLeft: 0}, "normal",function(){
            // возвращаем все, как было
            $("#mainImg").attr("src",nextImg).css({marginLeft:0});
            $("#tempImg").remove();
            current++;
            if (current==galerySize) current = 0;
            preload(current);
            isAnimated = false;
        });    
    }
}

/**
* Анимация prev
*/
function animatePrev(){
    if (!isAnimated){
        isAnimated = true;
        // добавляем фото
        $tempImg = $("<img />",{id : "tempImg", alt: "temp", src: prevImg});
        $tempImg.css({position: "absolute", marginLeft: "652px"}); 
        $("#photo-wrapper").append($tempImg);
        // движение
        $("#mainImg").animate({marginLeft: -652}, "normal");
        $("#tempImg").animate({marginLeft: 0}, "normal",function(){
            // возвращаем все, как было
            $("#mainImg").remove();
            $("#tempImg").attr("id","mainImg");
            current--;
            if (current<0) current = galerySize-1;
            preload(current);
            isAnimated = false;
            return false;
        });   
    }
}
//-----------------------------------------
$(function(){
    $(".photoButton").bind("click",function(){
        var $map = $("<div />",{id: "for-galery"}).appendTo("#main");   
        var eventId = $(this).attr("rel");
        current = 0;
        getImageList(eventId);
        // координаты экрана
        var top = $(window).height()/2 - 240;
        var left = $(window).width()/2 - 350;
        // загружаем форму для отображения
        $.post("scripts/_window.php",function(data){
            var galery = $("#for-galery");
            galerySize = pictures.length;
            galery.html(data).find(".photo-block").css({top: top, left: left});;
            galery.find("#photo-wrapper").width(654);
            var src = pictures[current];
            var $mainImg = $("<img />",{id : "mainImg",src : src, alt : "galery"});
            $("#photo-wrapper").append($mainImg);
            preload(current);
        });      
        return false;
    });
    
    /**
    * Обработчики событий нажатия
    */
    $(".close").live("click",function(e){
        e.preventDefault();
        $("#for-galery").hide().remove();
    });
    
    $(".next").live("click",function(e){
        animateNext();
        return false; 
    });
    
    $(".prev").live("click",function(e){
        animatePrev();
        return false; 
    });
    
    $(document).keyup(function(e){
        if (e.keyCode==27) $(".close").trigger("click");
        if (e.keyCode==39) $(".next").trigger("click");
        if (e.keyCode==37) $(".prev").trigger("click");
    });
    
    
    $(".event .picture img").each(function(i){
       var width = $(this).width() / 2;
       var height = $(this).height() / 2;

       $(this).css({marginTop: -height, marginLeft: -width}); 
    });                     
    
    
    /**
    * Прокрутка к выбранному пункту
    */
    j = $.cookie("event_id");
    $.cookie("event_id",null);
    if (j!=null) {
        if ($.browser.safari) var scrollObj = $("body");
        else scrollObj=$("html");
        scrollObj.animate({scrollTop: $("#e-"+j).offset().top},1000);    
    }    
});

$(document).ready(function(){
        var down=0;
       // $('.e-title a').hover(function(){$(this).css('border-bottom','none');},function(){$(this).css('border-bottom','dashed #1a80c1 1px');})
        $('.e-title a').live('click',function(){
            id=$(this).attr('id').split('_')[1];
            if ($(this).is('.open'))
            {
                $('#t_'+id+' a').toggleClass('e-title-a').toggleClass('open');
                //$('#t_'+id+' a:hover').css('border-bottom','none');
                $('#h_'+id).fadeOut("fast",function(){
                    down=0;
                    $('#s_'+id).fadeIn("normal");
                })
            }
            else
            {
               $('#t_'+id+' a').toggleClass('e-title-a').toggleClass('open');
                $('#s_'+id).fadeOut("fast",function(){
                    down=1;
                    $('#h_'+id).fadeIn("normal");
                })  
            }
            
        })
    })