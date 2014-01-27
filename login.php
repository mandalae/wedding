<?php
require_once "_inc/_page.php";

$user = new User();

if (isset($_GET['action']) && $_GET['action'] == 'logout'){
    $user->logout();
    header("Location: /");
}

if (isset($_POST['email']) && $_POST['email'] != '' && isset($_POST['password']) && $_POST['password'] != ''){
    if ($user->login($_POST['email'], $_POST['password']))
        header("Location: " . $_POST['returnUrl']);
    else 
        $page->assign("error", true);

}


$page->display('login.tpl');