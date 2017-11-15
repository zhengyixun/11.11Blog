<?php
defined("COME") or exit("非法进入");
class userRole extends main{
    //查看用户角色页面
    function selectUserRole(){
        $db=new db("role");
        $result=$db->select();
        $this->smarty->assign("result",$result);
        $this->smarty->display("admin/showUserRole.html");
    }
    //添加用户角色页面
    function addUserRole(){
        $this->smarty->display("admin/addUserRole.html");
    }
    //添加用户角色信息
    function addUserRoleCon(){
        //验证权限
        $lid=$_SESSION['level'];
        $db1=new db('level');
        $result0=$db1->where("lid=$lid and find_in_set('1',adminnum)")->select();  //如果有增加的权限在执行下面的
        if(count($result0)>0) {

            $rname = $_POST['rname'];
            $connum = $_POST['connum'];
            $conlevel = $_POST['conlevel'];
            $db = new db("role");
            $arr = array("rname" => "'{$rname}'", "connum" => $connum, "conlevel" => $conlevel);
            $result = $db->insert($arr);
            if ($result > 0) {
                echo "<script>alert('添加成功');location.href='index.php?m=admin&f=userRole&a=addUserRole'</script>";
            } else {
                echo "<script>alert('添加失败');location.href='index.php?m=admin&f=userRole&a=addUserRole'</script>";
            }
        }else{
            echo "<script>alert('您没有权限');location.href='index.php?m=admin&f=userRole&a=addUserRole'</script>";
        }
    }
    //删除角色
    function delUserRole(){
        //验证权限
        $lid=$_SESSION['level'];
        $db1=new db('level');
        $result0=$db1->where("lid=$lid and find_in_set('1',adminnum)")->select();  //如果有增加的权限在执行下面的
        if(count($result0)>0) {

            $rid = $_GET['rid'];
            $db = new db("role");
            $result = $db->where("rid=" . $rid)->delete();
            if ($result > 0) {
                echo "<script>alert('删除成功');location.href='index.php?m=admin&f=userRole&a=selectUserRole'</script>";
            }
        }else{
            echo "<script>alert('您没有权限');location.href='index.php?m=admin&f=userRole&a=selectUserRole'</script>";
        }
    }
    //编辑用户界面
    function editUserRole(){
        //验证权限
        $lid=$_SESSION['level'];
        $db1=new db('level');
        $result0=$db1->where("lid=$lid and find_in_set('1',adminnum)")->select();  //如果有增加的权限在执行下面的
        if(count($result0)>0) {

            $rid = $_GET['rid'];
            $db = new db("role");
            $result = $db->where("rid=" . $rid)->find();
            $this->smarty->assign("result", $result);
            $this->smarty->display("admin/editUserRole.html");

        }else{
            echo "<script>alert('您没有权限');location.href='index.php?m=admin&f=userRole&a=selectUserRole'</script>";
        }
    }
    //编辑用户信息
    function editUserRoleCon(){
        $rid=$_POST['rid'];
        $rname=$_POST['rname'];
        $connum=$_POST['connum'];
        $conlevel=$_POST['conlevel'];
        $db=new db("role");
        $result=$db->where("rid=".$rid)->update("rname='{$rname}'".","."connum=$connum".","."conlevel=$conlevel");
        if($result>0){
            echo "<script>location.href='index.php?m=admin&f=userRole&a=selectUserRole';alert('修改成功');</script>";
        }else{
            echo "<script>location.href='index.php?m=admin&f=userRole&a=selectUserRole';alert('修改失败');</script>";
        }
    }
}