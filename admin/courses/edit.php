<?php
require_once "../../_inc/_page.php";

$course = new Course(isset($_GET['id']) ? $_GET['id'] : null);


if (isset($_POST['headline'])){
    $course->setContent($_POST['contentEditor']);
    $course->setHeadline($_POST['headline']);
    $course->setSeo(Util::seoSafe($_POST['headline']));
    $course->setActive(isset($_POST['active']) && $_POST['active'] > 0 ? time() : 0);
    $course->setVisible(isset($_POST['visible']) && $_POST['visible'] > 0 ? 1 : 0);
    $course->setTimestamp(time());
    $course->save();
    
    header("Location: /admin/courses");
}

$page->assign('course', $course);


$page->display('admin/courses/edit.tpl');