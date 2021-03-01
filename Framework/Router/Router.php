<?php

namespace Liloy\Framework\Router;

use Liloy\App\Controller\ErrorController;
use Liloy\Framework\Helpers\Exceptions\FrameworkException;

class Router
{
    private string $route;

    private string $controller;

    private string $action;

    private string $path;

    private array $request = [];

    private const NOT_FOUND = '/errors/notFound';

    public function __construct(string $route)
    {
        $this->route = $route;
    }

    private function prepare(): void
    {
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
        }
        if (!method_exists($this->controller, $this->action)) {
            throw new BadRouteException();
        }
            $controller = new $this->controller($this->path, $this->request);
            $action = $this->action;
            $controller->$action();
    }

    public function run(): void
    {
        try {
            $this->execute();
        } catch (FrameworkException $error) {
            $controller = new ErrorController(self::NOT_FOUND);
            $controller->notFound();
        }
    }
}
