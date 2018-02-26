<?php
namespace Admin\Model;
use Think\Model;

class AttributeModel extends Model{
    public function search(){

        /***************搜索****************/
        $where = array();
        $search = array();

        if(I('get.attr_name'))
            $where['attr_name'] = I('get.attr_name');




        /*************翻页****************/
        //总的记录数
        $count = $this->where($where)->count();
        //生成翻页对象
        $page = new \Think\Page($count,2);
        //获取翻页字符串
        $pageString = $page->show();
        //取出当前页的数据
        $data = $this->where($where)->limit($page->firstRow.','.$page->listRows)->select();
        echo $this->getLastSql();
        return array(
            'search'=>$search,
            'page' => $pageString,
            'data' => $data,
        );
    }
}