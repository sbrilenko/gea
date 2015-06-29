var css;

function loadCss()
{
    var size=$(window).width();
    if (size<='1100') { css='1000';}
    if ((size>'1100')&&(size<='1285')) {css='1240';}
    if ((size>'1285')&&(size<='1371')) {css='1320';}
    if (size>'1371') {css='1400';}
    $('#fsize').attr('href', 'css/styles_'+css+'.css');    
}
loadCss();
var move='';
var xXx=0;    
var minExt=1024;
var maxExt=1440;
var Ext=$(window).width();
//          w   h    mt  ml
var No_1=[ 141, 94,  36, 6   ];
var No_2=[ 165, 110, 28, 114 ];
var No_3=[ 190, 126, 20, 223 ];
var No_4=[ 165, 110, 28, 357 ];
var No_5=[ 141, 94,  36, 489 ];
var No_D=100;
var arrMT=70;

function p(val)
{
    return Math.round((Ext*(val))/minExt);
    //return ((val/100)*10);
}

function resizer()
{
    loadCss();
        
    Ext=$(window).width();
    if (Ext<minExt) Ext=minExt;
    if (Ext>maxExt) Ext=maxExt;
    
    /*  
    var plus1=0;var plus2=0;var plus3=0;var plus4=0;var plus5=0;
    if (Ext>1100){}
    if (Ext>1200){plus=20;}
    if (Ext>1300){plus=30;}
    if (Ext>1400)
    {
        No_1[3] += 0; // 6   ]; 
        No_2[3] += 10; // 114 ]; 0.009644444444444
        No_3[3] += 15; // 223 ]; 0.010416666666666
        No_4[3] += 20; // 357 ]; 0.138888888888888
        No_5[3] += 30; // 489 ]; 0.020833333333333
    }
    else 
    {
        No_1[3] = 6; // 6   ];
        No_2[3] = 114; // 114 ];
        No_3[3] = 223; // 223 ];
        No_4[3] = 257; // 357 ];
        No_5[3] = 489; // 489 ];
    }
    */

    $('#main').width(Ext-310);

    
    $('.album').css({width:p(No_1[0]),height:p(No_1[1]),marginTop:p(No_1[2]),marginLeft:p(No_1[3])});
    $('.album img').css({width:p(No_1[0]),height:p(No_1[1])});
            
    $('.No-1').css({width:p(No_1[0]),height:p(No_1[1]),marginTop:p(No_1[2]),marginLeft:p(No_1[3])});
    $('.No-1 img').css({width:p(No_1[0]),height:p(No_1[1])});
    $('.No-1 .titleAlbom,.No-2 .titleAlbom,.No-4 .titleAlbom,.No-5 .titleAlbom').css({width:p(No_D)});
            
    $('.No-2').css({width:p(No_2[0]),height:p(No_2[1]),marginTop:p(No_2[2]),marginLeft:p(No_2[3])});
    $('.No-2 img').css({width:p(No_2[0]),height:p(No_2[1])});
            
    $('.No-3').css({width:p(No_3[0]),height:p(No_3[1]),marginTop:p(No_3[2]),marginLeft:p(No_3[3])});
    $('.No-3 img').css({width:p(No_3[0]),height:p(No_3[1])});
            
    $('.No-4').css({width:p(No_4[0]),height:p(No_4[1]),marginTop:p(No_4[2]),marginLeft:p(No_4[3])});
    $('.No-4 img').css({width:p(No_4[0]),height:p(No_4[1])});
            
    $('.No-5').css({width:p(No_5[0]),height:p(No_5[1]),marginTop:p(No_5[2]),marginLeft:p(No_5[3])});
    $('.No-5 img').css({width:p(No_5[0]),height:p(No_5[1])});
            
    $('.galery-new-btn-left,.galery-new-btn-right').css({marginTop:p(arrMT)});
    $('.galery-new').css({width:p(700),height:p(220)});
    $('.galery-new-main').css({width:p(636),height:p(220)});
    $('.galery-new-prewiew').css({width:($(window).width()-300)});
    $('.No-3 .titleAlbom').css('width','');
    
    $('.close_photos_gal').trigger('click');
}
    
