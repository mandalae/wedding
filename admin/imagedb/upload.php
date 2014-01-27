<?php
require_once "../../_inc/_page.php";

if (isset($_FILES['Filedata'])){
    if (file_exists($_FILES['Filedata']['tmp_name'])){
        $image = new Image();
    	// get image info
    	$res = $image->upload($_FILES['Filedata']['tmp_name'], $_FILES['Filedata']['name']);
    	$tags = explode(",", $_POST['tags']);
    	$image->addTags($tags);
    	echo json_encode(array("msg" => "Image uploaded", "success" => true, "path" => $res['path']));
    } else {
        echo json_encode(array("msg" => "File not found!", "success" => false));
    }
    // Stop the page here
    exit;
}

$page->assign("selector", isset($_GET['selector']) ? $_GET['selector'] : '');
$page->assign("multiple", isset($_GET['multiple']) ? $_GET['multiple'] : '');
$page->assign("query", isset($_GET['query']) ? $_GET['query'] : '');

$page->display('admin/imagedb/upload.tpl');