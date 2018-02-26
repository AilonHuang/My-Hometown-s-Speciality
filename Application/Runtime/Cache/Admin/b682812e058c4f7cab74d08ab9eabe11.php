<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
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
<!--管理员管理-->
<div class="pad_lr_10">
    <div class="J_tablelist table_list" data-acturi="<?php echo U('admin/ajax_edit');?>">
        <table width="100%" cellspacing="0">
            <thead>
            <tr>
                <th width="40"><input type="checkbox" name="checkall" class="J_checkall"></th>
                <th width="40">ID</th>
                <th><?php echo L('admin_username');?></th>
                <th><?php echo L('admininrole');?></th>
                <th><?php echo L('lasttime');?></th>
      			<th><?php echo L('lastip');?></th>
                <th><?php echo L('status');?></th>
                <th width=100><?php echo L('operations_manage');?></th>
            </tr>
            </thead>
    	    <tbody>
            <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><tr>
                <td align="center"><input type="checkbox" class="J_checkitem" value="<?php echo ($val["id"]); ?>"></td>
                <td align="center"><?php echo ($val["id"]); ?></td>
                <td align="center"><span data-tdtype="edit" data-field="username" class="tdedit" data-id="<?php echo ($val["id"]); ?>"><?php echo ($val["username"]); ?></span></td>
                <td align="center"><?php echo ($val["role"]["name"]); ?></td>
                <td align="center"><?php echo (date('Y-m-d H:i:s',$val["last_time"])); ?></td>
                <td align="center"><?php echo ($val["last_ip"]); ?></td>
                <td align="center">
                    <img data-tdtype="toggle" data-field="status" data-id="<?php echo ($val["id"]); ?>" data-value="<?php echo ($val["status"]); ?>" src="/shop/Public/images/admin/toggle_<?php if($val["status"] == 0): ?>disabled<?php else: ?>enabled<?php endif; ?>.gif" />
                </td>
                <td align="center">
                    <a href="javascript:;" class="J_showdialog" data-uri="<?php echo U('admin/edit', array('id'=>$val['id']));?>" data-title="<?php echo L('edit');?> - <?php echo ($val["username"]); ?>"  data-id="edit" data-width="450" data-height="210"><?php echo L('edit');?></a> | 
                    <a href="javascript:;" class="J_confirmurl" data-uri="<?php echo U('admin/delete', array('id'=>$val['id']));?>" data-msg="<?php echo sprintf(L('confirm_delete_one'),$val['username']);?>"><?php echo L('delete');?></a>
                </td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
    	   </tbody>
        </table>
    </div>
    <div class="btn_wrap_fixed">
		<label class="select_all mr10"><input type="checkbox" name="checkall" class="J_checkall"><?php echo L('select_all');?>/<?php echo L('cancel');?></label>
    	<input type="button" class="btn" data-tdtype="batch_action" data-acttype="ajax" data-uri="<?php echo U('admin/delete');?>" data-name="id" data-msg="<?php echo L('confirm_delete');?>" value="<?php echo L('delete');?>" />
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
</body>
</html>