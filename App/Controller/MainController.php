<?php

namespace Liloy\App\Controller;

use Liloy\Framework\Database\Connection;
use Liloy\App\Mappers\CategoryMapper;
use Liloy\App\Mappers\ProductMapper;
use Liloy\Framework\Core\View;
use Liloy\Framework\Core\Controller;

class MainController extends Controller
{
    public function index(): void
    {
        $productStorage = new ProductMapper(Connection::getDb());
        $products = $productStorage->getTopProducts();
        $categoryStorage = new CategoryMapper(Connection::getDb());
        $categories = $categoryStorage->getCategories();
        $view = new View($this->path, ['Product' => $products, 'Categories' => $categories]);
        $view->render();
    }

    public function basket(): void
    {
        $categoryStorage = new CategoryMapper(Connection::getDb());
        $categories = $categoryStorage->getCategories();
        $view = new View($this->path, ['Categories' => $categories]);
        $view->render();
    }

    public function categories(): void
    {
        if ($_SERVER['REQUEST_METHOD']  === 'POST') {
            $categoryStorage = new CategoryMapper(Connection::getDb());
            $arrayOfObjects = $categoryStorage->getCategories();
            $arrayOfCategories = [];
            foreach ($arrayOfObjects as $category) {
                $arrayOfCategories[] = ['name' => $category->getName(), 'id' => $category->getId()];
            }
            echo json_encode($arrayOfCategories);
        }
    }
}