function moveLeft()
{
    $(':animated').stop(true,true);//if ($('.album:animated').size()) return false;
    var animateSpeed=500;
    var albumNumber=$('.album').size();
    if (albumNumber==5)$('.galery-new-main').append('<div class="album No-6">'+$('.No-1').html()+'</div>');
    
    $('.No-6').css({marginLeft:383});
    $('.No-1').css({zIndex:1});
    $('.No-2').css({zIndex:2});
    $('.No-3').css({zIndex:3});
    $('.No-4').css({zIndex:4});
    $('.No-5').css({zIndex:2});
        
    $('.No-6').removeClass('hide').animate({marginLeft:p(No_5[3])},animateSpeed,function(){
        $(this).removeClass('No-6');
        $(this).addClass('No-5');
    }); 
                
    $('.No-5').animate({width:p(No_4[0]),height:p(No_4[1]),marginLeft:p(No_4[3]),marginTop:p(No_4[2])},animateSpeed,function(){
        $(this).removeClass('No-5');
        $(this).addClass('No-4');
    });
    $('.No-5 img').animate({width:p(No_4[0]),height:p(No_4[1]),opacity:0.95},animateSpeed);

    $('.No-4').animate({width:p(No_3[0]),height:p(No_3[1]),marginTop:p(No_3[2]),marginLeft:p(No_3[3])},animateSpeed,function(){
        $(this).removeClass('No-4');
        $(this).addClass('No-3');
        if (!xXx)
        {
            folder=$(this).attr('id').split('p')[1];
            getAllImg(folder);
            $('.titleAlbom').fadeIn(200);
            $('.titleAlbom').css('color','');
            location.hash = 'folder'+folder;
        }
        else
        {
            xXx=0;
            $('.titleAlbom').css('color','white');
        }
    });
    $('.No-4 img').animate({width:p(No_3[0]),height:p(No_3[1]),opacity:1},animateSpeed);
        
    $('.No-3').animate({width:p(No_2[0]),height:p(No_2[1]),marginTop:p(No_2[2]),marginLeft:p(No_2[3])},animateSpeed,function(){
        $(this).removeClass('No-3');
        $(this).addClass('No-2');
    });
    $('.No-3 img').animate({width:p(No_2[0]),height:p(No_2[1]),opacity:0.95},animateSpeed);
        
    $('.No-2').animate({width:p(No_1[0]),height:p(No_1[1]),marginTop:p(No_1[2]),marginLeft:p(No_1[3])},animateSpeed,function(){
        $(this).removeClass('No-2');
        $(this).addClass('No-1');
    });
    $('.No-2 img').animate({width:p(No_1[0]),height:p(No_1[1]),opacity:0.8},animateSpeed);  
        
    $('.No-1').animate({width:p(No_5[0]),height:p(No_5[1]),marginTop:p(No_5[2]),marginLeft:p(No_2[3])},animateSpeed,function(){
        $(this).removeClass('No-1');
        $(this).addClass('No-6 hide').css({marginLeft:370});
        for (i=6;i<=albumNumber;i++) $('.No-'+i).attr('class','album No-'+(i-1)+' hide'); 
        
        $('.No-5').each(function(){
            if($(this).hasClass('hide'))
                $(this).attr('class','album No-'+albumNumber+' hide')
        })    
    });    
    $('.No-4 .titleAlbom').css('width','');
}

