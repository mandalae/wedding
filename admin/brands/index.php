<?php
require_once "../../_inc/_page.php";

if (isset($_GET['delete'])){
    $brand = new Brand($_GET['delete']);
    $brand->delete();
    
    header("Location: /admin/brands");
}

$brand = new Brand();
$brands = $brand->getAll();

$page->assign('brands', $brands);

$page->display('admin/brands/index.tpl');