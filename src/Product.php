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
			'ITEM000004' => array(
				'product_id'	=> 'ITEM000004',
				'name'			=> '可口可乐',
				'price'			=> 3,
				'unit'			=> '瓶',
				),
			'ITEM000005' => array(
				'product_id'	=> 'ITEM000005',
				'name'			=> '羽毛球',
				'price'			=> 1,
				'unit'			=> '个',
				),
			'ITEM000006' => array(
				'product_id'	=> 'ITEM000006',
				'name'			=> '苹果',
				'price'			=> 5.5,
				'unit'			=> '斤',
				),
			'ITEM000007' => array(
				'product_id'	=> 'ITEM000007',
				'name'			=> '可口可乐',
				'price'			=> 3,
				'unit'			=> '瓶',
				),
			'ITEM000008' => array(
				'product_id'	=> 'ITEM000008',
				'name'			=> '羽毛球',
				'price'			=> 1,
				'unit'			=> '个',
				),
			'ITEM000009' => array(
				'product_id'	=> 'ITEM000009',
				'name'			=> '苹果',
				'price'			=> 5.5,
				'unit'			=> '斤',
				),
			'ITEM0000010' => array(
				'product_id'	=> 'ITEM0000010',
				'name'			=> '可口可乐',
				'price'			=> 3,
				'unit'			=> '瓶',
				),
			'ITEM0000011' => array(
				'product_id'	=> 'ITEM0000011',
				'name'			=> '羽毛球',
				'price'			=> 1,
				'unit'			=> '个',
				),
			'ITEM0000012' => array(
				'product_id'	=> 'ITEM0000012',
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
	public function getProductById($productId) {
		if (isset(self::$products[$productId])) {
			return self::$products[$productId];
		} else {
			return array();
		}
	}

}

