<?php

include_once '../autoload.php';

$logger = new Logger();
if ($_SERVER['REQUEST_URI'] === '/favicon.ico') {
    die();
}

try {
    $router = new Router($_SERVER['REQUEST_URI']);
    $router->execute();
} catch (BadRouteException $error) {
    $logger->warning($error->getMessage());
} catch (Exception $error) {
    echo $error->getMessage();
}
