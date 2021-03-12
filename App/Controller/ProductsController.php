<?php


namespace Liloy\App\Controller;

use Liloy\Framework\Database\Connection;
use Liloy\App\Mappers\ProductMapper;
use Liloy\Framework\Core\View;
use Liloy\Framework\Core\Controller;

class ProductsController extends Controller
{
    public function index(): void
    {
        $view = new View($this->path);
        $view->render();
    }

    public function product(): void
    {
        $view = new View($this->path);
        $view->render();
    }

    public function getProduct(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $decodedRequest = json_decode($this->request['ajax']);
            $productMapper = new ProductMapper(Connection::getDb());
            $product = $productMapper->getProductById($decodedRequest->id);
            echo json_encode($product);
        }
    }

    public function getTopProducts(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productStorage = new ProductMapper(Connection::getDb());
            $products = $productStorage->getTopProducts();
            echo json_encode($products);
        }
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

    public function remove(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $decodedRequest = json_decode($this->request['ajax']);
            $productMapper = new ProductMapper(Connection::getDb());
            $src = $productMapper->getProductById($decodedRequest->id)->getImg();
            unlink(trim($src, '/'));
            echo json_encode($productMapper->removeProductById($decodedRequest->id));
        }
    }
}
