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
}
