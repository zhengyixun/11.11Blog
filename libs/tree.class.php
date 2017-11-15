<?php
defined("COME") or exit ("error");
class tree extends main{
    public $str='';
    function getTree($pid,$table,$db,$flag,$step=-1){
        $step+=1;
        $str=str_repeat($flag,$step);
        $sql="select * from ".$table." where pid=".$pid;
        $result=$db->db->query($sql);
        $this->str.="<ul>";

        while($row=$result->fetch_assoc()){
            $cid=$row['cid'];
            $sql1="select * from ".$table." where pid=".$cid;
            $result1=$db->db->query($sql1);
            $cname=$row['cname'];
            if($result1->num_rows>0) {   //返回结果集中行的数目
                $this->str .= "<li class='parent'> <span class='span'>{$str}{$cname}</span>";
            }else{
                $this->str .= "<li class='son'> <a class='a' href='index.php?m=index&f=write&a=writeList&cid={$cid}' target='con'>{$str}{$cname}</a>";
            }
            $this->getTree($cid,$table,$db,$flag,$step);
        }
        $this->str.="</li></ul>";

    }
}