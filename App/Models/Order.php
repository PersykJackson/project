<?php


namespace Liloy\App\Models;

use Liloy\App\Mappers\OrderMapper;
use Liloy\App\Mappers\Order as MappersItem;
use Liloy\Framework\Session\Sessioner;

class Order extends \Liloy\Framework\Core\Model
{
    public function newOrder($request): bool
    {
        if ($request->address === '' || $request->phone === '') {
            return false;
        }
        $session = new Sessioner();
        if (!$session->get('basket')) {
            return false;
        }
        $order = new MappersItem();
        $amount = [];
        foreach ($session->get('basket') as $product) {
            $amount[$product['id']] = $product['amount'];
        }
        $order->setAddress($request->address)
            ->setComment($request->comment)
            ->setPhone($request->phone)
            ->setDate($request->date)
            ->setAmount($amount)
            ->setUserId($session->get('id'));
        $orderMapper = new OrderMapper($this->db);
        $orderMapper->insertOrder($order);
        $session->delete('basket');
        return true;
    }
}
