<?php if (!defined('THINK_PATH')) exit();?><!--添加栏目-->
<div class="dialog_content">
    <form id="info_form" action="" method="post">
        <table width="100%" class="table_form">
            <tr>
                <td class="label" align="center">属性名称：<input type="text" name="attr_name" value=""/></td>
            </tr>
            <tr>
                <td class="label" align="center">属性类型：
                    <label><input  type="radio" name="attr_type" value="0"/>唯一</label>
                    <label><input type="radio" name="attr_type" value="1"/>可选</label>
                </td>
            </tr>
            <tr>
                <td class="label" align="center">属性可选值：<input placeholder="逗号隔开" type="text" name="attr_option_values" value=""/></td>
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
<script src="/shop/Public/js/jquery/jquery.js"></script>
<script>
    //当选择类型时执行AJAX取出类型的属性
    $("#only").click(function(){
        $("#a").hide();
    });
    $("#select").click(function(){
        $("#a").show();
    });
</script>