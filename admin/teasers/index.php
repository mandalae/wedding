<?php
require_once "../../_inc/_page.php";

if (isset($_GET['delete'])){
    $teaser = new Teaser($_GET['delete']);
    $teaser->delete(false);
    
    header("Location: /admin/teasers");
}

$teaser = new Teaser();
$teasers = $teaser->getAll();

$page->assign('teasers', $teasers);

$page->display('admin/teasers/index.tpl');