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
<script charset="utf-8" src="/shop/Public/weixin/js/jquery.js" type="text/javascript"></script>
   <script>
		     $(function(){
		    
        	 $('#express').change(function(){
        	  if($(this).val()==1)
        	  {
        	  	$('#address_form').show();
        	  }else
        	  {
        	  		$('#address_form').hide();
        	  }
        	 });
        	 set_address();
        })
        
          function set_address()
          {
          	 var addr_id =$("#express").find("option:selected").val();
          	
           if(addr_id == 1)
            {
               
                $('#address_form').show();
            }
            else
            {
                $('#address_form').hide();
     
            }
          }
		    </script>
<!--添加商品-->
<div class="subnav">
    <h1 class="title_2 line_x">添加商品</h1>
</div>
<form id="info_form" action="<?php echo u('Goods/add');?>" method="post" enctype="multipart/form-data">
<div class="pad_lr_10">
	<div class="col_tab">
		<ul class="J_tabs tab_but cu_li">
			<li class="current">基本信息</li>
            <li>展示图片</li>
            <li>附加属性</li>
		</ul>
		<div class="J_panes">
        <div class="content_list pad_10">
		<table width="100%" cellpadding="2" cellspacing="1" class="table_form">
			<tr>
				<th width="120">所属分类 :</th>
                <td>
                    <select name="cat_id" class="J_cate_select mr10" data-pid="0" data-uri="<?php echo U('item_cate/ajax_getchilds', array('type'=>0));?>" data-selected="">
                        <?php if(is_array($catData)): $i = 0; $__LIST__ = $catData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?><option value="<?php echo ($val["id"]); ?>"><?php echo ($val["cat_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </td>
			</tr>
            <tr>
				<th>商品名称 :</th>
				<td><input type="text" name="goods_name" id="J_title" class="input-text" size="60"></td>
			</tr>
			<tr>
                <th>商品简介 :</th>
                <td><textarea name="goods_intro" cols="80" rows="2"></textarea></td>
            </tr>
            <tr>
				<th>商品图片 :</th>
				<td><input type="file" name="img" /></td>
 			</tr>
		
            <tr>
				<th>商品价格 :</th>
				<td><input id='J_price' onkeyup="this.value=this.value.replace(/[^0-9.]/g,'')" onafterpaste="this.value=this.value.replace(/[^0-9.]/g,'')" type="text" name="price" class="input-text" size="10"> 元</td>
			</tr>
		    <tr>
				<th>商品库存 :</th>
				<td><input name="goods_stock" id='J_goods_stock' onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" type="text" name="goods_stock" class="input-text" size="10"> </td>
			</tr>
		    <tr>
		      <!--<th>是否推荐:</th>--><td></td>
		      <td><input type="checkbox" name="is_new" value="1">新品&nbsp;
                  <input type="checkbox" name="is_hot" value="1">热卖
                  <input type="checkbox" checked name="is_on_sale" value="1">上架
              </td>
		    </tr>
		     <tr>
		      <th>运费:</th>
		      <td>
                  <select id='express' name="express">
                      <option value="0">卖家承担运费</option>
                      <option  value="1">买家承担运费</option>
                  </select>
		      </td>
		    </tr>
		    <tr id="address_form" style="display:none;">
		    <th></th>
		    <td>
		      运费:<input onkeyup="value=value.replace(/[^\d\.]/g,'')" type="text" name="freight" />
		    </tr>
           <tr>
                <th>商品详情 :</th>
                <td><textarea name="goods_desc" id="info" style="width:68%;height:400px;visibility:hidden;resize:none;"></textarea></td>
            </tr>
		</table>
		</div>
        <div class="content_list pad_10 hidden">
            <table width="100%" cellpadding="2" cellspacing="1" class="table_form" id="first_upload_file">
                <tbody class="uplode_file">
                <tr>
                    <th width="100"><a href="javascript:void(0);" class="blue" onclick="add_file();"><img src="/shop/Public/css/admin/bgimg/tv-expandable.gif" /></a> 上传文件 :</th>
                    <td><input type="file" name="imgs[]"></td>
                </tr>
                </tbody>
            </table>
        </div>
		<!-- 属性页 -->
        <div class="content_list pad_10 hidden">
            <table width="100%" cellpadding="2" cellspacing="1" class="table_form" id="item_attr">
                <tbody id="attr_container">
                <?php if(is_array($attrData)): $i = 0; $__LIST__ = $attrData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i; if($val['attr_type'] == 0): ?><tr>
                        <td>  <?php echo ($val["attr_name"]); ?>:<input type="text" name="attr_id[<?php echo ($val['id']); ?>]"></td></tr><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
                <tr>
                </tr>
            </table>
		</div>
        </div>
		<div class="mt10"><input type="submit" value="<?php echo L('submit');?>" class="btn btn_submit"></div>
	</div>
</div>
</form>

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
<script type="text/javascript">
$('.J_cate_select').cate_select('请选择');
$(function() { 		   
	$('ul.J_tabs').tabs('div.J_panes > div');
	//自动获取标签
	$('#J_gettags').live('click', function() {
		var title = $.trim($('#J_title').val());
		if(title == ''){
			$.pinphp.tip({content:lang.article_title_isempty, icon:'alert'});
			return false;
		}
		$.getJSON('<?php echo U("item/ajax_gettags");?>', {title:title}, function(result){
			if(result.status == 1){
				$('#J_tags').val(result.data);
			}else{
				$.pinphp.tip({content:result.msg});
			}
		});
	});
	$.formValidator.initConfig({formid:"info_form",autotip:true});
	$("#J_title").formValidator({onshow:'请填写商品名称',onfocus:'请填写商品名称'}).inputValidator({min:1,onerror:'请填写商品名称'});
	$("#J_price").formValidator({onshow:'请填写商品价格',onfocus:'请填写商品价格'}).inputValidator({min:1,onerror:'请填写商品价格'});
	$("#J_goods_stock").formValidator({onshow:'请填写商品库存',onfocus:'请填写商品库存'}).inputValidator({min:1,onerror:'请填写商品库存'});
});

function add_file()
{
    $("#next_upload_file .uplode_file").clone().insertAfter($("#first_upload_file .uplode_file:last"));
}
function del_file_box(obj)
{
	$(obj).parent().parent().remove();
}
function add_attr()
{
    $("#hidden_attr .add_item_attr").clone().insertAfter($("#item_attr .add_item_attr:last"));
}
function del_attr(obj)
{
	$(obj).parent().parent().remove();
}
</script>
<table id="next_upload_file" style="display:none;">
<tbody class="uplode_file">
   <tr>
      <th width="100"><a href="javascript:void(0);" onclick="del_file_box(this);" class="blue"><img src="/shop/Public/css/admin/bgimg/tv-collapsable.gif" /></a>上传文件 :</th>
      <td><input type="file" name="imgs[]"></td>
   </tr>
</tbody>
</table>
<table id="hidden_attr" style="display:none;">
<tbody class="add_item_attr">
<tr>
    <th width="200">
    <a href="javascript:void(0);" class="blue" onclick="del_attr(this);"><img src="/shop/Public/css/admin/bgimg/tv-collapsable.gif" /></a>属性名 :<input type="text" name="attr[name][]" class="input-text" size="20">
    </th>
    <td>属性值 :<input type="text" name="attr[value][]" class="input-text" size="30"></td>
</tr>
</tbody>
</table>
</body>
</html>
<script src="/shop/Public/js/kindeditor/kindeditor.js"></script>	
<script>

$(function() {
	KindEditor.create('#info', {
		uploadJson : '<?php echo U("attachment/editer_upload");?>',
		fileManagerJson : '<?php echo U("attachment/editer_manager");?>',
		allowFileManager : true
	});
	$('ul.J_tabs').tabs('div.J_panes > div');
});
</script>


<script>

	//点击加号
	function addnew(a){
	    //选中a所在的tr
        var tr = $(a).parent().parent();
        //获取a里面的内容
        if($(a).html() == '<img src="/shop/Public/css/admin/bgimg/tv-expandable.gif">'){
            //把tr克隆一份
            var newTr = tr.clone();
            //把克隆出来的 + 变成 -
            newTr.find('a').html('<img src="/shop/Public/css/admin/bgimg/tv-collapsable.gif">');
            //放在后面
            tr.after(newTr);
        }else{
            tr.remove();
        }


    }
</script>