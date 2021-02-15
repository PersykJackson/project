<?php

namespace Liloy\Router;

use Liloy\App\Controller\ErrorController;
use Liloy\App\Helpers\Exceptions\{
    AuthException,
    BadRouteException,
    SessException,
    StorageException,
};

class Router
{
    private string $route;

    private string $controller;

    private string $action;

    private array $get = [];

    public function __construct(string $route)
    {
        $this->route = $route;
    }

    public function prepare(): void
    {
        if ($this->route === '/') {
            $this->route = '/main/index';
        }
        if (strpos($this->route, '?')) {
            preg_match('/^\/(.+)\/(.+)\?(.+)$/', $this->route, $matches);
            $exploded = explode('?', $this->route);
            $this->route = $exploded[0];
            $exploded = explode('&', $exploded[1]);
            foreach ($exploded as $key => $value) {
                $result = explode('=', $value);
                $get[$result[0]] = $result[1];
            }
            $this->get = $get;
        } else {
            preg_match('/^\/(.+)\/(.+)$/', $this->route, $matches);
        }
        if (count($matches) < 3 || count($matches) > 4) {
            throw new BadRouteException();
        }
        $this->controller = 'Liloy\\App\\Controller\\'.ucfirst($matches[1]).'Controller';
        $this->action = $matches[2];
    }

    public function execute(): void
    {
        $this->prepare();
        if (class_exists($this->controller)) {
            if (method_exists($this->controller, $this->action)) {
                $controller = new $this->controller($this->route, $this->get);
                $action = $this->action;
                try {
                    $controller->$action();
                } catch (StorageException | AuthException | SessException $message) {
                    $controller = new ErrorController('/errors/notFound');
                    $controller->notFound();
                }
            } else {
                throw new BadRouteException();
            }
        } else {
            throw new BadRouteException();
        }
    }

    public function run(): void
    {
        try {
            $this->execute();
        } catch (BadRouteException $error) {
            $controller = new ErrorController('/errors/notFound');
            $controller->notFound();
        }
    }
}
