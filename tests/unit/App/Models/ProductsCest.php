<?php
namespace App\Models;

use Liloy\App\Models\Products;
use Liloy\Framework\Database\Connection;
use UnitTester;

class ProductsCest
{
    public function _before(UnitTester $I)
    {
        Connection::getInstance();
    }

    // tests
    public function tryToTest(UnitTester $I)
    {
        $productsModel = new Products(Connection::getDb());
        $class = new Class(){
            public $category = false;
            public $page = 1;
        };
        $result = $productsModel->getProductsWithPagination($class);
        $I->assertTrue(isset($result['page']));
        $I->assertTrue(isset($result['countPages']));
        $I->assertTrue(count($result['page']) > 0);
    }
}
