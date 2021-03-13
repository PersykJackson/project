<?php


namespace Liloy\Framework\Router;

use Liloy\Framework\Helpers\Exceptions\BadRouteException;

class RouteParser
{
    private string $controller;

    private string $action;

    private string $path;

    private const INDEX = '/main/index';

    public function parse(string $route): void
    {
        if ($route === '/') {
            $route = self::INDEX;
        }
        preg_match('/^\/(.+)\/(.+)$/', $route, $matches);
        if (count($matches) < 3) {
            throw new BadRouteException();
        }
        $this->controller = 'Liloy\\App\\Controller\\'.ucfirst($matches[1]).'Controller';
        $this->action = $matches[2];
        $this->path = $route;
    }

    public function getController(): string
    {
        return $this->controller;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function getPath(): string
    {
        return $this->path;
    }
}
