<?php
defined("COME") or exit("非法进入");
class index extends main{
    function init(){
        $this->smarty->display("admin/admin.html");
    }
    //用户管理-----查看
    function showUser(){
        $db=new db("user");
        $result=$db->select();
        $this->smarty->assign("result",$result);
        $this->smarty->display("admin/showUser.html");
    }
    //删除用户
    function delUser(){
        $lid=$_SESSION['level'];
        $db1=new db('level');
        $result0=$db1->where("lid=$lid and find_in_set('1',adminnum)")->select();  //如果有增加的权限在执行下面的
        if(count($result0)>0) {

            $uid = $_GET['uid'];
            $db = new db("user");
            $result = $db->where("uid=" . $uid)->delete();
            if ($result > 0) {
                echo "<script>alert('删除成功');location.href='index.php?m=admin&f=index&a=showUser'</script>";
            }
        }else{
            echo "<script>alert('您没有权限');location.href='index.php?m=admin&f=index&a=showUser'</script>";
        }
    }
    //编辑用户---页面
    function editUser(){
        $lid=$_SESSION['level'];
        $db1=new db('level');
        $result0=$db1->where("lid=$lid and find_in_set('1',adminnum)")->select();  //如果有增加的权限在执行下面的
        if(count($result0)>0) {

            $uid = $_GET['uid'];
            $db = new db("user");
            $result = $db->where("uid=" . $uid)->find();

            $this->smarty->assign("result", $result);
            $this->smarty->display("admin/editUserCon.html");
        }else{
            echo "<script>alert('您没有权限');location.href='index.php?m=admin&f=index&a=showUser'</script>";
        }
    }
    //编辑用户---信息
    function editUserText(){
        $uid=$_POST['uid'];
        $uname=$_POST['uname'];
        $nicheng=$_POST['nicheng'];
        $phone=$_POST['phone'];
        $level=$_POST['level'];
        $photo=empty($_POST['photo'])?$_POST['oldPhoto']:$_POST['photo'];//不传图片则使用原先的图片
        //var_dump($photo);exit();
        //测试中~~~~~~~问题：不上传图片会修改不成功
        $db=new db("user");
        $result=$db->where("uid=".$uid)->update("uname="."'{$uname}'".","."nicheng="."'{$nicheng}'".","."phone="."{$phone}".","."level="."'{$level}'".","."photo="."'{$photo}'");
        if($result>0){
            echo "<script>alert('修改成功');location.href='index.php?m=admin&f=index&a=showUser'</script>";
        }
    }
    //添加用户---页面
    function addUser(){
        $lid=$_SESSION['level'];
        $db1=new db('level');
        $result0=$db1->where("lid=$lid and find_in_set('1',adminnum)")->select();  //如果有增加的权限在执行下面的
        if(count($result0)>0) {

            $this->smarty->display("admin/addUser.html");

        }else{
            echo "<script>alert('您没有权限');location.href='index.php?m=admin&f=index&a=showUser'</script>";
        }
    }
    //添加用户---信息
    function addUserCon(){
        $uname=sql($_POST['uname']);
        $upass=md5($_POST['upass']);
        $nicheng=sql($_POST['nicheng']);
        $phone=$_POST['phone'];
        $photo=$_POST['photo'];
        $level=$_POST['level'];
        $db=new db("user");
        $arr=array("uname"=>"'{$uname}'","upass"=>"'{$upass}'","nicheng"=>"'{$nicheng}'","phone"=>$phone,"photo"=>"'{$photo}'","level"=>$level);
        $result=$db->insert($arr);
        if($result>0){
            echo "<script>alert('添加成功');location.href='index.php?m=admin&f=index&a=addUser'</script>";
        }
    }
    function uploads(){
        $upobj=new uploads();
        $upobj->move();
    }

}