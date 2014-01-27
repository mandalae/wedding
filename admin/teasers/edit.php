<?php
require_once "../../_inc/_page.php";

$teaser = new Teaser(isset($_GET['id']) ? $_GET['id'] : null);


if (isset($_POST['headline'])){
    $teaser->setHeadline($_POST['headline']);
    $teaser->setText($_POST['text']);
    $teaser->setUrl(Util::seoSafe($_POST['url']));
    $teaser->setActive(isset($_POST['active']) && $_POST['active'] > 0 ? time() : 0);
    $teaser->setImage($_POST['image']);
    $teaser->save();
    
    header("Location: /admin/teasers");
}

$page->assign('teaser', $teaser);


$page->display('admin/teasers/edit.tpl');