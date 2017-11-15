<?php
defined("COME") or exit ("error");
class login extends main{
    function init(){
        $this->smarty->display("admin/login.html");
    }
    function reg(){
        $this->smarty->display("admin/reg.html");
    }

    function imgCode(){
        $obj=new code();
        $obj->codeUrl = "static/demo.ttf";
        $obj->createCode();
    }

    function check(){
        //验证码验证
        if ($_POST["acode"] !== $_SESSION["code"]){
            echo "<script>alert('验证码输入错误');location.href = 'index.php?m=admin&f=login'</script>";
            exit();
        }
        /*
       //手机验证
       $phonecode=$_POST["phonecode"];
       if($phonecode!==$_SESSION["phonecode"]){
           echo "phonecode error!";
           exit;
       }
       */
        //验证用户名和密码
        $aname = P("aname");
        $apass = md5(P("apass"));
        $dbobj = new db("admin");
        $arr = $dbobj->where("aname='{$aname}' and apass='{$apass}'")->find();
        if(count($arr) > 0){
            $_SESSION["adminLogin"] = "yes";
            $_SESSION["aname"] = $aname;
            $_SESSION["aid"] = $arr['aid'];
            $_SESSION["level"] = $arr['level'];
            $this->smarty->assign('aname' ,$_SESSION['aname']);
            $this->smarty->display("admin/admin.html");

        }else{
            echo "<script>alert('用户名或密码错误');location.href='index.php?m=admin&f=login';</script>";
        }

    }
    function loginout(){
        unset($_SESSION['adminLogin']);
        unset($_SESSION['aname']);
        unset($_SESSION['apass']);
        echo "<script>alert('退出成功');location.href='index.php?m=admin&f=login'</script>";
    }

}