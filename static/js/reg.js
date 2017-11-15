$(function(){
    $('form').validate({
        rules:{
            aname: {
                required: true,
                minlength: 2
            },
            apass: {
                required: true,
                minlength: 6
            },
        },
        messages:{
            aname: {
                required: '请输入用户名',
                minlength: '长度不得小于2位'
            },
            apass: {
                required: '请输入密码',
                minlength: '长度不得小于6位'
            },
        },
    })
    $('.click').click(function () {
        var num=60;
        var t=setInterval(function(){
            num--;
            var text=`重新发送（${num})`;
            $('.click').text(text);
        },1000);
        if(num>0){
            $('.click').attr("disabled", true).css('color','#ccc');
        }
    })
})