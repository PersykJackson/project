<?php

include '../vendor/autoload.php';

use Liloy\Framework\Session\Sessioner;
use Liloy\Framework\Router\Router;
use Liloy\Logger\Logger;

if ($_SERVER['REQUEST_URI'] === '/favicon.ico') {
    die();
}

$log = new Logger(__DIR__.'/Logs/logger.log');
try {
    $session = new Sessioner();
    $session->setSavePath();
    if (array_key_exists('session', $_COOKIE)) {
        if ((int) $_COOKIE['session']) {
            $session->start();
        }
    }
    $router = new Router($_SERVER['REQUEST_URI']);
    $router->run();
} catch (Exception $error) {
    $log->critical($error->getMessage());
}
