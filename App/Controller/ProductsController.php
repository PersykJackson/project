<?php


namespace Liloy\App\Controller;

use Liloy\App\Storage\OrderMapper;
use Liloy\Framework\Database\Connection;
use Liloy\App\Storage\CategoryMapper;
use Liloy\App\Storage\ProductMapper;
use Liloy\Framework\Core\View;
use Liloy\Framework\Core\Controller;
use Liloy\Framework\Session\Sessioner;

class ProductsController extends Controller
{
    public function index(): void
    {
        $productStorage = new ProductMapper(Connection::getDb());
        if (isset($this->request['get']['category'])) {
            $products = $productStorage->getProductsByCategory((int)$this->request['get']['category']);
        } else {
            $products = $productStorage->getProducts();
        }
        $categoryStorage = new CategoryMapper(Connection::getDb());
        $categories = $categoryStorage->getCategories();
        $view = new View($this->path, ['Product' => $products, 'Categories' => $categories]);
        $view->render();
    }

    public function product(): void
    {
        $categoryStorage = new CategoryMapper(Connection::getDb());
        $categories = $categoryStorage->getCategories();
        $view = new View($this->path, ['Categories' => $categories]);

        $view->render();
    }
}
