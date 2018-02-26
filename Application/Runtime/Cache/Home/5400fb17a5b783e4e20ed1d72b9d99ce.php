<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0"/>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<title>支付页面</title>
<link href="/shop/Public/weixin/css/shop.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/shop/Public/weixin/js/jquery.js" charset="utf-8"></script>
<script type="text/javascript" src="/shop/Public/weixin/js/ecmall.js" charset="utf-8"></script>
<script type="text/javascript" src="/shop/Public/weixin/js/touchslider.dev.js" charset="utf-8"></script>
<script type="text/javascript">
//<!CDATA[
var SITE_URL = "http://store.weiapps.cn";
var REAL_SITE_URL = "http://store.weiapps.cn";
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
</head>

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
    <form action="<?php echo U('Order/end');?>" method="POST" id="goto_pay">
    <input type="hidden" name="orderid" value="<?php echo ($orderid); ?>" />
       <input type="hidden" name="dingdanhao" value="<?php echo ($dingdanhao); ?>" />
        <div class="step_main">
            <div class="clue_on"><h4>订单提交成功！</h4><p>您的订单已成功生成，选择您想用的支付方式进行支付</p></div>
            <div class="order_information">
                    <p>订单号<span><?php echo ($dingdanhao); ?></span></p>订单总价<span>¥<?php echo ($order_sumPrice); ?></span>
            </div>

            <div class="buy">
                <h3>选择支付方式并付款</h3>
                    <dl class="defray">
                        <dt>在线支付</dt>
                        <dd>
                            <p class="radio"><input checked='checked' id="payment_alipay" name="payment_id" value="1" type="radio"></p>
                            <p class="logo"><label for="payment_alipay"><img src="/shop/Public/weixin/images/zhi.png" ></label></p>
                            <p class="explain">欢迎使用支付宝</p>
                        </dd>
                    </dl>
                    <dl class="defray">
                        <dt>线下支付</dt>
                        <dd>
                            <p class="radio"><input id="payment_cod" name="payment_id" value="2" type="radio"></p>
                            <p class="logo"><label for="payment_cod"><img  src="/shop/Public/weixin/images/huodao.png"></label></p>
                            <p class="explain">欢迎使用货到付款</p>
                        </dd>
                    </dl>           
            </div>
            <div class="make_sure">
                <p>
                    <a href="javascript:$('#goto_pay').submit();" class="btn enter">确认支付</a>
                </p>
            </div>
            <!--<div class="remark">
                商品将于5工作日内送达。<a href="#">配送范围请查看</a>。<br />
                您可以在 <a href="#">我的订单</a>  中查看或取消您的订单，由于系统需进行订单预处理，您可能不会立刻查询到刚提交的订单。<br />
                如果您现在不方便支付，可以随后到 <a href="#">我的订单</a>  完成支付，我们会在48小时内为您保留未支付的订单。
            </div>-->
            <div class="clear"></div>
        </div>
    </form>
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