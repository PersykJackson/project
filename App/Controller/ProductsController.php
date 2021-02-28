<?php


namespace Liloy\App\Controller;

use Liloy\App\Storage\OrderStorage;
use Liloy\Framework\Database\Connection;
use Liloy\App\Storage\CategoryStorage;
use Liloy\App\Storage\ProductStorage;
use Liloy\Framework\Core\View;
use Liloy\Framework\Core\Controller;
use Liloy\Framework\Session\Sessioner;

class ProductsController extends Controller
{
    public function index(): void
    {
        $productStorage = new ProductStorage(Connection::getDb());
        if (isset($this->request['get']['category'])) {
            $products = $productStorage->getProductsByCategory((int)$this->request['get']['category']);
        } else {
            $products = $productStorage->getProducts();
        }
        $categoryStorage = new CategoryStorage(Connection::getDb());
        $categories = $categoryStorage->getCategories();
        $view = new View($this->path, ['Product' => $products, 'Categories' => $categories]);
        $view->render();
    }

    public function product(): void
    {
        $categoryStorage = new CategoryStorage(Connection::getDb());
        $categories = $categoryStorage->getCategories();
        $view = new View($this->path, ['Categories' => $categories]);

        $view->render();
    }
}
