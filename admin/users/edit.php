<?php
require_once "../../_inc/_page.php";

$user = new User(isset($_GET['id']) ? $_GET['id'] : null);


if (isset($_POST['name'])){
    $_POST['active'] = $_POST['active'] > 0 ? time() : 0;
    $user->populate($_POST);
    $user->save();
    header("Location: /admin/users");
}


$acl = new ACL();
$page->assign('acl', $acl->getAllActive());

$page->assign('user', $user);


$page->display('admin/users/edit.tpl');