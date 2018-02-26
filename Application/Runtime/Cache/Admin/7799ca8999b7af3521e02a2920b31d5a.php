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
<!--栏目列表-->
<div class="pad_lr_10">
    <form name="searchform" method="get">
        <table width="100%" cellspacing="0" class="search_form">
            <tbody>
            <tr>
                <td>
                    <div class="explain_col">
                        搜索：
                        <input name="attr_name" type="text" class="input-text" size="25" value="<?php echo ($search["attr_name"]); ?>" />
                        <input type="submit" name="search" class="btn" value="搜索" />
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </form>
    <div class="J_tablelist table_list" data-acturi="<?php echo U('item_cate/ajax_edit');?>">
        <table width="100%" cellspacing="0" id="J_cate_tree">
            <thead>
            <tr>
                <th width="30"><input type="checkbox" name="checkall" class="J_checkall"></th>
                <th>属性名称</th>
                <th>属性类型</th>
                <th>属性可选值</th>
                <th width="180">操作</th>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><tr>
                    <td align='center'><input type='checkbox' value='340' class='J_checkitem'></td>

                    <td align="center"><span data-tdtype='edit' data-field='name' data-id='340' class='tdedit' style='color:'><?php echo ($val["attr_name"]); ?></span>
                    </td>
                    <td align="center"><span data-tdtype='edit' data-field='name' data-id='340' class='tdedit' style='color:'><?php echo ($val["attr_type"]); ?></span>
                    </td>
                    <td align="center"><span data-tdtype='edit' data-field='name' data-id='340' class='tdedit' style='color:'><?php echo ($val["attr_option_values"]); ?></span>
                    </td>
                    <td align='center'>

                        <a href="<?php echo U('Attribute/edit',array('id'=>$val['id'],'type_id'=>$val['type_id'],'p'=>I('get.p',1 )));?>" class="" data-uri="" data-title="" data-id="edit" data-width="520" data-height="360">编辑</a> |
                        <a onclick="return confirm('确定要删除吗？')" href="<?php echo U('Attribute/delete',array('id'=>$val['id']));?>" class="" data-acttype="ajax"
                           data-uri="" data-msg="">删除</a>
                    </td>
                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
            <tr><td colspan="20" align="right"><?php echo ($page); ?></td></tr>
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