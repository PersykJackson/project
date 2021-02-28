<?php


namespace Liloy\App\Controller;

use Liloy\App\Storage\CategoryStorage;
use Liloy\Framework\Database\Connection;
use Liloy\Framework\Session\Sessioner;
use Liloy\App\Storage\OrderStorage;
use Liloy\Framework\Core\View;
use Liloy\Framework\Core\Controller;

class AccountController extends Controller
{
    public function history(): void
    {
        $categoryStorage = new CategoryStorage(Connection::getDb());
        $categories = $categoryStorage->getCategories();
        $session = new Sessioner();
        $orderStorage = new OrderStorage(Connection::getDb());
        if (isset($this->request['get']['str'])) {
            $lim = $this->request['get']['str'];
        } else {
            $lim = 1;
        }
        $count = $orderStorage->getCountOrdersById($session->get('id')) / 5;
        if (is_float($count)) {
            $count = (int)round($count, 1) + 1;
        }
        $orders = $orderStorage->getOrdersByUserId($session->get('id'), $lim);
        $view = new View($this->path, [
            'Categories' => $categories,
            'orders' => $orders,
            'countOrders' => $count
        ]);
        $view->render();
    }
    public function search()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = json_decode(file_get_contents('php://input'));
            $orderStorage = new OrderStorage(Connection::getDb());
            $session = new Sessioner();
            $orders = $orderStorage->search($session->get('id'), $result);
            echo json_encode($orders);
        }
    }
    public function startSearch()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $orderStorage = new OrderStorage(Connection::getDb());
            $session = new Sessioner();
            $orders = $orderStorage->startSearch($session->get('id'));
            echo json_encode($orders);
        }
    }
}
