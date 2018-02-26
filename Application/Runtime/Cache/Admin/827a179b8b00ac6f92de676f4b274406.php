<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	
	<link href="/shop/Public/css/admin/style.css" rel="stylesheet"/>
</head>

<body>
<div id="J_ajax_loading" class="ajax_loading"><?php echo L('ajax_loading');?></div>
<?php if(!empty($menu)): ?><div class="subnav">
		<div class="content_menu ib_a blue line_x">
			<a class="add fb " href="<?php echo ($menu["iframe"]); ?>" data-uri="<?php echo ($menu["iframe"]); ?>" data-title="<?php echo ($menu["title"]); ?>" data-id="<?php echo ($menu["id"]); ?>" data-width="<?php echo ($menu["width"]); ?>" data-height="<?php echo ($menu["height"]); ?>"><em><?php echo ($menu["title"]); ?></em></a>　
		</div>
	</div><?php endif; ?>
<!--商品列表-->
<div class="pad_lr_10" >
    <form name="searchform" method="get" >
    <table width="100%" cellspacing="0" class="search_form">
        <tbody>
            <tr>
                <td>
                <div class="explain_col">
                    <!--<input type="hidden" name="g" value="admin" />-->
                    <!--<input type="hidden" name="m" value="item" />-->
                    <!--<input type="hidden" name="a" value="index" />-->
                    <!--<input type="hidden" name="menuid" value="<?php echo ($menuid); ?>" />-->
                    <input type="hidden" name="p">
					<?php if($sm != ''): ?><input type="hidden" name="sm" value="<?php echo ($sm); ?>" /><?php endif; ?>
                    发布时间 :
                    <input type="text" name="start_addtime" id="J_time_start" class="date" size="12" value="<?php echo ($search["startAddtime"]); ?>">
                    -
                    <input type="text" name="end_addtime" id="J_time_end" class="date" size="12" value="<?php echo ($search["endAddtime"]); ?>">

					&nbsp;&nbsp;分类 :
                    <select class="J_cate_select mr10" data-pid="0" data-uri="<?php echo U('item_cate/ajax_getchilds', array('type'=>0));?>" data-selected="<?php echo ($search["selected_ids"]); ?>"></select>
                    <input type="hidden" name="cate_id" id="J_cate_id" value="<?php echo ($search["cate_id"]); ?>" />
          	&nbsp;&nbsp;是否上架 :
          	<select name="is_on_sale" >
          	<option value="-1">--所有--</option>
          	<option <?php if($search["isOnSale"] == 1): ?>selected=''<?php endif; ?> value="1">上架</option>
          	<option <?php if($search["isOnSale"] == 0): ?>selected=''<?php endif; ?> value="0">下架</option>
          	</select>
                    &nbsp;是否删除 :
                    <select name="is_delete" >
                        <option value="-1">--所有--</option>
                        <option <?php if($search["isDelete"] == 1): ?>selected=''<?php endif; ?> value="1">已删除</option>
                        <option <?php if($search["isDelete"] == 0): ?>selected=''<?php endif; ?> value="0">未删除</option>
                        </select>
                    <div class="bk8"></div>
                    价格区间 :
                    <input type="text" name="start_price" class="input-text" size="5" value="<?php echo ($search["startPrice"]); ?>" />
                    -
                    <input type="text" name="end_price" class="input-text" size="5" value="<?php echo ($search["endPrice"]); ?>" />



                    &nbsp;&nbsp;商品名 :
                    <input name="goods_name" type="text" class="input-text" size="25" value="<?php echo ($search["goodsName"]); ?>" />
                    <input type="submit" name="search" class="btn" value="搜索" />

                </div>
                </td>
            </tr>
        </tbody>
    </table>
    </form>
    <div class="J_tablelist table_list" data-acturi="<?php echo U('item/ajax_edit');?>">
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
                <th width=25><input type="checkbox" id="checkall_t" class="J_checkall"></th>
                <th><span data-tdtype="order_by" data-field="id">ID</span></th>
                <th width="40">&nbsp;</th>
                <th align="left"><span data-tdtype="order_by" data-field="goods_name">商品名称</span></th>
                <th width="70"><span data-tdtype="order_by" data-field="buy_num">卖出数量</span></th>
                <th width="60"><span data-tdtype="order_by" data-field="cate_id">分类</span></th>
               
                <th width="70"><span data-tdtype="order_by" data-field="price">价格(元)</span></th>
				
                <th width="40"><span data-tdtype="order_by" data-field="ordid"><?php echo L('sort_order');?></span></th>
                <th width="70"><span data-tdtype="order_by" data-field="status">是否上架</span></th>
                <th width="70"><span data-tdtype="order_by" data-field="status">是否删除</span></th>
                <th width="120"><span data-tdtype="order_by" data-field="add_time">发布时间</span></th>
                <!--<th width="80"><?php echo L('operations_manage');?></th>-->
                <th width="130">操作</th>

            </tr>
        </thead>
    	<tbody>
            <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><tr>
                <td align="center"><input type="checkbox" class="J_checkitem" value="<?php echo ($val["id"]); ?>"></td>
                <td align="center"><?php echo ($val["id"]); ?></td>
                <td align="right">

                    <?php if(!empty($val['img'])): ?><div class="img_border"><img src="<?php echo showImage($val['sm_img']);?>" width="32" width="32" class="J_preview" data-bimg="<?php echo showImage($val['sm_img']);?>"></div><?php endif; ?>
                </td>
                <td align="left"><span data-tdtype="edit" data-field="title" data-id="<?php echo ($val["id"]); ?>" class="tdedit" style="color:<?php echo ($val["colors"]); ?>;"><?php echo ($val["goods_name"]); ?></span></td>
                <td align="center"><b><?php echo ($val["buy_num"]); ?></b></td>
                <td align="center"><b><?php echo ($cate_list[$val['cate_id']]); ?></b></td>
               
                
                <td align="center" class="red"><?php echo ($val["price"]); ?></td>
                <td align="center"><span data-tdtype="edit" data-field="ordid" data-id="<?php echo ($val["id"]); ?>" class="tdedit"><?php echo ($val["ordid"]); ?></span></td>
                <td align="center"><img data-tdtype="toggle" data-id="<?php echo ($val["id"]); ?>" data-field="is_on_sale" data-value="<?php echo ($val["is_on_sale"]); ?>" src="/shop/Public/images/admin/toggle_<?php if($val["is_on_sale"] == 0): ?>disabled<?php else: ?>enabled<?php endif; ?>.gif" /></td>
                <td align="center"><img data-tdtype="toggle" data-id="<?php echo ($val["id"]); ?>" data-field="is_delete" data-value="<?php echo ($val["is_delete"]); ?>" src="/shop/Public/images/admin/toggle_<?php if($val["is_delete"] == 0): ?>disabled<?php else: ?>enabled<?php endif; ?>.gif" /></td>
                <td align="center"><?php echo (date('Y-m-d H:i:s',$val["addtime"])); ?></td>
                <td align="center"><a onclick="return confirm('确定要还原吗？')" href="<?php echo u('Goods/restore', array('id'=>$val['id'], 'menuid'=>$menuid));?>">还原</a> |
                    <a onclick="return confirm('确定要删除吗？')" href="<?php echo U('Goods/delete',array('id'=>$val['id'],'p'=>I('get.p',1)));?>">删除</a></td>

            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    	</tbody>
    </table>
    </div>
    <div class="btn_wrap_fixed">
        <label class="select_all mr10"><input type="checkbox" name="checkall" class="J_checkall">全选/取消</label>
        <input type="button" class="btn" data-tdtype="batch_action" data-acttype="ajax" data-uri="<?php echo U('Goods/delete');?>" data-name="id" data-msg="<?php echo L('confirm_delete');?>" value="删除" />
        <div id="pages"><?php echo ($page); ?></div>
    </div>
