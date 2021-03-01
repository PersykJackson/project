<?php


namespace Liloy\App\Controller;

use Liloy\Framework\Database\Connection;
use Liloy\App\Storage\CategoryMapper;
use Liloy\Framework\Core\View;
use Liloy\Framework\Core\Controller;

class ErrorController extends Controller
{
    public function notFound()
    {
        $categoryStorage = new CategoryMapper(Connection::getDb());
        $categories = $categoryStorage->getCategories();
        $view = new View($this->path, ['Categories' => $categories]);
        $view->render();
    }
}
