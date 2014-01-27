<?php
require_once "../../_inc/_page.php";

$brand = new Brand();
$brands = $brand->getAllActive();

$page->assign('brands', $brands);

$product = new Product(isset($_GET['id']) ? $_GET['id'] : null);

if (isset($_POST['name'])){
    $product->setName($_POST['name']);
    $product->setSeo(Util::seoSafe($_POST['name']));
    $product->setBrand($_POST['brand']);
    $product->setDescription($_POST['description']);
    $product->setDiscount_price($_POST['discountPrice']);
    $product->setPrice($_POST['price']);
    $product->setOffer(isset($_POST['offer']) && $_POST['offer'] > 0 ? 1 : 0);
    $product->setImage($_POST['image']);
    $product->setActive(isset($_POST['active']) && $_POST['active'] > 0 ? time() : 0);
    $product->setVisible(isset($_POST['visible']) && $_POST['visible'] > 0 ? 1 : 0);
    $product->setTimestamp(time());
    $product->save();
    
    header("Location: /admin/products");
}

$page->assign('product', $product);


$page->display('admin/products/edit.tpl');