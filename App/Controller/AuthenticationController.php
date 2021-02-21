<?php

namespace Liloy\App\Controller;

use Liloy\Framework\Authentication\Authentication;
use Liloy\Framework\Database\Connection;
use Liloy\App\Storage\CategoryStorage;
use Liloy\App\Storage\UserStorage;
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
            $categoryStorage = new CategoryStorage(Connection::getDb());
            $categories = $categoryStorage->getCategories();
            $view = new View($this->path, ['Categories' => $categories]);
            $view->content['css'] = 'login';
            $view->render();
        }
    }

    public function login(): void
    {
        if ($this->auth->auth($_POST['login'], $_POST['password'])) {
            header('Location: /main/index');
        } else {
            setcookie('errors', "Неверный логин или пароль!", time() + 1);
            header('Location: /authentication/index');
        }
    }

    public function logout(): void
    {
        $this->auth->logOut();
        header('Location: /main/index');
    }
}
