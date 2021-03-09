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
        $view = new View($this->path);
        $view->render();
    }

    public function categories(): void
    {
        if ($_SERVER['REQUEST_METHOD']  === 'POST') {
            $categoryStorage = new CategoryMapper(Connection::getDb());
            $arrayOfObjects = $categoryStorage->getCategories();
            $arrayOfCategories = [];
            foreach ($arrayOfObjects as $category) {
                $arrayOfCategories[] = [
                    'name' => $category->getName(),
                    'id' => $category->getId(),
                    'img' => $category->getImg()
                ];
            }
            echo json_encode($arrayOfCategories);
        }
    }
}
