<?php
session_start();

set_include_path(get_include_path() . ":../:../../_class");

define('DOCUMENT_ROOT', realpath(''));
define('WEB_ROOT', str_replace('/vagrant', '', realpath('')));

// Autoload classes
function wedding_autoload($class_name) {
    $class_name = str_replace('_', '/', $class_name);
    $found = false;
    $includePaths = explode(':', get_include_path());
    foreach ($includePaths as $path){
        if (@is_file($path . '/_class/' . $class_name . '.php'))
            $found = true;
    }
    if ($found)
        require_once '_class/' . $class_name . '.php';
}

spl_autoload_register('wedding_autoload');

$page = new Page();

if (isset($_SESSION['user']))
    $page->assign('user', unserialize($_SESSION['user']));
else 
    $page->assign('user', new User());
