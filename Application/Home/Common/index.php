<?php

require './Wechat.class.php';
define('APPID', 'wxbb876a4f47f85d18');
define('APPSECRET','9ca0f3b1b0369785ac5de45949c87a9d');
define("TOKEN", "wechat");
$wechat = new WeChat(APPID, APPSECRET, TOKEN);

//第一次验证
//$wechat->firstValid();
$wechat->responseMSG();
