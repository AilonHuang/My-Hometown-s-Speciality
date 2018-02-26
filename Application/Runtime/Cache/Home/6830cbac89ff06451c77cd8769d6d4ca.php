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
<link href="/shop/Public/weixin/css/dialog.css" rel="stylesheet" type="text/css">
<script charset="utf-8" type="text/javascript" src="/shop/Public/weixin/js/jquery_003.js"></script>
<script charset="utf-8" type="text/javascript" src="/shop/Public/weixin/js/zh-CN.js"></script>
<script charset="utf-8" type="text/javascript" src="/shop/Public/weixin/js/jquery_002.js"></script>
<link rel="stylesheet" type="text/css" href="/shop/Public/weixin/css/jquery.css">
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


<div class="content">



    <h3 class="membertop">
       <p class="my_name"><a href="#">  <?php echo ($visitor["username"]); ?></a></p>
       <p class="my_address"><a href="<?php echo U('user/address');?>">收货地址管理</a></p>
    </h3>
    <ul class="buyer_stat">
          <li class="btn_1 <?php if($status == 1): ?>active<?php endif; ?> "><a href="<?php echo U('User/index',array('status'=>1));?>">待付款</a><span>待付款</span></li>        
          <li class="btn_2 <?php if($status == 2): ?>active<?php endif; ?> "><a href="<?php echo U('User/index',array('status'=>2));?>">待发货</a><span>待发货</span></li>
          <li class="btn_3 <?php if($status == 3): ?>active<?php endif; ?>"><a href="<?php echo U('User/index',array('status'=>3));?>">待收货</a><span>待收货</span></li>
          <li class="btn_4 <?php if($status == 4): ?>active<?php endif; ?>"><a href="<?php echo U('User/index',array('status'=>4));?>">已完成</a><span>已完成</span></li>
    </ul>
	<script type="text/javascript">
    $(function(){
    $(".buyer_stat > li a").each(function() {
                href="http://store.weiapps.cn/"+$(this).attr("href");
                if(window.location.href==href){
                    $(this).parent("li").addClass("active");
                }
            });
    });
    </script>
    
    
    
    
    <div class="wrap">
        <div class="public">
        
            <?php if(!empty($item_orders)): if(is_array($item_orders)): $i = 0; $__LIST__ = $item_orders;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="order_form">
                    <p class="num">订单号: <?php echo ($vo["order_id"]); ?></p>
                    <?php if(is_array($vo["items"])): $i = 0; $__LIST__ = $vo["items"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><div class="con">
                        <p class="ware_pic"><a href="<?php echo U('Goods/index',array('id'=>$item['itemId']));?>" ><img src="<?php echo showImage($item['img']);?>" height="80" width="80"></a></p>
                        <p class="ware_text"><a href="<?php echo U('Goods/index',array('id'=>$item['itemId']));?>"><?php echo ($item["title"]); ?></a><br><span class="attr"></span></p>
                        <p class="price">价格: <span>¥<?php echo ($item["price"]); ?></span></p>
                        <p class="amount">数量: <span><?php echo ($item["quantity"]); ?></span></p>
                    </div><?php endforeach; endif; else: echo "" ;endif; ?>
                    <div class="clear"></div>
                    <div class="foot">
                        <p class="time">添加时间:<?php echo (date('Y-m-d H:i:s',$vo["addtime"])); ?></p>
                         <div class="handle">
                            <div style="float:left;">
                                订单总价: <b id="order118_order_amount">¥<?php echo ($vo["total_price"]); ?>&nbsp;&nbsp;</b>
                            </div>   
                         <?php switch($vo["status"]): case "1": ?><!--待付款 -->
                           <a href="<?php echo U('Order/pay',array('orderId'=>$vo['order_id']));?>" id="order118_action_pay" class="btn">付款</a>
                          
                            <a href="<?php echo U('order/cancelOrder',array('orderId'=>$vo['order_id']));?>" id="order118_action_cancel"> 取消订单</a>
                            <a href="<?php echo U('order/checkOrder',array('orderId'=>$vo['order_id'],'status'=>$status));?>" >查看订单</a><?php break;?>
                         <?php case "2": ?><!--待发货 -->
                            <a href="<?php echo U('order/checkOrder',array('orderId'=>$vo['order_id'],'status'=>$status));?>" >查看订单</a><?php break;?>
                         <?php case "3": ?><!-- 待收货 -->
                            <a href="<?php echo U('order/confirmOrder',array('orderId'=>$vo['order_id'],'status'=>$status));?>" id="order118_action_confirm" >确认收货</a>
                            <a href="<?php echo U('order/checkOrder',array('orderId'=>$vo['order_id'],'status'=>$status));?>" >查看订单</a><?php break;?>
                        <?php default: ?>
                         <a href="<?php echo U('order/checkOrder',array('orderId'=>$vo['order_id'],'status'=>$status));?>" >查看订单</a><?php endswitch;?>                     
                        </div>
                    </div>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
            <?php else: ?>
           <div class="order_form member_no_records">
                <span>没有符合条件的记录</span>
            </div><?php endif; ?>
        
            
            <div class="order_form_page">
                <div class="page">
            	</div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="wrap_bottom"></div>
    </div>     
    
    
    
    
    
    
    <div class="wrap_line margin1" style="display:none;">
            <div class="public_index">
                <div class="information_index">
                    <div class="awoke">
                        您目前还没有已生成的订单<br>去<a href="#">商城首页</a>，挑选喜爱的商品，体验购物乐趣吧。
                    </div>
                </div>

            </div>
            <div class="wrap_bottom"></div>
        </div>
    <div class="clear"></div>
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