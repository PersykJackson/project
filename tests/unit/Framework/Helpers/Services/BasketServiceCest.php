<?php
namespace Framework\Helpers\Services;

use Liloy\Framework\Helpers\Exceptions\BasketException;
use Liloy\Framework\Helpers\Services\BasketService;
use Liloy\Framework\Session\Sessioner;
use UnitTester;

class BasketServiceCest
{
    private BasketService $basket;
    private Sessioner $session;

    public function _before(UnitTester $I)
    {
        $this->session = new Sessioner();
        $this->session->setSavePath(__DIR__.'/../../Session/Sessions');
        $this->session->start();
        $this->basket = new BasketService($this->session);
    }

    public function _after(UnitTester $I)
    {
        $this->session->destroy();
    }

    // tests
    public function tryToTestBasketService(UnitTester $I)
    {
        $this->basket->set(['id' => 33, 'name' => 'test']);
        $I->assertEquals('test', $this->basket->get('33')['name']);
        $this->basket->setAmount(33, 11);
        $I->assertEquals(11, $this->basket->getAmount(33));
        $this->basket->delete(33);
        $I->expectThrowable(BasketException::class, function () {
            $this->basket->get('33')['name'];
        });
    }
}
