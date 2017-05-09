<?php 
 
/**=============================================================================
* @filesource: Receipt.php
* @description: 
* @author: xuzhengqiang - xuzq1312@163.com
* @date: 2017-05-09 18:07
=============================================================================*/

require_once 'Product.php';
require_once 'Promotion.php';

class Receipt {
	
	private $products = array();
	private $productsInfo = array();
	private $productObj = NULL;
	private $promotionObj = NULL;

	public function __construct ($products) {
		$this->products = json_decode($products, true);
		$this->productObj = new Product();
		$this->promotionObj = new Promotion();
	}

	public function computeAmount($productId, $num) {
		$productInfo = $this->productObj->getProductById($productId);
		$feeInfo = $this->promotionObj->getFeeInfoByProduct($productInfo, $num);
	
		if ($feeInfo['ret_code'] != 200) {
			error_log(var_export($feeInfo, true));
			exit();
		}

		$this->productsInfo[] = array(
			'product'	=> $productInfo,
			'num'		=> $num,
			'fee'		=> $feeInfo['result'],
		);
	}
	public function computeFee() {
		foreach ($this->products as $key => $num) {
			$this->computeAmount($key, $num);
		}
	}

	private function getReceiptStr($product) {
		$name = $product['product']['name'];
		$num = $product['num'];
		$unit = $product['product']['unit'];
		$price = $product['product']['price'];
		$amount = $product['fee']['amount'];

		$str = '';
		$str .= "名称: " . $name . "，数量: " . $num . $unit . "，单价" . $price . "（元），小计：" . $amount . "（元）";

		return $str;
	}

	public function printProductReceipt() {
		$freeProduct = array();

		$receiptTitle = "***<没钱赚商店>购物清单***\n";
		$separator1	= "----------------------\n";
		$separator2	= "**********************\n";
		$title1 = "买二赠一商品：\n";
		$totalAmount = 0;
		$totalFree = 0;
		$str = $receiptTitle;
		foreach ($this->productsInfo as $product) {
			switch ($product['fee']['prom_type']) {
				case Promotion::PROM_TYPE_FREE_ONE:
					$name = $product['product']['name'];
					$freeCount = $product['fee']['free_count'];
					$unit = $product['product']['unit'];

					$totalAmount += $product['fee']['amount'];
					$totalFree += $product['fee']['free'];

					$str .= $this->getReceiptStr($product); 
					$str .= "\n";
					if (isset($freeProduct[$name])) {
						$freeProduct[$name]['free_count'] 	+= $freeCount;
					} else {
						$freeProduct[$name]['free_count'] 	= $freeCount;
						$freeProduct[$name]['unit']			= $unit;
					}

					break;
				case Promotion::PROM_TYPE_DISCOUNT:
					$str .= $this->getReceiptStr($product); 
					$str .= "，节省" . $product['fee']['free'] . "（元）\n";
					$totalAmount += $product['fee']['amount'];
					$totalFree += $product['fee']['free'];
					break;
				case Promotion::PROM_TYPE_NONE:
					$str .= $this->getReceiptStr($product);
					$str .= "\n";
					$totalAmount += $product['fee']['amount'];
					$totalFree += $product['fee']['free'];
					break;
				default:
					error_log("error promotion type");
					exit();
					break;
			}
		}
		if (!empty($freeProduct)) {
			$str .= $separator1;
			foreach($freeProduct as $key => $value) {
				$str .= $title1 . "名称: " . $key . "，数量: " . $value['free_count'] . $value['unit'] . "\n";
			}
		}

		$str .= $separator1;
		$str .= "总计：" . $totalAmount . "（元）\n";
		$str .= "节省：" . $totalFree . "（元）\n";
		$str .= $separator2;

		echo $str;
	}
	public function printReceipt() {
		$this->adjustProducts();
		$this->computeFee();
		$this->printProductReceipt();
	}

	public function adjustProducts() {
		$productsArr = array();
		foreach($this->products as $pro) {
			$val = explode('-', $pro);
			if ($this->productObj->isValidProduct($val[0])) {
				$productsArr[$val[0]] += isset($val[1]) ? $val[1] : 1;
			} else {
				error_log("Invalid product " . var_export($pro, true));
				exit();
			}
		}
		$this->products = $productsArr;
	}
}
