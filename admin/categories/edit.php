<?php
require_once "../../_inc/_page.php";

$category = new Category(isset($_GET['id']) ? $_GET['id'] : null);


if (isset($_POST['name'])){
    $category->populate($_POST);
    $category->setActive(isset($_POST['active']) && $_POST['active'] > 0 ? time() : 0);
    $category->setSeo(Util::seoSafe($_POST['name']));
    $category->save();
    
    header("Location: /admin/categories");
}

$categories = $category->getAllActive();

$page->assign('category', $category);
$page->assign('cats', $categories);

$page->display('admin/categories/edit.tpl');