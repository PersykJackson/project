<?php
namespace App\Models;

use Liloy\App\Models\Main;
use Liloy\Framework\Database\Connection;
use UnitTester;

class MainCest
{
    public function _before(UnitTester $I)
    {
        Connection::getInstance();
    }

    // tests
    public function tryToTestGetCategories(UnitTester $I)
    {
        $mainModel = new Main(Connection::getDb());
        $categories = $mainModel->getCategories();
        $I->assertTrue(count($categories) > 0);
        $I->assertTrue(isset($categories[0]['name'])
            && isset($categories[0]['id'])
            && isset($categories[0]['img']));
    }
}
