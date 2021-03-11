<?php


namespace Liloy\App\Mappers;

use Liloy\Framework\Core\Mapper;
use Liloy\Logger\Logger;

class UserMapper extends Mapper
{
    public function getUserById($id): User
    {
        $columns = ['first_name', 'last_name', 'login', 'email'];
        $result = $this->select('users', $columns)
            ->where("id = ?")
            ->params([$id])
            ->execute()[0];
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
            ->where("email = ?")
            ->params([$email])
            ->execute();
        return (bool)$user;
    }

    public function userExistsByLogin(string $login): bool
    {
        $columns = ['login'];
        $user = $this->select('users', $columns)
            ->where("login = ?")
            ->params([$login])
            ->execute();
        return (bool)$user;
    }

    public function register(User $user): bool
    {
        $fields = ['login' => $user->getLogin(),
            'password' => $user->getPassword(),
            'first_name' => $user->getFirstName(),
            'last_name' => $user->getLastName(),
            'email' => $user->getEmail()];
        $this->create('users', $fields);
        $id = $this->select('users', ['id'])
            ->where('login = ?')
            ->params([$user->getLogin()])
            ->execute()[0]['id'];
        $this->create('users_roles', ['user_id' => $id, 'role_id' => 1]);
        return $this->userExistsByLogin($user->getLogin());
    }

    public function auth(string $login, string $password): bool
    {
        $result = $this->select('users', ['login'])
            ->where("login = ? AND password = ?")
            ->params([$login, md5($password.'MaxiMarket')])
            ->execute();
        return (bool)$result;
    }

    public function getUserByLogin(string $login): User
    {
        $result = $this->select('users', ['id', 'first_name', 'last_name', 'email'])
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

    public function getRole(int $id): int
    {
        return $this->select('users_roles', ['role_id'])
            ->where('user_id = ?')
            ->params([$id])
            ->execute()[0]['role_id'];
    }
}
