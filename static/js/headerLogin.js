$(function(){
    $('#reg1').mouseenter(function(){
        $('.lists').css('display','block');
        $('#Img').css('background','#eee');
        $('.angel').css({ 'borderBottom':'5px solid #eee', 'borderLeft':'5px solid #eee', 'borderRight':'5px solid #eee' })
    }).mouseleave(function(){
        $('.lists').css('display','none');
        $('#Img').css('background','#fff');
        $('.angel').css({ 'borderBottom':'5px solid #fff', 'borderLeft':'5px solid #fff', 'borderRight':'5px solid #fff' })
    })
});