<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0"/>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<title>会员中心 - 查看订单</title>
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
                    <a href="<?php echo U('Goods/cate',array('cid'=>$vo['id']));?>" class="none_ico"> <?php echo ($vo["cat_name"]); ?></a>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>
             
            
            </ul>
        </li>
        <li class="r active" id="n_1"><a href="<?php echo U('Index/index');?>"><span></span></a></li>
        <li class="r" id="n_2"><a href="<?php echo U('User/index');?>"><span></span></a></li>
        <li class="r" id="n_3"><a href="<?php echo U('Cart/index');?>"><span></span></a><i></i></li>
    </ul>
    <script type="text/javascript">
    	$(".navlist > li#n_0").click(function(){
			$(this).toggleClass("active");
			
		});
		$(".navlist > li.r a").each(function() {
            href="index.php-app=member&act=login&ret_url=-index.php-app=member.htm"+$(this).attr("href");
			whref=window.location.href;
			if(whref.indexOf(href)!='-1'){
				$(this).parent("li").addClass("active");
			}
        });
    </script>
    
</div>
<div class="content">
    <div class="particular">
        <div class="particular_wrap">
            <dl class="order_detail">
            	<dt class="til_font">订单详情</dt>
                <dt>订单状态</dt>
                <dd>
                <?php switch($order["status"]): case "1": ?>待付款<?php break;?>
                         <?php case "2": ?>待发货<?php break;?>
                         <?php case "3": ?>待收货<?php break;?>
                        <?php default: ?>完成<?php endswitch;?>
                </dd>
                <dt>订单号</dt>
                <dd><?php echo ($order["order_id"]); ?></dd>
                <dt>下单时间</dt>
                <dd><?php echo (date('Y-m-d H:i:s',$order["addtime"])); ?></dd>
            </dl>
     
            <div class="ware_line">
            
                <div class="ware">
                 <?php if(is_array($item_detail)): $i = 0; $__LIST__ = $item_detail;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><div class="ware_list">
                        <div class="ware_pic"><img src="<?php echo showImage($item['img']);?>" height="50" width="50"></div>
                        <div class="ware_text">
                            <div class="ware_text1">
                                <a href="#"><?php echo ($item["title"]); ?></a><br>
                                <span></span>
                            </div>
                            <div class="ware_text2">
                                <span>数量:<strong><?php echo ($item["quantity"]); ?></strong></span>
                                <span>单价:<strong>¥<?php echo ($item["price"]); ?></strong></span>
                            </div>
                        </div>
                    </div><?php endforeach; endif; else: echo "" ;endif; ?>   
                 
                    <div class="transportation">
                    	<!--优惠打折<span>¥0.00</span><br>-->
                    <?php if($order["freetype"] == 0): ?>卖家包邮 <?php else: ?>
                    运费:<span>¥<?php echo ($order["freeprice"]); ?><strong>(<?php switch($order["freetype"]): case "1": ?>平邮<?php break;?>
                         <?php case "2": ?>快递<?php break;?>
                        <?php default: ?>EMS<?php endswitch;?>)</strong></span><?php endif; ?>	
                    	<br>
                    	总价:<b>¥<?php echo ($order["total_price"]); ?></b>
                    </div>
                    <?php if($order["status"] != 1): ?><ul class="order_detail_list">
                       <li>支付方式:<?php switch($order["supportmetho"]): case "1": ?>支付宝<?php break;?>
                        <?php default: ?>货到付款<?php endswitch;?></li>
                     <li>下单时间:<?php echo (date('Y-m-d H:i:s',$order["addtime"])); ?></li>
                    </ul><?php endif; ?>
                   <ul class="order_detail_list">
                      <li>配送快递:  <?php if($order["userfree"] == '0'): ?>无需快递<?php elseif($order["userfree"] != '' and $order["userfree"] != '0' ): echo ($order["userfree"]); else: ?>-<?php endif; ?></li>
                     <li>快递编号:<?php if($order["freecode"] == ''): ?>-<?php else: echo ($order["freecode"]); endif; ?></li>
                     <li>发货时间:<?php if($order["fahuo_time"] == ''): ?>-<?php else: echo (date('Y-m-d H:i:s',$order["fahuo_time"])); endif; ?></li>
                    </ul> 
                     
                </div>
            </div>
			<dl>
				<dt class="til_font">物流信息</dt>
				<dt>收货地址</dt>
				<dd><?php echo ($order["name"]); ?>, &nbsp;<?php echo ($order["mobile"]); ?>, <?php echo ($order["address"]); ?></dd>
				<dt>配送方式</dt>
				<dd><?php switch($order["freetype"]): case "1": ?>平邮<?php break;?>
                         <?php case "2": ?>快递<?php break;?>
                         <?php case "3": ?>EMS<?php break;?>
                        <?php default: ?>卖家包邮<?php endswitch;?></dd>               
            </dl>
        </div>
        <div class="clear"></div>
        <?php if($order["status"] == 1): ?><div class="btn_list">
        	<a class="order_cancel" href="<?php echo U('order/cancelOrder',array('orderId'=>$order['orderId']));?>" id="order118_action_cancel"> 取消订单</a>
	        <a class="order_pay" href="<?php echo U('order/pay',array('orderId'=>$order['orderId']));?>" id="order118_action_pay">付款</a>
        </div><?php endif; ?>
        <div class="adorn_right2"></div>
        <div class="adorn_right3"></div>
        <div class="adorn_right4"></div>
    </div>
    <div class="clear"></div>
</div>
﻿<div id="footer">
    <p class="foot_nav">
        <a href="<?php echo U('Index/index');?>">商城首页</a> | <a href="<?php echo U('User/index');?>">会员中心</a> | <a href="#">品牌介绍</a>
    </p>
    <div style="height:40px; background:#fff; padding:0; overflow:hidden;">
        <div style="float:left; margin:5px 10px 0 0; display:inline;"><img height="20" src="/shop/Public/weixin/images/logo.png"></div>
        <div style="line-height:40px; height:40px; display:inline-block; margin-left:10px; float:right; color:#aaa; font-size:14px;">技术支持</div>
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