<?php


namespace Liloy\App\Controller;

use Liloy\App\Models\Account;
use Liloy\Framework\Core\Controller;
use Liloy\Framework\Core\View;
use Liloy\Framework\Database\Connection;

class AdminController extends Controller
{
    public function index(): void
    {
        $accountModel = new Account(Connection::getDb());
        if (!$accountModel->isAdmin()) {
            exit('only admin have access to this page');
        }
        $view = new View($this->path);
        $view->render();
    }

    public function createProduct(): void
    {
        if (isset($this->request['file'])) {
            $this->getModel()->saveImage($this->request['file']);
            exit(json_encode($this->request['file']['name']));
        }
        if ($this->request['ajax']) {
            $decodedRequest = json_decode($this->request['ajax']);
            echo json_encode($this->getModel()->createProduct($decodedRequest));
        }
    }

    public function remove(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $decodedRequest = json_decode($this->request['ajax']);
            echo json_encode($this->getModel()->removeProduct($decodedRequest->id));
        }
    }
}
