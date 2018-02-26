<?php
namespace Home\Controller;

class IndexController extends BaseController {
    public function _initialize(){
        parent::_initialize();
    }
    public function index(){
        //广告
        $ad = M('Ad')->select();
        $this->assign('ad',$ad);
        //热卖
        $hot = M('Goods')->where(array('is_hot'=>1,'is_delete'=>0))->limit(4)->select();
        $this->assign('hot',$hot);
        //新品
        $news = M('Goods')->where(array('is_new'=>1,'is_delete'=>0))->limit(4)->select();
        $this->assign('news',$news);
        //所以商品
        $goods = M('Goods')->where(array('is_delete'=>0))->select();
        $this->assign('goods',$goods);
        //分类
        $category = M('Category')->select();
        $this->assign('category',$category);
        $this->display();
    }
}