<?php
function P($params){
    return $_POST[$params];
}
function G($params){
    return $_GET[$params];
}
function sql($params){
    return addslashes(htmlspecialchars($params));
}
function tree($pid=0,&$arr){

    $db=new db();
    $i=0;

    $sql="select * from category WHERE pid=".$pid;
    $result=$db->db->query($sql);
    while($row=$result->fetch_assoc()){
        $arr[$i]=array(
            "id"=>$row['cid'],
            "text"=>$row['cname'],
            "childen"=>array()
        );
        tree($row['cid'],$arr[$i]['children']);
        $i=$i+1;
    }
}