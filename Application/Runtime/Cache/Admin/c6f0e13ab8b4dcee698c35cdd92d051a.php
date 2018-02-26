<?php if (!defined('THINK_PATH')) exit();?><!--添加广告-->
<div class="dialog_content">
    <form id="info_form" action="<?php echo U('Ad/edit');?>" method="post" enctype="multipart/form-data">
        <table width="100%" cellpadding="2" cellspacing="1" class="table_form">
            <tr>
                <td widtd="80"  align="center">广告名称
                    <input value="<?php echo ($data["name"]); ?>" type="text" name="name" id="name" class="input-text" size="40"></td>
            </tr>
            <tr>
                <td align="center">广告URL
                    <input value="<?php echo ($data["url"]); ?>" type="text" name="url" class="input-text" size="40"></td>
            </tr>
            <tr align="center" id="ad_image" class="bill_media">
                <td>广告图片
                    <input type="file" name="img" id="J_img" class="input-text fl mr10" size="30">
                    <img src="<?php echo showImage($data['sm_img']);?>" />
                </td>
            </tr>
            <tr>
                <td align="center">广告描述
                    <input value="<?php echo ($data["desc"]); ?>" type="text" name="desc" class="input-text fl mr10" size="30">
                </td>
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