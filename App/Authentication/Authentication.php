<?php

namespace Liloy\App\Authentication;

use Liloy\App\Database\Connection;
use Liloy\App\Session\Sessioner;
use Liloy\App\Helpers\Exceptions\AuthException;
use Liloy\App\Storage\UserStorage;

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
            $storage = new UserStorage(Connection::getDb());
            if ($storage->auth($login, $password)) {
                $this->sessioner->start();
                $this->sessioner->set('auth', true);
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
