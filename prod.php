<?php
require_once "_inc/_page.php";

$product = new Product();
$product->loadByType('seo', $_GET['seo']);

$brand = new Brand($product->getBrand());

$page->assign('product', $product);
$page->assign('brand', $brand);

$page->display('prod.tpl');