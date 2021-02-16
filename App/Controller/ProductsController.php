<?php


namespace Liloy\App\Controller;

use Liloy\App\Database\Connection;
use Liloy\App\Storage\CategoryStorage;
use Liloy\App\Storage\ProductStorage;
use Liloy\App\View\View;

class ProductsController extends Controller
{
    public function index(): void
    {
        $productStorage = new ProductStorage(Connection::getDb());
        if (isset($this->get['category'])) {
            $products = $productStorage->getProductsByCategory((int)$this->get['category']);
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
