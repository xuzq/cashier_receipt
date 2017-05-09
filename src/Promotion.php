<?php 
 
/**=============================================================================
* @filesource: Promotion.php
* @description: 产品优惠信息类
* @author: xuzhengqiang - xuzhengqiang@yongche.com
* @date: 2017-05-09 14:11
=============================================================================*/

class Promotion {

	const PROM_TYPE_DISCOUNT 			1; /* 折扣优惠 */
	const PROM_TYPE_FREE_ONE			2; /* 买多送一 */

	const promotionList = array(
		array(
			'product_id' 	=> 'ITEM000001',
			'prom_type'		=> PROM_TYPE_DISCOUNT,
			'factor'		=> 0.95,
		),
		array(
			'product_id' 	=> 'ITEM000002',
			'prom_type'		=> PROM_TYPE_FREE_ONE,
			'factor'		=> 2,
		),
		array(
			'product_id' 	=> 'ITEM000003',
			'prom_type'		=> PROM_TYPE_DISCOUNT,
			'factor'		=> 0.95,
		),
		array(
			'product_id' 	=> 'ITEM000003',
			'prom_type'		=> PROM_TYPE_FREE_ONE,
			'factor'		=> 2,
		),
	);

	public function __construct () {
		
	}

}
