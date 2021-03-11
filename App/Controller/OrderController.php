<?php


namespace Liloy\App\Controller;

use Liloy\Framework\Database\Connection;
use Liloy\Framework\Session\Sessioner;
use Liloy\App\Mappers\Order;
use Liloy\App\Mappers\OrderMapper;
use Liloy\Framework\Core\View;
use Liloy\Framework\Core\Controller;

class OrderController extends Controller
{
    public function index(): void
    {
        $view = new View($this->path);
        $view->render();
    }

    public function new(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $decodedRequest = json_decode($this->request['ajax']);
            if ($decodedRequest->address === '' || $decodedRequest->phone === '') {
                echo json_encode(false);
                exit();
            }
            $session = new Sessioner();
            $order = new Order();
            $amount = [];
            foreach ($session->get('basket') as $product) {
                $amount[$product['id']] = $product['amount'];
            }
            $order->setAddress($decodedRequest->address)
                ->setComment($decodedRequest->comment)
                ->setPhone($decodedRequest->phone)
                ->setDate($decodedRequest->date)
                ->setAmount($amount)
                ->setUserId($session->get('id'));
            $orderStorage = new OrderMapper(Connection::getDb());
            $orderStorage->insertOrder($order);
            $session->delete('basket');
            echo json_encode(true);
        }
    }
}
