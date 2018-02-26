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
<!--广告列表-->
<div class="pad_lr_10">
    <form name="searchform" method="get" >
    <table width="100%" cellspacing="0" class="search_form">
        <tbody>
            <tr>
            <td>
            <div class="explain_col">
            	<input type="hidden" name="g" value="admin" />
                <input type="hidden" name="m" value="ad" />
                <input type="hidden" name="a" value="index" />
                <input type="hidden" name="menuid" value="<?php echo ($menuid); ?>" />
            	<div class="bk3"></div>
                关键字
                <input name="keyword" type="text" class="input-text mr10" size="25" value="<?php echo ($search["keyword"]); ?>" />
                <input type="submit" name="search" class="btn" value="搜索" />
        	</div>
            </td>
            </tr>
        </tbody>
    </table>
    </form>
    
    <div class="J_tablelist table_list" data-acturi="<?php echo U('ad/ajax_edit');?>">
		<table width="100%" cellspacing="0">
        <thead>
          <tr>
            <th><input type="checkbox" name="checkall" class="J_checkall"></th>
            <th><span data-tdtype="order_by" data-field="name">广告名称</span></th>
            <th><span data-tdtype="order_by" data-field="img">图片</span></th>
            <th ><span data-tdtype="order_by" data-field="url">URL</span></th>
             <th><span data-tdtype="order_by" data-field="status">描述</span></th>
            <th>操作</th>
          </tr>
        </thead>
        <tbody>
          <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><tr>
            <td align="center"><input type="checkbox" class="J_checkitem" value="<?php echo ($val["id"]); ?>"></td>
            <td align="center"><span data-tdtype="edit" data-field="name" data-id="<?php echo ($val["id"]); ?>" class="tdedit"><?php echo ($val["name"]); ?></span></td>
              <?php if(!empty($val['img'])): ?><div class="img_border"><td><img src="<?php echo showImage($val['sm_img']);?>" width="32" width="32" class="J_preview" data-bimg="<?php echo showImage($val['sm_img']);?>"></td></div><?php endif; ?>
            <td align="center"><span data-tdtype="edit" data-field="url" data-id="<?php echo ($val["id"]); ?>" class="tdedit"><?php echo ($val["url"]); ?></span></td>
              <td align="center"><span data-tdtype="edit" data-field="url" data-id="<?php echo ($val["id"]); ?>" class="tdedit"><?php echo ($val["desc"]); ?></span></td>

              <td align="center">
            	<a href="<?php echo U('Ad/edit', array('id'=>$val['id']));?>" class="" data-uri="" data-title="" data-id="edit" data-width="520" data-height="410">编辑</a> |
                <a href="<?php echo U('Ad/delete', array('id'=>$val['id']));?>" class="" data-acttype="" data-uri="" data-msg="">删除</a></td>
          </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
      	</table>
		<div class="btn_wrap_fixed">
    		<label class="select_all"><input type="checkbox" name="checkall" class="J_checkall"><?php echo L('select_all');?>/<?php echo L('cancel');?></label>
            <input type="button" class="btn" data-tdtype="batch_action" data-acttype="ajax" data-uri="<?php echo U('ad/delete');?>" data-name="id" data-msg="<?php echo L('confirm_delete');?>" value="<?php echo L('delete');?>" />
    		<div id="pages"><?php echo ($page); ?></div>
    	</div>
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
</body>
<script>
    $('.J_preview').preview(); //查看大图
    $('.J_cate_select').cate_select({top_option:lang.all}); //分类联动
    $('.J_tooltip[title]').tooltip({offset:[10, 2], effect:'slide'}).dynamic({bottom:{direction:'down', bounce:true}});
</script>
</html>