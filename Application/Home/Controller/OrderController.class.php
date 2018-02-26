<?php

namespace Home\Controller;

use Think\Controller;

class OrderController extends Controller {

    public function zhifu() {
        $this->display();
    }

    public function cancelOrder() {//取消订单
        $orderId = $_GET['orderId'];
        !$orderId && $this->_404();

        $this->assign('orderId', $orderId);
        $this->display();
    }

    public function confirmOrder() {//确认收货
        $orderId = $_GET['orderId'];
        $status = $_GET['status'];
        !$orderId && $this->_404();
        $item_order = M('Order');
        $item = M('Goods');
        $item_orders = $item_order->where('orderId=' . $orderId . ' and userId=' . $this->visitor->info['id'] . ' and status=3')->find();
        if (!is_array(Order)) {
            $this->error('该订单不存在!');
        }
        $data['status'] = 4; //收到货
        if ($item_order->where('orderId=' . $orderId . ' and userId=' . session('uid'))->save($data)) {
            $order_detail = M('order_detail');
            $order_details = $order_detail->where('orderId=' . $orderId)->select();
            foreach ($order_details as $val) {
                $item->where('id=' . $val['itemId'])->setInc('buy_num', $val['quantity']);
            }
            $this->redirect('User/index?status=' . $status);
        } else {
            $this->error('确定收货失败');
        }
    }

    public function closeOrder() {//关闭订单

        $orderId = $_POST['orderId'];
        $cancel_reason = $_POST['cancel_reason'];
        !$orderId && $this->_404();
        $item_order = M('Order');
        $item = M('item');
        $order_detail = M('OrderDetail');
        $order = $item_order->where('orderId=' . $orderId . ' and userId=' . $this->visitor->info['id'])->find();

        if (!is_array($order)) {
            $this->error('该订单不存在');
        } else {
            $data['status'] = 5;
            $data['closemsg'] = $cancel_reason;
            if ($item_order->where('orderId=' . $orderId)->save($data)) {//设置为关闭
                $order_details = $order_detail->where('orderId=' . $orderId)->select();

                foreach ($order_details as $val) {
                    $item->where('id=' . $val['itemId'])->setInc('goods_stock', $val['quantity']);
                }
                $this->redirect('User/index');
            } else {
                $this->error('关闭订单失败!');
            }
        }
    }

    public function checkOrder() {//查看订单
        $orderId = $_GET['orderId'];
        !$orderId && $this->_404();
        $status = $_GET['status'];
        $item_order = M('Order');
        $order = $item_order->where('order_id=' . $orderId . ' and uid=' . session('uid'))->find();
        if (!is_array($order)) {
            $this->error('该订单不存在');
        } else {

            $order_detail = M('OrderDetail');

            $order_details = $order_detail->where("order_id='" . $order['order_id'] . "'")->select();
            
            $item_detail = array();
            foreach ($order_details as $val) {
                $items = array('title' => $val['goods_name'], 'img' => $val['img'], 'price' => $val['price'], 'quantity' => $val['goods_number']);
                //$order[$key]['items'][]=$items;
                $item_detail[] = $items;
            }
        }


        $this->assign('item_detail', $item_detail);
        $this->assign('order', $order);
        var_dump($item_detail);
        var_dump($order);
        $this->display();
    }

