<?php

namespace Liloy\Router;

use Liloy\App\Controller\ErrorController;
use Liloy\App\Database\Connection;
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

    private string $path;

    private array $request = [];

    public function __construct(string $route)
    {
        $this->route = $route;
    }

    private function prepare(): void
    {
        Connection::getInstance();
        $parser = new RouteParser();
        $request = new Request();
        if (strpos($this->route, '?')) {
            $exploded = explode('?', $this->route);
            $parser->parse($exploded[0]);
            $request->get($exploded[1]);
        } else {
            $parser->parse($this->route);
        }
        $this->controller = $parser->getController();
        $this->action = $parser->getAction();
        $this->path = $parser->getPath();
        $this->request = $request->getRequest();
    }

    private function execute(): void
    {
        $this->prepare();
        if (!class_exists($this->controller)) {
            throw new BadRouteException();
        } elseif (!method_exists($this->controller, $this->action)) {
            throw new BadRouteException();
        } else {
            $controller = new $this->controller($this->path, $this->request);
            $action = $this->action;
            try {
                $controller->$action();
            } catch (StorageException | AuthException | SessException $message) {
                $controller = new ErrorController('/errors/notFound');
                $controller->notFound();
            }
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
