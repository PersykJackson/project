<?php


namespace Liloy\App\Controller;

use Liloy\App\Database\Connection;
use Liloy\App\Session\Sessioner;
use Liloy\App\Storage\User;
use Liloy\App\Storage\UserStorage;
use Liloy\App\View\View;

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
        if ($_POST) {
            $errors = $this->validate($_POST);
            if (count($errors) < 1) {
                $storage = new UserStorage(Connection::getDb());
                $user = new User();
                $user->setPassword(md5($_POST['password'].'MaxiMarket'))
                    ->setEmail($_POST['email'])
                    ->setLogin($_POST['login'])
                    ->setFirstName($_POST['firstName'])
                    ->setLastName($_POST['lastName']);
                $storage->register($user);
                header('Location: /authentication/index');
            } else {
                setcookie('errors', $errors[0], 0, '/registration/index');
                header('Location: /registration/index');
            }
        } else {
            exit();
        }
    }
    private function validate(array $user): array
    {
        $storage = new UserStorage(Connection::getDb());
        $errors = [];
        foreach ($user as $value) {
            if ($value === '') {
                $errors[] = 'Поля не могут быть пустыми!';
            }
        }
        if (strlen($user['login']) < 5 || strlen($user['login'] > 20)) {
            $errors[] = 'Логин должен быть длиннее 5-ти символов и короче 20-ти символов!';
        }
        if ($user['password'] !== $user['confirm']) {
            $errors[] = 'Пароли не совпадают!';
        }
        if (strlen($user['password']) < 10 || !preg_match('/([a-zA-Z1-9])/', $user['password'])) {
            $errors[] = 'Пароль должен быть длиннее 10-ти символов,
             а также содержать хотя бы один буквенный символ и хотя бы одну цифру';
        }
        if ($storage->userExistsByEmail($user['email'])) {
            $errors[] = 'Почта уже зарегистрирована!';
        }
        if ($storage->userExistsByLogin($user['login'])) {
            $errors[] = 'Логин уже зарегистрирован!';
        }
        return $errors;
    }
}