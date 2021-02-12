<?php

namespace Liloy\App\Controller;

use Liloy\App\Database\Connection;
use Liloy\App\Storage\CategoryStorage;
use Liloy\App\Storage\ProductStorage;
use Liloy\App\View\View;

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
    public function products(): void
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
    public function productPage(): void
    {
        $categoryStorage = new CategoryStorage(Connection::getDb());
        $categories = $categoryStorage->getCategories();
        $view = new View($this->path, ['Categories' => $categories]);
        $view->render();
    }
}
