<?php
require_once "_inc/_page.php";

$course = new Course();
$course->loadByType('seo', $_GET['seo']);

$page->assign("headline", $course->getHeadline());
$page->assign("text", $course->getContent());

$page->display('course.tpl');