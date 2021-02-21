<?php


namespace Liloy\App\Storage;

use Liloy\Framework\Core\Storage;

class OrderStorage extends Storage
{
    public function insertOrder(Order $order): void
    {
        $this->create('orders', ['address' => $order->getAddress(),
            'comment' => $order->getComment(),
            'phone' => $order->getPhone(),
            'date' => $order->getDate(),
            'user_id' => $order->getUserId()]);
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

    public function getOrdersByUserId(int $id): array
    {
        $orders = $this->select('orders', ['id' ,'address', 'comment', 'phone', 'date'])
            ->where('user_id = ?')
            ->params([$id])
            ->execute();
        foreach ($orders as $key => $order) {
            $products = $this->select('orders_products', ['product_id', 'amount'])
                ->where('order_id = ?')
                ->params([$order['id']])
                ->execute();
            foreach ($products as $product) {
                if (isset($orders[$key]['info'])) {
                    $orders[$key]['info'] .= $tst = $this->select('products', ['name'])
                            ->where('id = ?')
                            ->params([$product['product_id']])
                            ->execute()[0]['name'] . " - " . $product['amount'].'<br>';
                } else {
                    $orders[$key]['info'] = $tst = $this->select('products', ['name'])
                            ->where('id = ?')
                            ->params([$product['product_id']])
                            ->execute()[0]['name'] . " - " . $product['amount'].'<br>';
                }
            }
        }
        return $orders;
    }
}
