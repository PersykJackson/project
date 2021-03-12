<?php

namespace Liloy\App\Controller;

use Liloy\Framework\Database\Connection;
use Liloy\App\Mappers\CategoryMapper;
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
            echo json_encode($this->getModel()->getCategories());
        }
    }
}
