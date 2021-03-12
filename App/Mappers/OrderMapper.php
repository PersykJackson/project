<?php


namespace Liloy\App\Mappers;

use Liloy\Framework\Core\Mapper;
use Liloy\Framework\Database\Connection;

class OrderMapper extends Mapper
{
    public function insertOrder(Order $order): void
    {
        $this->create('orders', ['address' => $order->getAddress(),
            'comment' => $order->getComment(),
            'phone' => $order->getPhone(),
            'date' => $order->getDate(),
            'user_id' => $order->getUserId()]);
        $id = (int)$this->select('orders', ['id'])
            ->orderBy(['id DESC'])
            ->limit(1)
            ->execute()[0]['id'];
        foreach ($order->getAmount() as $productId => $amount) {
            $this->create('orders_products', ['order_id' => $id,
                'product_id' => $productId,
                'amount' => $amount]);
        }
    }

    public function getOrderProductsByOrderId(int $id): array
    {
        $products = $this->select('orders_products', ['product_id', 'amount'])
            ->where('order_id = ?')
            ->params([$id])
            ->execute();
        $productsStorage = new ProductMapper(Connection::getDb());
        foreach ($products as $key => $product) {
            $products[$key]['name'] = $productsStorage->getProductById($product['product_id'])->getName();
        }
        return $products;
    }

    public function searchOrders(int $id, object $obj): array
    {
        $searchResult = $this->select(
            'orders',
            [
                'id',
                'address',
                'phone',
                'date',
                'comment'
            ]
        )
            ->where("user_id = ? AND {$obj->type} LIKE ?")
            ->orderBy([$obj->sort])
            ->params([$id, '%'.$obj->search.'%'])
            ->execute();
        $orders = [];
        foreach ($searchResult as $key => $value) {
            $orders[$key]['products'] = $this->getOrderProductsByOrderId($value['id']);
        }
        return $orders;
    }

    public function getCountOrders(int $id): int
    {
        return $this->select('orders', ['count(id)'])
            ->where('user_id = ?')
            ->params([$id])
            ->execute()[0]['count(id)'];
    }
}
