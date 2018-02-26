<?php
namespace Admin\Model;
use Think\Model;

class AdModel extends Model{
    protected function _before_insert(&$data,$options) {
        //获取当前时间
        $data['addtime'] = time();
        //上传图片
        $ret = uploadOne('img','Goods/',array(
            array(700,300),
        ));
        if($ret['ok'] == 1){
            $data['img'] = $ret['images'][0];
            $data['sm_img'] = $ret['images'][1];
        }
    }
    protected function _before_update(&$data,$options) {
        $data['id'] = I('post.id');
        var_dump($data);
        //判断是否有新图片
        if($_FILES['img']) {
            //上传图片
            $ret = uploadOne('img','Goods/',array(
                array(700,300),
            ));
            if($ret['ok'] == 1){
                //上传成功，把图片路径更新到数据库
                $data['img'] = $ret['images'][0];
                $data['sm_img'] = $ret['images'][1];
                //删除原来的图片
                //获取图片地址
                $goodsModel = M('Ad');
                $imgs = $goodsModel->field('img,sm_img')->where(array('id'=>$data['id']))->select();
                foreach($imgs as $v) {
                    deleteImage($v);
                }
            }
        }
    }
}