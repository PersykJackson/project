<?php


namespace Liloy\App\Controller;

use Liloy\App\Storage\CategoryMapper;
use Liloy\Framework\Database\Connection;
use Liloy\App\Storage\User;
use Liloy\App\Storage\UserMapper;
use Liloy\Framework\Core\View;
use Liloy\Framework\Core\Controller;
use Mailer\Messenger\Messenger;
use Mailer\Messenger\TemplateType;

class RegistrationController extends Controller
{
    public function index(): void
    {
        $categoryStorage = new CategoryMapper(Connection::getDb());
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
        $this->request['ajax'] = json_decode($this->request['ajax']);
        $errors = $this->validate($this->request['ajax']);
        if (count($errors) < 1) {
            $storage = new UserMapper(Connection::getDb());
            $mailer = new Messenger(parse_ini_file(__DIR__.'/../../.env'));
            $user = new User();
            $user->setPassword(md5($this->request['ajax']->password.'MaxiMarket'))
                ->setEmail($this->request['ajax']->email)
                ->setLogin($this->request['ajax']->login)
                ->setFirstName($this->request['ajax']->firstName)
                ->setLastName($this->request['ajax']->lastName);
            $storage->register($user);
            $mailer->setTemplate(
                TemplateType::REGISTER_COMPLETE,
                'Поздравляем с успешной регистрацией'
            )->setTitle('MaxiMarket: успешная регистрация!')
                ->to($this->request['ajax']->email)->execute();
            echo json_encode(['registration' => true]);
        } else {
            echo json_encode($errors);
        }
    }
    private function validate(object $user): array
    {
        $storage = new UserMapper(Connection::getDb());
        $errors = [];
        foreach ($user as $value) {
            if ($value === '') {
                $errors[] = 'Поля не могут быть пустыми!';
                break;
            }
        }
        if (strlen($user->login) < 5 || strlen($user->login > 20)) {
            $errors[] = 'Логин должен быть длиннее 5-ти символов и короче 20-ти символов!';
        }
        if ($user->password !== $user->confirm) {
            $errors[] = 'Пароли не совпадают!';
        }
        if (strlen($user->password) < 10 || !preg_match('/([a-zA-Z1-9])/', $user->password)) {
            $errors[] = 'Пароль должен быть длиннее 10-ти символов,
             а также содержать хотя бы один буквенный символ и хотя бы одну цифру';
        }
        if ($storage->userExistsByEmail($user->email)) {
            $errors[] = 'Почта уже зарегистрирована!';
        }
        if ($storage->userExistsByLogin($user->login)) {
            $errors[] = 'Логин уже зарегистрирован!';
        }
        return $errors;
    }
}