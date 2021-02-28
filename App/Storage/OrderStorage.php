<?php


namespace Liloy\App\Storage;

use Liloy\Framework\Core\Storage;
use Liloy\Framework\Database\Connection;

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

    public function getOrdersByUserId(int $id, int $lim = 1): array
    {
        $lim -= 1;
        $orders = $this->select('orders', ['id' ,'address', 'comment', 'phone', 'date'])
            ->where('user_id = ?')
            ->limit(5, $lim * 5)
            ->params([$id])
            ->execute();
        foreach ($orders as $key => $order) {
            $products = $this->select('orders_products', ['product_id', 'amount'])
                ->where('order_id = ?')
                ->params([$order['id']])
                ->execute();
            foreach ($products as $product) {
                if (isset($orders[$key]['info'])) {
                    $orders[$key]['info'] .= $this->select('products', ['name'])
                            ->where('id = ?')
                            ->params([$product['product_id']])
                            ->execute()[0]['name'] . " - " . $product['amount'].'<br>';
                } else {
                    $orders[$key]['info'] = $this->select('products', ['name'])
                            ->where('id = ?')
                            ->params([$product['product_id']])
                            ->execute()[0]['name'] . " - " . $product['amount'].'<br>';
                }
            }
        }
        return $orders;
    }

    public function getOrderProductsByOrderId(int $id): array
    {
        $products = $this->select('orders_products', ['product_id', 'amount'])
            ->where('order_id = ?')
            ->params([$id])
            ->execute();
        $productsStorage = new ProductStorage(Connection::getDb());
        foreach ($products as $key => $product) {
            $products[$key]['name'] = $productsStorage->getProductById($product['product_id'])->getName();
        }
        return $products;
    }

    public function getCountOrdersById(int $id): int
    {
        $result = $this->select('orders', ['COUNT(id)'])
            ->where('user_id = ?')
            ->params([$id])
            ->execute();
        return $result[0]['COUNT(id)'];
    }

    public function search(int $id, object $obj): array
    {
        $result = $this->select('orders', ['*'])
            ->where("user_id = ? AND {$obj->type} LIKE ?")
            ->orderBy([$obj->sort])
            ->params([$id, '%'.$obj->search.'%'])
            ->execute();
        foreach ($result as $key => $value) {
            $result[$key]['products'] = $this->getOrderProductsByOrderId($value['id']);
        }
        return $result;
    }
    public function startSearch(int $id): array
    {
        $result = $this->select('orders', ['*'])
            ->where("user_id = ?")
            ->params([$id])
            ->execute();
        foreach ($result as $key => $value) {
            $result[$key]['products'] = $this->getOrderProductsByOrderId($value['id']);
        }
        return $result;
    }
}
