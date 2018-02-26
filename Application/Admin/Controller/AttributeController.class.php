<?php
namespace Admin\Controller;
use Think\Controller;

class AttributeController extends Controller{
    public function index(){
        $model = D('Attribute');
        //获取带翻页的数据
        $data = $model->search();
        $this->assign(
            array(
                'data'=>$data['data'],
                'page'=>$data['page'],
                'search'=>$data['search'],
            )
        );
        var_dump($data);
//        // 接收当前类型的type_id
//        $typeId = I('get.type_id');
//        $this->assign('typeId',$typeId);
//        //取出所有类型
//        $typeModel = M('Type');
//        $typeData = $typeModel->select();
//        $this->assign('typeData',$typeData);
        $menu = array(
            'title'=> '添加属性',
            'iframe' => U('Attribute/add'),
        );
        $this->assign('menu',$menu);
        $this->display();
    }
    public function add(){
        if(IS_POST){
            $model = D('Attribute');
            if($model->create(I('post.'),1)){
                if($id = $model->add()){
                    $this->success('添加成功',U('Attribute/index?p='.I('get.p',1),'&type_id='.I('get.type_id')));
                    exit;
                }
            }
            $this->error($model->getError());
        }


        $this->display();
    }

    public function delete(){
        $model = D('Attribute');
        $model->delete(I('get.id'));
        $this->success('操作成功',U('index?p='.I('get.p',1)));
    }

    public function edit(){
        //处理表单
        if(IS_POST){
            $model = M('Attribute');
            if($model->create(I('post.'),2)){
                if(FALSE !== $model->save()){
                    $this->success('操作成功',U('index',array('p'=>I('get.p'),'type_id'=>I('get.type_id'))));
                    // 停止执行后面的代码
                    exit;
                }

            }
            //如果失败
            //显示错误，并跳回上一个页面
            $this->error($model->getError());
        }
        //接收id
        $id = I('get.id');
        $typeId = I('get.type_id');
        $this->assign('typeId',$typeId);
        //从数据库取出要修改的信息
        $model = M('Attribute');
        $data = $model->find($id);
        $this->assign('data',$data);
        $typeModel = M('Type');
        $typeData = $typeModel->select();
        $this->assign('typeData',$typeData);
        //显示表单
        $this->display();
    }
}