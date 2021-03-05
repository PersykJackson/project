<?php


namespace Liloy\App\Controller;

use Liloy\Framework\Database\Connection;
use Liloy\Framework\Session\Sessioner;
use Liloy\App\Mappers\OrderMapper;
use Liloy\Framework\Core\View;
use Liloy\Framework\Core\Controller;

class AccountController extends Controller
{
    public function history(): void
    {
        $view = new View($this->path);
        $view->render();
    }

    public function search(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = json_decode($this->request['ajax']);
            $orderStorage = new OrderMapper(Connection::getDb());
            $session = new Sessioner();
            $orders = $orderStorage->search($session->get('id'), $result);
            echo json_encode($orders);
        }
    }

    public function startSearch(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $orderStorage = new OrderMapper(Connection::getDb());
            $session = new Sessioner();
            $orders = $orderStorage->startSearch($session->get('id'));
            echo json_encode($orders);
        }
    }
}
