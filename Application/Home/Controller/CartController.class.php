<?php
namespace Home\Controller;

class CartController extends BaseController{
    public function _initialize() {
        parent::_initialize();
        import('/Home/Common/Cart',APP_PATH);// 导入购物车类
//    	$cart=new Cart();
    	  
    }
    
    public function index(){
//     import('Think.ORG.Cart');// 导入分页类
    $cart=new \Cart();	

	  // import('Think.ORG.Util.weixin');// 导入分页类
	   
	  //  $wechat = new wechat();// 实例化分页类 传入总记录数ss
	  //  $wechat->responseMsg();
	//  echo "<pre>";
	  //var_dump($_SESSION['cart']);
	 // echo "</pre>";
	$this->assign('item',$_SESSION['cart']);
//        var_dump($_SESSION);
	$this->assign('sumPrice',$cart->getPrice());
	  $this->display();
    }
    
    public function add_cart()//添加进购物车
    {
//        session('cart',null);
//    	 import('Think.ORG.Cart');// 导入分页类
    	  $cart=new \Cart();
    	
    	$goodId= I('post.goodId','','intval');//商品ID
    	$quantity=I('post.quantity','', 'intval');//购买数量
    	$item=M('Goods')->field('id,goods_name,img,price,goods_stock')->find($goodId);
    	if(!is_array($item))
    	{
    		$data=array('status'=>0,'msg'=>'不存在该商品','count'=>$cart->getCnt(),'sumPrice'=>$cart->getPrice());
    	}elseif($item['goods_stock']<$quantity){
    		
    		$data=array('status'=>0,'msg'=>'没有足够的库存','count'=>$cart->getCnt(),'sumPrice'=>$cart->getPrice());
    	}else {
    		$result= $cart->addItem($item['id'],$item['goods_name'],$item['price'],$quantity,$item['img']);
    		if($result==1)//购物车存在该商品
    		{
    			$data=array('result'=>$result,'status'=>1,'count'=>$cart->getCnt(),'sumPrice'=>$cart->getPrice(),'msg'=>'该商品已经存在购物车');
    		}else{
                    $data=array('result'=>$result,'status'=>1,'count'=>$cart->getCnt(),'sumPrice'=>$cart->getPrice(),'msg'=>'商品已成功添加到购物车');
    		}
    	};
    	//$data=array('status'=>2);
//        var_dump($data);
    	echo json_encode($data);
    }
    
    public function remove_cart_item()//删除购物车商品
    {
//    	import('Think.ORG.Cart');// 导入购物车类
    	  $cart=new \Cart();
    	
    	$goodId= I('post.itemId','', 'intval');//商品ID
    	 $cart->delItem($goodId);
    	$data=array('status'=>1);
    	echo json_encode($data);
    }
    
    public function change_quantity()
    {
//    	import('Think.ORG.Cart');// 导入购物车类
        $cart=new \Cart();
    	  
    	$itemId= I('post.itemId','', 'intval');//商品ID
    	$quantity= I('post.quantity',''. 'intval');//购买数量
    	$item=M('Goods')->field('goods_stock')->find($itemId);
    	if($item['goods_stock']<$quantity)
    	{
            $data=array('status'=>0,'msg'=>'该商品的库存不足');
    	}else {
            $cart->modNum($itemId,$quantity);
            $data=array('status'=>1,'item'=>$cart->getItem($itemId),'sumPrice'=>$cart->getPrice());
    	}
    	
    
    	echo json_encode($data);
    }
}