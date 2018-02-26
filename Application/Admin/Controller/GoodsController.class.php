<?php

namespace Admin\Controller;


class GoodsController extends IndexController{

    public function index(){
        $model = D('Goods');
        //获取带翻页的数据
        $data = $model->search(5);
        $this->assign(
            array(
                'data'=>$data['data'],
                'page'=>$data['page'],
                'search'=>$data['search'],
            )
        );
        $menu = array(
            'title'=> '添加商品',
            'url' => U('Goods/add'),
        );
        $this->assign('menu',$menu);
        $this->display();
    }
    public function recycle(){
        $model = M('Goods');
        $model->where(array(
            'id'=>array('eq',I('get.id'))
        ))->setField(array('is_delete'=>1,'is_on_sale'=>0));
        $this->success('放入回收站成功',U('index',array('p'=>I('get.p',1))));
    }
    public function restore(){
        $model = M('Goods');
        $model->where(array(
            'id'=>array('eq',I('get.id'))
        ))->setField(array('is_delete'=>0,'is_on_sale'=>1));
        $this->success('还原成功',U('recyclelist',array('p'=>I('get.p',1))));
    }
    public function recyclelist(){
        $model = D('Goods');
        //获取带翻页的数据
        $data = $model->search(5,1,0);
        $this->assign(
            array(
                'data'=>$data['data'],
                'page'=>$data['page'],
                'search'=>$data['search'],
            )
        );
        $menu = array(
            'title'=> '商品列表',
            'url' => U('Goods/index'),
        );

        $this->assign($menu);
        $this->display();
    }
    public function add(){

        if(IS_POST){
            $model = D('Goods');

            if($a = $model->create(I('post.'),1)){
                if($model->add()){
                    $this->success('操作成功',U('index'));
                    // 停止执行后面的代码
                    exit;
                }
            }
            //如果失败
            $error = $model->getError();
            //显示错误，并跳回上一个页面
            $this->error($error);
        }
        $catModel = M('Category');
        $catData = $catModel->select();
        $this->assign('catData',$catData);
        $attrModel = M('Attribute');
        $attrData = $attrModel->select();
        $this->assign('attrData',$attrData);
        $this->display();
    }

    public function delete(){
        $model = D('Goods');
        $model->delete(I('get.id'));
        $this->success('操作成功',U('index?p='.I('get.p')));
    }

    public function edit(){
        //处理表单
        if(IS_POST){
            $model = D('Goods');
            if($model->create(I('post.'),2)){
                if(FALSE !== $model->save()){
                    $this->success('操作成功',U('index?p='.I('get.p')));
                    // 停止执行后面的代码
                    exit;
                }
            }
            //如果失败
            //显示错误，并跳回上一个页面
            $this->error($model->getError());
        }
        //接收商品的id
        $id = I('get.id');
        //从数据库取出要修改的信息
        $model = M('Goods');
        $data = $model->find($id);
        $this->assign('data',$data);
        //取得分类
        $catModel = M('Category');
        $catData = $catModel->select();
        $this->assign('catData',$catData);
        //取得所有属性
        $attrModel = M('Attribute');
        $attrData = $attrModel->select();
        $this->assign('attrData',$attrData);
        //取得商品属性
        $goodsAttrModel = M('GoodsAttr');
        //SELECT a.*,b.* FROM goods_attr as a LEFT JOIN goods_attribute as b ON a.attr_id=b.id
        $tmp = $goodsAttrData = $goodsAttrModel->field('a.*,b.*')->alias('a')->join('LEFT JOIN shop_attribute b ON a.attr_id=b.id')->where(array('a.goods_id'=>array('eq',$data['id'])))->select();
        $goodsAttrData='';
        foreach($tmp as $k=>$v) {
            $goodsAttrData[$v['attr_id']] = $v['attr_value'];
        }
        $this->assign('goodsAttrData',$goodsAttrData);
        //取得商品图片
        $goodsImgModel = M('GoodsImgs');
        $goodsImgData = $goodsImgModel->where(array('goods_id'=>$data['id']))->select();
        $this->assign('goodsImgData',$goodsImgData);
        //显示表单
        $this->display();
    }
    public function ajaxDelImage(){
        $imgId = I('get.img_id');
        $goodsImgModel = M('GoodsImgs');
        $img = $goodsImgModel->field('img,sm_img')->find($imgId);
        deleteImage($img);
        $goodsImgModel->delete($imgId);

    }
}