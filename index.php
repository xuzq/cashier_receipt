<?php

require_once 'src/Receipt.php';

if ($argc < 2) {
	echo "miss argumnets. Usage: php index xxxx(json product)\n";
	exit();
}
$params = $argv[1];
$ret = new Receipt($params);
$ret->printReceipt();
