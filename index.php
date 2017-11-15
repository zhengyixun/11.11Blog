<?php
session_start();
header("content-type:text/html;charset=utf-8");
//单入口文件
define("COME","yes");
// 服务器的根目录
define("ROOT_PATH", $_SERVER["DOCUMENT_ROOT"]);
// 应用的根目录
define("APP_PATH", substr($_SERVER["SCRIPT_FILENAME"], 0, strrpos($_SERVER["SCRIPT_FILENAME"], "/")));
// libs文件的路径
define("LIBS_PATH", APP_PATH . "/libs");
// moudles文件的路径
define("MOUDLES_PATH", APP_PATH . "/modules");
// 模板的路径
define("TPL_PATH", APP_PATH . "/template");
//2.  服务器的路径
//协议
define("PROT",strtolower(strchr($_SERVER["SERVER_PROTOCOL"],"/",true)));
//主机地址
define("HOST",$_SERVER["HTTP_HOST"]);
// 项目的路径
define("APP_URL",substr($_SERVER["SCRIPT_NAME"],0,strrpos($_SERVER["SCRIPT_NAME"],"/")));
//服务器的项目路径
define("HTTP_URL",PROT."://".HOST.APP_URL);
//静态目录的路径
define("STATIC_URL",HTTP_URL."/static");
//smarty路径
define('SMARTY_PATH',LIBS_PATH.'/'.'Smarty'.'/'.'Smarty.class.php');

define("CSS_URL",STATIC_URL."/css");    //css文件路径
define("JS_URL",STATIC_URL."/js");      //js文件路径
define("IMG_URL",STATIC_URL."/img");     //img文件路径
define("FONT_URL",STATIC_URL."/fonts");    //字体文件路径
define("ICONFONTS_URL",STATIC_URL."/iconfonts");    //iconfonts文件路径
define("SELT_URL",PROT . "://" . HOST .$_SERVER['REQUEST_URI']);

define("PAGE_URL", PROT . "://" . HOST . $_SERVER["SCRIPT_NAME"] . "?" . $_SERVER["QUERY_STRING"]);
define("PLUGIN_URL",STATIC_URL."/plugin");
include_once LIBS_PATH."/"."route.class.php";   //路由 的类

include_once SMARTY_PATH;
include_once LIBS_PATH."/main.class.php";   //fu 的类
include_once LIBS_PATH."/uploads.class.php";   //上传的类
include_once LIBS_PATH."/code.class.php";   //验证 的类
include_once LIBS_PATH."/pages.class.php";   //分页 的类
include_once LIBS_PATH."/functions.php";    //db函数

require_once LIBS_PATH."/db.class.php";     //数据库 的类

$routeobj=new route();
$routeobj->set();
