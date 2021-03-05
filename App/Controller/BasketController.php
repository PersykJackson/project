<?php


namespace Liloy\App\Controller;

use Liloy\Framework\Database\Connection;
use Liloy\Framework\Session\Sessioner;
use Liloy\App\Storage\CategoryMapper;
use Liloy\App\Storage\ProductMapper;
use Liloy\Framework\Core\View;
use Liloy\Framework\Core\Controller;

class BasketController extends Controller
{
    private const UNSET = 'unset';

    private const INCREMENT = 'increment';

    private const DECREMENT = 'decrement';

    public function index(): void
    {
        $view = new View($this->path);
        $view->content['css'] = 'basket';
        $view->render();
    }

    public function change(): void
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $session = new Sessioner();
            $decodedRequest = json_decode($this->request['ajax']);
            if ($decodedRequest->action === self::UNSET) {
                $session->deleteFromBasket($decodedRequest->id);
            } elseif ($decodedRequest->action === self::INCREMENT) {
                $session->setAmount($decodedRequest->id, ($session->getFromBasket($decodedRequest->id)['amount'] + 1));
            } elseif ($decodedRequest->action === self::DECREMENT) {
                $session->setAmount($decodedRequest->id, $session->getFromBasket($decodedRequest->id)['amount'] - 1);
                if ($session->getFromBasket($decodedRequest->id)['amount'] < 1) {
                    $session->deleteFromBasket($decodedRequest->id);
                }
            }
        }
    }

    public function getBasket(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST')
        $productsStorage = new ProductMapper(Connection::getDb());
        $products = [];
        $session = new Sessioner();
        if ($session->get('basket')) {
            foreach ($session->get('basket') as $item) {
                $products[] = ['item' => $productsStorage->getProductById($item['id']), 'amount' => $item['amount']];
            }

        }
        echo json_encode($products);
    }

    public function add(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $sessioner = new Sessioner();
            $id = json_decode($this->request['ajax'])->id;
            if ($sessioner->contains('basket')) {
                $basket = $sessioner->get('basket');
                foreach ($basket as $key => $item) {
                    if ($item['id'] === $id) {
                        $basket[$key]['amount']++;
                        $sessioner->set('basket', $basket);
                        return;
                    }
                }
                $basket[] = ['id' => $id, 'amount' => 1];
            } else {
                $basket[] = ['id' => $id, 'amount' => 1];
            }
            $sessioner->set('basket', $basket);
        }
    }
}
