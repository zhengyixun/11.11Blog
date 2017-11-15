<?php
class main{
    function __construct(){
        $smarty=new Smarty();
        $smarty->setCompileDir("compile");
        $smarty->setTemplateDir("template");
        $this->smarty=$smarty;
        $this->smarty->assign("header",TPL_PATH."/index/header.html");
        $this->smarty->assign("comment",TPL_PATH."/index/comment.html");
        $logins=isset($_SESSION['userLogin'])?$_SESSION['userLogin']:null;
        $this->logins=$logins;
        $photos=isset($_SESSION['photo'])?$_SESSION['photo']:null;
        $nichengs=isset($_SESSION['nicheng'])?$_SESSION['nicheng']:null;
        $this->smarty->assign("logins",$logins);
        $this->smarty->assign("photos",$photos);
        $this->smarty->assign("nichengs",$nichengs);
    }
}
?>