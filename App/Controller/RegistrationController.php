<?php


namespace Liloy\App\Controller;

use Liloy\Framework\Database\Connection;
use Liloy\App\Mappers\User;
use Liloy\App\Mappers\UserMapper;
use Liloy\Framework\Core\View;
use Liloy\Framework\Core\Controller;
use Mailer\Messenger\Messenger;
use Mailer\Messenger\TemplateType;

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
