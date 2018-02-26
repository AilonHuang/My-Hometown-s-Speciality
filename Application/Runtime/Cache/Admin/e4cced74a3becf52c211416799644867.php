<?php if (!defined('THINK_PATH')) exit();?><!--添加广告-->
<div>
    <form id="info_form" action="" method="post" enctype="multipart/form-data">
        <table cellpadding="2" cellspacing="1">
            <tr>
                <th colspan="2">添加广告</th>
            </tr>
            <tr>
                <td>广告名称</td><td><input type="text" name="name" size="40"></td>
            </tr>
            <tr>
                <td align="center">广告URL</td><td><input type="text" name="url" class="input-text" size="40"></td>
            </tr>
            <tr align="center" id="ad_image" class="bill_media">
                <td>广告图片
                  
                </td><td><input type="file" name="img" id="J_img" class="input-text fl mr10" size="30"></td>
            </tr>
            <tr>
                <td align="center">广告描述
                  
                </td>
                <td><input type="text" name="desc" class="input-text fl mr10" size="30"></td>
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