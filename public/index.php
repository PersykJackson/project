<?php

include_once '../autoload.php';

try {
    $products = require_once '../products.php';
    $productSearcher = new ProductSearcher($products);
    $product = $productSearcher->getProduct(11);
    $path = trim($_SERVER['REQUEST_URI'], '/');
    $loader = new LayoutLoader(array(), $path);
    $loader->render();
} catch (ProductFoundtException $error) {
    echo $error->getMessage();
} catch (Exception $error) {
    echo $error->getMessage();
}
