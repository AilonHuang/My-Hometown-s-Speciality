<?php if (!defined('THINK_PATH')) exit();?><!--添加栏目-->
<div class="dialog_content">
    <form id="info_form" action="<?php echo U('Type/add');?>" method="post">
        <table width="100%" class="table_form">
            <tr>
                <td class="label" align="center">类型名称：<input  type="text" name="type_name" value="" /></td>
            </tr>
            <tr>
                <td colspan="99" align="center">
                    <input type="submit" class="button" value=" 确定 " />
                    <input type="reset" class="button" value=" 重置 " />
                </td>
            </tr>
        </table>
    </form>
</div>