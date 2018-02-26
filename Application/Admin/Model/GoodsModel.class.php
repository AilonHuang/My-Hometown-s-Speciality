<?php
namespace Admin\Model;
use Think\Model;

class GoodsModel extends Model{
    //在添加时调用create方法时允许接收的字段
//    protected $insertFields = array('goods_name','price','goods_desc','is_on_sale');
//    protected $updateFields = array('id,goods_name','price','goods_desc','is_on_sale');

    /**
     * TP在调用add方法之前会自动调用这个方法，我们可以把在插入数据库之前要执行的代码写到这里
     * 说明：在这个函数中要改变这个函数外部的$data，需要按钮引用传递，否则修改也无效
     * 说明：如果return false是指控制器中的add方法返回了false
     * @param $data 就是表单中的数据（要插入到数据库中的数据）是一个一维数组
     * @param $option 额外信息，：当前模型对应的实际的表名是什么
     */
    protected function _before_insert(&$data,$option){
        //运费
        if(I('post.express'!= '0')){
            $data['freight'] = I('post.freight');
        }else{
            $data['freight'] = 0;
        }
        //获取当前时间
        $data['addtime'] = time();
       //上传图片
        $ret = uploadOne('img','Goods/',array(
            array(200,200),
        ));
        if($ret['ok'] == 1){
            $data['img'] = $ret['images'][0];
            $data['sm_img'] = $ret['images'][1];
        }
    }
    protected  function _after_insert(&$data,$option)
    {

        //属性
        $attrID = I('post.attr_id');
        $attrNumber = I('post.attr_number');
        $goodsAttrModel = M('GoodsAttr');
        foreach ($attrID as $k => $v) {
            $goodsAttrModel->add(array(
                'goods_id' => $data['id'],
                'attr_id' => $k,
                'attr_value' => $v,
            ));
        }

        //图片
        if(hasImage('imgs')){
            $goodImgModel = M('GoodsImgs');
            $imgs = array();
            foreach ($_FILES['imgs']['name'] as $k=>$v){
                if($_FILES['imgs']['size'][$k] == 0) {
                    continue;
                }

                $imgs[] = array(
                    'name' => $v,
                    'type' => $_FILES['imgs']['type'][$k],
                    'tmp_name' => $_FILES['imgs']['tmp_name'][$k],
                    'error'=>$_FILES['imgs']['error'][$k],
                    'size'=>$_FILES['imgs']['size'][$k],
                );
            }
            $_FILES = $imgs;
            foreach($imgs as $k=>$v){
                $ret = uploadOne($k,'Goods/',array(
                    array(200,200)
                ));
                if($ret['ok'] == 1){
                    $goodImgModel->add(array(
                        'goods_id' => $data['id'],
                        'img' => $ret['images'][0],
                        'sm_img' => $ret['images'][1],
                    ));
                }
            }

        }
    }
    public function search($pageSize,$isDelete=0,$isOnSale=1){

        /***************搜索****************/
        $where = array();
        $where['is_on_sale'] = $isOnSale;
        $where['is_delete'] = $isDelete;
        $search = array();
        //商品名称搜索
        if($search['goodsName'] = I('get.goods_name'))
            $where['goods_name'] = array('like',"%$search[goodsName]%");
        //商品价格搜索
        $search['startPrice'] = I('get.start_price');
        $search['endPrice'] = I('get.end_price');
        if($search['startPrice'] && $search['endPrice'])
            $where['price'] = array('between',array($search['startPrice'],$search['endPrice']));
        elseif($search['startPrice'])
            $where['price'] = array('egt',$search['startPrice']);
        elseif($search['endPrice'])
            $where['price'] = array('elt',$search['endPrice']);

        //是否上架
        $search['isOnSale'] = I('get.is_on_sale',-1);
        if( $search['isOnSale'] != '-1')
            $where['is_on_sale'] = array('eq', $search['isOnSale']);
        //是否删除
        $search['isDelete'] = I('get.is_delete',-1);
        if($search['isDelete'] != '-1')
            $where['is_delete'] = array('eq', $search['isDelete']);
        //时间搜索
        $search['startAddtime'] = I('get.start_addtime');
        $search['endAddtime']= I('get.end_addtime');
        if( $search['startAddtime'] && $search['endAddtime'])
            $where['addtime'] = array('between',array(strtotime(" $search[startAddtime] 00:00:01"),strtotime("$search[endAddtime] 23:58:59")));
        elseif( $search['startAddtime'])
            $where['addtime'] = array('egt',strtotime("$search[startAddtime] 00:00:01"));
        elseif( $search['endAddtime'])
            $where['addtime'] = array('elt',strtotime(" $search[endAddtime] 23:59:59"));


        /*************翻页****************/
        //总的记录数
        $count = $this->field('a.*,b.cat_name')->alias('a')->join('JOIN shop_category b ON a.cat_id=b.id')->where($where)->count();
        //生成翻页对象
        $page = new \Think\Page($count,$pageSize);
        //获取翻页字符串
        $pageString = $page->show();
        //取出当前页的数据
        $data = $this->field('a.*,b.cat_name')->alias('a')->join('JOIN shop_category b ON a.cat_id=b.id')->where($where)->limit($page->firstRow.','.$page->listRows)->select();
        return array(
            'search'=>$search,
            'page' => $pageString,
            'data' => $data,
        );
    }

