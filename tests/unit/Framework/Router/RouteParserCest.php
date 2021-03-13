<?php
namespace Framework\Router;

use Liloy\Framework\Router\RouteParser;
use Liloy\Framework\Helpers\Exceptions\BadRouteException;
use UnitTester;

class RouteParserCest
{
    public function _before(UnitTester $I)
    {
    }

    // tests
    public function tryToTestRouteParse(UnitTester $I)
    {
        $routeParser = new RouteParser();
        $route = '/controller/index';
        $routeParser->parse($route);
        $I->assertEquals('Liloy\\App\\Controller\\ControllerController', $routeParser->getController());
        $I->assertEquals('index', $routeParser->getAction());
        $I->assertEquals($route, $routeParser->getPath());
        $routeParser->parse('/');
        $I->assertEquals('Liloy\\App\\Controller\\MainController', $routeParser->getController());
        $I->assertEquals('index', $routeParser->getAction());
        $I->assertEquals('/main/index', $routeParser->getPath());
        $I->expectThrowable(BadRouteException::class, function () use ($routeParser) {
            $routeParser->parse('/dss');
        });
    }
}
