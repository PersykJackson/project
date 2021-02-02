<?php

include '../vendor/autoload.php';

use Liloy\App\Session\Sessioner;
use Liloy\Router\Router;
use Liloy\App\Helpers\{
    Logger\Logger,
    Exceptions\BadRouteException,
    Exceptions\SessException,
    Exceptions\AuthException,
    Exceptions\StorageException,
};

$logger = new Logger();
if ($_SERVER['REQUEST_URI'] === '/favicon.ico') {
    die();
}

try {
    $session = new Sessioner();
    $session->setSavePath();
    if (array_key_exists('PHPSESSID', $_COOKIE)) {
        $session->start();
        echo "<script>console.log('Session has start!')</script>";
    }
    $router = new Router($_SERVER['REQUEST_URI']);
    $router->execute();
} catch (BadRouteException $error) {
    $logger->warning($error->getMessage());
} catch (SessException $error) {
    $logger->warning($error->getMessage());
} catch (AuthException $error) {
    $logger->warning($error->getMessage());
} catch (StorageException $error) {
    $logger->warning($error->getMessage());
} catch (Exception $error) {
    echo $error->getMessage();
}
