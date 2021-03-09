<?php


namespace Liloy\App\Controller;

use Liloy\Framework\Database\Connection;
use Liloy\Framework\Helpers\Services\BasketService;
use Liloy\Framework\Session\Sessioner;
use Liloy\App\Mappers\ProductMapper;
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
            $basket = new BasketService(new Sessioner());
            $decodedRequest = json_decode($this->request['ajax']);
            if ($decodedRequest->action === self::UNSET) {
                $basket->delete($decodedRequest->id);
            } elseif ($decodedRequest->action === self::INCREMENT) {
                $basket->setAmount($decodedRequest->id, $basket->getAmount($decodedRequest->id) + 1);
            } elseif ($decodedRequest->action === self::DECREMENT) {
                $basket->setAmount($decodedRequest->id, $basket->getAmount($decodedRequest->id) - 1);
                if ($basket->getAmount($decodedRequest->id) < 1) {
                    $basket->delete($decodedRequest->id);
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
            echo json_encode($products);
        }

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
