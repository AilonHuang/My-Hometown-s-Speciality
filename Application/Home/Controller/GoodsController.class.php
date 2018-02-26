<?php
namespace Home\Controller;
use Think\Controller;

class GoodsController extends Controller{
    public function cate(){
        
    }
    public function search(){
        if($id = I('get.cid')){
            //分类
            $category = M('Category')->select();
            $this->assign('category',$category);


            $cat_name = I('get.cat_name');
            $data = M('Goods')->where(array('cat_id'=>$id))->select();
            $this->assign('data',$data);
            $this->assign('cat_name',$cat_name);
        }elseif($goods_name = I('get.goods_name')){
            $data = M('Goods')->where(array('goods_name'=>array('like','%'.$goods_name.'%')))->select();
            $this->assign('data',$data);
            $this->assign('goods_name',$goods_name);
            
        }
        $this->display();
    }
    public function index(){
        $id = I('get.id');
        $data = M('Goods')->find($id);
        $this->assign('item',$data);
        $img_list = M('GoodsImgs')->where(array('goods_id'=>$id))->select();
        $this->assign('img_list',$img_list);
        $this->display();
    }
}