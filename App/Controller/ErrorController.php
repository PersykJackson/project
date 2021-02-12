<?php


namespace Liloy\App\Controller;

use Liloy\App\Database\Connection;
use Liloy\App\Storage\CategoryStorage;
use Liloy\App\View\View;

class ErrorController extends Controller
{
    public function notFound()
    {
        $categoryStorage = new CategoryStorage(Connection::getDb());
        $categories = $categoryStorage->getCategories();
        $view = new View($this->path, ['Categories' => $categories]);
        $view->render();
    }
}