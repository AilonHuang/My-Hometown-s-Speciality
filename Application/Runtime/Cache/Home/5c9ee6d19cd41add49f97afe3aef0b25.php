<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>用户登入-<?php echo ($page_seo["title"]); ?></title>
<link href="/shop/Public/weixin/css/shop.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/shop/Public/weixin/js/index.js"></script>
<script type="text/javascript" src="/shop/Public/weixin/js/jquery.js" charset="utf-8"></script>
<script type="text/javascript" src="/shop/Public/weixin/js/ecmall.js" charset="utf-8"></script>
<script type="text/javascript" src="/shop/Public/weixin/js/touchslider.js" charset="utf-8"></script>

<script charset="utf-8" type="text/javascript" src="/shop/Public/weixin/js/jquery_002.js"></script></head>

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

<script type="text/javascript">
$(function(){	

	
    $('#login_form').validate({
//        errorPlacement: function(error, element){
//            $(element).next("label").append(error);
//        },
//        success       : function(label){
//            //label.addClass('validate_right').text('OK!');
//        },
//		onsubmit:true,// 是否在提交是验证
//        onkeyup : false,
//        rules : {
//            username : {
//                required : true,
//			/*	remote   : {
//					url:'index.php?app=member&act=check_user&ajax=1&login=1',
//					type:'get',
//					data:{
//						username : function(){
//                        return $('#username').val();
//                        }
//					}
//				}*/
//            },
//            password : {
//                required : true
//            },
//
//        },
        messages : {
            username : {
                required : '您必须提供一个用户名',
				remote   : '用户名不存在！'
            },
            password  : {
                required : '您必须提供一个密码'
            }
        },
}); 
});
</script>

<div id="content">
    <form method="post" id="login_form" action="<?php echo U('User/login');?>">
            <input name="username" id="username" class="text width5" placeholder="用户名" type="text">
            <label></label>
            <input name="password" id="password" class="text width5" placeholder="密 码" type="password">
            <label></label>                              
            <label id="login_text"></label>
            <input name="Submit" value="登陆" class="enter" type="submit">
            <a href="#" class="clew" style="display:none;">忘记密码？</a>
           <!-- <input name="ret_url" value=" " type="hidden">-->
    </form>
    <div class="login_right">
        <h4>如果您还不是会员，请<a href="<?php echo U('User/register');?>" title="立即注册">立即注册</a></h4>
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