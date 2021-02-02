<?php

namespace Liloy\App\Controller;

use Liloy\App\Authentication\Authentication;
use Liloy\App\View\View;

class AuthenticationController extends Controller
{
    private Authentication $auth;
    public function __construct(string $path)
    {
        parent::__construct($path);
        $this->auth = new Authentication();
    }
    public function index(): void
    {
        $view = new View($this->path);
        $view->content['css'] = 'login';
        $view->render();
    }
    public function login(): void
    {
        if ($this->auth->auth($_POST['login'], $_POST['password'])) {
            header('Location: /main/index');
        } else {
            header('Location: /authentication/login');
        }
    }
    public function logout(): void
    {
        $this->auth->logOut();
        header('Location: /main/index');
    }
}