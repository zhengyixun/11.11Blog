<?php
/* Smarty version 3.1.30, created on 2017-11-15 09:36:03
  from "D:\360Downloads\wamp64\www\1703\11-01mvc\template\index\header.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a0c0a83b7e9c9_76237584',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c0076f96fe2357f2f7e3a4725ace4e2fdb608652' => 
    array (
      0 => 'D:\\360Downloads\\wamp64\\www\\1703\\11-01mvc\\template\\index\\header.html',
      1 => 1510233805,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a0c0a83b7e9c9_76237584 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!doctype  HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo CSS_URL;?>
/bootstrap.css">
    <link rel="stylesheet" href="<?php echo CSS_URL;?>
/headerLogin.css">
    <link rel="stylesheet" href="<?php echo ICONFONTS_URL;?>
/iconfont.css">
    <?php echo '<script'; ?>
 src="<?php echo JS_URL;?>
/jquery-3.2.1.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo JS_URL;?>
/headerLogin.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo JS_URL;?>
/jquery-hcheckbox.js"><?php echo '</script'; ?>
>
    <title>header</title>
</head>
<body>
<header>
    <div class="headLeft">
        Blog
    </div>
    <span class="do"><a href="index.php">发现</a></span>
    <span class="do"><a href="index.php?m=index&f=index&a=guanzhu">关注</a></span>
    <span class="do">消息</span>
    <div class="search">
        <input type="text" placeholder="搜索">
    </div>
    <span class="login">
        <?php if ($_smarty_tpl->tpl_vars['logins']->value == null) {?>
        <a href="index.php?m=index&f=indexLogin">登录/注册</a>
        <?php } else { ?>
        <a href="javascript:;"><?php echo $_smarty_tpl->tpl_vars['nichengs']->value;?>
</a>
        <?php }?>
    </span>
    <?php if ($_smarty_tpl->tpl_vars['logins']->value == null) {?>
    <div class="reg" id="reg11">
        <a href="index.php?m=index&f=indexLogin&a=init" id="Img1">
            <img  src="<?php echo IMG_URL;?>
/header.jpg" alt="">
            <div class="angel"></div>
        </a>
    </div>
    <?php } else { ?>
    <div class="reg" id="reg1">
        <a href="javascript:;" id="Img">
            <img src="<?php echo $_smarty_tpl->tpl_vars['photos']->value;?>
" alt="">
            <div class="angel"></div>
        </a>
        <!--下拉列表-->
        <ul class="lists" style="display: none;z-index: 99">
            <li>
                <a href="index.php?m=index&f=index&a=ownPage" >
                    <div class="iconfont icon-wodezhuye"></div>
                    <span>我的主页</span>
                </a>
            </li>
            <li>
                <a href="index.php?m=index&f=index&a=self" >
                    <div class="iconfont icon-wodezhuye"></div>
                    <span>我的信息</span>
                </a>
            </li>
            <li>
                <a href="index.php?m=index&f=index&a=carcar">
                    <div class="iconfont icon-qianbao"></div>
                    <span>购物车</span>
                </a>
            </li>
            <li>
                <a href="index.php?m=index&f=index&a=carcar" >
                    <div class="iconfont icon-qianbao"></div>
                    <span>我的钱包</span>
                </a>
            </li>
            <li>
                <a href="index.php?m=index&f=indexLogin&a=unsets">
                    <div class="iconfont icon-tuichu"></div>
                    <span>退出</span>
                </a>
            </li>
        </ul>
    </div>
    <?php }?>
    <div class="reg write">
        <a href="index.php?m=index&f=index&a=writeText" id="tex">写文章</a>
    </div>
</header>
<?php }
}
