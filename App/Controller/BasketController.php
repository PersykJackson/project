<?php


namespace Liloy\App\Controller;

use Liloy\App\Database\Connection;
use Liloy\App\Session\Sessioner;
use Liloy\App\Storage\CategoryStorage;
use Liloy\App\Storage\ProductStorage;
use Liloy\App\View\View;

class BasketController extends Controller
{
    public function index(): void
    {
        $categoryStorage = new CategoryStorage(Connection::getDb());
        $categories = $categoryStorage->getCategories();
        $productsStorage = new ProductStorage(Connection::getDb());
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
            if ($sessioner->contains('basket')) {
                $basket = $sessioner->get('basket');
                foreach ($basket as $key => $item) {
                    if ($item['id'] === $_POST['id']) {
                        $basket[$key]['amount']++;
                        $sessioner->set('basket', $basket);
                        return;
                    }
                }
                $basket[] = ['id' => $_POST['id'], 'amount' => 1];
            } else {
                $basket[] = ['id' => $_POST['id'], 'amount' => 1];
            }
            $sessioner->set('basket', $basket);
        }
    }
}