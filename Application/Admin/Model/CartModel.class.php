<?php
namespace Admin\Model;
use Think\Model;

class CartModel extends Model{
    //加入购物车
    public function addToCart($goods_id,$goods_number=1){
        $uid = session('uid');
        if($uid){
            $cartModel = M('Cart');
            $has = $cartModel->where(array(
                'user_id' => $uid,
                'goods_id' => $goods_id,
            ))->find();
            if($has){
                $cartModel->where('id='.$has['id'])->setInc('goods_number',$goods_number);
            }else
                $cartModel->add(array(
                    'goods_id' => $goods_id,
                    'goods_number' => $goods_number,
                    'user_id' => $uid,
                ));
        }else{
            $cart = isset($_COOKIE['cart'])?unserialize($_COOKIE['cart']) : array();
            $key = $goods_id;
            if(isset($cart[$key]))
                $cart[$key] += $goods_number;
            else
                $cart[$key] = $goods_number;
            $cart[$key] = $goods_number;
            setcookie('cart',serialize($cart),time()+30*86400);
        }
    }

    public function cartList(){
        $uid = session('uid');
        if($uid){
            $cartModel = M('Cart');
            $_cart = $cartModel->where(array('user_id'=>$uid))->select();
        }else {
            $_cart_ = isset($_COOKIE['cart']) ? unserialize($_COOKIE['cart']) : array();
            $_cart = array();
            foreach($_cart_ as $k => $v){
                $_k = explode('-',$k);
                $_cart[] = array(
                    'goods_id' => $_k[0],
                    'goods_attr_id' => $_k[1],
                    'goods_number' => $v,
                    'user_id' => 0,
                );
            }
        }
        $goodsModel = D('Admin/Goods');
        foreach ($_cart as $k => $v){
            $goodsInfo = $goodsModel->field('sm_img,goods_name,price')->find($v['goods_id']);
            $_cart[$k]['goods_name'] = $goodsInfo['goods_name'];
            $_cart[$k]['sm_img'] = $goodsInfo['sm_img'];
            $_cart[$k]['price'] = $goodsInfo['price'];
        }
        return $_cart;
    }

    public function changeQuantity($goods_id,$goods_number){
        $uid = session('uid');
        if($uid){
            $cartModel = M('Cart');
            $cartModel->where(array(
                'goods_id'=>$goods_id,
                'user_id' => $uid,
            ))->setField('goods_number',$goods_number);
        }else{
            $cart = isset($_COOKIE['cart'])?unserialize($_COOKIE['cart']) : array();
            $key = $goods_id;
            $cart[$key] = $goods_number;
            setcookie('cart',serialize($cart),time()+30*86400);
        }
    }
}