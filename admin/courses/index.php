<?php
require_once "../../_inc/_page.php";

if (isset($_GET['delete'])){
    $course = new Course($_GET['delete']);
    $course->delete(false);
    
    header("Location: /admin/courses");
}

$course = new Course();
$courses = $course->getAll();

$page->assign('courses', $courses);

$page->display('admin/courses/index.tpl');