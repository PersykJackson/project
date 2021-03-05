<?php

namespace Liloy\Framework\Authentication;

use Liloy\Framework\Database\Connection;
use Liloy\Framework\Session\Sessioner;
use Liloy\Framework\Helpers\Exceptions\AuthException;
use Liloy\App\Mappers\UserMapper;

class Authentication
{
    public Sessioner $sessioner;

    public function __construct()
    {
        $this->sessioner = new Sessioner();
    }

    public function isAuth(): bool
    {
        if ($this->sessioner->contains('auth')) {
            return true;
        }
        return false;
    }

    public function auth(string $login, string $password): bool
    {

        if (!$this->isAuth()) {
            $storage = new UserMapper(Connection::getDb());
            if ($storage->auth($login, $password)) {
                $this->sessioner->start();
                $this->sessioner->set('auth', true);
                $userStorage = new UserMapper(Connection::getDb());
                var_dump($login);
                $user = $userStorage->getUserByLogin($login);
                $this->sessioner->set('id', $user->getId());
                setcookie('session', 1, 0, '/');
                return true;
            }
        }
        return false;
    }

    public function getLogin(): string
    {
        if ($this->isAuth()) {
            return $this->sessioner->get('login');
        }
        throw new AuthException('Auth: You are not authorized.');
    }

    public function logOut(): void
    {
        if ($this->isAuth()) {
            setcookie('session', 0, 1, '/');
            $this->sessioner->delete('auth');
            $this->sessioner->destroy();
        } else {
            throw new AuthException('Auth: You are not authorized.');
        }
    }
}