</div>
<script src="/shop/Public/js/jquery/jquery.js"></script>
<script src="/shop/Public/js/jquery/plugins/jquery.tools.min.js"></script>
<script src="/shop/Public/js/jquery/plugins/formvalidator.js"></script>
<script src="/shop/Public/js/pinphp.js"></script>
<script src="/shop/Public/js/admin.js"></script>
<script>
//初始化弹窗
(function (d) {
    d['okValue'] = lang.dialog_ok;
    d['cancelValue'] = lang.dialog_cancel;
    d['title'] = lang.dialog_title;
})($.dialog.defaults);
</script>

<?php if(isset($list_table)): ?><script src="/shop/Public/js/jquery/plugins/listTable.js"></script>
<script>
$(function(){
	$('.J_tablelist').listTable();
});
</script><?php endif; ?>
<link rel="stylesheet" href="/shop/Public/js/calendar/calendar-blue.css"/>
<script src="/shop/Public/js/calendar/calendar.js"></script>
<script>
Calendar.setup({
	inputField : "J_time_start",
	ifFormat   : "%Y-%m-%d",
	showsTime  : false,
	timeFormat : "24"
});
Calendar.setup({
	inputField : "J_time_end",
	ifFormat   : "%Y-%m-%d",
	showsTime  : false,
	timeFormat : "24"
});
$('.J_preview').preview(); //查看大图
$('.J_cate_select').cate_select({top_option:lang.all}); //分类联动
$('.J_tooltip[title]').tooltip({offset:[10, 2], effect:'slide'}).dynamic({bottom:{direction:'down', bounce:true}});
</script>
</body>
</html>