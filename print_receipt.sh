#!/bin/bash


#为了便于测试，添加了多个产品类型
echo
echo "# case 1: 当购买的商品中，有符合“买二赠一”优惠条件的商品时"
php index.php [\"ITEM000001-3\",\"ITEM000002-5\",\"ITEM000003-2\"]
echo 

echo "# case 2: 当购买的商品中，没有符合“买二赠一”优惠条件的商品时"
php index.php [\"ITEM000004-3\",\"ITEM000005-5\",\"ITEM000006-2\"]
echo

echo "# case 3: 当购买的商品中，有符合“95折”优惠条件的商品时"
php index.php [\"ITEM000007-3\",\"ITEM000008-5\",\"ITEM000009-2\"]
echo

echo "#case 4: 当购买的商品中，有符合“95折”优惠条件的商品，又有符合“买二赠一”优惠条件的商品时"
php index.php [\"ITEM0000010-3\",\"ITEM0000011-6\",\"ITEM0000012-2\"]
echo
