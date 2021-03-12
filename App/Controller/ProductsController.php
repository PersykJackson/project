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
            $productMapper = new ProductMapper(Connection::getDb());
            $products = $productMapper->getTopProducts();
            echo json_encode($products);
        }
    }

    public function getProducts(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $decodedRequest = json_decode($this->request['ajax']);
            echo json_encode($this->getModel()->getProductsWithPagination($decodedRequest));
        }
    }
}
