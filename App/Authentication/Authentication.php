<?php

namespace Liloy\App\Authentication;

use Liloy\App\Session\Sessioner;
use Liloy\App\Helpers\Exceptions\AuthException;

class Authentication
{
    private string $login;
    private string $password;
    public Sessioner $sessioner;

    public function __construct()
    {
        $this->login = 'login';
        $this->password = md5('password');
        $this->sessioner = new Sessioner();
    }

    public function isAuth(): bool
    {
        if ($this->sessioner->contains('auth')) {
            return true;
        }
        return false;
    }

    public function auth(string $login, string $pass): bool
    {
        if (!$this->isAuth()) {
            if ($login === $this->login
                && md5($pass) === $this->password) {
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
            return $this->login;
        }
        throw new AuthException('Auth: You are not authorized.');
    }

    public function logOut(): void
    {
        if ($this->isAuth()) {
            setcookie('session', 0, 0, '/');
            $this->sessioner->delete('auth');
            $this->sessioner->destroy();
        } else {
            throw new AuthException('Auth: You are not authorized.');
        }
    }
}
