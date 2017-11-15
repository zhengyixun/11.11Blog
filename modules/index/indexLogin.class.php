<?php
defined("COME") or exit ("error");
class indexLogin extends main{
    //前端登录页面
    function init(){
        $this->smarty->display("index/indexLogin.html");
    }
    //前端注册页面
    function indexReg(){
        $this->smarty->display("index/indexReg.html");
    }
    //前端注册页面内容
    function indexRegCon(){
        //验证码验证
        if ($_POST["ucode"] !== $_SESSION["code"]){
            $this->smarty->assign("errorinfo","验证码错误");
            $this->smarty->assign("uppage","index.php?m=index&f=indexLogin&a=indexReg");
            $this->smarty->display("index/error.html");
            exit();
        }
        //验证用户名和密码
        $uname =sql(P("uname")) ;
        $phone =sql(P("phone")) ;
        $upass = md5(P("upass"));
        $db = new db("user");
        $result=$db->insert(array("uname"=>"'{$uname}'","upass"=>"'{$upass}'","nicheng"=>"'User'","level"=>2,"phone"=>"{$phone}"));
        if($result>0){
            //使用成功页验证
            $this->smarty->assign("successinfo","注册成功");
            $this->smarty->assign("uppage","index.php?m=index&f=indexLogin&a=init");
            $this->smarty->display("index/success.html");
        }
//        //手机验证
//        $phonecode=$_POST["phonecode"];
//        if($phonecode!==$_SESSION["phonecode"]){
//            echo "phonecode error!";
//            exit;
//        }
//
//        function sendCode(){
//            //duapp.com  手机验证
//            include LIBS_PATH."/Ucpaas.class.php";
//            //初始化必填
//            $options['accountsid']='1a6d42d9ac402348d9bbc508c8036fc7';
//            $options['token']='df87ec2ea7a3dcfb989551d7c2b8645a';
////初始化 $options必填
//            $ucpass = new Ucpaas($options);
////开发者账号信息查询默认为json或xml
////短信验证码（模板短信）,默认以65个汉字（同65个英文）为一条（可容纳字数受您应用名称占用字符影响），超过长度短信平台将会自动分割为多条发送。分割后的多条短信将按照具体占用条数计费。
//            $appId = "c4a7e9bde53443668cdf750b41529a11";
//            $to = $_POST["phonecode"];
//            $templateId = "60488";
//            $zhongzi="1234567890abcdefg";
//            $param="";
//            for($i=0;$i<4;$i++){
//                $param.=$zhongzi[mt_rand(0,strlen($zhongzi)-1)];
//            }
//            $_SESSION["phonecode"]=$param;
//            echo $ucpass->templateSMS($appId,$to,$templateId,$param);
//        }
    }

    //验证用户名是否重复
    function nameCheck(){
        $uname=$_POST['uname'];
        $db=new db("user");
        $result=$db->where("uname="."'{$uname}'")->select();
        if(count($result)){
            echo "false";
        }else{
            echo "true";
        }
    }

    //前端登录页验证码
    function imgCode(){
        $obj=new code();
        $obj->codeUrl = "static/demo.ttf";
        $obj->createCode();
    }
    //前端检查
    function check(){
        //验证码验证
        if (strtolower($_POST["ucode"]) !== $_SESSION["code"]){
            //使用自定义错误页面
            $this->smarty->assign("errorinfo","验证码错误");
            $this->smarty->assign("uppage","index.php?m=index&f=indexLogin&a=init");
            $this->smarty->display("index/error.html");
            exit();
        }
        //验证用户名和密码
        $uname =sql(P("uname"));
        $upass = md5(P("upass"));
        $dbobj = new db("user");
        $arr = $dbobj->where("uname='{$uname}' and upass='{$upass}'")->find();
        //匹配成功
        if(count($arr) > 0){
            $_SESSION["userLogin"] = "yes";
            $_SESSION["uname"] = $uname;
            $_SESSION["nicheng"] = $arr['nicheng'];
            $_SESSION["uid"] = $arr['uid'];
            $_SESSION["level"] = $arr['level'];
            $_SESSION["photo"] = $arr['photo'];

            $url=isset($_SESSION['nearurl'])?$_SESSION['nearurl']:"index.php";

            $this->smarty->assign('nichengs' ,$_SESSION['nicheng']);
            $this->smarty->assign('photos' ,$_SESSION['photo']);
            $this->smarty->assign('logins' ,$_SESSION['userLogin']);
            $this->smarty->assign("uppage",$url);
            $this->smarty->assign("successinfo","登陆成功");
            $this->smarty->display("index/success.html");
        }else{
            //使用自定义错误页面
            $this->smarty->assign("errorinfo","用户名或密码错误");
            $this->smarty->assign("uppage","index.php?m=index&f=indexLogin&a=init");
            $this->smarty->display("index/error.html");
        }
    }
    //退出 销毁变量
    function unsets(){
        unset($_SESSION["userLogin"]);
        unset($_SESSION["uname"]);
        unset($_SESSION["nicheng"]);
        unset($_SESSION["uid"]);
        unset($_SESSION["level"]);
        unset($_SESSION["photo"]);
        unset($_SESSION["nearurl"]);
        $this->smarty->assign("successinfo","退出成功");
        $this->smarty->assign("uppage","index.php");
        $this->smarty->display("index/success.html");
    }
}