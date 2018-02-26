<?php
namespace Admin\Controller;
use Think\Controller;
class AdController extends Controller {

    public function index(){
        $data = M('Ad')->select();
        $this->assign('data',$data);
        $this->display();
    }

    public function add(){
        if(IS_POST){
            $model = D('Ad');
            if($a = $model->create(I('post.'),1)){
                var_dump($a);
                if($model->add()){
                    $this->success('添加成功',U('Ad/index'));
                    exit;
                }
            }
            $this->error($model->getError());
        }
        $this->display();
    }
    public function edit(){
        if(IS_POST){
            $model = D('Ad');
            if($a = $model->create(I('post.'),1)){
                if($model->save()){
                    $this->success('添加成功',U('Ad/index'));
                    exit;
                }
            }
            $this->error($model->getError());
        }
        $id = I('get.id');
        $model = M('Ad');
        $tmp = $data = $model->where(array('id'=>$id))->select();
        $data = '';
        $data = $tmp[0];
        $this->assign('data',$data);
        $this->display();
    }
}