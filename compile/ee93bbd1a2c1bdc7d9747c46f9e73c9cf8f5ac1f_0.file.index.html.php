<?php
/* Smarty version 3.1.30, created on 2017-11-15 09:36:03
  from "D:\360Downloads\wamp64\www\1703\11-01mvc\template\index\index.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5a0c0a83a28ae5_62566052',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ee93bbd1a2c1bdc7d9747c46f9e73c9cf8f5ac1f' => 
    array (
      0 => 'D:\\360Downloads\\wamp64\\www\\1703\\11-01mvc\\template\\index\\index.html',
      1 => 1510638941,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a0c0a83a28ae5_62566052 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender($_smarty_tpl->tpl_vars['header']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

    <link rel="stylesheet" href="<?php echo CSS_URL;?>
/index.css">
    <?php echo '<script'; ?>
 src="<?php echo JS_URL;?>
/jquery-1.7.1.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo JS_URL;?>
/jquery.slider.js"><?php echo '</script'; ?>
>
<main>
<div class="headBox"></div>
    <div class="banner slider">
        <div class="imgBox"><a href="#"><img style="width: 1000px;height: 300px" src="<?php echo IMG_URL;?>
/dt1.jpg" alt=""></a></div>
        <div class="imgBox"><a href="#"><img style="width: 1000px;height: 300px" src="<?php echo IMG_URL;?>
/dt3.jpg" alt=""></a></div>
        <div class="imgBox"><a href="#"><img style="width: 1000px;height: 300px" src="<?php echo IMG_URL;?>
/dt4.jpg" alt=""></a></div>
        <div class="imgBox"><a href="#"><img style="width: 1000px;height: 300px" src="<?php echo IMG_URL;?>
/dt5.jpg" alt=""></a></div>
    </div>
    <!--推荐位-->

    <div class="category">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['result']->value, 'v');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['v']->value) {
?>
        <div class="cSon">
            <a href="index.php?m=index&f=index&a=positions&posid=<?php echo $_smarty_tpl->tpl_vars['v']->value['pid'];?>
" style="display: block;width: 100%;height: 100%">
                <!--背景图片-->
                <div class="cSonImg"><img src="<?php echo $_smarty_tpl->tpl_vars['v']->value['pthumb'];?>
" alt=""></div>
                <!--文字-->
                <span><?php echo $_smarty_tpl->tpl_vars['v']->value['pname'];?>
</span>
            </a>
        </div>
       <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

    </div>
    <!--推荐位结束-->
    <!--文章展示开始-->
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['result2']->value, 'v2');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['v2']->value) {
?>
    <div class="text">
        <div class="textTop">
            <div class="textTopImg">
                <img src="<?php echo $_smarty_tpl->tpl_vars['v2']->value['photo'];?>
" alt="">
            </div>
            <span><?php echo $_smarty_tpl->tpl_vars['v2']->value['uname'];?>
</span>
            <span>10小时以前</span>
        </div>
        <div class="textMid">
            <h4><a href="index.php?m=index&f=index&a=blogCon&cid=<?php echo $_smarty_tpl->tpl_vars['v2']->value['cid'];?>
"><?php echo $_smarty_tpl->tpl_vars['v2']->value['ctitle'];?>
</a></h4>
            <p><?php echo mb_substr($_smarty_tpl->tpl_vars['v2']->value['ccon'],0,100,"utf-8");?>
</p>
        </div>
        <div class="textBot">
            <div class="textCate">心理</div>
            <div class="textBotImg">
                <img src="<?php echo IMG_URL;?>
/eyey.png" alt="">
            </div>
            <span>30</span>

            <div class="textBotImg">
                <img src="<?php echo IMG_URL;?>
/info.png" alt="">
            </div>
            <span>300</span>

            <div class="textBotImg">
                <img src="<?php echo IMG_URL;?>
/love.png" alt="">
            </div>
            <span>30</span>
        </div>
        <div class="pic">
            <img src="<?php echo $_smarty_tpl->tpl_vars['v2']->value['thumb'];?>
" alt="">
        </div>
    </div>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

    <!--文章展示结束-->
    <!--分类-->
    <div class="list">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['result1']->value, 'v1');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['v1']->value) {
?>
        <div class="listSon">
            <a href="index.php?m=index&f=index&a=categoryCon&cid=<?php echo $_smarty_tpl->tpl_vars['v1']->value['cid'];?>
">
                <span><?php echo $_smarty_tpl->tpl_vars['v1']->value['cname'];?>
</span>
            </a>
            <div class="imgPng">
                <img src="<?php echo $_smarty_tpl->tpl_vars['v1']->value['cimage'];?>
" style="width: 90px;height: 50px">
            </div>
        </div>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

        <div class="down">
           <div class="downImg">
               <img src="<?php echo IMG_URL;?>
/down.jpg" alt="">
           </div>
            <h5>下载APP></h5>
            <h6>随时随地发现和创作内容</h6>
        </div>
        <div class="listSon say">查看更多</div>
    </div>
</main>
</body>
<?php echo '<script'; ?>
 type="text/javascript">
    jQuery(document).ready(function ($) {
        $(".slider").slideshow({
            width: 1000,
            height: 300,
            transition: ['bar', 'Rain', 'square', 'squareRandom', 'explode']
        });
    });
<?php echo '</script'; ?>
>
</html><?php }
}
