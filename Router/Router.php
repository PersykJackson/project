<?php


class Router
{
    private string $route;
    private string $controller;
    private string $action;
    public function __construct(string $route)
    {
        $this->route = $route;
    }
    public function prepare(): void
    {
        if ($this->route === '/') {
            $this->route = '/main/index';
        }
        preg_match('/\/(.*)\/(.*)$/', $this->route, $matches);
        if (count($matches) < 3) {
            throw new BadRouteException();
        }
        $this->controller = ucfirst($matches[1]).'Controller';
        $this->action = $matches[2];
    }
    public function execute(): void
    {
        $this->prepare();
        if (class_exists($this->controller)) {
            if (method_exists($this->controller, $this->action)) {
                $controller = new $this->controller($this->route);
                $action = $this->action;
                $controller->$action();
            } else {
                throw new BadRouteException();
            }
        } else {
            throw new BadRouteException();
        }
    }
}