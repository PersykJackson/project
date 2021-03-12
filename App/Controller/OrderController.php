<?php


namespace Liloy\App\Controller;

use Liloy\Framework\Core\View;
use Liloy\Framework\Core\Controller;

class OrderController extends Controller
{
    public function index(): void
    {
        $view = new View($this->path);
        $view->render();
    }

    public function new(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $decodedRequest = json_decode($this->request['ajax']);
            echo json_encode($this->getModel()->newOrder($decodedRequest));
        }
    }
}
