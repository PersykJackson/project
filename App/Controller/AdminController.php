<?php


namespace Liloy\App\Controller;

use Liloy\App\Mappers\CategoryMapper;
use Liloy\App\Mappers\Product;
use Liloy\App\Mappers\ProductMapper;
use Liloy\App\Mappers\UserMapper;
use Liloy\Framework\Core\Controller;
use Liloy\Framework\Core\View;
use Liloy\Framework\Database\Connection;
use Liloy\Framework\Session\Sessioner;

class AdminController extends Controller
{
    public function index(): void
    {
        $userMapper = new UserMapper(Connection::getDb());
        $session = new Sessioner();
        $roleId = $userMapper->getRole($session->get('id'));
        if ($roleId !== 2) {
            exit('only admin have access to this page');
        }
        $view = new View($this->path);
        $view->render();
    }

    public function createProduct(): void
    {
        if ($_FILES) {
            move_uploaded_file($_FILES['file']['tmp_name'], $_FILES['file']['name']);
            exit(json_encode($_FILES['file']['name']));
        }
        if ($this->request['ajax']) {
            $decodedRequest = json_decode($this->request['ajax']);
            foreach ($decodedRequest as $value) {
                if ($value === null) {
                    exit(json_encode(false));
                }
            }
            $productMapper = new ProductMapper(Connection::getDb());
            $productNumber = $productMapper->getCountProductByCategory($decodedRequest->categoryId) + 1;
            $fileFormat = explode('.', $decodedRequest->imageName)[1];
            $productNameHash = md5($productNumber . random_int(99, 999999));
            $fileName = $productNameHash . '.' . $fileFormat;
            $productSrc = 'images/products/' . $decodedRequest->categoryId . '/' . $fileName;
            if (!file_exists('images/products/' . $decodedRequest->categoryId)) {
                mkdir('images/products/' . $decodedRequest->categoryId);
            }
            rename($decodedRequest->imageName, $productSrc);
            $product = new Product();
            $product
                ->setName($decodedRequest->name)
                ->setImg('/' . $productSrc)
                ->setCategoryId($decodedRequest->categoryId)
                ->setDiscount($decodedRequest->discount)
                ->setCost($decodedRequest->cost)
                ->setDescription($decodedRequest->description);

            echo json_encode($productMapper->insertProduct($product));
        }
    }
}
