<?php


namespace Liloy\App\Controller;

use Liloy\App\Mappers\UserMapper;
use Liloy\Framework\Database\Connection;
use Liloy\Framework\Session\Sessioner;
use Liloy\App\Mappers\OrderMapper;
use Liloy\Framework\Core\View;
use Liloy\Framework\Core\Controller;

class AccountController extends Controller
{
    public function index(): void
    {
        $view = new View($this->path);
        $view->render();
    }

    public function history(): void
    {
        $view = new View($this->path);
        $view->render();
    }

    public function info(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userStorage = new UserMapper(Connection::getDb());
            $orderMapper = new OrderMapper(Connection::getDb());
            $session = new Sessioner();
            $ordersCount = $orderMapper->getCountOrders($session->get('id'));
            $user = $userStorage->getUserById($session->get('id'));
            $userArray = [
                'firstName' => $user->getFirstName(),
                'lastName' => $user->getLastName(),
                'login' => $user->getLogin(),
                'email' => $user->getEmail(),
                'ordersCount' => $ordersCount
            ];
            echo json_encode($userArray);
        }
    }

    public function search(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $decodedRequest = json_decode($this->request['ajax']);
            $orderStorage = new OrderMapper(Connection::getDb());
            $session = new Sessioner();
            $orders = $orderStorage->search($session->get('id'), $decodedRequest);
            $countPages = ceil(count($orders) / 5);
            $firstProduct = (json_decode($this->request['ajax'])->page - 1) * 5;
            $lastProduct = $firstProduct + 4;
            $page = [];
            foreach ($orders as $key => $product) {
                if ($key >= $firstProduct && $key <= $lastProduct) {
                    $page[] = $product;
                }
            }
            $answer['countPages'] = $countPages;
            $answer['page'] = $page;
            echo json_encode($answer);
        }
    }
    public function isAdmin(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userMapper = new UserMapper(Connection::getDb());
            $session = new Sessioner();
            $roleId = $userMapper->getRole($session->get('id'));
            if ($roleId === 2) {
                echo json_encode(true);
            } else {
                echo json_encode(false);
            }
        }
    }
}