function moveRight()
{
    $(':animated').stop(true,true);//if ($('.album:animated').size()) return false;
    var animateSpeed=500;
    var albumNumber=$('.album').size();
    if (albumNumber==5) $('.galery-new-main').append('<div class="album No-6">'+$('.No-5').html()+'</div>');
    
    $('.No-'+albumNumber).css({marginLeft:114});
    $('.No-1').css({zIndex:3});
    $('.No-2').css({zIndex:4});
    $('.No-3').css({zIndex:3});
    $('.No-4').css({zIndex:2});
    $('.No-5').css({zIndex:1});
        
    $('.No-'+albumNumber).removeClass('hide').animate({marginLeft:6},animateSpeed,function(){
        $(this).removeClass('No-'+albumNumber);
        $(this).addClass('No-1');
    });
           
    $('.No-1').animate({width:p(No_2[0]),height:p(No_2[1]),marginTop:p(No_2[2]),marginLeft:p(No_2[3])},animateSpeed,function(){
        $(this).removeClass('No-1');
        $(this).addClass('No-2');
    });
    $('.No-1 img').animate({width:p(No_2[0]),height:p(No_2[1]),opacity:0.95},animateSpeed);
        
    $('.No-2').animate({width:p(No_3[0]),height:p(No_3[1]),marginTop:p(No_3[2]),marginLeft:p(No_3[3])},animateSpeed,function(){
        $(this).removeClass('No-2');
        $(this).addClass('No-3');
        if (!xXx)
        {
            folder=$(this).attr('id').split('p')[1];
            getAllImg(folder);
            $('.titleAlbom').fadeIn(200);
            $('.titleAlbom').css('color','');
            location.hash = 'folder'+folder;
        }
        else
        {
            xXx=0;
            $('.titleAlbom').css('color','white');
        }
    });
    $('.No-2 img').animate({width:p(No_3[0]),height:p(No_3[1]),opacity:1},animateSpeed);
          
    $('.No-3').animate({width:p(No_4[0]),height:p(No_4[1]),marginTop:p(No_4[2]),marginLeft:p(No_4[3])},animateSpeed,function(){
        $(this).removeClass('No-3');
        $(this).addClass('No-4');
    });
    $('.No-3 img').animate({width:p(No_4[0]),height:p(No_4[1]),opacity:0.95},animateSpeed);
         
    $('.No-4').animate({width:p(No_5[0]),height:p(No_5[1]),marginTop:p(No_5[2]),marginLeft:p(No_5[3])},animateSpeed,function(){
        $(this).removeClass('No-4');
        $(this).addClass('No-5');
    });
    $('.No-4 img').animate({width:p(No_5[0]),height:p(No_5[1]),opacity:0.8},animateSpeed);  
        
    $('.No-5').animate({width:p(No_1[0]),height:p(No_1[1]),marginTop:p(No_1[2]),marginLeft:p(383)},animateSpeed,function(){
        $(this).removeClass('No-5');
        $(this).addClass('No-'+albumNumber+' hide').css({marginLeft:114});
        for (i=albumNumber;i>=6;i--) $('.No-'+i).attr('class','album No-'+(i+1)+' hide');
          
        $('.No-'+(albumNumber+1)).each(function(){
            if($(this).hasClass('hide'))
                $(this).attr('class','album No-6 hide')
        })
    });       
    $('.No-2 .titleAlbom').css('width','');
}


