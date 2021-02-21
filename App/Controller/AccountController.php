<?php


namespace Liloy\App\Controller;

use Liloy\Framework\Database\Connection;
use Liloy\Framework\Session\Sessioner;
use Liloy\App\Storage\OrderStorage;
use Liloy\Framework\Core\View;
use Liloy\Framework\Core\Controller;

class AccountController extends Controller
{
    public function history(): void
    {
        $view = new View($this->path);
        $session = new Sessioner();
        $orderStorage = new OrderStorage(Connection::getDb());
        $orders = $orderStorage->getOrdersByUserId($session->get('id'));
        $view->content['orders'] = $orders;
        $view->render();
    }
}
