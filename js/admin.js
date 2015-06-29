
//------------------------------------------------
// Функция передает параметры скрипту на pfuhepre категорий
//------------------------------------------------
function promtLink(obj, action) {
	
    var link = prompt('Введите url', "http://");

    if (link != null) {

    }
}
//------------------------------------------------
// Функция вставляет псевдотеги
//------------------------------------------------
function replaceSelectedText(obj, action, url)
{
	var obj = document.getElementById(obj);
	var rs, add_count;
	obj.focus();
	if (document.selection) 
	{
		var s = document.selection.createRange(); 
		if (s.text)
		{
			switch (action) {
				case "bold": 
						s.text = "[strong]" + s.text + "[/strong]";
						break;
                                case "cursiv": 
						s.text = "[em]" + s.text + "[/em]";
						break;
					
				case "color": 	
						s.text = "[color]" + s.text + "[/color]";
						break;
				
				case "url": 	
						s.text = "[url=" + url + "]" + s.text + "[/url]";
						break;
			}
			
			return true;
		}
	}
	else
		if (typeof(obj.selectionStart)=="number")
 		{
			if (obj.selectionStart != obj.selectionEnd)
			{
				var start = obj.selectionStart;
				var end = obj.selectionEnd;
				
				switch (action) {
					case "bold": 
							rs = "[strong]" + obj.value.substr(start, end - start) + "[/strong]";
							add_count = 17; 
							break;
                                                        
					case "cursiv": 
							rs = "[em]" + obj.value.substr(start, end - start) + "[/em]";
							add_count = 9; 
							break;
						
					case "color": 	
							rs = "[color]" + obj.value.substr(start, end - start) + "[/color]";
							add_count = 15; 
							break;

					case "url": 	
							rs = "[url=" + url + "]" + obj.value.substr(start, end - start) + "[/url]";
							add_count = 12 + url.length; 
							break;
				}
				obj.value = obj.value.substr(0, start) + rs + obj.value.substr(end);
				obj.setSelectionRange(end + add_count, end + add_count);
			}
			return true;
		}

	return false;
}

$(document).ready(function(){
	$('.showCat, .showSite').on('change',function(){
        var block = $(this).parents('tr');            
        var action = 'edit';        
        var id = block.attr('id').replace(/[^\d.]/g, "");
        var showCat = (block.find('.showCat').attr('checked') == 'checked') ? 1 : 0;
        console.log(showCat + ' '+ id);
        var showSite = (block.find('.showSite').attr('checked') == 'checked') ? 1 : 0;
        console.log(showSite + ' '+ id);
        $.post('/views/admin/ajax/products/QuickSave.php',
            {
            	id:id,
            	showCat:showCat,
            	showSite:showSite
            });
    })



})