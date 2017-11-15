<?php
defined('COME') or exit('非法进入');
class smarty{
    public $templeteUrl;    //模板文件坐在路径
    public $compileUrl;     //解析后文件所在路径
    public $arr=array();

    public function setTempleteUrl($dirname='template'){
        $this->templeteUrl=$dirname;
        $tplUrl=APP_PATH.'/'.$this->templeteUrl;  //完整路径
        $this->templeteUrl=$tplUrl;
        if(!is_dir($tplUrl)){   //如果没有 创建该文件
            mkdir($tplUrl);
        }
    }
    public function setCompileUrl($dirname='compile'){
        $this->compileUrl=$dirname;
        $comurl=APP_PATH."/".$this->compileUrl;
        $this->compileUrl=$comurl;
        if(!is_dir($comurl)){
            mkdir($comurl);
        }
    }
    public function assign($str,$val){
        $this->arr[$str]=$val;
    }
    public function display($url){
        $fullPath=$this->templeteUrl.'/'.$url;
        $str=file_get_contents($fullPath);
        $newstr = preg_replace('/\{([^\}\s]+)\}/','<?php echo $this->arr["$1"]?>',$str);
        $comFullPath= $this->compileUrl.'/'.'1.php';
        file_put_contents($comFullPath,$newstr);
        include $comFullPath;
    }
}
?>