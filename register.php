<?php
require_once "_inc/_page.php";

$text = new Text();
$text->loadByType("seo", "register");
$page->assign('text', $text);

if (isset($_POST['email'])){
    if ($_POST['password'] === $_POST['password2']){
        $user = new User();
        $user->loadByType("email", $_POST['email']);
        if ($user->isNew()){
            $_POST['password'] = md5($_POST['password']);
            $user->populate($_POST);
            // always set acl to student when created on website
            $user->setAcl(ACL_STUDENT);
            $user->setTimestamp(time());
            $user->setActive(time());
            $user->save();
            
            if ($user->login($_POST['email'], $_POST['password2']))
                header("Location: /");
                // Error handling
        } else {
            // User exists
        }        
    } else {
        // Passwords don't match
    }
}

$page->display('register.tpl');