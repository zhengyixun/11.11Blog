<?php
defined("COME") or exit("非法进入");
class member extends main{
    //查询管理员
    function init(){
        $db=new db();
        $sql="select admin.*,level.lname from admin,level WHERE admin.level=level.lid";
        $result = $db->select($sql);
        $this->smarty->assign("result",$result);
        $this->smarty->display("admin/member.html");
    }
    //添加管理员
    function addMember(){
        $db=new db("level");
        $result=$db->select();
        $this->smarty->assign("result",$result);
        $this->smarty->display("admin/addMember.html");
    }
    //添加管理员（内容）
    function addMemberCon(){
        $lid=$_SESSION['level'];
        $db1=new db('level');
        $result0=$db1->where("lid={$lid} and find_in_set('2',adminnum)")->select();  //如果有增加的权限在执行下面的
        if(count($result0)>0) {


            $aname = $_POST['aname'];
            $apass = md5($_POST['apass']);
            $level = $_POST['lid'];
            $db = new db("admin");
            $result = $db->insert(array("aname" => "'{$aname}'", "apass" => "'{$apass}'", "level" => $level));
            if ($result > 0) {
                echo "<script>alert('插入成功');location.href='index.php?m=admin&f=member&a=addMember'</script>";
            }
        }else{
            echo "<script>alert('您没有权限');location.href='index.php?m=admin&f=member&a=addMember'</script>";
        }

    }
    //删除管理员
    function delAdmin(){
        $lid=$_SESSION['level'];
        $db1=new db('level');
        $result=$db1->where("lid={$lid} and find_in_set('2',adminnum)")->select();  //如果有增加的权限在执行下面的

        if(count($result)>0) {

            $aid = $_GET['aid'];
            $db = new db("admin");
            $result = $db->where("aid=$aid")->delete();
            if ($result) {
                echo "<script>alert('删除成功');location.href='index.php?m=admin&f=member&a=init'</script>";
            }
        }else{
            echo "<script>alert('您没有权限');location.href='index.php?m=admin&f=member'</script>";
        }
    }
    //编辑管理员
    function editAdmin(){
        $lid=$_SESSION['level'];
        $db1=new db('level');
        $result=$db1->where("lid={$lid} and find_in_set('1',adminnum)")->select();  //如果有增加的权限在执行下面的

        if(count($result)>0) {

            $aid = $_GET['aid'];

            $db1 = new db("level");
            $result = $db1->select();
            $this->smarty->assign("result", $result);


            $db = new db('admin');
            $result1 = $db->where("aid=$aid")->find();
            $this->smarty->assign("result1", $result1);
            $this->smarty->display("admin/editAdmin.html");
        }else{
            echo "<script>alert('您没有权限');location.href='index.php?m=admin&f=member'</script>";
        }
    }
    //编辑管理员内容
    function editAdminCon(){
        $aname=$_POST['aname'];
        $level=$_POST['lid'];
        $aid=$_POST['aid'];
        $db=new db("admin");
        $result= $db->where("aid=$aid")->update("aname='{$aname}'".","."level=$level");
        if($result>0){
            echo "<script>alert('修改成功');location.href='index.php?m=admin&f=member&a=init'</script>";
        }
    }
    //查询管理员角色
    function showRole(){
        $this->smarty->display("admin/showRole.html");
    }
    //查看角色
    function selectRole(){
        $db=new db("level");
        $result=$db->select();
        $arr=array();
        $arr["rows"]=$result;

        echo json_encode($arr,true);

    }
    function addRole(){
        $lid=$_SESSION['level'];
        $db1=new db('level');
        $result=$db1->where("lid=$lid and find_in_set('1',adminnum)")->select();  //如果有增加的权限在执行下面的
        if(count($result)>0) {

            $type = $_GET["type"];
            $lname = $_POST['lname'];
            $messagenum = $_POST['messagenum'];
            $connum = $_POST['connum'];
            $adminnum = $_POST['adminnum'];
            $lid = $_POST["lid"];
            $db = new db('level');
            if ($type == "add") {
                $result = $db->insert(array("lname" => "'{$lname}'", "messagenum" => "'{$messagenum}'", "connum" => "'{$connum}'", "adminnum" => "'{$adminnum}'"));
                if ($result > 0) {
                    echo $db->db->insert_id; //返回上一步insert操作产生的id
                }
            } else if ($type == "edit") {
                $res = $db->where("lid=$lid")->update("lname='{$lname}'" . "," . "messagenum='{$messagenum}'" . "," . "connum='{$connum}'" . "," . "adminnum='{$adminnum}'");
                if ($res > 0) {
                    echo "edit";
                }
            }
        }else{
            echo "<script>alert('您没有权限');location.href='index.php?m=admin&f=member&a=showRole'</script>";
        }

    }
//删除的方法
    function delete(){
        $lid=$_SESSION['level'];
        $db1=new db('level');
        $result=$db1->where("lid=$lid and find_in_set('2',adminnum)")->select();  //如果有权限在执行下面的
        if(count($result)>0) {
            //真正删除的代码
            $lids = $_POST['lids'];
            $db = new db("level");
            $result = $db->delete("lid in $lids");
            if ($result) {
                echo "ok";
            }

        }else{
            echo "no";
        }

    }


    //测试分页
    function testRole(){
        $pages=$_GET['pages'];
        include_once LIBS_PATH."/pages.class.php";
        $db= new db("level");

        $result=$db->select();

        $pagesobj=new pages();
        $pagesobj->nums=2;
        $pagesobj->total=count($result);
        $res= $pagesobj->show();
        $this->smarty->assign("res",$res);

        $pagesobj->pageNum=ceil($pagesobj->total/$pagesobj->nums);
        $sql1="select * from level limit {$pages},{$pagesobj->nums}";
        $result3=$db->select($sql1);

        $this->smarty->assign("result3",$result3);
        $this->smarty->display("admin/testRole.php");


    }

}