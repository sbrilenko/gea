$(function(){   
    $("#main").css({marginLeft : -50});
    $(".send").bind("click",function(){
        var captch = $.trim($("#captch").val());
        var name = $.trim($("[name=fio]").val());
        var email = $.trim($("[name=email]").val());
        var phone = $.trim($("[name=phone]").val());
        var theme = $.trim($("[name=theme]").val());
        var message = $.trim($("[name=question]").val());
        
        if (name=="" || email=="" || phone=="" || theme=="" || message==""){
            alert("Заполните все поля формы, пожалуйста!");
        } else {
            if (captch!=getCaptch()){
                alert("Символы с картинки введены неверно!")
            } else {
                $("form").submit();
            }
        }
        return false; 
    });  

    $(".send-back").bind("click",function(){
        var name = $.trim($("[name=fio]").val());
        var email = $.trim($("[name=email]").val());
        var message = $.trim($("[name=question]").val());
        
        if (name=="" || email=="" || message==""){
            alert("Заполните все поля формы, пожалуйста!");
        } else {
                            $("form").submit();
                            alert('Ваше сообщение отправлено');
            }

        return false; 
    });	
});