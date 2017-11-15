<?php
defined("COME") or exit ("error");
class index extends main{
    function init(){
        //推荐位
        $db=new db("position");
        $result=$db->select();

        $this->smarty->assign("result",$result);
        //分类
        $db1=new db("category");
        $result1=$db1->where("pid=0")->select();
        $this->smarty->assign("result1",$result1);
        //文章--关联查询
        $db2=new db();
        $sql2="select con.*,user.uname,user.photo from con,user WHERE con.uid=user.uid and state=3 limit 1,9";
        $result2=$db2->select($sql2);
        $this->smarty->assign("result2",$result2);

        $this->smarty->display("index/index.html");
    }
    //查看详情页
    function blogCon(){
        $cid=$_GET['cid'];
        //文章--关联查询
        $db=new db("con");
        $result=$db->where("cid=".$cid)->find();
        $db1=new db("user");
        $result1=$db1->where("uid=".$result['uid'])->find();

        $this->smarty->assign("uname",$result1['uname']);
        $this->smarty->assign("result",$result);
        $this->smarty->assign("uid1",@$_SESSION['uid']);
        //存一下当前页的路径
        $_SESSION['nearurl']=SELT_URL;
        //关注+取消
        $uid2=$result['uid'];
        $uid1=isset($_SESSION['uid'])?$_SESSION['uid']:0;
        $dbobj=new db();
        $flag=$dbobj->select("select * from guanzhu WHERE uid2=".$uid2." and uid1=".$uid1);
        $this->smarty->assign("flag",count($flag));
        //点击数量
        $db->selectTable("hits");
        $dj=$db->where("conid=".$cid)->find();
        $this->smarty->assign("dj",$dj);

        $this->smarty->assign("username",@$_SESSION['uname']);

        $this->smarty->display("index/blogCon.html");
    }
    //查看分类页面
    function categoryCon(){
        //查用户
        $db=new db();
        $sql="select * from user limit 1,6";
        $result=$db->select($sql);
        $this->smarty->assign("result",$result);
        //查属于这个分类的内容
        $cid=$_GET['cid'];
        $db->selectTable("category");
        $result1=$db->where("cid=".$cid)->find();
        $this->smarty->assign("result1",$result1);  //作者名

        $result2=$db->select("select con.*,user.uname from con,user WHERE con.uid=user.uid and con.cateid=".$cid);
        $this->smarty->assign("result2",$result2);

        $this->smarty->display("index/categoryCon.html");
    }
    //查看全部作者
    function authorAll(){
        $db=new db("user");
        $result=$db->select();
        $this->smarty->assign("result",$result);
        $this->smarty->display("index/authorAll.html");
    }
    //购物车
    function carcar(){
        $this->smarty->display("index/car.html");
    }
    //个人中心--首页
    function ownPage(){
        $uid=$_SESSION['uid'];
        //用户名
        $db=new db("user");
        $result=$db->where("uid=".$uid)->find();
        $this->smarty->assign("result",$result);
        //粉丝数
        $db->selectTable("guanzhu");
        $result1=$db->where("uid2=".$uid)->select();
        $this->smarty->assign("result1",count($result1));
        //关注数
        $result2=$db->where("uid1=".$uid)->select();
        $this->smarty->assign("result2",count($result2));
        //发表的文章
        $db1=new db();
        $data=$db1->select("select con.*,user.uname from con,user WHERE con.uid=user.uid and state=3 and con.uid=".$uid);
        $this->smarty->assign("data",$data);
        $this->smarty->display("index/Self/ownPage.html");
    }
    //个人中心--个人基本信息
    function self(){
        $this->smarty->display("index/Self/self.html");
    }

    //发布文章2
    function writeText(){
        if($this->logins){   //判断是否登录
            include LIBS_PATH."/tree.class.php";
            $db=new db();
            $treeobj=new tree();
            $treeobj->getTree(0,"category",$db,"—");
            $this->smarty->assign("a",$treeobj->str);
            $this->smarty->display("index/writeText.html");
        }else{
            $this->smarty->display("index/indexLogin.html");
        }
    }
    //关注的页面
    function guanzhu(){
        $this->smarty->display("index/Self/guanzhu.html");
    }
    //关注的页面--iframe
    function guanzhuzhe(){
        $this->smarty->display("index/Self/guanzhuzhe.html");
    }
    //点击文章。阅读量+1
    function hits(){
        $cid=$_POST['cid'];
        $db=new db("hits");
        $result=$db->where("conid=".$cid)->select();
        //如果数据库中这篇文章已经被查看，则后面自增，没有则创建
        if(count($result)>0){
            if($db->where("conid=".$cid)->update("hnum=hnum+1")){
                echo "ok";
            };
        }else{
            $result1=$db->insert(array(
                "conid"=>$cid,
                "hnum"=>1
            ));
            if($result1>0){
                echo "ok";
            }
        };
    }
    //推荐位分类页
    function positions(){
        $posid=$_GET['posid'];
        //查用户
        $db=new db();
        $sql="select * from user limit 1,6";
        $result=$db->select($sql);
        $this->smarty->assign("result",$result);
        $db->selectTable("con");
        $result0=$db->select();

        foreach ($result0 as $k=>$v){
            $arr=explode(",",$v['posid']);
            if(in_array($posid,$arr)){
                $result0[$k]['pp']=$posid;
            }else{
                $result0[$k]['pp']="-1";
            }
        }

        $this->smarty->assign("result0",$result0);
        $db->selectTable("position");
        $pos=$db->where("pid=".$posid)->find();
        $this->smarty->assign("pos",$pos);

        $this->smarty->display("index/positions.html");
    }
}