<?php

function sendMail($to,$title,$content){
    require_once('./PHPMailer_v5.1/class.phpmailer.php');
    $mail = new PHPMailer();
    // 设置为要发邮件
    $mail->IsSMTP();
    // 是否允许发送HTML代码做为邮件的内容
    $mail->IsHTML(TRUE);
    // 是否需要身份验证
    $mail->SMTPAuth=TRUE;
    $mail->CharSet='UTF-8';
    /*  邮件服务器上的账号是什么 */
    $mail->From=C('MAIL_ADDRESS');
    $mail->FromName=C('MAIL_FROM');
    $mail->Host=C('MAIL_SMTP');
    $mail->Username=C('MAIL_LOGINNAME');
    $mail->Password=C('MAIL_PASSWORD');
    // 发邮件端口号默认25
    $mail->Port = 25;
    // 收件人
    $mail->AddAddress($to);
    // 邮件标题
    $mail->Subject=$title;
    // 邮件内容
    $mail->Body=$content;
    return($mail->Send());
}

/**
 * @param $imgName
 * @param $dirName
 * @param array $thumb
 * @return array
 */
function uploadOne($imgName,$dirName,$thumb = array()){
    //上传图片
     file_put_contents('b.txt', gettype($_FILES[$imgName]['error']));
    if(isset($_FILES[$imgName]) && $_FILES[$imgName]['error'] == 0){
        file_put_contents('b.txt', $_FILES[$imgName]['error']);
        $rootPath = C('IMG_rootPath');
        $upload = new \Think\Upload(
            array(
                'rootPath' => $rootPath,
            )
        );// 实例化上传类
        $upload->maxSize = (int)C('IMG_maxSize') * 1024 * 1024;// 设置附件上传大小
        $upload->exts  = C('IMG_exts');// 设置附件上传类型
        //$upload->rootPath = './Uploads/'; // 设置附件上传根目录
        $upload->savePath = $dirName; // 设置附件上传（子）目录
        // 上传文件

        $info   =   $upload->upload(array($imgName=>$_FILES[$imgName]));
        file_put_contents('b.txt', 123);
        if(!$info) {// 上传错误提示错误信息
            return array(
                'ok' => 0,
                'error' => $upload->getError(),
            );
        }else{// 上传成功
            $ret['ok'] = 1;
            $ret['images'][0] = $img = $info[$imgName]['savepath'].$info[$imgName]['savename'];
            //判断是否生成缩略图
            if($thumb){
                //生成缩略图
                $image = new \Think\Image();
                //循环生成缩略图
                foreach($thumb as $k => $v){
                    //拼出每个缩略图的文件名
                    $ret['images'][$k+1] = $smImg = $info[$imgName]['savepath'].'thumb_'.$k.'_'.$info[$imgName]['savename'];
                    //打开要处理的图片
                    $image->open($rootPath.$img);
                    $image->thumb($v[0], $v[1])->save($rootPath.$smImg);
                }

            }
            return $ret;
        }
    }
}

/**
 * 显示图片
 * @param $url图片地址
 */
function showImage($url){
    $url = __ROOT__.'/Public/Uploads/'.$url;
    echo $url;
}

/**
 * 删除图片
 * @param $image图片数组
 */
function deleteImage($image){
    //先取出图片所在目录
    $rp = C('IMG_rootPath');
    foreach($image as $v){
        unlink($rp.$v);
    }
}

function hasImage($imgName){
    foreach($_FILES[$imgName]['error'] as $v){
        if($v == 0){
            return TRUE;
        }
        return FALSE;
    }
}