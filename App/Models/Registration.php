<?php


namespace Liloy\App\Models;

use Liloy\App\Mappers\User;
use Liloy\App\Mappers\UserMapper;
use Mailer\Messenger\Messenger;
use Mailer\Messenger\TemplateType;

class Registration extends \Liloy\Framework\Core\Model
{
    public function registerUser($request)
    {
        $errors = $this->validate($request);
        if (count($errors) < 1) {
            $errors = false;
            $userMapper = new UserMapper($this->db);
            $mailer = new Messenger(parse_ini_file(__DIR__.'/../../.env'));
            $user = new User();
            $user->setPassword(md5($request->password.'MaxiMarket'))
                ->setEmail($request->email)
                ->setLogin($request->login)
                ->setFirstName($request->firstName)
                ->setLastName($request->lastName);
            $userMapper->register($user);
            $mailer->setTemplate(
                TemplateType::REGISTER_COMPLETE,
                'Поздравляем с успешной регистрацией'
            )->setTitle('MaxiMarket: успешная регистрация!')
                ->to($request->email)->execute();
            return $errors;
        }
        return $errors;
    }

    private function validate(object $user): array
    {
        $userMapper = new UserMapper($this->db);
        $errors = [];
        foreach ($user as $value) {
            if ($value === '') {
                $errors[] = 'Поля не могут быть пустыми!';
                return $errors;
            }
        }
        if (strlen($user->login) < 5 || strlen($user->login) > 20) {
            $errors[] = 'Логин должен быть длиннее 5-ти символов и короче 20-ти символов!';
        }
        if ($user->password !== $user->confirm) {
            $errors[] = 'Пароли не совпадают!';
        }
        if (strlen($user->password) < 10 || !preg_match('/([a-zA-Z1-9])/', $user->password)) {
            $errors[] = 'Пароль должен быть длиннее 10-ти символов,
             а также содержать хотя бы один буквенный символ и хотя бы одну цифру';
        }
        if ($userMapper->userExistsByEmail($user->email)) {
            $errors[] = 'Почта уже зарегистрирована!';
        }
        if ($userMapper->userExistsByLogin($user->login)) {
            $errors[] = 'Логин уже зарегистрирован!';
        }
        return $errors;
    }
}
