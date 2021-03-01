<?php


namespace Liloy\App\Controller;

use Liloy\App\Storage\CategoryMapper;
use Liloy\Framework\Database\Connection;
use Liloy\Framework\Session\Sessioner;
use Liloy\App\Storage\Order;
use Liloy\App\Storage\OrderMapper;
use Liloy\Framework\Core\View;
use Liloy\Framework\Core\Controller;

class OrderController extends Controller
{
    public function index(): void
    {
        $categoryStorage = new CategoryMapper(Connection::getDb());
        $categories = $categoryStorage->getCategories();
        $view = new View($this->path, ['Categories' => $categories]);
        $view->render();
    }

    public function new(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $session = new Sessioner();
            $order = new Order();
            $amount = [];
            foreach ($session->get('basket') as $product) {
                $amount[$product['id']] = $product['amount'];
            }
            $order->setAddress($this->request['post']['address'])
                ->setComment($this->request['post']['comment'])
                ->setPhone($this->request['post']['phone'])
                ->setDate($this->request['post']['date'])
                ->setAmount($amount)
                ->setUserId($session->get('id'));
            $orderStorage = new OrderMapper(Connection::getDb());
            $orderStorage->insertOrder($order);
            $session->delete('basket');
            header('Location: /main/index');
        }
    }
}
