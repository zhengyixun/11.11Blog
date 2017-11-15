$(function(){
    $("table").delegate(".pname","dblclick",function(){
        var that=$(this);
        var oldv=$(this).html();
        $(this).html("");
        var input=$("<input type='text'>").appendTo(this).val(oldv).focus();

        input.blur(function(){
            var newv=$(this).val();
            if(newv!=oldv){
                var pid=that.attr("pid");
                $.ajax({
                    url:"index.php?m=admin&f=cate&a=edit",
                    data:{pname:newv,pid:pid},
                    type:"post",
                    success:function(e){
                        if(e=="ok"){
                            alert("修改成功");
                        }else if(e=="err"){
                            alert("修改失败");
                        }
                    }
                })
            }
            input.remove();
            that.html(newv);
        })
    })
})