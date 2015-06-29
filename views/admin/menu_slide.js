$( document ).ready(function() {
    $('#bottom-f').addClass('no_active')
    
    $(document).on('click touchstart','#bottom-f #click-catalog','#bottom-f #2click-catalog',function()
    {
        if($('#bottom-f:animated').length) { $('.menu li').unbind; return false;}
        else
        {
            if($('#bottom-f').hasClass('active_kat'))
            {
                $("#bottom_hiden").animate({height:38}, 1000, function() {$('#bottom-f').removeClass('active_kat');$('#bottom-f').addClass('no_active')});



            }
            else
            {
                /* var size=('innerWidth' in window) ? window.innerWidth : document.body.offsetWidth;
                 var h=117;
                 if(size<1200) {h=117;}
                 else
                 if (size>=1201 && size<1599) {h=130;}
                 else
                 if (size>=1600) {h=150;}*/
                console.log('click')
                var h=117;
                    console.log($('.menu').height())
                    height_menu=$('.menu').height()+76
                    console.log(height_menu)
                    $('#bottom-f').css({height:height_menu})
                $("#bottom_hiden").animate({height:height_menu}, 1000, function() {$('#bottom-f').addClass('active_kat');$('#bottom-f').removeClass('no_active') });


            }
        }

    })

    $(window).bind('resize',function(){

    console.log($('.menu').height())
    height_menu=$('.menu').height()+76
    console.log(height_menu)

        if($('#bottom-f').hasClass('no_active'))
        {

        }
        else
        {

            if($('#bottom-f').hasClass('active_kat'))
            {
               
                $('#bottom_hiden').css({height:height_menu})
                $('#bottom-f').css({height:height_menu})
            }
            else
            {
                height_menu=$('.menu_tovar').height()+76
                $('#bottom_hiden').css({height:height_menu})
                $('#bottom-f').css({height:height_menu})
            }
        }

    })

    $(".menu li a").click(function () {
       /* height_menu=$('.menu_tovar').height()+76
        if($('#bottom-f').hasClass('active'))
        {
            $('#bottom_hiden').css({height:height_menu})
            $('#bottom-f').css({height:height_menu})
        }
        else
        {

        }*/
    });
    $(window).bind('resize',function(){

      /*  height_menu=$('.menu_tovar').height()+76
        if($('#bottom-f').hasClass('active'))
        {
            $('#bottom_hiden').css({height:height_menu})
            $('#bottom-f').css({height:height_menu})
        }
        else
        {

        }*/
    })

    /* var doit;
     $(window).bind('resize',function(){
     clearTimeout(doit);
     doit = setTimeout(function(){
     if($('#bottom-f:animated').length) { return false;}
     else
     {
     if($('.koord-ul ul').is(':visible') && $('#bottom-f').hasClass('active'))
     {
     var size=('innerWidth' in window) ? window.innerWidth : document.body.offsetWidth;
     var h=117;
     if(size<1200) {h=117;}
     else
     if (size>=1201 && size<1599) {h=130;}
     else
     if (size>=1600) {h=150;}
     $("#bottom-f").css({top:(-1)*h});
     $(".koord-ul ul").css({height:h});
     $('.white-koord-back').css({height:h});

     }
     }


     } , 100)
     })*/

});