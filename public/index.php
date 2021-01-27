<?php

include_once '../autoload.php';

$logger = new Logger();
if ($_SERVER['REQUEST_URI'] === '/favicon.ico') {
    die();
}
try {
    $products = require_once '../App/Database/products.php';
    $productSearcher = new ProductSearcher($products);
    $product = $productSearcher->getProduct(11);
    $path = trim($_SERVER['REQUEST_URI'], '/');
    $loader = new LayoutLoader($products, $path);
    $loader->render();
} catch (ProductFoundtException $error) {
    $logger->warning($error->getMessage(), ['id' => 13]);
} catch (Exception $error) {
    echo $error->getMessage();
}
