<?php
class content extends main {
    function showCon(){
        $state="";
        if(@$_GET['state']){
            $state="and con.state=".$_GET['state'];
        };
        $cquanxian='';
        if(@$_GET['cquanxian']){
            $cquanxian="and con.cquanxian=".$_GET['cquanxian'];
        };
        $db=new db();
        $page=new pages();
        $sql="select con.*,user.uname,category.cname from con,user,category where con.uid=user.uid and con.cateid=category.cid";
        $result=$db->select($sql);
        $result1=$db->select("select * from position");
        $page->total=count($result);
        $str0=$page->show();

        $sql0="select con.*,user.uname,category.cname from con,user,category where con.uid=user.uid and con.cateid=category.cid ".$state." ".$cquanxian." limit ".$page->limit;
        $result0=$db->select($sql0);

        foreach ($result0 as $k=>$v){
            $pid=$v['posid'];
            $arr=explode(",",$pid);
            $str='';
            foreach ($result1 as $v1){
                if(in_array($v1['pid'],$arr)){
                    $str.=$v1['pname'].",";
                }
            }
            $str=substr($str,0,-1);
            $result0[$k]['pname']=$str;
        }
        $this->smarty->assign('str',$str0);
        $this->smarty->assign("result",$result0);
        $this->smarty->display("admin/showCon.html");
    }

    //文章详情
    function adminCon(){
        $cid=$_GET['cid'];
        $db=new db('con');
        $result=$db->where("cid=".$cid)->find();
        $a=$result['uid'];
        $db1=new db("user");
        $result1=$db1->where("uid=".$a)->find();

        $this->smarty->assign('result',$result);
        $this->smarty->assign('result1',$result1);
        $this->smarty->display("admin/adminCon.html");
    }
    //审核
    function shen(){
        $cid=$_GET['cid'];
        $state=$_POST['state'];
        $cquanxian=$_POST['cquanxian'];
        $db=new db("con");

        $result=$db->where("cid=".$cid)->update("state=$state,cquanxian=$cquanxian");
        if($result>0){
            echo "<script>alert('审核完成'),location.href='index.php?m=admin&f=content&a=showCon'</script>";
        }
    }
}