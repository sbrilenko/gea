function nyDisco(){
    var height = 675;
    var position = 0;
    
    $(".animation").everyTime(300,function(){
        position -= height;
        if (position<-3*height) position = 0;
        $(this).css({"background-position" : "0 "+position+"px"});
    });
}

$(function(){
    $(".more").bind("click",function(){
    	if (!$(this).hasClass("default")){
    		var event_id = $(this).attr("href");
	        $.cookie("event_id",event_id);
	        window.location.href="/events";	
	        return false;
    	}
    });
    
    //nyDisco();
    //$(".animation").hide();
});