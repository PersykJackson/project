<?php


namespace Liloy\App\Controller;

use Liloy\App\Database\Connection;
use Liloy\App\Session\Sessioner;
use Liloy\App\Storage\Order;
use Liloy\App\Storage\OrderStorage;
use Liloy\App\View\View;

class OrderController extends Controller
{
    public function index(): void
    {
        $view = new View($this->path);
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
            $order->setAddress($_POST['address'])
                ->setComment($_POST['comment'])
                ->setPhone($_POST['phone'])
                ->setDate($_POST['date'])
                ->setAmount($amount);
            $orderStorage = new OrderStorage(Connection::getDb());
            $orderStorage->insertOrder($order);
            $session->delete('basket');
            header('Location: /main/index');
        }
    }
}
