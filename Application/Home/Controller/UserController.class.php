<?php

namespace Home\Controller;

use Think\Controller;

class UserController extends Controller {
    public function _initialize(){
        
    }
    public function index() {
        $orderModel = M('Order');
        $status = I('get.status', '1');
        $uid = session('uid');
        $orders = $orderModel->order('id desc')->where(array('status' => $status, 'uid' => $uid))->select();
        $orderDetailModel = M('OrderDetail');
        foreach ($orders as $k => $v) {
            $details = $orderDetailModel->where(array('order_id' => $v['order_id']))->select();

            foreach ($details as $val) {
                $items = array(
                    'title' => $val['goods_name'],
                    'img' => $val['img'],
                    'price' => $val['price'],
                    'quantity' => $val['goods_number'],
                    'itemId' => $val['goods_id'],
                    'addtime' => $v['addtime'],
                );
                $orders[$k]['items'][] = $items;
            }
        }
        $this->assign('item_orders', $orders);
        $this->assign('status', $status);
        $this->display();
    }

//    public function register() {
//        if (IS_POST) {
//            $model = D('Admin/User');
//            if ($model->create(I('post.'), 1)) {
//                if ($model->add()) {
//                    $this->success('注册成功，请登录您的邮箱完成验证！');
//                    exit;
//                }
//            }
//            $this->error($model->getError());
//        }
//        $this->display();
//    }

//    public function login() {
//        if (IS_POST) {
//            $model = D('Admin/User');
//            if ($model->create(I('post.'), 4)) {
//                if ($model->login()) {
//                    $this->success('登录成功', U('Index/index'));
//                    exit;
//                }
//            }
//            $this->error($model->getError());
//        }
//        $this->display();
//    }

//    public function emailchk() {
//        //接收验证码
//        $code = I('get.code');
//        if ($code) {
//            $model = M('User');
//            $email = $model->where(array('email_code' => $code))->find();
//            if ($email) {
//                $model->where(array('id' => $email['id']))->setField('email_code', '');
//                $this->success('已经完成验证，现在可以去登录', U('login'));
//                exit;
//            }
//        }
//    }

//    public function logout() {
//        session(null);
//        redirect('/Home/index');
//    }

    /**
     * 收货地址
     */
    public function address() {

        $user_address_mod = M('user_address');
        //获取get参数      
        $id = I('get.id', '', 'intval');
        $type = I('get.type', '', 'trim', 'edit');
        //如果有id参数，那么只可能是删除单条收货地址或者查询单条收货地址信息       
        if ($id) {

            if ($type == 'del') { //删除单条收货地址信息
                $user_address_mod->where(array('id' => $id, 'uid' => session('uid')))->delete();
                $msg = array('status' => 1, 'info' => L('delete_success'));
                $this->assign('msg', $msg);
            } else {//查询单条收货地址信息  
                $info = $user_address_mod->find($id);
                $this->assign('info', $info);
            }
        }

        //是post请求，所以是编辑收货地址
        if (IS_POST) {
            //获取psot参数
            $consignee = I('post.consignee', '', 'trim');
            $address = I('address', '', 'trim');
            $mobile = I('phone_mob', '', 'trim');
            $sheng = I('sheng', '', 'trim');
            $shi = I('shi', '', 'trim');
            $qu = I('qu', '', 'trim');
            $id = I('id', '', 'intval');

            if ($id) {//如果psot参数中存在id参数，那么可以判断是修改单条收货地址
                $result = $user_address_mod->where(array('id' => $id, 'uid' => session('uid')))->save(array(
                    'name' => $consignee,
                    'address' => $address,
                    'mobile' => $mobile,
                    'province' => $sheng,
                    'city' => $shi,
                    'area' => $qu,
                ));
                if ($result) {
                    $msg = array('status' => 1, 'info' => '修改成功');
                } else {
                    $msg = array('status' => 0, 'info' => '修改失败');
                }
            } else {//如果post请求中没有id参数，我们认为是新增一条收货地址信息
                $result = $user_address_mod->add(array(
                    'uid' => session('uid'),
                    'name' => $consignee,
                    'address' => $address,
                    'mobile' => $mobile,
                ));
                if ($result) {
                    $msg = array('status' => 1, 'info' => '添加地址成功');
                } else {
                    $msg = array('status' => 0, 'info' => '添加地址失败');
                }
            }
            $this->assign('msg', $msg);
        }
        //如果没有id参数，也不是post请求，那么就是查询所有收货地址
        $address_list = $user_address_mod->where(array('uid' => session('uid')))->select();
        $this->assign('address_list', $address_list);
        $this->display();
    }

    public function addaddress() {
        if (IS_POST) {
            $user_address = M('user_address');

            $consignee = I('post.consignee','', 'trim');
            $sheng = I('post.sheng','', 'trim');
            $shi = I('post.shi','', 'trim');
            $qu = I('qu','', 'trim');
            $address = I('address','', 'trim');
            $phone_mob = I('phone_mob','', 'trim');

            $data['uid'] = session('uid');
            $data['name'] = $consignee;
            $data['province'] = $sheng;
            $data['city'] = $shi;
            $data['area'] = $qu;
            $data['address'] = $address;
            $data['mobile'] = $phone_mob;

            if ($user_address->data($data)->add() !== false) {
                $this->redirect('user/address');
            }
        }
        $this->display();
    }

    public function edit_address() {
        $user_address_mod = M('user_address');
        $id = I('get.id', '', 'intval');
        $info = $user_address_mod->find($id);
        var_dump($info);
        $this->assign('info', $info);
        $this->display();
    }

}
