<?php


namespace Liloy\App\Controller;

use Liloy\App\Mappers\CategoryMapper;
use Liloy\App\Mappers\Product;
use Liloy\App\Mappers\ProductMapper;
use Liloy\Framework\Core\Controller;
use Liloy\Framework\Core\View;
use Liloy\Framework\Database\Connection;

class AdminController extends Controller
{
    public function index(): void
    {
        $view = new View($this->path);
        $view->render();
    }

    public function createProduct(): void
    {
        if ($_FILES) {
            move_uploaded_file($_FILES['file']['tmp_name'], $_FILES['file']['name']);
            echo json_encode($_FILES['file']['name']);
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $decodedRequest = json_decode($this->request['ajax']);
            $productMapper = new ProductMapper(Connection::getDb());
            $categoryMapper = new CategoryMapper(Connection::getDb());
            $productNumber = $productMapper->getCountProductByCategory($decodedRequest->categoryId) + 1;
            $fileFormat = explode('.', $decodedRequest->imageName)[1];
            $fileName = $productNumber.'.'.$fileFormat;
            $productSrc = 'images/products/'.$decodedRequest->categoryId.'/'.$fileName;
            if (!file_exists('images/products/'.$decodedRequest->categoryId)) {
                mkdir('images/products/'.$decodedRequest->categoryId);
            }
            rename($decodedRequest->imageName, $productSrc);
            $product = new Product();
            $product
                ->setName($decodedRequest->name)
                ->setImg('/'.$productSrc)
                ->setCategoryId($decodedRequest->categoryId)
                ->setDiscount($decodedRequest->discount)
                ->setCost($decodedRequest->cost)
                ->setDescription($decodedRequest->description);

            echo json_encode($productMapper->insertProduct($product));
        }
    }
}
