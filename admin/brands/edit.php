<?php
require_once "../../_inc/_page.php";

$brand = new Brand(isset($_GET['id']) ? $_GET['id'] : null);


if (isset($_POST['name'])){
    $brand->populate($_POST);
    $brand->setActive(isset($_POST['active']) && $_POST['active'] > 0 ? time() : 0);
    $brand->setSeo(Util::seoSafe($_POST['name']));
    $brand->save();
    
    header("Location: /admin/brands");
}

$page->assign('brand', $brand);


$page->display('admin/brands/edit.tpl');