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

<!--栏目列表-->
<div class="pad_lr_10">
    <div class="J_tablelist table_list" data-acturi="<?php echo U('Category/ajax_edit');?>">
        <table width="100%" cellspacing="0" id="J_cate_tree">
            <thead>
            <tr>
                <th width="30"><input type="checkbox" name="checkall" class="J_checkall"></th>

                <th>分类名称</th>
                <th width="180">操作</th>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><tr id='node-340'>
                    <td align='center'><input type='checkbox' value='340' class='J_checkitem'></td>

                    <td><span data-tdtype='edit' data-field='name' data-id='340' class='tdedit' style='color:'><?php echo ($val["cat_name"]); ?></span>
                    </td>


                    <td align='center'>
                        <a href="<?php echo U('Category/edit',array('id'=>$val['id']));?>" class=""
                           data-uri="" data-title=""
                           data-id="edit" data-width="520" data-height="360">编辑</a> |
                        <a onclick="return confirm('确定要删除吗？')" href="<?php echo U('Category/delete',array('id'=>$val['id']));?>" class="" data-acttype="ajax"
                           data-uri="" data-msg="">删除</a>
                    </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            <tr><td colspan="99" align="right"><?php echo ($page); ?></td></tr>
            </tbody>
        </table>
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
<script src="/shop/Public/js/jquery/plugins/jquery.treetable.js"></script>
<script>
    $(function () {
        //initialState:'expanded'
        $("#J_cate_tree").treeTable({indent: 20, treeColumn: 2});
        $(".J_preview").preview();
    });
</script>
</body>
</html>