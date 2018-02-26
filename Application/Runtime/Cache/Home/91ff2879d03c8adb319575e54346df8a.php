<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>我家特产</title>
<meta name="keywords" content="<?php echo ($page_seo["keywords"]); ?>" />
<meta name="description" content="<?php echo ($page_seo["description"]); ?>" />
<meta content="width=device-width,minimum-scale=1.0,maximum-scale=1.0" name="viewport">
<script src="/shop/Public/js/jquery/jquery.js"></script>
<script type="text/javascript" src="/shop/Public/weixin/js/index.js"></script>
<link type="text/css" rel="stylesheet" href="/shop/Public/weixin/css/shop.css">
<script charset="utf-8" src="/shop/Public/weixin/js/jquery.js" type="text/javascript"></script>
<script charset="utf-8" src="/shop/Public/weixin/js/ecmall.js" type="text/javascript"></script>
<script charset="utf-8" src="/shop/Public/weixin/js/touchslider.dev.js" type="text/javascript"></script>
<script charset="utf-8" src="/shop/Public/weixin/js/goodsinfo.js" type="text/javascript"></script>
<script charset="utf-8" type="text/javascript" src="/shop/Public/weixin/js/jquery_002.js"></script></head>
<script type="text/javascript">
//<!CDATA[
var SITE_URL = "index.php-app=member&act=login&ret_url=-index.php-app=member.htm";
var REAL_SITE_URL = "index.php-app=member&act=login&ret_url=-index.php-app=member.htm";
var PRICE_FORMAT = '¥%s';

$(function(){
    var span = $("#child_nav");
    span.hover(function(){
        $("#float_layer:not(:animated)").show();
    }, function(){
        $("#float_layer").hide();
    });
});
//]]>
</script>
<script charset="utf-8" type="text/javascript" src="/shop/Public/weixin/js/dialog.js" id="dialog_js"></script>
<script charset="utf-8" type="text/javascript" src="/shop/Public/weixin/js/jquery.ui.js" ></script>
<script charset="utf-8" type="text/javascript" src="/shop/Public/weixin/js/jquery.validate.js" ></script>
<script charset="utf-8" type="text/javascript" src="/shop/Public/weixin/js/mlselection.js" ></script>
<link rel="stylesheet" type="text/css" href="/shop/Public/weixin/css/jquery.ui.css" /></head>

<body>



<div id="head">
    <img height="50" src="/shop/Public/images/store_logo.jpg">
</div>
<div id="nav">
    <ul class="navlist">
        <li id="n_0">
            <span ></span>
            <ul class="submenu">
                <?php if(is_array($category)): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                        <a href="<?php echo U('Goods/search',array('cid'=>$vo['id'],'cat_name'=>$vo['cat_name']));?>" class="none_ico"><?php echo ($vo["cat_name"]); ?></a>
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>


            </ul>
        </li>
        <li class="r active" id="n_1"><a href="<?php echo U('Index/index');?>"><span></span></a></li>
        <li class="r" id="n_2"><a href="<?php echo U('User/index');?>"><span></span></a></li>
        <li class="r" id="n_3"><a href="<?php echo U('Cart/index');?>"><span></span></a><i></i></li>
    </ul>
    <script type="text/javascript">
        $(".navlist > li#n_0").click(function () {
            $(this).toggleClass("active");

        });
        $(".navlist > li.r a").each(function () {
            href = "index.php-app=member&act=login&ret_url=-index.php-app=member.htm" + $(this).attr("href");
            whref = window.location.href;
            if (whref.indexOf(href) != '-1') {
                $(this).parent("li").addClass("active");
            }
        });
    </script>

</div>

<div id="content">
    <div class="wrap">
        <div class="eject_btn" title="新增地址"><a class="enter" href="<?php echo U('user/addaddress');?>">新增地址</a></div> 
        <!-----------
        <ul class="address_list">
            <li class="no_address">
            <span class="noaddress">您没有添加收货地址</span>
            </li>
        </ul>
        ------>
        <ul class="address_list">
        <?php if(is_array($address_list)): $i = 0; $__LIST__ = $address_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                <p><?php echo ($vo["name"]); ?>(<?php echo ($vo["mobile"]); ?>)</p>
                <p><?php echo ($vo["province"]); ?>&nbsp;<?php echo ($vo["city"]); ?>&nbsp;<?php echo ($vo["area"]); ?>&nbsp;<?php echo ($vo["address"]); ?></p>
                <p class="new_line"><br /></p>
                <p class="address_action">
                    <span class="edit"><a href="<?php echo U('User/edit_address',array('id'=>$vo['id']));?>"><i class="edit_icon"></i>编辑</a></span>
                    <span><a href="<?php echo U('User/address',array('id'=>$vo['id'],'type'=>'del'));?>" class="delete float_none"><i class="delete_icon"></i>删除</a></span>
                </p>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <div class="public table" style="display:none;">
            <table class="table_head_line">
               
                <tr class="line_bold">
                    <th colspan="6"></th>
                </tr>
                <tr class="line tr_color">
                    <th>收货人姓名</th>
                    <th>所在地区</th>
                    <th class="width3">详细地址</th>
                    <th>邮政编码</th>
                    <th class="width5">电话/手机</th>
                    <th>操作</th>
                </tr>
                
                <tr>
                    <td colspan="6" class="member_no_records padding6">您没有添加收货地址</td>
                </tr>
            </table>
        </div>
        <div class="wrap_bottom"></div>
    </div>
</div>



﻿<div id="footer">
    <p class="foot_nav">
        <a href="<?php echo U('Index/index');?>">商城首页</a> | <a href="<?php echo U('User/index');?>">会员中心</a> | <a href="#">品牌介绍</a>
    </p>
    <div style="height:40px; background:#fff; padding:0; overflow:hidden;">
        <!--<div style="float:left; margin:5px 10px 0 0; display:inline;"><img height="20" src="/shop/Public/weixin/images/logo.png"></div>-->
        <!--<div style="line-height:40px; height:40px; display:inline-block; margin-left:10px; float:right; color:#aaa; font-size:14px;">技术支持</div>-->
    </div>
</div>

<script>
var PINER = {
    root: "/shop",
    uid: "<?php echo $visitor['id'];?>", 
    async_sendmail: "<?php echo $async_sendmail;?>",
    config: {
        wall_distance: "<?php echo C('pin_wall_distance');?>",
        wall_spage_max: "<?php echo C('pin_wall_spage_max');?>"
    },
    //URL
    url: {}
};
//语言项目
var lang = {};
<?php $_result=L('js_lang');if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>lang.<?php echo ($key); ?> = "<?php echo ($val); ?>";<?php endforeach; endif; else: echo "" ;endif; ?>
</script>
<pin:load type="js" href="/shop/Public/js/jquery/plugins/jquery.tools.min.js,/shop/Public/js/jquery/plugins/jquery.masonry.js,/shop/Public/js/jquery/plugins/formvalidator.js,/shop/Public/js/fileuploader.js,/shop/Public/js/pinphp.js,/shop/Public/js/front.js,/shop/Public/js/dialog.js,/shop/Public/js/wall.js,/shop/Public/js/item.js,/shop/Public/js/user.js,/shop/Public/js/album.js" />
</body>
</html>