<?php if (!defined('THINK_PATH')) exit(); if(is_array($left_menu)): $i = 0; $__LIST__ = $left_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><h3 class="f14"><span class="J_switchs cu on" title="<?php echo L('expand_or_contract');?>"></span><?php echo ($val["name"]); ?></h3>
    <ul>
        <?php if(is_array($val['sub'])): $i = 0; $__LIST__ = $val['sub'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sval): $mod = ($i % 2 );++$i;?><li class="sub_menu"><a href="javascript:;" data-uri="<?php echo U($sval['module_name'].'/'.$sval['action_name'], array('menuid'=>$sval['id'])); echo ($sval["data"]); ?>" data-id="<?php echo ($sval["id"]); ?>" hidefocus="true"><?php echo ($sval["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>

    </ul><?php endforeach; endif; else: echo "" ;endif; ?>
<h3 class="f14"><span class="J_switchs cu on" title="<?php echo L('expand_or_contract');?>"></span>商品管理</h3>
<ul>
    <li class="sub_menu"><a href="javascript:;" data-uri="<?php echo U('Index/index');?>" data-id="" hidefocus="true">后台首页</a></li>
    <li class="sub_menu"><a href="javascript:;" data-uri="<?php echo U('Goods/index');?>" data-id="2" hidefocus="true">商品管理</a></li>
    <li class="sub_menu"><a href="javascript:;" data-uri="<?php echo U('Category/index');?>" data-id="3" hidefocus="true">商品分类</a></li>
    <li class="sub_menu"><a href="javascript:;" data-uri="<?php echo U('Goods/add');?>" data-id="4" hidefocus="true">添加商品</a></li>
    <li class="sub_menu"><a href="javascript:;" data-uri="<?php echo U('Attribute/index');?>" data-id="5" hidefocus="true">属性管理</a></li>
    <li class="sub_menu"><a href="javascript:;" data-uri="<?php echo U('Goods/recyclelist');?>" data-id="6" hidefocus="true">商品回收站</a></li>

</ul>
<h3 class="f14"><span class="J_switchs cu on" title="<?php echo L('expand_or_contract');?>"></span>交易管理</h3>
<ul>
    <li class="sub_menu"><a href="javascript:;" data-uri="<?php echo U('Order/index');?>" data-id="7" hidefocus="true">订单管理</a></li>
</ul>
<h3 class="f14"><span class="J_switchs cu on" title="<?php echo L('expand_or_contract');?>"></span>客户管理</h3>
<ul>
    <li class="sub_menu"><a href="javascript:;" data-uri="<?php echo U('User/index');?>" data-id="<?php echo ($sval["id"]); ?>" hidefocus="true">会员管理</a></li>
</ul>
<h3 class="f14"><span class="J_switchs cu on" title="<?php echo L('expand_or_contract');?>"></span>微信管理</h3>
<ul>
    <li class="sub_menu"><a href="javascript:;" data-uri="<?php echo U('Keyword/addkeyword');?>" data-id="9" hidefocus="true">关键词自动回复</a></li>
    <li class="sub_menu"><a href="javascript:;" data-uri="<?php echo U('Keyword/addmess');?>" data-id="10" hidefocus="true">消息自动回复</a></li>
    <li class="sub_menu"><a href="javascript:;" data-uri="<?php echo U('Keyword/addfollow');?>" data-id="11" hidefocus="true">关注自动回复</a></li>
    <li class="sub_menu"><a href="javascript:;" data-uri="<?php echo U('Ad/add');?>" data-id="12" hidefocus="true">自定义菜单</a></li>

</ul>
<h3 class="f14"><span class="J_switchs cu on" title="<?php echo L('expand_or_contract');?>"></span>首页广告设置</h3>
<ul>
    <li class="sub_menu"><a href="javascript:;" data-uri="<?php echo U('Ad/index');?>" data-id="9" hidefocus="true">广告管理</a></li>
    <li class="sub_menu"><a href="javascript:;" data-uri="<?php echo U('Ad/add');?>" data-id="10" hidefocus="true">添加广告</a></li>
</ul>