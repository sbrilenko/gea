$( document ).ready(function() {
    w_width=$(window).width()
    console.log(w_width)
    if (w_width<1220)
    {
        $('.menu li').css({width: (w_width/4)-1  })
    }
    if (w_width>=1220)
    {
        $('.menu li').css({width: ((w_width)/5)-1  })
    }
    if (w_width>=1460)
    {
        $('.menu li').css({width: (w_width/6)-1    })
    }
    if (w_width>=1700)
    {
        $('.menu li').css({width: (w_width/7)-1    })
    }
    if (w_width>=1920)
    {
        $('.menu li').css({width: (w_width/8)-1   })
    }
    if (w_width>=2180)
    {
        $('.menu li').css({width: (w_width/9)-1    })
    }

    $(window).bind('resize',function(){

       w_width=$(window).width()
        console.log(w_width)
        if (w_width<1220)
        {
            $('.menu li').css({width: (w_width/4)-1   })
        }
        if (w_width>=1220)
        {
            $('.menu li').css({width: (w_width/5)-1    })
        }
        if (w_width>=1460)
        {
            $('.menu li').css({width: (w_width/6)-1    })
        }
        if (w_width>=1700)
        {
            $('.menu li').css({width: (w_width/7)-1   })
        }
        if (w_width>=1920)
        {
            $('.menu li').css({width: (w_width/8)-1    })
        }
        if (w_width>=2180)
        {
            $('.menu li').css({width: (w_width/9)-1    })
        }


    });



});