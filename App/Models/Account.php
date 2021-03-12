<?php


namespace Liloy\App\Models;

use Liloy\App\Mappers\OrderMapper;
use Liloy\App\Mappers\UserMapper;
use Liloy\Framework\Database\Connection;
use Liloy\Framework\Session\Sessioner;

class Account extends \Liloy\Framework\Core\Model
{
    public function getAccountInfo(): array
    {
        $userStorage = new UserMapper($this->db);
        $orderMapper = new OrderMapper($this->db);
        $session = new Sessioner();
        $ordersCount = $orderMapper->getCountOrders($session->get('id'));
        $user = $userStorage->getUserById($session->get('id'));
        return [
            'firstName' => $user->getFirstName(),
            'lastName' => $user->getLastName(),
            'login' => $user->getLogin(),
            'email' => $user->getEmail(),
            'ordersCount' => $ordersCount
        ];
    }
    public function isAdmin(): bool
    {
        $userMapper = new UserMapper($this->db);
        $session = new Sessioner();
        $roleId = $userMapper->getRole($session->get('id'));
        return $roleId === 2;
    }

    public function searchFromHistory($request): array
    {
        $orderStorage = new OrderMapper($this->db);
        $session = new Sessioner();
        $orders = $orderStorage->search($session->get('id'), $request);
        $countPages = ceil(count($orders) / 5);
        $firstProduct = ($request->page - 1) * 5;
        $lastProduct = $firstProduct + 4;
        $page = [];
        foreach ($orders as $key => $product) {
            if ($key >= $firstProduct && $key <= $lastProduct) {
                $page[] = $product;
            }
        }
        $answer['countPages'] = $countPages;
        $answer['page'] = $page;
        return $answer;
    }
}
