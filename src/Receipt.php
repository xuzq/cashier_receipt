<?php 
 
/**=============================================================================
* @filesource: Receipt.php
* @description: 
* @author: xuzhengqiang - xuzq1312@163.com
* @date: 2017-05-09 18:07
=============================================================================*/

class Receipt {
	
	private $products = array();
	private $productObj = NULL;

	public function __construct ($products) {
		$this->products = $this->adjustProducts(json_decode($products, true));
		$this->productObj = new Product();

	}

	public function computeFee() {
		
	}

	public function printReceipt() {
		$this->computeFee();
		$this->printProductReceipt();
	}

	public function adjustProducts($productsArr) {
		foreach($productsArr as $pro) {
			$val = explode ('-', $pro);
			if ($this->productObj->isValidProduct($val[0])) {
				$this->products[$val[0]] += isset[$val[1]] : $val[1] : 1;
			} else {
				error_log("Invalid product ". var_export($pro, true));
				exit();
			}
		}
	}
}
