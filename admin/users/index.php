<?php
require_once "../../_inc/_page.php";

if (isset($_GET['delete'])){
    $user = new User($_GET['delete']);
    $user->delete();
    
    header("Location: /admin/users");
}

$user = new User();
$users = $user->getAll();

$page->assign('users', $users);

$page->display('admin/users/index.tpl');