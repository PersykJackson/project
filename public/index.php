<?php

include '../vendor/autoload.php';

use Liloy\App\Session\Sessioner;
use Liloy\Router\Router;
use Liloy\Logger\Logger;
use Liloy\App\Helpers\{
    Exceptions\BadRouteException,
    Exceptions\SessException,
    Exceptions\AuthException,
    Exceptions\StorageException,
};

if ($_SERVER['REQUEST_URI'] === '/favicon.ico') {
    die();
}

try {
    $log = new Logger(__DIR__.'/Logs/logger.log');
    $session = new Sessioner();
    $session->setSavePath();
    if (array_key_exists('session', $_COOKIE)) {
        if ((int) $_COOKIE['session']) {
            $session->start();
        }
    }
    $router = new Router($_SERVER['REQUEST_URI']);
    $router->execute();
} catch (BadRouteException | SessException $error) {
    $log->warning($error->getMessage());
} catch (AuthException $error) {
    $log->warning($error->getMessage());
} catch (StorageException $error) {
    $log->warning($error->getMessage());
} catch (Exception $error) {
    $log->warning($error->getMessage());
}