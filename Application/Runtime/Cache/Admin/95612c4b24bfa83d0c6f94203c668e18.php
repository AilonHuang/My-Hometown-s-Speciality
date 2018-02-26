<?php if (!defined('THINK_PATH')) exit();?><!--添加栏目-->
<div class="dialog_content">
	<form id="info_form" action="<?php echo U('Category/add');?>" method="post">
	<table width="100%" class="table_form">
            <tr><th>添加分类</th></tr>
		<tr style="display: none;">
			<td align="center">父分类
				<select name="parent_id" class=" mr10" data-pid="0" data-uri="" data-selected="">
					<option value="0">顶级分类</option>
				</select>
				<input type="hidden" name="pid" id="J_cate_id" />
			</td>
		</tr>
		<tr align="center">
			<td>分类名称
				<input type="text" name="cat_name" id="J_name" class="input-text" size="30">
			</td>
		</tr>
		<tr>
			<td colspan="99" align="center">
				<input type="submit" class="button" value=" 确定 "/>
				<input type="reset" class="button" value=" 重置 "/>
			</td>
		</tr>
	</table>
	</form>
</div>
<script src="/shop/Public/js/fileuploader.js"></script>