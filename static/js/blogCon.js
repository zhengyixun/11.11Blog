$(function(){
    var cid=$("main").attr("cid");
    $.ajax({
        url:"index.php?m=index&f=index&a=hits",
        type:"post",
        data:{cid:cid},
        success:function(e){
            if(e=="ok"){
                console.log('yes')
            }else{
                console.log('no')
            }
        }
    });
    //关注
    $(".guanzhu").click(function(){
        var uid1=$("main").attr("uid1");
        var uid2=$("main").attr("uid2");
        $.ajax({
            url:"index.php?m=index&f=guanzhu&a=add",
            type:"post",
            data:{uid1,uid2},
            success:function(e){
                if(e!=="err"){
                    alert(e);
                    $(".guanzhu").css("display","none");
                    $(".cancel").css("display","block");
                }else if(e=="err"){
                    location.href="index.php?m=index&f=indexLogin";
                }
            }
        })
    })
    //关注
    $(".cancel").click(function(){
        var uid1=$("main").attr("uid1");
        var uid2=$("main").attr("uid2");
        $.ajax({
            url:"index.php?m=index&f=guanzhu&a=cancel",
            type:"post",
            data:{uid1,uid2},
            success:function(e){
                if(e=="ok"){
                    $(".guanzhu").css("display","block");
                    $(".cancel").css("display","none");
                }
            }
        })
    });
    //评论区的js----事件委托
    $('.comment').delegate(".rbtn","click",function(){
        $(this).parents(".commentCon").find("textarea").val("");
        $(this).parents(".commentCon").find(".inp").animate({height:"130px"});
        //如果评论框在可视范围以外，让它到屏幕中间
        if($(this).parents(".commentCon").find(".inp").offset().top>$(window).height()+$(window).scrollTop()){
            $(window).scrollTop($(window).scrollTop()+$(window).height()/2);
        }
    });
    //问题
    $('.comment').delegate(".replayBtn","click",function(){
        $(this).parents(".commentCon").find("textarea").val("");
        var username=$("main").attr("username");
        var str="@"+username+":";
        $(this).parents(".commentCon").find("textarea").val(str);
    });

    $(".comment").delegate(".cancels","click",function () {
        $(this).parents(".commentCon").find(".inp").animate({height:"0"});
        $(this).parents(".commentCon").find("textarea").val("");
    });
    //提交评论
    $(".myConBtn").click(function(){
        var mcon=$(".myCon").val();
        var state=0;
        var uid1=$("main").attr("uid1");
        var uid2=$("main").attr("uid2");
        var conid=$("main").attr("cid");
        if(mcon==""){
            alert("评论内容不可为空");
        }else{
            // uid1  uid2  conid mcon state
            $.ajax({
                url:"index.php?m=index&f=message&a=add",
                type:"post",
                data:{uid1,uid2,conid,mcon,state},
                success:function(e){
                    if(e=="err"){
                        location.href="index.php?m=index&f=indexLogin";
                    }else{
                        alert("评论成功");
                        $(".myCon").val("");
                        $("<div class='commentCon'></div>").html(e).prependTo(".comment");
                    }
                }
            })
        }
    });
    //提交回复
    $(".comment").delegate(".tj","click",function(){
        var mcon=$(".tjCon").val();   //textarea的内容
        var state=1;             //pid
        var uid1=$("main").attr("uid1");   //留言者-不变
        var uid2=$(".tj").attr("uid");   //被留言者
        var conid=$("main").attr("cid");   //文章--不变
        if(mcon==""){
            alert("回复内容不能为空");
        }else{
            // uid1  uid2  conid mcon state
            $.ajax({
                url:"index.php?m=index&f=message&a=replay",
                data:{uid1,uid2,conid,state,mcon},
                type:"post",
                success:function(e){
                    if(e=="err"){
                        location.href="index.php?m=index&f=indexLogin";
                    }else{
                        $(".tjCon").val("");
                        $("<div class='replayCon'></div>").html(e).prependTo(".replayList");

                    }
                }
            })
        }
    });
});
