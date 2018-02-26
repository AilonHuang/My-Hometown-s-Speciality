<?php
namespace Home\Controller;
use Think\Controller;

class BaseController extends Controller{
    public function _initialize(){
//        var_dump($_SESSION);
        session('uid','3');
        if(session('uid')){
//            session(null);
        }elseif(session('openid')){
            //判断此openid是否已经注册
            $userModel = M('User');
            $user = $userModel->field('id')->where(array('openid'=>session('openid')))->find();
            //如果未注册    
            if(!$user){
                $data['username'] = session('username');
                $data['openid'] = session('openid');
                $data['addtime'] = time();
                $id = $userModel->add($data);
                session('uid',$id);
            }else{
                session('uid',$user['id']);
            }
            session('url',null);
            session('openid',null);
        }else{
            //获取微信用户的openid
            R('Wechat/getUserDetail');
        }
    }
    
    
}