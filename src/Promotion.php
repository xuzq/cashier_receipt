<?php 
 
/**=============================================================================
* @filesource: Promotion.php
* @description: 产品优惠信息类
* @author: xuzhengqiang - xuzhengqiang@yongche.com
* @date: 2017-05-09 14:11
=============================================================================*/

class Promotion {

	const PROM_TYPE_NONE		= 0; /* 无优惠 */
	const PROM_TYPE_DISCOUNT 	= 1; /* 折扣优惠 */
	const PROM_TYPE_FREE_ONE	= 2; /* 买多送一 */

	static $promotionList = array(
		array(
			'product_id' 	=> 'ITEM000001',
			'prom_type'		=> self::PROM_TYPE_FREE_ONE,
			'factor'		=> 2,
			'priority'		=> 2,
		),
		array(
			'product_id' 	=> 'ITEM000002',
			'prom_type'		=> self::PROM_TYPE_FREE_ONE,
			'factor'		=> 2,
			'priority'      => 2,
		),
		array(
			'product_id' 	=> 'ITEM000003',
			'prom_type'		=> self::PROM_TYPE_NONE,
			'factor'		=> 0,
			'priority'      => 0,
		),
		array(
			'product_id' 	=> 'ITEM000004',
			'prom_type'		=> self::PROM_TYPE_NONE,
			'factor'		=> 0,
			'priority'      => 0,
		),
		array(
			'product_id' 	=> 'ITEM000005',
			'prom_type'		=> self::PROM_TYPE_NONE,
			'factor'		=> 0,
			'priority'      => 0,
		),
		array(
			'product_id' 	=> 'ITEM000006',
			'prom_type'		=> self::PROM_TYPE_NONE,
			'factor'		=> 0,
			'priority'      => 0,
		),
		array(
			'product_id' 	=> 'ITEM000007',
			'prom_type'		=> self::PROM_TYPE_NONE,
			'factor'		=> 0,
			'priority'      => 0,
		),
		array(
			'product_id' 	=> 'ITEM000008',
			'prom_type'		=> self::PROM_TYPE_NONE,
			'factor'		=> 0,
			'priority'      => 0,
		),
		array(
			'product_id' 	=> 'ITEM000009',
			'prom_type'		=> self::PROM_TYPE_DISCOUNT,
			'factor'		=> 0.95,
			'priority'      => 1,
		),
		array(
			'product_id' 	=> 'ITEM0000010',
			'prom_type'		=> self::PROM_TYPE_FREE_ONE,
			'factor'		=> 2,
			'priority'		=> 2,
		),
		array(
			'product_id' 	=> 'ITEM0000010',
			'prom_type'		=> self::PROM_TYPE_DISCOUNT,
			'factor'		=> 0.95,
			'priority'		=> 1,
		),
		array(
			'product_id' 	=> 'ITEM0000011',
			'prom_type'		=> self::PROM_TYPE_FREE_ONE,
			'factor'		=> 2,
			'priority'      => 2,
		),
		array(
			'product_id' 	=> 'ITEM0000011',
			'prom_type'		=> self::PROM_TYPE_DISCOUNT,
			'factor'		=> 0.95,
			'priority'		=> 1,
		),
		array(
			'product_id' 	=> 'ITEM0000012',
			'prom_type'		=> self::PROM_TYPE_DISCOUNT,
			'factor'		=> 0.95,
			'priority'      => 1,
		),
	);

	public function __construct () {
		
	}

	/**
	 * 根据产品信息，以及产品的个数，获取该产品的优惠费用信息
	 * @param array $productInfo 产品信息
	 * @param int 	$num		 产品数量
	 */
	public function getFeeInfoByProduct($productInfo, $num) {
		$promotion = array();
		foreach (self::$promotionList as $value) {
			if ($productInfo['product_id'] == $value['product_id']) {
				$promotion[$value['priority']] = $value;
			}
		}

		/* set default prom_type PROM_TYPE_NONE */
		if (empty($promotion)) {
			$promotion[0] = array(
					'product_id' 	=> $productInfo['product_id'],
					'prom_type'		=> self::PROM_TYPE_NONE,
					'factor'		=> 0,
					'priority'      => 0,
					);
		}

		/* 按优先级降序排序 */
		krsort($promotion);
		foreach($promotion as $value) {
			$promotion = $value;
			break;
		}
		switch ($promotion['prom_type']) {
			case self::PROM_TYPE_FREE_ONE:
				$free = $productInfo['price'] * (($num - $num % ($promotion['factor'] + 1)) / ($promotion['factor'] + 1));
				$amount = $num * $productInfo['price'] - $free;
				$freeCount = ($num - $num % ($promotion['factor'] + 1)) / ($promotion['factor'] + 1);
				$res = array('amount' => $amount, 'free' => $free, 'prom_type' => $promotion['prom_type'], 'free_count' => $freeCount);
				break;
			case self::PROM_TYPE_DISCOUNT:
				$free = $num * $productInfo['price'] * (1 - $promotion['factor']);
				$amount = $num * $productInfo['price'] - $free;
				$res = array('amount' => $amount, 'free' => $free, 'prom_type' => $promotion['prom_type']);
				break;
			case self::PROM_TYPE_NONE:
				$free = 0;
				$amount = $num * $productInfo['price'];
				$res = array('amount' => $amount, 'free' => $free, 'prom_type' => $promotion['prom_type']);
				break;
			default:
				$res = array();
				break;
		}
		
		if (empty($res)) {
			return array('ret_code' => 404, 'ret_msg' => 'getFeeInfoByProduct failed');
		} else {
			return array('ret_code' => 200, 'ret_msg' => 'success', 'result' => $res);
		}
	}
}
