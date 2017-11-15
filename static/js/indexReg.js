$(function(){
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
    $.validator.addMethod("phone",function(value, element){
        var test=/^(135|178|184|155|186|157|123)\d{8}$/;
        return test.test(value)||this.optional(element);
    });
    $('form').validate({
        rules:{
            uname: {
                required: true,
                minlength: 2,
                remote:{
                    url:"index.php?m=index&f=indexLogin&a=nameCheck",
                    type:"post"
                }
            },
            upass: {
                required: true,
                minlength: 6
            },
            phone:{
                required: true,
                phone:true,
            }
        },
        messages:{
            uname: {
                required: '请输入用户名',
                minlength: '长度不得小于2位',
                remote:"用户名已存在"
            },
            upass: {
                required: '请输入密码',
                minlength: '长度不得小于6位'
            },
            phone:{
                required: "请输入手机号",
                phone:"请输入正确的手机号",
            }
        }
    })
})