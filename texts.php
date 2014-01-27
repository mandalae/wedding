<?php
require_once "_inc/_page.php";

$text = new Text();
$text->loadByType('seo', $_GET['seo']);

$page->assign("headline", $text->getHeadline());
$page->assign("text", $text->getContent());

$page->display('texts.tpl');