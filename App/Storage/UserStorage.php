<?php


namespace Liloy\App\Storage;

use Liloy\Framework\Core\Storage;

class UserStorage extends Storage
{
    public function getUserById($id): User
    {
        $columns = ['first_name', 'last_name', 'login', 'email'];
        $result = $this->select('users', $columns)->where("id = $id")->execute();
        $user = new User();
        $user->setFirstName($result['first_name'])
            ->setLastName($result['last_name'])
            ->setLogin($result['login'])
            ->setEmail($result['email']);
        return $user;
    }

    public function userExistsByEmail(string $email): bool
    {
        $columns = ['email'];
        $user = $this->select('users', $columns)
            ->where("email = $email")
            ->execute();
        if ($user) {
            return true;
        }
        return false;
    }

    public function userExistsByLogin(string $login): bool
    {
        $columns = ['login'];
        $user = $this->select('users', $columns)
            ->where("login = $login")
            ->execute();
        if ($user) {
            return true;
        }
        return false;
    }

    public function register(User $user): void
    {
        $fields = ['login' => $user->getLogin(),
            'password' => $user->getPassword(),
            'first_name' => $user->getFirstName(),
            'last_name' => $user->getLastName(),
            'email' => $user->getEmail()];
        $this->create('users', $fields);
    }

    public function auth(string $login, string $password): bool
    {
        $result = $this->select('users', ['login'])
            ->where("login = ? AND password = ?")
            ->params([$login, md5($password.'MaxiMarket')])
            ->execute();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserByLogin(string $login): User
    {
        $result = $this->select('users', ['id', 'first_name', 'last_name', 'email', 'login'])
            ->where('login = ?')
            ->params([$login])
            ->execute()[0];
        $user = new User();
        $user->setId($result['id'])
            ->setEmail($result['email'])
            ->setFirstName($result['first_name'])
            ->setLastName($result['last_name']);
        return $user;
    }
}
