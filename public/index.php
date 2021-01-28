<?php

include_once '../autoload.php';

$logger = new Logger();
if ($_SERVER['REQUEST_URI'] === '/favicon.ico') {
    die();
}
try {
    $router = new Router($_SERVER['REQUEST_URI']);
    $router->execute();
    //$products = require_once '../App/Database/products.php';
    //$path = trim($_SERVER['REQUEST_URI'], '/');
    //$loader = new LayoutLoader($products, $path);
    //$loader->render();
} catch (BadRouteException $error) {
    $logger->warning($error->getMessage());
} catch (ProductFoundtException $error) {
    $logger->warning($error->getMessage(), ['id' => 13]);
} catch (Exception $error) {
    echo $error->getMessage();
}
