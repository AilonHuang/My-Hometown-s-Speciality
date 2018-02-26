<?php if (!defined('THINK_PATH')) exit();?><html>
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
                <li><a href="<?php echo U('Goods/cate',array('cid'=>$vo['id']));?>" class="none_ico">搜索一下？</a></li>
                <?php if(is_array($category)): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                        <a href="<?php echo U('Goods/cate',array('cid'=>$vo['id']));?>" class="none_ico"><?php echo ($vo["cat_name"]); ?></a>
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
<div class="s_bottom"></div>
<script type="text/javascript">
    $(function () {
        $("div.module_special .wrap .major ul.list li:last-child").addClass("remove_bottom_line");
    });
    var active = 0,
            as = document.getElementById('pagenavi').getElementsByTagName('a');

    for (var i = 0; i < as.length; i++) {
        (function () {
            var j = i;
            as[i].onclick = function () {
                t2.slide(j);
                return false;
            }
        })();
    }
    var t2 = new TouchSlider({id: 'sliderlist', speed: 600, timeout: 6000, before: function (index) {
            as[active].className = '';
            active = index;
            as[active].className = 'active';
        }});
</script>


<div id="content">
    <div class="module_special tbr">
        <h2 class="common_title veins2">
            <div class="ornament1"></div>
            <div class="ornament2"></div>
            <span class="ico1">
                <span class="ico2">
                    <input type="text" placeholder="输入关键词搜索" /><input type="submit" value="搜索" />
                </span>
            </span>
        </h2>
        <div class="wrap">
            <div class="wrap_child">
                <div class="major">
                    <ul class="list">
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="module_special tbr">
        <h2 class="common_title veins2">
            <div class="ornament1"></div>
            <div class="ornament2"></div>
            <span class="ico1">
                <span class="ico2"><?php echo ($page_seo["title"]); ?></span>
            </span>
        </h2>
        <div class="wrap">
            <div class="wrap_child">
                <div class="major">
                    <ul class="list">
                        <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?><li>
                                <div class="pic">
                                    <a href="<?php echo U('Item/index',array('id'=>$item['id']));?>"><img  src="<?php echo showImage($item['img']);?>"></a>
                                </div>
                                <div class="good_content">
                                    <h3>
                                        <a  href="<?php echo U('Item/index',array('id'=>$item['id']));?>"><?php echo ($item["goods_name"]); ?></a>
                                    </h3>
                                    <p>¥<?php echo ($item["price"]); ?></p>
                                </div>
                                <span class="show_good">
                                    <a  href="<?php echo U('Item/index',array('id'=>$item['id']));?>"></a>
                                </span>
                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="clear">
    </div>
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