<?php 
 
/**=============================================================================
* @filesource: Product.php
* @description: 
* @author: xuzhengqiang - xuzq1312@163.com
* @date: 2017-05-09 16:54
=============================================================================*/

class Product {

	static $products  = array(
			'ITEM000001' => array(
				'product_id'	=> 'ITEM000001',
				'name'			=> '可口可乐',
				'price'			=> 3,
				'unit'			=> '瓶',
				),
			'ITEM000002' => array(
				'product_id'	=> 'ITEM000002',
				'name'			=> '羽毛球',
				'price'			=> 1,
				'unit'			=> '个',
				),
			'ITEM000003' => array(
				'product_id'	=> 'ITEM000003',
				'name'			=> '苹果',
				'price'			=> 5.5,
				'unit'			=> '斤',
				),
			);
	public function __construct(){
		
	}

	public function isValidProduct($productId) {
		if (isset(self::$products[$productId])) {
			return true;
		} else {
			return false;
		}
	}

}

