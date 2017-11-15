<?php
/* 基类 父类 */
class indexMain{
    function __construct(){
        $smarty=new Smarty();
        $smarty->setCompileDir('compile');
        $smarty->setTemplateDir('template/index');
        $this->smarty=$smarty;
    }
    function jump($message,$url){
        echo "<script>alert('{$message}');location.href='{$url}';</script>";
    }
}
?>