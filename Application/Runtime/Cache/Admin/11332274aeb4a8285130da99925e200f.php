<?php if (!defined('THINK_PATH')) exit();?><link rel="stylesheet" type="text/css" href="/shop/Public/weixin/css/dingcan/css2.css"/>
<div class="content-right" style="padding-top:20px;">
</div>
</div>
<div class="showimg" style="display:none">
	<div class="stit">
    	<span>上传图片</span>
        <a href="javascript:zsc_close();"><img src="/shop/Public/weixin/images/dingcan/addpageup_06.jpg" /></a>
    </div>
    <div class="sup">
	<input type="button" value="上传图片" class="uploadbtn"/>
    <form action="<?php echo U('keyword/ajaxupload');?>" method="post" id="zsc_myform" enctype="multipart/form-data" target="yframe"><!-- target="yframe"--><!--target="yframe"-->
    	<input type="file" value="上传图片" class="uploadbtn" style="position:absolute; top:75px; left:20px; filter:alpha(pacity=0);opacity:0; z-index:999;" onchange="zsc_upload()" name="image[]" />大小不超过1M ，仅限png,jpeg,jpg
        <input type="hidden" name="sub" value="submit" /> 
    </form>
	<iframe name="yframe" src="<?php echo U('keyword/ajaxupload');?>" style="border:none; display:none;"></iframe>
    </div>
    <div class="imgbox">
   
    </div>
    <div class="sbottom"><input type="button" class="submit" id="zsc_surebtn" /></div>
     <!-----正在提交------>
    <span class="loadsubmit">正在上传...</span>
</div>
<div class="zhe" style="display:none"></div>
</body>
</html>
<script type="text/javascript" src="/shop/Public/weixin/js/dingcan/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="/shop/Public/weixin/js/dingcan/addmess2.js"></script>
<script>
	$(function(){
	
		$('#menu2_autoreply').show();
		$('.arrow_img_autoreply').attr('src', 'static/weixin/images/index_20.png');
		$('#zsc_keyNew').css("backgroundColor","#D9DDDE");
	});
</script>