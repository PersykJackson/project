<?php
namespace App\Models;

use Liloy\Framework\Database\Connection;
use UnitTester;
use Liloy\App\Models\Basket;

class BasketCest
{
    private Basket $basketModel;

    public function _before(UnitTester $I)
    {
        Connection::getInstance();
        $this->basketModel = new Basket(Connection::getDb());
    }

    // tests
    public function tryToTestBasketModel(UnitTester $I)
    {
        $id = 9;
        $this->basketModel->addProductToBasket($id);
        $changeProductCountRequest = new Class() {
            public $id = 9;
            public $action = 'increment';
        };
        $this->basketModel->changeProductsCountFromBasket($changeProductCountRequest);
        $basket = $this->basketModel->getBasket();
        $I->assertEquals($id, $basket[0]['item']->id);
        $I->assertEquals(2, $basket[0]['amount']);

        $changeProductCountRequest->action = 'decrement';
        $this->basketModel->changeProductsCountFromBasket($changeProductCountRequest);
        $basket = $this->basketModel->getBasket();
        $I->assertEquals($id, $basket[0]['item']->id);
        $I->assertEquals(1, $basket[0]['amount']);

        $changeProductCountRequest->action = 'unset';
        $this->basketModel->changeProductsCountFromBasket($changeProductCountRequest);
        $basket = $this->basketModel->getBasket();
        $I->assertFalse(isset($basket[0]));
    }
}
