<?php

namespace Liloy\App\Controller;

use Liloy\Framework\Database\Connection;
use Liloy\App\Storage\CategoryStorage;
use Liloy\App\Storage\ProductStorage;
use Liloy\Framework\Core\View;
use Liloy\Framework\Core\Controller;

class MainController extends Controller
{
    public function index(): void
    {
        $productStorage = new ProductStorage(Connection::getDb());
        $products = $productStorage->getProducts();
        $categoryStorage = new CategoryStorage(Connection::getDb());
        $categories = $categoryStorage->getCategories();
        $view = new View($this->path, ['Product' => $products, 'Categories' => $categories]);
        $view->render();
    }

    public function basket(): void
    {
        $categoryStorage = new CategoryStorage(Connection::getDb());
        $categories = $categoryStorage->getCategories();
        $view = new View($this->path, ['Categories' => $categories]);
        $view->render();
    }
}
