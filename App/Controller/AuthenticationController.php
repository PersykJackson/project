<?php

namespace Liloy\App\Controller;

use Liloy\Framework\Authentication\Authentication;
use Liloy\Framework\Core\View;
use Liloy\Framework\Core\Controller;

class AuthenticationController extends Controller
{
    private Authentication $auth;

    public array $errors = [];

    public function __construct(string $path, array $get = [])
    {
        parent::__construct($path, $get);
        $this->auth = new Authentication();
    }

    public function index(): void
    {
        if ($this->auth->isAuth()) {
            header("Location: /main/index");
        } else {
            $view = new View($this->path);
            $view->content['css'] = 'login';
            $view->render();
        }
    }

    public function login(): void
    {
        $decodedRequest = json_decode($this->request['ajax']);
        if (empty($decodedRequest->login) || empty($decodedRequest->password)) {
            $answer = "Данные не были введены!";
        } elseif ($this->auth->auth($decodedRequest->login, $decodedRequest->password)) {
            $answer = true;
        } else {
            $answer = "Неправильный логин или пароль!";
        }
            echo json_encode($answer);
    }


    public function logout(): void
    {
        $this->auth->logOut();
        header('Location: /main/index');
    }

    public function isAuth(): void
    {
        echo json_encode($this->auth->isAuth());
    }
}
