<?php
require_once "_inc/_page.php";

$text = new Text();
$text->loadByType('seo', 'products');

$page->assign("headline", $text->getHeadline());
$page->assign("text", $text->getContent());

$offset = isset($_GET['offset']) ? $_GET['offset'] : 0;
$limit = isset($_GET['limit']) ? $_GET['limit'] : 16;
$brandSeo = isset($_GET['brand']) ? $_GET['brand'] : null;
$categorySeo = isset($_GET['category']) ? $_GET['category'] : null;
$offer = isset($_GET['offers']) ? true : false;

$brand = new Brand();
$brand->loadByType('seo', $brandSeo);

$category = new Category();
$category->loadByType('seo', $categorySeo);

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
$meta = $product->getActiveProducts(array('brand' => $brand->getId(), 'categories' => $includeCats, 'offer' => $offer), ($offset*$limit), $limit);

$page->assign('products', $meta['products']);
$page->assign('nextPage', $offset+1);
$page->assign('previousPage', $offset-1);
if ($meta['numberOfProducts'] > ($offset*$limit)+$limit){
    $page->assign('showMore', true);
} else {
    $page->assign('showMore', false);
}
$page->assign('categorySeo', $categorySeo);
$page->assign('brandSeo', $brandSeo);

$page->display('products.tpl');