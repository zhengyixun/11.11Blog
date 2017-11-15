<?php
if(!defined('COME')){
    echo "非法访问";
    exit();
}
class route{
    private static $m;    //目录 modules
    private static $f;    //文件 file
    private static $a;    //方法 action
    private function getInfo(){
        self::$m=isset($_REQUEST['m'])&&!empty($_REQUEST['m'])?$_REQUEST['m']:'index';
        self::$f=isset($_REQUEST['f'])&&!empty($_REQUEST['f'])?$_REQUEST['f']:'index';
        self::$a=isset($_REQUEST['a'])&&!empty($_REQUEST['a'])?$_REQUEST['a']:'init';
    }
    public function set(){
        $this->getInfo();  //调用一下getInfo方法
        $murl=MOUDLES_PATH."/".self::$m;    //目录的路径
        if(is_dir($murl)){      //判断目录是不是存在
            $furl=MOUDLES_PATH."/".self::$m."/".self::$f.".class.php";
            if(is_file($furl)){        //判断文件是不是存在
                include_once $furl;
                if(class_exists(self::$f)){   //检查类是否被定义
                    $obj=new self::$f();    //如果存在，new一下这个类
                    $method=self::$a;
                    if(method_exists($obj,$method)){   //判断类中是否存在method方法
                        $obj->$method();
                    }else{
                        echo self::$a."这个方法不存在";
                    }
                }else{
                    echo self::$f.'这个类不存在';
                }
            }else{
                echo $furl.'这个文件不存在';
            }
        }else{
            echo $murl.'这个目录不存在';
        }
    }
}