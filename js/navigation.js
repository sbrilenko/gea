$(document).ready(function(){
    var q = 0;
    $(document).on('touchstart',function(){
        console.log('касание')
    })
    $(document).on('touchend',function(){
        console.log('кончилось')
    })
})