    public function jiesuan() {//结算
        if (count($_SESSION['cart']) > 0) {
            //查询用户收货地址
            $user_address_mod = M('user_address');
            $address_list = $user_address_mod->where(array('uid' => session('uid')))->select();
            $this->assign('address_list', $address_list);
            //商品模型对象
            $items = M('Goods');

            //邮递费统计
            $freig = 0; //邮费
            //遍历购物车中每个商品的信息 
            foreach ($_SESSION['cart'] as $item) {
                //从商品信息表中查询出商品的邮递费用,商品信息表的is_free_freight字段表示是否包邮：1-表示包邮；2-表示不包邮。
                $freight = $items->field('freight')->find($item['id']);
                if (is_array($free)) {//如果查询到邮递费用，
                    $freig += $freight['freight'];
                }
            }

            //   $dingdanhao = date("Y-m-dH-i-s");
            // $dingdanhao = str_replace("-","",$dingdanhao);
            // $dingdanhao .= rand(1000,2000);
//		  import('Think.ORG.Cart');// 导入分页类
            import('/Home/Common/Cart', APP_PATH); // 导入购物车类
            $cart = new \Cart();
            $sumPrice = $cart->getPrice();

            //将各类邮递方式的费用组装到一个数组，目的是为了方便传送。
            $freearr = array();
            if ($pingyou > 0) {
                $freearr[] = array('value' => 1, 'price' => $pingyou);
            }
            if ($kuaidi > 0) {
                $freearr[] = array('value' => 2, 'price' => $kuaidi);
            }
            if ($ems > 0) {
                $freearr[] = array('value' => 3, 'price' => $ems);
            }


            // var_dump($freearr);
            $this->assign('freearr', $freearr);
            $this->assign('freesum', $freesum);
            $this->assign('sumPrice', $sumPrice);
            //$this->assign('pingyou',$pingyou);
            //$this->assign('kuaidi',$kuaidi);
            //$this->assign('ems',$ems);


            $this->display();
        } else {
            //购物车中没有任何商品，直接让浏览器重定向到购物车首页页面。
            $this->redirect('Shopcart/index');
        }
    }

    public function pay() {//出订单


        if (IS_POST && count($_SESSION['cart']) > 0) {
            import('/Home/Common/Cart',APP_PATH);// 导入购物车类
            $cart = new \Cart();
            $user_address = M('user_address');
            $item_order = M('Order');
            $order_detail = M('OrderDetail');
            $item_goods = M('Goods');
//            $this->visitor->info['id']; //用户ID
//            $this->visitor->info['username']; //用户账号
            //生成订单号
            $dingdanhao = date("Y-m-dH-i-s");
            $dingdanhao = str_replace("-", "", $dingdanhao);
            $dingdanhao .= rand(1000, 2000);

            $time = time(); //订单添加时间

            $address_options = I('post.address_options', 'intval'); //地址  0：刚填的地址 大于0历史的地址
            $shipping_id = I('post.shipping_id', 'intval'); //配送方式
            $postscript = I('post.postscript','', 'trim'); //卖家留言

            if (!empty($postscript)) {//卖家留言
                $data['note'] = $postscript;
            }

            if (empty($shipping_id)) {//卖家包邮
                $data['freetype'] = 0;
                $data['order_sumPrice'] = $cart->getPrice();
            } else {
                $data['freetype'] = $shipping_id;
                $data['freeprice'] = $this->getFree($shipping_id); //取到运费
                $data['order_sumPrice'] = $cart->getPrice() + $this->getFree($shipping_id);

                //echo $cart->getPrice()+$this->getFree($shipping_id);exit;
            }

            $data['order_id'] = $dingdanhao; //订单号
            $data['addtime'] = $time; //添加时间
            $data['total_price'] = $cart->getPrice(); //商品总额
//            $data['userId'] = $this->visitor->info['id']; //用户ID
//            $data['userName'] = $this->visitor->info['username']; //用户名
            $data['uid'] = session('uid'); //用户ID
            $data['username'] = session('username'); //用户名
            
            if ($address_options == 0) {
                $consignee = I('post.consignee','', 'trim'); //真实姓名
                $sheng = I('post.sheng','', 'trim'); //省
                $shi = I('post.shi','', 'trim'); //市
                $qu = I('post.qu','', 'trim'); //区
                $address = I('post.address','', 'trim'); //详细地址
                $phone_mob = I('post.phone_mob','', 'trim'); //电话号码
                $save_address = I('post.save_address','', 'trim'); //是否保存地址

                $data['name'] = $consignee; //收货人姓名
                $data['mobile'] = $phone_mob; //电话号码
                $data['address'] = $sheng . $shi . $qu . $address; //地址
//                var_dump($data);
                if ($save_address) {//保存地址
                    $add_address['uid'] = session('uid');
                    $add_address['name'] = $consignee;
                    $add_address['address'] = $address;
                    $add_address['mobile'] = $phone_mob;
                    $add_address['province'] = $sheng;
                    $add_address['city'] = $shi;
                    $add_address['area'] = $qu;

                    $user_address->data($add_address)->add();
                }
            } else {

                $address = $user_address->where('uid=' . session('uid'))->find($address_options); //取到地址

                $data['name'] = $address['name']; //收货人姓名
                $data['mobile'] = $address['mobile']; //电话号码
                $data['address'] = $address['province'] . $address['sity'] . $address['area'] . $address['address']; //地址
                var_dump($data);
            }
            if ($orderid = $item_order->data($data)->add()) {//添加订单成功
                $orders['order_id'] = $dingdanhao;
                foreach ($_SESSION['cart'] as $item) {
                    $item_goods->where('id=' . $item['id'])->setDec('goods_stock', $item['num']);

                    $orders['goods_id'] = $item['id']; //商品ID
                    $orders['goods_name'] = $item['goods_name']; //商品名称
                    $orders['img'] = $item['img']; //商品图片
                    $orders['price'] = $item['price']; //商品价格 
                    $orders['goods_number'] = $item['num']; //购买数量
                    $order_detail->data($orders)->add();
                }


                $cart->clear(); //清空购物车

                $this->assign('orderid', $orderid); //订单ID
                $this->assign('dingdanhao', $dingdanhao); //订单号
                $this->assign('order_sumPrice', $data['order_sumPrice']);
            } else {
                $this->error('生成订单失败!');
            }
        } else if (isset($_GET['orderId'])) {
            $item_order = M('Order');
            $orderId = $_GET['orderId']; //订单号
            $orders = $item_order->where('uid=' . session('uid') . ' and order_id=' . $orderId)->find();
            if (!is_array($orders))
                $this->_404();

            if (empty($orders['supportmetho'])) {//是否已有支付方式
                $this->assign('orderid', $orders['id']); //订单ID
                $this->assign('dingdanhao', $orders['order_id']); //订单号
                $this->assign('order_sumPrice', $orders['total_price']);
            } else {
                $alipay = M('alipay')->find();
                echo "<script>location.href='wapapli/alipayapi.php?WIDseller_email=" . $alipay['alipayname'] . "&WIDout_trade_no=" . $orderId . "&WIDsubject=" . $orderId . "&WIDtotal_fee=" . $orders['order_sumPrice'] . "'</script>";
                exit;
            }
        } else {
            $this->redirect('user/index');
        }
        $this->display();
    }

