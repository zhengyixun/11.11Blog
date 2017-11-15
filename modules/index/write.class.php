<?php
defined("COME") or exit ("error");
class write extends main{
    //iframe的提示页
    function init(){
        $this->smarty->display("index/iframe.html");
    }
    //写文章--列表页
    function writeList(){
        $cateid=$_GET['cid'];

        $db=new db("con");
        $result=$db->where("cateid=$cateid")->select();
        $this->smarty->assign("result",$result);

        $this->smarty->assign("cateid",$cateid);
        $this->smarty->display("index/writeList.html");
    }
    //写文章 内容
    function writeCon(){
        $cateid=$_GET['cateid'];
        $this->smarty->assign("cateid",$cateid);


        $db1=new db("position");
        $result1=$db1->select();
        $this->smarty->assign("result1",$result1);

        $this->smarty->display("index/writeCon.html");
    }
    //写文章--上传图片
    function uploads(){
        $upobj=new uploads();
        $upobj->move();
    }
    //写内容---提交
    function add(){
        $state=$_GET['state'];
        $ccon=addcslashes($_POST['con'],"s");  //带有s的标签转义
        $price=$_POST['price'];
        $thumb=$_POST['thumb'];
        $cateid=$_POST['cateid'];
        $uid=$_SESSION['uid'];
        $ctitle=$_POST['ctitle'];
        $cquanxian=1;
        //其他分类
        $pid=implode(",",$_POST['pid']);
        $db=new db("con");
        $arr=array(
            "ctitle"=>"'{$ctitle}'",
            "ccon"=>"'{$ccon}'",
            "uid"=>$uid,
            "cquanxian"=>$cquanxian,
            "thumb"=>"'{$thumb}'",
            "cateid"=>$cateid,
            "state"=>$state,
            "price"=>$price,
            "posid"=>"'{$pid}'"
        );
        if($db->insert($arr)>0){
            echo "<script>alert('发布成功');location.href='index.php?m=index&f=write&a=writeCon&cateid={$cateid}'</script>";
        }else{
            echo "<script>alert('发布失败');location.href='index.php?m=index&f=write&a=writeCon&cateid={$cateid}'</script>";
        }
    }
    //修改文章内容---页面
    function editWriteCon(){
        $cid=$_GET['cid'];
        $db=new db("con");
        $result=$db->where("cid=".$cid)->find();
        $this->smarty->assign("result",$result);
        $this->smarty->assign("cid",$cid);

        $db1=new db("position");
        $result1=$db1->select();
        $this->smarty->assign("result1",$result1);

        $this->smarty->display("index/editWriteCon.html");
    }
    //修改文章  ----信息
    function editWriteConCon(){
        $ctitle=$_POST['ctitle'];
        $ccon=addcslashes($_POST["ccon"],"s");
        $thumb=isset($_POST["thumb"])?$_POST["thumb"]:"";
        $price=isset($_POST["price"])?$_POST["price"]:0;
        $uid=$_POST["uid"];
        $state=$_POST["state"];
        $cateid=$_POST["cateid"];
        $cquanxian=$_POST["cquanxian"];
        $posid=implode(",",$_POST["pid"]);
        //要知道修改的是那条数据   cid
        $cid=$_GET['cid'];
        $db=new db("con");
        if($thumb){
            $result=$db->where("cid=".$cid)->update("ctitle='{$ctitle}',ccon='{$ccon}',thumb='{$thumb}',price='{$price}',posid='{$posid}',uid=$uid,state=$state,cquanxian=$cquanxian,cateid=$cateid");
            if($result>0){
                echo "<script>alert('修改成功');location.href='index.php?m=index&f=write&a=editWriteCon&cid={$cid}'</script>";
            }
        }else{
            $result1=$db->where("cid=".$cid)->update("ctitle='{$ctitle}',ccon='{$ccon}',price='{$price}',posid='{$posid}',uid=$uid,state=$state,cquanxian=$cquanxian,cateid=$cateid");
            if($result1>0){
                echo "<script>alert('修改成功');location.href='index.php?m=index&f=write&a=editWriteCon&cid={$cid}'</script>";
            }
        }
    }
    //删除thumb
    function delThumb(){
        $cid=$_POST['cid'];
        $db=new db("con");
        $result=$db->field("thumb")->where("cid=".$cid)->find();
        unlink($result["thumb"]);
        if($db->update("thumb=''")){
            echo "ok";
        }
    }
    //删除列表中的列表项
    function delList(){
        $cid=$_GET['cid'];

        $db=new db("con");
        $data=$db->where("cid=".$cid)->find();
        $cateid=$data['cateid'];
        $result=$db->where("cateid=$cateid")->select();
        $this->smarty->assign("result",$result);
        $this->smarty->assign("cateid",$cateid);

//        $dbobj=new db();
//        $sql="select user.uname,con.uid from user,con where con.uid=user.uid";
//        $data=$dbobj->select($sql);
////        var_dump($data[0]['uname']);exit();
//        $this->smarty->assign("data",$data);

        $result0=$db->where("cid=".$cid)->delete();
        if($result0>0){
            echo "<script>alert('删除成功');location.href='index.php?m=index&f=write&a=writeList&cid={$data['cateid']}'</script>";
        }
    }
}