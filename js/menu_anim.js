
$( document ).ready(function() {

    $(".menu li a").click(function () {

        $.post('views/menu_bot.php', {id : $(this).attr('id')}, function(data){$('.menu_tovar').html(data)})
        $('.f_center_content_now').html($(this).find('.text').html())

       

        $('.menu').addClass("display_none")
        $('.f_right_hide').addClass("display_none")
        $('.f_center_content_now').removeClass("display_none")
        $('.menu_tovar').removeClass("display_none")
        $('.f_right_hide2').removeClass("display_none")


        setTimeout(function() {
/*
            height_menu=$('.menu_tovar').height()+76
            $('#bottom_hiden').css({height:height_menu})
            $('#bottom-f').css({height:height_menu})*/


        }, 1000)



    /*    height_menu=$('.menu_tovar').height()+76
        $('#bottom_hiden').css({height:height_menu})
        $('#bottom-f').css({height:height_menu})*/
    });

    $("#click-prew").click(function () {
        $('#bottom-f').addClass('active');
        $('.menu_tovar').addClass("display_none")
        $('.f_right_hide').removeClass("display_none")
        $.post('views/menu_bot.php', {id : $(this).attr('id')}, function(data){$('.menu_tovar').html(data)})
        $('.f_center_content_now').html($(this).find('.text').html())
        $('.menu').removeClass("display_none")
        $('.f_center_content_now').addClass("display_none")
        $('.f_right_hide2').addClass("display_none")
        height_menu=$('.menu').height()+76
        $('#bottom_hiden').css({height:height_menu})
        $('#bottom-f').css({height:height_menu})

    });


    $(function()
    {
        $('.menu li a').click(function()
        {

            return false;
        })
    })




    var test = $('.menu li');
    var flag=0;
    var th_hover;
    var touchtrue=true;
    function getVar(th)
    {
        var ret,w=th.width(),h=th.height(),w_percent=w*120/100,h_percent=h*120/100;
        ret={
            'w':w,
            'h':h,
            'h_percent':h_percent,
            'w_percent':w_percent,

            'left':(-1)*((w_percent-w)/2),
            'top':-11

        }
        return ret;
    }


    test.hover(
     /*   function() {

            var vari=getVar($(this));

            console.log( $('.menu li a').css('font-size'))
            $(this).children().css({zIndex:'10',border:"1px solid #ddd"});
            $(this).children().stop().animate({fontSize:16,top:vari.top,left:vari.left,width:vari.w_percent,height:vari.h_percent},300);
            $('.menu li').children(".imgage .imag").css({height:114,width:103});

        },
        function() {
            $(this).children().stop();
            $(this).children().removeAttr('style');



        }*/
    );

    /*

     $('.menu li a .hover').hover(function(){



     var vari=getVar($(this));
     if(touchtrue)
     {
     $(this).stop()
     $(this).css({zIndex:'10',left:"0",top:"0",border:"1px solid #ddd"});
     $(this).stop().animate({top:vari.top,left:vari.left,width:vari.w_percent,height:vari.h_percent},300);
     touchtrue=false;
     }
     else
     {

     }

     },






     function()
     {             $(this).removeAttr('style');})*/});


