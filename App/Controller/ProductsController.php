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

    public function getProducts(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productStorage = new ProductMapper(Connection::getDb());
            if (json_decode($this->request['ajax'])->category) {
                $products = $productStorage->getProductsByCategory((int)json_decode($this->request['ajax'])->category);
            } else {
                $products = $productStorage->getProducts();
            }
            $countPages = ceil(count($products) / 12);
            $firstProduct = (json_decode($this->request['ajax'])->page - 1) * 12;
            $lastProduct = $firstProduct + 11;
            $page = [];
            foreach ($products as $key => $product) {
                if ($key >= $firstProduct && $key <= $lastProduct) {
                    $page[] = $product;
                }
            }
            $answer['countPages'] = $countPages;
            $answer['page'] = $page;
            echo json_encode($answer);
        }
    }
}
