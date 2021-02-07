<?php


namespace Liloy\App\Controller;

use Liloy\App\View\View;

class ErrorController extends Controller
{
    public function notFound()
    {
        $view = new View($this->path);
        $view->render();
    }
}