function getAllImg(folder)
{
    var xhr;
    $('.galery-new-prewiew').html('');
    /*$.post('/ajax/getAllImg.php',{folder:folder,css:css},function(data){
        $('.galery-new-prewiew').html(data);
        $('.galery-new-prewiew img').map(function(){
            $(this).load(function(){$(this).css('opacity','0.7').fadeIn()});
        })
    });
*/
    if (xhr) xhr.abort();
    xhr = $.ajax({
    type: "POST",
    url: "/ajax/getAllImg.php",
    data: {folder:folder,css:css},
    success: function(data){
       $('.galery-new-prewiew').html(data);
        $('.galery-new-prewiew img').map(function(){
            $(this).load(function(){

                var w = $(this).width();
                var h = $(this).height();
                $(this).parent().css({height:h})
                $(this).parent().css('max-height',h+'px')
                $(this).parent().css('opacity','0.7')
                
                
                //$(this).fadeIn()
            });
        })
         
     
    }
});
 

 $(document).ajaxStop(function(){

    $("img.lazy").lazyload({ 
        effect: "fadeIn" 
    }).removeClass("lazy");
});
// Убить запрос


    FOLDER=folder;
}
resizer();
function selectSelected(dir)
{ 
    folder = $('.No-3').attr('id').replace(/[^0-9]/g,''); 
    if (((dir - folder)) == -2) {xXx=1;moveRight();setTimeout('moveRight()',600)}
    else
    if (((dir - folder)) == -1) {moveRight();}
    else
     
    if (dir != folder)
    {
        moveLeft();
        function tmp()
        {
            selectSelected(dir);
        }
        setTimeout(tmp,700);
    }
}
$(document).ready(function() {
    

    if ($.browser.msie) $('.No-2,.No-3,.No-4,.galery-new-prewiew-hover').each(function() {PIE.attach(this);}); 
    
    $(window).resize(function(){
        resizer();
        var isiPad = navigator.userAgent.match(/iPad/i) != null;
        if (!isiPad) getAllImg(folder);
    })
    resizer();
    var folder; 
    if (location.hash)
    {
        var folder = location.hash.replace(/[^0-9]/g,'');
        selectSelected(folder)
    }
    //else 
    {
        folder = $('.No-3').attr('id').replace(/[^0-9]/g,''); 
        if (location.hash && location.hash.replace(/[^0-9]/g,'') == folder)
            getAllImg(folder);
        else 
            getAllImg(folder);
    }
    

    
    
    $('.No-2 img,.No-4 img').css('opacity','0.95');
    $('.No-1 img,.No-5 img').css('opacity','0.8');
    
    $('.No-2,.No-4').live('mouseover',function(){$(this).find('img').css('opacity','1');$(this).find('.titleAlbom').addClass('titleAlbomSel');})
    $('.No-2,.No-4').live('mouseout',function(){$(this).find('img').css('opacity','0.95');$(this).find('.titleAlbom').removeClass('titleAlbomSel');})
    $('.No-1,.No-5').live('mouseover',function(){$(this).find('img').css('opacity','1');$(this).find('.titleAlbom').addClass('titleAlbomSel');})
    $('.No-1,.No-5').live('mouseout',function(){$(this).find('img').css('opacity','0.8');$(this).find('.titleAlbom').removeClass('titleAlbomSel');})
    
    $('.galery-new-btn-right').hover(function(){$(this).css('background-position','-68px 0px');},function(){$(this).css('background-position','-68px -68px');})
    $('.galery-new-btn-left').hover(function(){$(this).css('background-position','0px -68px');},function(){$(this).css('background-position','0px 0px');})

    $('.galery-new-btn-right').live('click',moveRight);
    $('.galery-new-btn-left').live('click',moveLeft);
    
    $('.No-2').live('click',moveRight);
    $('.No-4').live('click',moveLeft);
    $('.No-1').live('click',function(){xXx=1;moveRight();setTimeout('moveRight()',600)});
    $('.No-5').live('click',function(){xXx=1;moveLeft();setTimeout('moveLeft()',600)});
    

    $('.galery-new-prewiew div').live('mouseover',function(){
        $(':animated').stop(true,true)
        $(this).addClass('galery-new-prewiew-hover').animate({opacity:1},200);
        var img = $(this).children();
        //img.css('height','')
        var wW = Math.round(img.width());
        var hW = Math.round(img.height());
        //hWas = h;
        if (wW < hW) 
        {
            img.animate({width:wW + 40,height:(((wW + 40) / wW) * hW),marginLeft:-20,marginTop:-18},500);
        }
        else
        {
            img.animate({width:wW + 50,height:(((wW + 50) / wW) * hW),marginLeft:-25,marginTop:-6},500);
        }
    })

    $('.galery-new-prewiew div').live('mouseout',function(){
        $(':animated').stop(true,true);
        $(this).removeClass('galery-new-prewiew-hover').animate({opacity:0.7},200);
        var img = $(this).children();
        var wW = Math.round(img.width());
        var hW = Math.round(img.height());

        if (wW < hW) 
        {
            img.animate({width:wW - 40,height:(((wW - 40) / wW) * hW),marginLeft:0,marginTop:0},500);
        }
        else
        {
            img.animate({width:wW - 50,height:(((wW - 50) / wW) * hW),marginLeft:0,marginTop:0},500);
        }
    })
    
    $('.galery-new-prewiew div img').live('click',function(){WHATFOTOOPEN = parseInt($(this).attr('data-id')); Viewer2.open(); })

    //if (location.hash)
    //{
    //    var hash = location.hash.replace(/[^0-9]/g,'');
     //   $('#p'+hash).trigger('click')
        //alert (hash)
    //}
});