<?php


namespace Liloy\App\Controller;

use Liloy\Framework\Core\View;
use Liloy\Framework\Core\Controller;

class RegistrationController extends Controller
{
    public function index(): void
    {
        $view = new View($this->path);
        $view->content['css'] = 'register';
        $view->render();
    }
    public function register(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $decodedRequest = json_decode($this->request['ajax']);
            $errors = $this->getModel()->registerUser($decodedRequest);
            echo json_encode($errors);
        }
    }
}
