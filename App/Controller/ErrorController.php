<?php


namespace Liloy\App\Controller;

use Liloy\Framework\Core\View;
use Liloy\Framework\Core\Controller;

class ErrorController extends Controller
{
    public function notFound()
    {
        $view = new View($this->path);
        $view->render();
    }
}
