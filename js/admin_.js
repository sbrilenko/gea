$(function(){
    //******************************** Группы и подгруппы
    $('.showing').click(function(){
        $(this).next('div').toggleClass('hidden')
    })
    
    //******************************** Товыры
    //список подгрупп
    $('#idGroup').click(function(){
        $('#idSubgroup').attr('disabled','disabled');
        var idGroup = $(this).val();
        $.post('/views/admin/ajax/products/getSelectSubgroup.php',{idGroup:idGroup},function(result){
            if (result) $('#forSelectSubgroup').html(result);
        })
    })
    
    //проверка на наличие новых товаров
    setInterval(check,(1000*60*5))
    //check()
    
    function check()
    {
        $.post('/views/admin/ajax/order/check.php',{action:'check'},function(result){
            if (result)
            {
                //beep();
                if ($('#orderPage').val())
                {
                    $.post('/views/admin/ajax/order/orders.php',{action:'update'},function(result){
                        $('#fieldOrder').html(result)
                    })    
                }
            }
        })
    }
})
//функция воспроизводит звуковой сигнал
function beep() 
{
    $('.beep').remove();
    $('body').prepend("<embed class='beep' src='/mp3/beep.mp3' hidden=true autostart=true loop=false>");
}