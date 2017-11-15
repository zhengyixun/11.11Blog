<?php
class cate extends main{
    function addCate(){
        $this->smarty->display("admin/addCate.html");
    }
    function addCateCon(){
        $lid=$_SESSION['level'];
        $db1=new db('level');
        $result=$db1->where("lid=$lid and find_in_set('1',adminnum)")->select();  //如果有增加的权限在执行下面的
        if(count($result)>0) {

            $cname=$_POST['cname'];
            $cinfo=$_POST['cinfo'];
            $pid=$_POST['pid'];
            $cimage=$_POST['cimage'];
            $db=new db("category");
            $arr=array("cname"=>"'{$cname}'","cinfo"=>"'{$cinfo}'","pid"=>"'{$pid}'","cimage"=>"'{$cimage}'");
            $result=$db->insert($arr);
            if($result>0){
                echo "<script>alert('插入成功');location.href='index.php?m=admin&f=cate&a=addCate'</script>";
            }

        }else{
            echo "<script>alert('您没有权限');location.href='index.php?m=admin&f=cate&a=addCate'</script>";
        }
    }
    function showCate(){
            $arr = array();
            tree(0, $arr);
            echo json_encode($arr);
    }
    //查看分类---->树
    function seeCate(){
        $this->smarty->display("admin/seeCate.html");
    }
    //查看全部分类
    function seeCateCon(){
        $db=new db("category");
        $result=$db->select();
        $arr=array();
        $arr["total"]=count($result);
        $arr["rows"]=array(
            array(
                "id"=>0,
                "cname"=>"一级分类",
                "cinfo"=>' ',
            )

        );
        foreach ($result as $v){
            $arr["rows"][]=array(
                "id"=>$v['cid'],
                "cname"=>$v['cname'],
                "cinfo"=>$v['cinfo'],
                "_parentId"=>$v['pid']
            );
        }
        $arr["footer"]=array(
            "cname"=>"总计:",
            "cinfo"=>count($result),
            "iconCls"=>"icon-sum",
        );
        echo json_encode($arr);
    }
//修改分类内容
    function editCon(){
        $cid=P("cid");
        $field=P("field");
        $cname=P("val");
        $db=new db('category');
        $result=$db->where("cid=".$cid)->update("$field="."'{$cname}'");
        if($result>0){
            echo "ok";
        }else{
            echo "no";
        }
    }
    //删除分类
    function delCon(){
        $cid=P("cid");
        $db=new db('category');
        $result=$db->where("cid=".$cid)->delete();
        if($result){
            echo "ok";
        }
    }
    //查询推荐位
    function showPos(){
        $db=new db("position");
        $result=$db->select();
        $this->smarty->assign("result",$result);
        $this->smarty->display("admin/showPos.html");
    }
    //添加推荐位
    function addPos(){
        $this->smarty->display("admin/addPos.html");
    }
    //添加推荐位信息
    function addPosCon(){
        $pname=$_POST['pname'];
        $pthumb=$_POST['pthumb'];
        $db=new db("position");
        if($db->insert(array("pname"=>"'{$pname}'","pthumb"=>"'{$pthumb}'"))){
            echo "<script>alert('添加成功');location.href='index.php?m=admin&f=cate&a=addPos'</script>";
        }
    }
    function uploads(){
        $upobj=new uploads();
        $upobj->move();
    }
    //删除推荐位
    function delPos(){
        $pid=$_GET['pid'];
        $db=new db("position");
        $result=$db->where("pid=".$pid)->delete();
        if($result>0){
            echo "<script>alert('删除成功');location.href='index.php?m=admin&f=cate&a=showPos'</script>";
        }
    }
    //修改推荐位名称
    function edit(){
        $pname=$_POST["pname"];
        $pid=$_POST["pid"];
        $db=new db("position");
        if($db->where("pid=".$pid)->update("pname='{$pname}'")){
            echo "ok";
        }else{
            echo "err";
        }
    }
}