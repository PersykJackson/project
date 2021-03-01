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
        $categoryStorage = new CategoryMapper(Connection::getDb());
        $categories = $categoryStorage->getCategories();
        $view = new View($this->path, ['Categories' => $categories]);
        $view->render();
    }

    public function product(): void
    {
        $categoryStorage = new CategoryMapper(Connection::getDb());
        $categories = $categoryStorage->getCategories();
        $view = new View($this->path, ['Categories' => $categories]);
        $view->render();
    }

    public function all(): void
    {
        if ($_SERVER['REQUEST_METHOD']) {
            $productStorage = new ProductMapper(Connection::getDb());
            if (isset($this->request['ajax']['category'])) {
                $products = $productStorage->getProductsByCategory((int)$this->request['get']['category']);
            } else {
                $products = $productStorage->getProducts();
                echo json_encode($products);
            }
        }
    }
}