    //在控制器中调用delete方法之前会自动调用
    protected function _before_delete($option){
        //先根据id获取图片的路径
        $img = $this->field('img,sm_img')->find($option['where']['id']);
        //从配置文件中取出图片目录
        $rp = C('IMG_rootPath');
        //删除图片
        unlink($rp.$img['img']);
        unlink($rp.$img['sm_img']);

    }

    protected function _before_update(&$data,$option){
        //属性
        $data['id'] = I('post.id');
        $attrID = I('post.attr_id');
        $attrNumber = I('post.attr_number');
        $goodsAttrModel = M('GoodsAttr');
        $goodsAttrModel->where(array('goods_id'=>$data['id']))->delete();
        foreach ($attrID as $k => $v) {
            $goodsAttrModel->add(array(
                'goods_id' => $data['id'],
                'attr_id' => $k,
                'attr_value' => $v,
            ));
        }
        //商品相册
        if(hasImage('imgs')){
            $goodImgModel = M('GoodsImgs');
            $imgs = array();
            foreach ($_FILES['imgs']['name'] as $k=>$v){
                if($_FILES['imgs']['size'][$k] == 0) {
                    continue;
                }

                $imgs[] = array(
                    'name' => $v,
                    'type' => $_FILES['imgs']['type'][$k],
                    'tmp_name' => $_FILES['imgs']['tmp_name'][$k],
                    'error'=>$_FILES['imgs']['error'][$k],
                    'size'=>$_FILES['imgs']['size'][$k],
                );
            }
            $_FILES = $imgs;
            foreach($imgs as $k=>$v){
                $ret = uploadOne($k,'Goods/',array(
                    array(200,200)
                ));
                var_dump($ret);
                if($ret['ok'] == 1){
                    $goodImgModel->add(array(
                        'goods_id' => $data['id'],
                        'img' => $ret['images'][0],
                        'sm_img' => $ret['images'][1],
                    ));
                }
            }
        }
        //判断是否有新图片
        if($_FILES['img']) {
            //上传图片
            $ret = uploadOne('img','Goods/',array(
                array(200,200),
            ));
            if($ret['ok'] == 1){
                //上传成功，把图片路径更新到数据库
                $data['img'] = $ret['images'][0];
                $data['sm_img'] = $ret['images'][1];
                //删除原来的图片
                //获取图片地址
                $goodsModel = M('Goods');
                $imgs = $goodsModel->field('img,sm_img')->where(array('id'=>$data['id']))->select();
                foreach($imgs as $v) {
                    deleteImage($v);
                }
            }
        }


    }
}