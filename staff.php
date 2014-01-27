<?php
require_once "_inc/_page.php";

$text = new Text();
$text->loadByType('seo', 'staff');

$page->assign("headline", $text->getHeadline());
$page->assign("text", $text->getContent());

$user = new User();
$users = $user->getAllByType(array('staff', 'admin', 'floor'));

$page->assign('userList', $users);

$page->display('staff.tpl');