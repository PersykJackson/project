<?php


namespace Liloy\App\Controller;

use Liloy\App\Storage\CategoryMapper;
use Liloy\Framework\Database\Connection;
use Liloy\Framework\Session\Sessioner;
use Liloy\App\Storage\OrderMapper;
use Liloy\Framework\Core\View;
use Liloy\Framework\Core\Controller;

class AccountController extends Controller
{
    public function history(): void
    {
        $categoryStorage = new CategoryMapper(Connection::getDb());
        $categories = $categoryStorage->getCategories();
        $view = new View($this->path, ['Categories' => $categories]);
        $view->render();
    }
    public function search()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = json_decode(file_get_contents('php://input'));
            $orderStorage = new OrderMapper(Connection::getDb());
            $session = new Sessioner();
            $orders = $orderStorage->search($session->get('id'), $result);
            echo json_encode($orders);
        }
    }
    public function startSearch()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $orderStorage = new OrderMapper(Connection::getDb());
            $session = new Sessioner();
            $orders = $orderStorage->startSearch($session->get('id'));
            echo json_encode($orders);
        }
    }
}
