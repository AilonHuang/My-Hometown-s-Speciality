<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0"/>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<title>会员中心 - 我的地址</title>
<link href="/shop/Public/weixin/css/shop.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/shop/Public/weixin/js/jquery.js" charset="utf-8"></script>
<script type="text/javascript" src="/shop/Public/weixin/js/ecmall.js" charset="utf-8"></script>
<script type="text/javascript" src="/shop/Public/weixin/js/touchslider.dev.js" charset="utf-8"></script>

<script charset="utf-8" type="text/javascript" src="/shop/Public/weixin/js/dialog.js" id="dialog_js"></script>
<script charset="utf-8" type="text/javascript" src="/shop/Public/weixin/js/jquery.ui.js" ></script>
<script charset="utf-8" type="text/javascript" src="/shop/Public/weixin/js/jquery.validate.js" ></script>
<script charset="utf-8" type="text/javascript" src="/shop/Public/weixin/js/mlselection.js" ></script>
<script type="text/javascript" language="javascript" src='/shop/Public/weixin/js/dizhi2.js'></script>
<script type="text/javascript" language="javascript" src='/shop/Public/weixin/js/diqu2.js'></script>
<link rel="stylesheet" type="text/css" href="/shop/Public/weixin/css/jquery.ui.css" /></head>









<body onLoad="setup()">



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
<script type="text/javascript" src="/shop/Public/weixin/js/jquery_002.js" charset="utf-8"></script>
<script type="text/javascript">
//<!CDATA[
$(function(){
    regionInit("region");
    $('#address_form').validate({
        /*errorPlacement: function(error, element){
            var _message_box = $(element).parent().find('.field_message');
            _message_box.find('.field_notice').hide();
            _message_box.append(error);
        },
        success       : function(label){
            label.addClass('validate_right').text('OK!');
        },*/
        errorLabelContainer: $('#warning'),
        invalidHandler: function(form, validator) {
           var errors = validator.numberOfInvalids();
           if(errors)
           {
               $('#warning').show();
           }
           else
           {
               $('#warning').hide();
           }
        },
        onkeyup : false,
        rules : {
            consignee : {
                required : true
            },
            sheng : {
                required : true
              
            },
            address   : {
                required : true
            },
            phone_mob : {
                required : true,
                minlength:6,
                digits : true
            }
        },
        messages : {
            consignee : {
                required : '请填写收货人姓名. '
            },
            sheng : {
                required : '请选择所在地区. '
             
            },
            address   : {
                required : '请填写详细地址. '
            },
            phone_mob : {
                required : '固定电话和手机请至少填写一项. ',
                minlength: '错误的手机号码,只能是数字,并且不能少于6位. ',
                digits : '错误的手机号码,只能是数字,并且不能少于6位. '
            }
        }
    });
});
function check_phone(){
    return ($('[name="phone_tel"]').val() == '' && $('[name="phone_mob"]').val() == '');
}
function hide_error(){
    $('#region').find('.error').hide();
}
//]]>
</script>
<div class="eject_con" id="content">
    <div class="add">
    
        <div id="warning"></div>
        <form method="post" action="<?php echo U('User/address');?>" id="address_form">
        <input type="hidden" name="id" value="<?php echo ($info["id"]); ?>" />
            <ul class="form_address">
                <li>
                    <!-- <h3>收货人姓名: </h3> -->
                    <input class="text width_normal" value="<?php echo ($info["name"]); ?>" name="consignee" placeholder="请填写您的真实姓名" type="text">
                    <label class="field_message"><span class="field_notice"></span></label>
                </li>
                <li>
                    <!-- <h3>所在地区: </h3> -->
                  <!--  <div id="region">
                         <input name="region_id" value="" id="region_id" class="mls_id" type="hidden">
                         <input name="region_name" value="" class="mls_names" type="hidden">
                         <select onchange="hide_error();">
                           <option selected="selected">请选择...</option>
                           <option value="1">中国</option>
                         </select>
                       
                         <b class="field_message" style="font-weight:normal;"><label class="field_notice"></label></b>
                    </div>-->
            <select name="sheng" id="s1"></select>
<select name="shi" id="s2"></select>
<select name="qu" id="s3"></select>
                </li>
                
                 	<script language="javascript">
								new PCAS("sheng","shi","qu","<?php echo ($info["province"]); ?>","<?php echo ($info["city"]); ?>","<?php echo ($info["area"]); ?>");
				</script>
                
                <li>
                    <!-- <h3>详细地址: </h3> -->
                    <input value="<?php echo ($info["address"]); ?>" class="text width_normal" name="address" placeholder="不必重复填写地区" type="text"><label class="field_message"><span class="field_notice"></span></label>
                </li>
                <li>
                    <!-- <h3>手机号码:</h3> -->
                    <input value="<?php echo ($info["mobile"]); ?>" class="text width_normal" name="phone_mob" placeholder="电话号码" type="text"><label class="field_message"><span class="field_notice"></span></label>
                </li>
            </ul>
            <div class="submit">
                <input class="btn enter" value="新增地址" type="submit">
            </div>
        </form>
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

</body></html>