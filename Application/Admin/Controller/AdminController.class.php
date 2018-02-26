<?php
namespace Admin\Controller;
use Think\Controller;

class AdminController extends Controller{
    public function login(){
        if(IS_POST){
            $model = D('Admin');
            if($model->validate($model->_login_validate)->create()){
                if(TRUE === $model->login())
                    redirect(U('Index/index'));//直接跳转
            }
            $this->error($model->getError());
        }
        //显示表单
        $this->display();
    }
    public function verify_code(){
        $verfy = new \Think\Verify(
            array(
                'length'=>4
            )
        );
        $verfy->entry();
    }
}