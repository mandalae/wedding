<?php
require_once "../../_inc/_page.php";

if (isset($_GET['delete'])){
    $text = new Text($_GET['delete']);
    $text->delete(false);
    
    header("Location: /admin/pages");
}

$text = new Text();
$texts = $text->getAll();

$page->assign('pages', $texts);

$page->display('admin/pages/index.tpl');