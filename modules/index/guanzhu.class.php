<?php
class guanzhu extends main{
    //关注
    function add(){
        $uid1 = $_POST['uid1'];
        $uid2 = $_POST['uid2'];
        if ($uid1) {
            $db = new db("guanzhu");
            $result = $db->insert(array(
                "uid1" => $uid1,
                "uid2" => $uid2
            ));
            if ($result > 0) {
                echo "关注成功";
                $_SESSION['flag']="true";
            }
        } else {
            echo "err";
        }
    }
    //取消关注
    function cancel(){
        $uid1 = $_POST['uid1'];
        $uid2 = $_POST['uid2'];
        $db = new db("guanzhu");
        $result=$db->where("uid1=$uid1 and uid2=$uid2")->deletes();
        if($result>0){
            echo "ok";
        }
    }
}