    public function end() {
        if (IS_POST) {
            //支付方式代码 1-支付宝， 2-货到收款  
            $payment_id = $_POST['payment_id'];
            //订单表记录id
            $orderid = $_POST['orderid'];
            //订单号i
            $dingdanhao = $_POST['dingdanhao'];
            $item_order = M('Order')->where('uid=' . session('uid') . ' and order_id=' . $dingdanhao)->find();
            !$item_order && $this->_404();
            if ($payment_id == 2) {//货到付款
                $data['status'] = 2;
                $data['pay_method'] = 2;
                $data['post_time'] = time();
                if (M('Order')->where('uid=' . session('uid') . ' and order_id=' . $dingdanhao)->data($data)->save()) {
                    $this->redirect('user/index');
                } else {
                    $this->error('操作失败!');
                }
            } elseif ($payment_id == 1) { //支付宝


                $data['pay_method'] = 1;

                if (M('Order')->where('uid=' . session('uid') . ' and order_id=' . $dingdanhao)->data($data)->save()) {
                    $alipay = M('alipay')->find();
                    var_dump($alipay);
                    echo "<script>location.href='/shop/wapapli/alipayapi.php?WIDseller_email=" . $alipay['alipayname'] . "&WIDout_trade_no=" . $dingdanhao . "&WIDsubject=" . $dingdanhao . "&WIDtotal_fee=" . $item_order['order_sumPrice'] . "'</script>";
                } else {
                    echo M('Order')->getLastSql();
                    $this->error('操作失败!');
                }
            } else {
                $this->error('操作失败!');
            }
        }
    }

    public function getFree($type) {
        import('/Home/Common/Cart',APP_PATH);// 导入购物车类
        $cart = new \Cart();
        $money = 0;
        $items = M('Goods');

        $method = array(1 => 'pingyou', 2 => 'kuaidi', 3 => 'ems');
        //echo $method[$type];exit;
        foreach ($_SESSION['cart'] as $item) {
            $free = $items->field('freight')->where('free=2')->find($item['id']);
            if (is_array($free)) {
                $money += $free[$method[$type]];
            }
        }
        return $money;
    }

}
