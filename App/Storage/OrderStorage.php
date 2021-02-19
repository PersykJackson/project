<?php


namespace Liloy\App\Storage;

use Liloy\App\Session\Sessioner;

class OrderStorage extends Storage
{
    public function insertOrder(Order $order): void
    {
        $this->create('orders', ['address' => $order->getAddress(),
            'comment' => $order->getComment(),
            'phone' => $order->getPhone(),
            'date' => $order->getDate()]);
        $id = (int)$this->select('orders', ['id'])
            ->where("date = ? AND comment = ?")
            ->params([$order->getDate(), $order->getComment()])
            ->execute()[0]['id'];
        foreach ($order->getAmount() as $productId => $amount) {
            $this->create('orders_products', ['order_id' => $id,
                'product_id' => $productId,
                'amount' => $amount]);
        }
    }
}
