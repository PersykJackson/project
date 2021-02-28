<?php


namespace Liloy\App\Controller;

use Liloy\App\Storage\CategoryStorage;
use Liloy\Framework\Database\Connection;
use Liloy\App\Storage\User;
use Liloy\App\Storage\UserStorage;
use Liloy\Framework\Core\View;
use Liloy\Framework\Core\Controller;
use Mailer\Messenger\Messenger;
use Mailer\Messenger\TemplateType;

class RegistrationController extends Controller
{
    public function index(): void
    {
        $categoryStorage = new CategoryStorage(Connection::getDb());
        $categories = $categoryStorage->getCategories();
        $view = new View($this->path, ['Categories' => $categories]);
        $view->content['css'] = 'register';
        $view->render();
    }
    public function register(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            exit();
        }
        $errors = $this->validate($this->request['post']);
        if (count($errors) < 1) {
            $storage = new UserStorage(Connection::getDb());
            $mailer = new Messenger(parse_ini_file(__DIR__.'/../../.env'));
            $user = new User();
            $user->setPassword(md5($_POST['password'].'MaxiMarket'))
                ->setEmail($this->request['post']['email'])
                ->setLogin($this->request['post']['login'])
                ->setFirstName($this->request['post']['firstName'])
                ->setLastName($this->request['post']['lastName']);
            $storage->register($user);
            $mailer->setTemplate(
                TemplateType::REGISTER_COMPLETE,
                'Поздравляем с успешной регистрацией'
            )->setTitle('MaxiMarket: успешная регистрация!')
                ->to($this->request['post']['email'])->execute();
            header('Location: /authentication/index');
        } else {
            $string = "<ul>";
            foreach ($errors as $error) {
                $string .= "<li>".$error."</li>";
            }
            $string .= "</ul>";
            setcookie('errors', $string, time() + 2, '/registration');
            header('Location: /registration/index');
        }
    }
    private function validate(array $user): array
    {
        $storage = new UserStorage(Connection::getDb());
        $errors = [];
        foreach ($user as $value) {
            if ($value === '') {
                $errors[] = 'Поля не могут быть пустыми!';
                break;
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