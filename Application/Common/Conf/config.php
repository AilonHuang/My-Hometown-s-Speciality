<?php
return array(
	//'配置项'=>'配置值'
    /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'shop',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  '',          // 密码
    'DB_PORT'               =>  '',        // 端口
    'DB_PREFIX'             =>  'shop_',    // 数据库表前缀


    /******************图片相关配置**************/
    'IMG_maxSize' => '3M',
    'IMG_exts' => array('jpg','pjpg','bmp','gif','png','jpeg'),
    'IMG_rootPath' => './Public/Uploads/',
    //'SHOW_PAGE_TRACE' => true,
    /************** 发邮件的配置 ***************/
    'MAIL_ADDRESS' => '529678737@qq.com',   // 发货人的email
    'MAIL_FROM' => '我家特产',      // 发货人姓名
    'MAIL_SMTP' => 'smtp.qq.com',      // 邮件服务器的地址
    'MAIL_LOGINNAME' => '529678737',
    'MAIL_PASSWORD' => '',
    );