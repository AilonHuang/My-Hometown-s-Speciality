<?php
namespace Admin\Controller;
use Think\Controller;

class CategoryController extends Controller{
    public function index(){
        $model = M('Category');
        $data = $model->select();
        $this->assign('data',$data);
        //menu (标题，地址，弹窗ID，宽，高)
        $menu = array(
            'title' => '添加分类',
            'iframe' => U('Category/add'),
        );
        $this->assign('menu',$menu);
        $this->display();
    }
    public function add(){
        if(IS_POST){
            $model = D('Category');
            if($model->create(I('post.'),1)){
                if($id = $model->add()){
                    $this->success('添加成功',U('Category/index',array('p'=>I('get.p'))));
                    exit;
                }
            }
            $this->error($model->getError());
        }

        $this->display();
    }
    public function delete(){
        $model = D('Category');
        $model->delete(I('get.id'));
        $this->success('操作成功',U('index?p='.I('get.p')));
    }
    public function edit(){
        //处理表单
        if(IS_POST){
            $model = M('Category');
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
        //接收的id
        $id = I('get.id');
        //从数据库取出要修改的信息
        $model = M('Category');
        $data = $model->find($id);
        $this->assign('data',$data);
        var_dump($data);
        //显示表单
        $this->display();
    }
}