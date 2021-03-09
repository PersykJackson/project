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
            ->where("date = ? AND comment = ?")
            ->params([$order->getDate(), $order->getComment()])
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

    public function search(int $id, object $obj): array
    {
        $result = $this->select(
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
        foreach ($result as $key => $value) {
            $result[$key]['products'] = $this->getOrderProductsByOrderId($value['id']);
        }
        return $result;
    }
}
