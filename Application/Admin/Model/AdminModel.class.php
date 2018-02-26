<?php
namespace Admin\Model;
use Think\Model;

class AdminModel extends Model{
     //登录时表单验证规则
    public $_login_validate = array(
            array('username','require','用户名不能为空！',1),
            array('password','require','密码不能为空！',1),
            array('verify_code','require','验证码不能为空！',1),
            array('verify_code','verify_code','验证码错误！',1,'callback'),
        );
    //添加和修改管理员时的规则
    public $_validate = array(
        array('username','require','用户名不能为空！',1),
        array('password','require','密码不能为空！',1),
        array('verify_code','require','验证码不能为空！',1),
        array('verify_code','verify_code','验证码错误！',1,'callback'),
    );
    public function verify_code($code){
        $verfy = new \Think\Verify();
        return $verfy->check($code);
    }
    public function login(){

        //获取表单中的用户名和密码
        $username = $this->username;
        $password = $this->password;

        $user = $this->where(
          array(
              'username' => array('eq',$username),
          )
        )->find();

        //判断有没有帐号
        if($user){
            //判断是否启用,超级管理员不能禁用
            if($user['id'] == 1 || $user['is_use'] == 1){
                //判断密码
                if($user['password'] == sha1($password)){
                    //把id和用户名存到session中
                    session('id',$user['id']);
                    session('username',$user['username']);
                    return TRUE;
                }
            }
        }else{
            $this->error = '用户名不存在！';
            return FALSE;
        }
    }
}