<?php

namespace Framework\Router;

use Liloy\Framework\Router\Request;
use UnitTester;

class RequestCest
{
    public function _before(UnitTester $I)
    {
        $_POST['test'] = 'test';
        $_FILES['file'] = 'test';
    }

    // tests
    public function tryToTestRequestGetting(UnitTester $I)
    {
        $requestClass = new Request();
        $requestClass->setPost();
        $requestClass->setGet('name=Jack&age=38');
        $request = $requestClass->getRequest();
        $I->assertEquals('test', $request['post']['test']);
        $I->assertEquals('Jack', $request['get']['name']);
        $I->assertEquals('38', $request['get']['age']);
        $I->assertEquals('test', $request['file']);
    }
}
