<?php
require_once "../_inc/_page.php";

$offset = isset($_POST['offset']) ? $_POST['offset'] : 0;
$limit = isset($_POST['limit']) ? $_POST['limit'] : 16;
$brandId = isset($_POST['brandId']) ? $_POST['brandId'] : null;
$categoryId = isset($_POST['categoryId']) ? $_POST['categoryId'] : null;
$query = isset($_POST['query']) ? $_POST['query'] : null;
$lowerPrice = isset($_POST['lowerPrice']) ? $_POST['lowerPrice'] : null;
$upperPrice = isset($_POST['upperPrice']) ? $_POST['upperPrice'] : null;

$brand = new Brand($brandId);

$category = new Category($categoryId);

if (!$category->isNew()){
    $includeCats = array($category->getId());
    if ($category->getParent_category() == 0){
        $children = $category->getChildren();

        foreach ($children as $child){
            $includeCats[] = $child['id'];
        }
    }
}

$product = new Product();
$meta = $product->getActiveProducts(array('brand' => $brand->getId(), 'categories' => $includeCats, 'offer' => $offer, 'query' => $query, 'price' => array('lower' => $lowerPrice, 'upper' => $upperPrice)), ($offset*$limit), $limit);

$page->assign('products', $meta['products']);
$page->assign('nextPage', $offset+1);
$page->assign('previousPage', $offset-1);
if ($meta['numberOfProducts'] > ($offset*$limit)+$limit){
    $page->assign('showMore', true);
} else {
    $page->assign('showMore', false);
}
$page->assign('categorySeo', $categoryId);
$page->assign('brandSeo', $brandId);

$page->display('product-list.tpl');