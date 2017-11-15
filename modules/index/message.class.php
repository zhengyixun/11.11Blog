<?php
class message extends main{
    //添加留言
    function add(){
        if(!$this->logins){
           echo "err";
        }else{
            $uid1=$_POST['uid1'];  //留言者/ 第二次被留言者
            $uid2=$_POST['uid2'];
            $conid=$_POST['conid'];
            $state=$_POST['state'];
            $mcon=$_POST['mcon'];
            $db=new db("message");
            $result=$db->insert(array(
                "uid1"=>$uid1,
                "uid2"=>$uid2,
                "conid"=>$conid,
                "state"=>$state,
                "mcon"=>"'{$mcon}'"
            ));
            if($result>0){
                $this->smarty->assign("uid1",$uid1);
                $this->smarty->assign("username",$_SESSION['uname']);
                $this->smarty->assign("mcon",$mcon);
                echo $this->smarty->display("index/comTemplate.html");
            }
        }
    }
    //回复留言
    function replay(){
        if(!$this->logins){
            echo "err";
        }else{
            $uid1=$_POST['uid1'];  //留言者/ 第二次被留言者
            $uid2=$_POST['uid2'];
            $conid=$_POST['conid'];
            $state=$_POST['state'];
            $mcon=$_POST['mcon'];
            $db=new db("message");
            $result=$db->insert(array(
                "uid1"=>$uid1,
                "uid2"=>$uid2,
                "conid"=>$conid,
                "state"=>$state,
                "mcon"=>"'{$mcon}'"
            ));
            if($result>0){
                $this->smarty->assign("mcon",$mcon);
                $this->smarty->assign("username1",$_SESSION['uname']);
                echo $this->smarty->display("index/huifuTem.html");
            }
        }
    }
}