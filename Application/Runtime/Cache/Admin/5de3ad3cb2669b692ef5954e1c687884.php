<?php if (!defined('THINK_PATH')) exit();?><!--添加栏目-->
<div class="dialog_content">
	<form id="info_form" action="<?php echo U('Attribute/edit',array('type_id'=>$typeId,'p'=>I('get.p',1)));?>" method="post">
		<table width="100%" class="table_form">

			<tr>
				<td class="label" align="center">所在的类型的id：
					<select name="type_id" id="">
						<option value="">选择类型</option>
						<?php if(is_array($typeData)): $i = 0; $__LIST__ = $typeData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><option <?php if($typeId == $val['id']): ?>selected="selected"<?php endif; ?> value="<?php echo ($val["id"]); ?>" ><?php echo ($val["type_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					</select>
				</td>
			</tr>
			<tr>
				<td class="label" align="center">属性名称：<input type="text" name="attr_name" value="<?php echo ($data["attr_name"]); ?>"/></td>
			</tr>
			<tr>
				<td class="label" align="center">属性类型：<?php echo ($data["attr_type"]); ?>
					<label><input <?php if(0 == $data['arrt_type']): ?>selected<?php endif; ?> type="radio" name="attr_type" value="0"/>唯一</label>
						<label><input  <?php if($data['attr_type'] == 1): ?>selected<?php endif; ?> type="radio" name="attr_type" value="1"/>可选</label>
				</td>
			</tr>
			<tr>
				<td class="label" align="center">属性可选值：<input placeholder="逗号隔开" type="text" name="attr_option_values" value="<?php echo ($data["attr_option_values"]); ?>"/></td>
			</tr>
			<tr>
				<td colspan="99" align="center">
					<input type="submit" class="button" value=" 确定 "/>
					<input type="reset" class="button" value=" 重置 "/>
				</td>
			</tr>
		</table>
		<input type="hidden" name="id" value="<?php echo ($data["id"]); ?>">
	</form>
</div>