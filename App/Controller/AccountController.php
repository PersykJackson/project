<?php


namespace Liloy\App\Controller;

use Liloy\App\Database\Connection;
use Liloy\App\Session\Sessioner;
use Liloy\App\Storage\OrderStorage;
use Liloy\App\View\View;

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
