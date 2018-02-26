<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {

    public function __construct()
    {
        //验证登录
        if(!session('id'))
            redirect(U('Admin/Admin/login'));
        //先调用父类的构造方法
        parent::__construct();
    }

    public function index(){


        $this->display();
    }

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