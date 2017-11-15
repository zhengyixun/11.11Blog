<?php
if(!defined('COME')){
    echo "非法访问";
    exit();
}
class uploads{
    public $size;
    public $date;
    public $fullPath;
    public $fileName="file";
    public $fileRoot="upload";
    private $type="image/png,image/jpeg,image/jpg,image/gif";
    function __construct(){
        $this->size=1024*1024*10;
    }
    public function move(){
        //1.接收
        $this->accept();
        //2.检查
        if($this->check()){
            //3.创建目录 createDir
            $this->createDir();
            //4.移动到指定目录
            $this->toDir();
        };
    }
    private function accept(){
        $this->data=$_FILES[$this->fileName];
    }
    private function check(){
        if(is_uploaded_file($this->data["tmp_name"])) {
            if(!is_dir($this->fileRoot)){
                mkdir($this->fileRoot);
            }
            //判断图片格式 判断图片大小
            if(!strchr($this->type,$this->data["type"])&&$this->data['size']>$this->size){
                echo "ERROR";
                return false;
            }
            return true;
        }
    }
    private function createDir(){
        $this->date=date("y-m-d");
        if(!is_dir($this->fileRoot."/".$this->date)){
            mkdir($this->fileRoot."/".$this->date,0777,true);
        }
    }
    private function toDir(){
        //生成随机文件名
        $name=time().mt_rand(0,999).$this->data["name"];
        //完整路径
        echo $this->fullPath=$this->fileRoot."/".$this->date."/".$name;
        move_uploaded_file($this->data["tmp_name"],$this->fullPath);
    }
}
//$obj=new uploads();
//$obj->move();
