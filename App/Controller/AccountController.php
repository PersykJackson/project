<?php


namespace Liloy\App\Controller;

use Liloy\Framework\Core\View;
use Liloy\Framework\Core\Controller;

class AccountController extends Controller
{
    public function index(): void
    {
        $view = new View($this->path);
        $view->render();
    }

    public function history(): void
    {
        $view = new View($this->path);
        $view->render();
    }

    public function info(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            echo json_encode($this->getModel()->getAccountInfo());
        }
    }

    public function search(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $decodedRequest = json_decode($this->request['ajax']);
            echo json_encode($this->getModel()->searchFromHistory($decodedRequest));
        }
    }

    public function isAdmin(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            echo json_encode($this->getModel()->isAdmin());
        }
    }
}
