<?php
require_once "../../_inc/_page.php";

if (isset($_GET['delete'])){
    $product = new Product($_GET['delete']);
    $product->delete(false);
    
    header("Location: /admin/products");
}

$product = new Product();
$products = $product->getAll();

$page->assign('products', $products);

$page->display('admin/products/index.tpl');