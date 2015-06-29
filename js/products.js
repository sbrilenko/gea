$(function(){
    $('.productCaption:gt(0)').addClass('productCaptionCatalogue');
    
    $('.expand').bind('click',function(){
    	$div = $('.textSection');
    	if ($div.is(':visible')){
    		$div.hide();
    		$('span',$(this)).text('Подробное описание');
    	} else {
    		$div.show();
    		$('span',$(this)).text('Скрыть');
    	}
    	return false;
    });
    
});
