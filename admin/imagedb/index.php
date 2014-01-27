<?php
require_once "../../_inc/_page.php";

$image = new Image();
$images = $image->getAll();

$page->assign('images', $images);

$page->assign("selector", isset($_GET['selector']) ? $_GET['selector'] : '');
$page->assign("multiple", isset($_GET['multiple']) ? $_GET['multiple'] : '');
$page->assign("query", isset($_GET['query']) ? $_GET['query'] : '');

$page->display('admin/imagedb/index.tpl');