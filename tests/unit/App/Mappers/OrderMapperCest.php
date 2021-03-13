<?php
namespace App\Mappers;

use Liloy\App\Mappers\Order;
use Liloy\App\Mappers\OrderMapper;
use Liloy\Framework\Database\Connection;
use UnitTester;
use function PHPUnit\Framework\assertTrue;

class OrderMapperCest
{
    public OrderMapper $orderMapper;

    public function _before(UnitTester $I)
    {
        putenv('APP_ENV=test');
        Connection::getInstance();
        $this->orderMapper = new OrderMapper(Connection::getDb());
    }

    // tests
    public function tryToTestInsertAndSearchOrder(UnitTester $I)
    {
        $order = new Order();
        $amount[12] = 1;
        $hash = md5(rand(11, 9999));
        $order->setAddress($hash)
            ->setAmount($amount)
            ->setUserId(24)
            ->setDate('2021-12-12')
            ->setPhone('0990668424')
            ->setComment('test');
        $this->orderMapper->insertOrder($order);
        $orderSearchParams = new Class(){
            public $type = 'address';
            public $sort = 'id';
            public $search = '';
        };
        $orderSearchParams->search = $hash;
        $order = $this->orderMapper->searchOrders(24, $orderSearchParams);
        $I->assertTrue((bool)$order);
    }

    public function tryToTestGetOrderProductsByOrderId(UnitTester $I)
    {
        $orders = $this->orderMapper->getOrderProductsByOrderId(23);
        $I->assertEquals(3, count($orders));
    }

    public function tryToTestGetCountOrders()
    {
        $count = $this->orderMapper->getCountOrders(24);
        assertTrue($count > 0);
    }
}
