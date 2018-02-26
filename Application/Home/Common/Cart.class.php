<?php
class Cart{
	
	
	public function __construct() {
		if(!isset($_SESSION['cart'])){
			$_SESSION['cart'] = array();
		}
	}
	


	/*
	添加商品
	param int $id 商品主键
		  string $name 商品名称
		  float $price 商品价格
		  int $num 购物数量
	*/
	public  function addItem($id,$name,$price,$num,$img) {
		//如果该商品已存在则直接加其数量
		if (isset($_SESSION['cart'][$id])) {
			//增加购物车中商品的数量
			$this->incNum($id,$num);
			//返回1通知调用方该商品已经存在
			return 1;
		}
		
		//新建商品信息数组
		$item = array();
		$item['id'] = $id;
		$item['name'] = $name;
		$item['price'] = $price;
		$item['num'] = $num;
		$item['img'] = $img;
		//将新建的商品信息数组添加到购物车中，key即为商品id，value为商品具体信息的数组。
		$_SESSION['cart'][$id] = $item;
	}

	/*
	修改购物车中的商品数量
	int $id 商品主键
	int $num 某商品修改后的数量，即直接把某商品
	的数量改为$num,默认为1 /
	*/
	public function modNum($id,$num=1) {
		if (!isset($_SESSION['cart'][$id])) {
			//购物车中不存在该商品的信息，返回false
			return false;
		}
		//设置商品的数量
		$_SESSION['cart'][$id]['num'] = $num;
	}

	/*
	增加购物车中商品的数量
	int $id 商品主键
	int $num 要增加的商品的数量，即在该商品原有数量之上再增加的数量
	,默认增加1 /
	*/
	public function incNum($id,$num=1) {
		
		if (isset($_SESSION['cart'][$id])) {
			$_SESSION['cart'][$id]['num'] += $num;
		}
	}

	/*
	减少购物车中商品的数量
	int $id 商品主键
	int $num 要减少的商品的数量，即在该商品原有数量之上要减少 的数量
	,默认减少1 /
	*/
	public function decNum($id,$num=1) {
		if (isset($_SESSION['cart'][$id])) {
			$_SESSION['cart'][$id]['num'] -= $num;
		}

		//如果减少后，数量为0，则把这个商品删掉
		if ($_SESSION['cart'][$id]['num'] <1) {
			$this->delItem($id);
		}
	}

	/*
	删除商品
	*/
	public function delItem($id) {
		//直接输出购物车中该商品
		unset($_SESSION['cart'][$id]);
	}
	
	/*
	获取单个商品的具体信息，返回值是表示该商品具体信息的一个关联数组
	*/
	public function getItem($id) {
		return $_SESSION['cart'][$id];
	}

	/*
	查询购物车中商品的种类
	*/
	public function getCnt() {
		//返回购物车中商品的种类数目。购物车中每个商品id表示一种商品，只需要count出id数就知道商品的种类数目了。
		return count($_SESSION['cart']);
	}
	
	/*
	查询购物车中商品的总数
	*/
	public function getNum(){
		if ($this->getCnt() == 0) {
			//种数为0，表示购物车为空，商品个数也为0
			return 0;
		}

		$sum = 0;
		//$data是一个多维关联数组
		$data = $_SESSION['cart'];
		//$data中每个元素的值就是一个表示商品具体信息的关联数组
		foreach ($data as $item) {
			//累加每种商品的数量
			$sum += $item['num'];
		}
		return $sum;
	}

	/*
	购物车中商品的总金额
	*/
	public function getPrice() {
		//购物车中商品种类 为0，购物车是空的，所以总金额为0
		if ($this->getCnt() == 0) {
			return 0;
		}
		
		$price = 0.00;
		//$item表示一个商品的具体信息，是一个关联数组
		foreach ($_SESSION['cart'] as $item) {
			//该商品的单价乘以数量得到该商品的总价，然后对各商品的总价累加得到购物车中所有商品的总金额
			$price += $item['num'] * $item['price'];
		}
		//格式化输出浮点数，保留2位小数。
		return sprintf("%01.2f", $price);
	}

	/*
	清空购物车
	*/
	public function clear() {
		//将session中的cart置为空的数组，表示购物车被清空了。
		$_SESSION['cart'] = array();
	}
}