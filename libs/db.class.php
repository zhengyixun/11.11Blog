<?php
if(!defined("COME")){
    echo "非法进入";
    exit();
}
class db{
    private $host;
    private $port;
    private $user;
    private $pass;
    private $database;
    public $db; //连接的的资源

    function __construct($table=""){
        $configs=require APP_PATH."/config.php";  //配置文件  require表示必须，缺少文件将不执行下边的代码
        $this->table=$table;
        $this->host=$configs['database']['host'];
        $this->port=$configs['database']['port'];
        $this->user=$configs['database']['user'];
        $this->pass=$configs['database']['pass'];
        $this->database=$configs['database']['database'];
        if (mysqli_connect_error()){
            echo "连接数据库失败 ";
            exit;
        }
        $this->db=new mysqli($this->host,$this->user,$this->pass,$this->database,$this->port);
        $this->db->query("set names utf8");  //设置字符集

        $this->opts['field']='*';     //区域  字段名
        $this->opts['where']='';
        $this->opts['limit']='';
        $this->opts['order']='';
        $this->opts['val']='';
    }
    function field($params='*'){
        $this->opts['field']=$params;
        return $this;
    }
    function where($params){
        $this->opts['where']="WHERE ".$params;
        return $this;
    }
    function limit($params){
        $this->opts['limit']="LIMIT ".$params;
        return $this;
    }
    function order($params){
        $this->opts['order']="ORDER BY ".$params;
        return $this;
    }
    function selectTable($tablename){
        $this->table=$tablename;
    }
    /*查询多条数据*/
    function select($sql=''){     //查询的方法

        if(empty($sql)){
            $sql="select ".$this->opts['field']." from ".$this->table.' '.$this->opts['where'].' '.$this->opts['order'].' '.$this->opts['limit'];
        }else{
            $sql=$sql;
        }
        $result=$this->db->query($sql);

        $arr=array();
        while ($row=$result->fetch_assoc()){
            $arr[]=$row;  //放进数组
        }
        return $arr;
    }
    /*查询一条数据*/
    function find($sql=''){     //查询的方法
        if(empty($sql)){
            $sql="select ".$this->opts['field']." from ".$this->table.' '.$this->opts['where'].' '.$this->opts['order'].' '.$this->opts['limit'];
        }else{
            $sql=$sql;
        }
        $result=$this->db->query($sql);
        $row=$result->fetch_assoc();
        return $row;
    }
    /*插入*/
    function insert($params){
        if(!empty($params)){
            $attr='';
            $val='';
            $arr=$params;
            foreach ($arr as $k=>$v){
                $attr.=$k.',';
                $val.=$v.',';
            }
            $this->opts['field']=substr($attr,0,-1);    //删除掉最后一个逗号
            $this->opts['val']=substr($val,0,-1);      //删除掉最后一个逗号
        }

        $sql="insert into ".$this->table." (".$this->opts['field'].") values (".$this->opts['val'].")";
        $this->db->query($sql);
        return $this->db->affected_rows;

    }
    /*删除*/
    function delete($params=''){
        $this->opts["where"]=(!empty($params))?" WHERE ".$params:$this->opts["where"];
        $sql="delete from ".$this->table."  ".$this->opts['where'];
        $this->db->query($sql);
        return $this->db->affected_rows;
    }
    function deletes(){
        $sql="delete from ".$this->table." ".$this->opts["where"];
        $this->db->query($sql);
        return $this->db->affected_rows;
    }
    /*修改*/
//    function update($params=''){
//        if(!empty($params)){
//            $params=strtolower($params);
//            $index=strrpos($params,"where");   //返回where最后一次出现的位置
//            if($index>-1){   //表示查到where
//                if($index==0){
//                    $this->opts['field']=$this->opts['field'];
//                }else{
//                    $this->opts['field']=substr($params,0,$index);
//                }
//
//                $this->opts["where"]=substr($params,$index);
//            }else{
//                $this->opts['field']=$params;
//                $this->opts['where']=$this->opts['where'];
//            }
//
//        }
//
//        $sql="update ".$this->table." set ".$this->opts['field']." values ".$this->opts['where'];
//        $this->db->query($sql);
//        return $this->db->affected_rows;
//    }



    function update($sql){
        $sql = "update ".$this->table." set ".$sql." ".$this->opts["where"];
        $this->db->query($sql);
        return $this->db->affected_rows;
    }
}
?>