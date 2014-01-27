<?php
require_once "../../_inc/_page.php";

if (isset($_FILES['csv'])){
    $csv = file_get_contents($_FILES['csv']['tmp_name']);
    
    $rows = explode("\n", $csv);
    
    foreach ($rows as $row){
        $item = explode(",", $row);
        
        $item[3] = str_replace("\\", "", $item[3]);
        
        if (trim($item[1]) == '') continue;
        
        $product = new Product();
        $product->setName($item[1]);
        $product->setPrice($item[0]);
        $product->setWeight($item[2]);
        
        $category = new Category();
        if (strlen($item[3]) > 1){
            $category->loadByType('name', $item[3]);
            
            if ($category->isNew()){
                $category->setName($item[3]);
                $category->setActive(time());
                $category->setSeo(Util::seoSafe($item[3]));
                $category->save();
            }
        }
        
        $product->setCategory($category->getId());
        $product->setActive(time());
        $product->setTimestamp(time());
        $product->setSeo(Util::seoSafe($item[1]));
        
        $product->save();
    }
    
    //header("Location: /admin/products");
}

$page->display('admin/products/upload.tpl');