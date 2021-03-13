<?php
namespace Framework\Core;

use Liloy\Framework\Core\View;
use UnitTester;

class ViewCest
{
    public function _before(UnitTester $I)
    {
    }

    // tests
    public function tryToTestView(UnitTester $I)
    {
        $view = new View('/main/index', ['name' => 'test']);
        $view->prepare();
        $I->assertEquals('test', $view->content['data']['name']);
        $I->assertEquals('index', $view->content['css']);
    }
}
