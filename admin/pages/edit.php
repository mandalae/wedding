<?php
require_once "../../_inc/_page.php";

$text = new Text(isset($_GET['id']) ? $_GET['id'] : null);


if (isset($_POST['headline'])){
    $text->setContent($_POST['contentEditor']);
    $text->setHeadline($_POST['headline']);
    $text->setSeo(Util::seoSafe($_POST['headline']));
    $text->setActive(isset($_POST['active']) && $_POST['active'] > 0 ? time() : 0);
    $text->setVisible(isset($_POST['visible']) && $_POST['visible'] > 0 ? 1 : 0);
    $text->setTimestamp(time());
    $text->save();
    
    header("Location: /admin/pages");
}

$page->assign('text', $text);


$page->display('admin/pages/edit.tpl');