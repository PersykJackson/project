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
    public function index(): void
    {
        $categoryStorage = new CategoryMapper(Connection::getDb());
        $categories = $categoryStorage->getCategories();
        $productsStorage = new ProductMapper(Connection::getDb());
        $products = [];
        $session = new Sessioner();
        if ($session->get('basket')) {
            foreach ($session->get('basket') as $item) {
                $products[] = ['item' => $productsStorage->getProductById($item['id']), 'amount' => $item['amount']];
            }

        }

        $view = new View($this->path, ['Categories' => $categories, 'Products' => $products]);
        $view->content['css'] = 'basket';
        $view->render();
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
