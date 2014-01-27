<?php
require_once "../../_inc/_page.php";

if (isset($_GET['delete'])){
    $category = new Category($_GET['delete']);
    $category->delete();
    
    header("Location: /admin/categories");
}

$category = new Category();
$categories = $category->getAll("name ASC");
foreach ($categories as $key => $category){
    $cat = new Category($category['parent_category']);
    $categories[$key]['parent'] = $cat->getName();
}

$page->assign('categories', $categories);

$page->display('admin/categories/index.tpl');