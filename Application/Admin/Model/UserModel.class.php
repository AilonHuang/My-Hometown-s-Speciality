<?php
namespace Admin\Model;
use Think\Model;

class UserModel extends Model{
     //登录时表单验证规则
    public $_login_validate = array(
            array('username','require','用户名不能为空！',1),
            array('password','require','密码不能为空！',1),
            array('verify_code','require','验证码不能为空！',1),
            array('verify_code','verify_code','验证码错误！',1,'callback'),
        );
    public function verify_code($code){
        $verfy = new \Think\Verify();
        return $verfy->check($code);
    }

    protected function _before_insert(&$data,$option){
        $data['addtime'] = time();
        $data['email_code'] = sha1(uniqid());
        $data['password'] = sha1($data['password']);
    }

    protected function _after_insert($data,$option){
        $content = <<<EFO
        欢迎您成为本站会员，请点击以下链接完成emial验证<br>
        <a href="http://yilunhuang.eicp.net/shop/index.php/Home/User/emailchk/code/{$data['email_code']}">点击完成验证</a>
EFO;

        sendMail($data['email'],'我家特产网-邮箱验证',$content);
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
            //判断密码
            if($user['password'] == sha1($password)){
                //把id和用户名存到session中
                session('uid',$user['id']);
                session('username',$user['username']);
                return TRUE;
            }

        }else{
            $this->error = '用户名不存在！';
            return FALSE;
        }
    }
}