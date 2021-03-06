<?php if (!defined('THINK_PATH')) exit();?><html>
<head>
<meta content="width=device-width,minimum-scale=1.0,maximum-scale=1.0" name="viewport">
<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
<title>购物车</title>
<link type="text/css" rel="stylesheet" href="/shop/Public/weixin/css/shop.css">
<script charset="utf-8" src="/shop/Public/weixin/js/jquery.js" type="text/javascript"></script>
<script charset="utf-8" src="/shop/Public/weixin/js/ecmall.js" type="text/javascript"></script>
<script charset="utf-8" src="/shop/Public/weixin/js/touchslider.dev.js" type="text/javascript"></script>
<script type="text/javascript">
//<!CDATA[
var SITE_URL = "index.php-app=member&act=login&ret_url=-index.php-app=member.htm"/*tpa=http://store.weiapps.cn/*/;
var REAL_SITE_URL = "index.php-app=member&act=login&ret_url=-index.php-app=member.htm"/*tpa=http://store.weiapps.cn/*/;
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
<script type="text/javascript" src="/shop/Public/weixin/js/cart.js" charset="utf-8"></script>

<div id="content">
<?php if(count($_SESSION['cart'])==0){ ?>
    <div class="null_shopping">
          <div class="cart_pic"></div>
          <h4>您还没有宝贝，赶快去逛逛吧！</h4>
          <p>
              <a class="enter" href="<?php echo U('Index/index');?>">马上去逛逛</a>
          </p>
      </div>  
   <?php }else{ ?>   
   <!--<h3 id="chose_all"><b class="ico">全选商品</b></h3>-->
    <ul class="cart_list">
    
     <?php if(is_array($item)): $i = 0; $__LIST__ = $item;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li id="cart_item_<?php echo ($vo["id"]); ?>">
              <p class="goods_info">
                  <span class="img"><a href="<?php echo U('Item/index',array('id'=>$vo['id']));?>" ><img src="<?php echo showImage($vo['img']);?>" height="80" width="80"></a></span>
                  <span class="tit">
                      <a href="<?php echo U('Goods/index',array('id'=>$vo['id']));?>" ><?php echo ($vo["goods_name"]); ?></a><br>
                      <span>价格:</span><span class="price1">¥<?php echo ($vo["price"]); ?></span><br>
                      <span>数量:</span>
                      <span>
                          <img src="/shop/Public/weixin/images/subtract.gif" onClick="decrease_quantity(<?php echo ($vo["id"]); ?>);" alt="decrease" style="vertical-align: middle;width:16px">
                           <input id="input_item_<?php echo ($vo["id"]); ?>" value="<?php echo ($vo["num"]); ?>" orig="1" changed="<?php echo ($vo["num"]); ?>" onKeyUp="change_quantity(<?php echo ($vo["id"]); ?>, this);" class="text1 width3" type="text" style="height:20px;">
                          <img src="/shop/Public/weixin/images/adding.gif" onClick="add_quantity(<?php echo ($vo["id"]); ?>);" alt="increase" style="vertical-align: middle;width:16px">
                      </span><br>
                      <span>
                          <a class="del" href="javascript:;" onClick="drop_cart_item(<?php echo ($vo["id"]); ?>);"> <img src="/shop/Public/weixin/images/del.png"  style="vertical-align: middle;height:20px;width:20px"></a>
                      </span>
                  </span>
              </p>
              <p class="buy_info">
                  <span class="total">
                      <span>小计:</span>
                      <span class="price2" id="item<?php echo ($vo["id"]); ?>_subtotal">¥<?php echo sprintf("%01.2f",$vo['num']*$vo['price']); ?></span>
                  </span>
              </p>                        
          </li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
   
    <div class="buy_foot">
        <p class="goods_amount">
            <span>商品总价:</span>
            <strong class="fontsize1" id="cart_amount">¥<?php echo ($sumPrice); ?></strong>
        </p>
        <p class="jiesuan_btn">
            <a href="<?php echo U('order/jiesuan');?>" class="btn"><span>去结算</span><img src="/shop/Public/weixin/images/jiesuan.png" width="50%"></a>
        </p>
    </div>
    <?php } ?>
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