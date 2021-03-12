<?php


namespace Liloy\App\Mappers;

use Liloy\Framework\Core\Mapper;

class UserMapper extends Mapper
{
    public function getUserById($id): User
    {
        $columns = ['first_name', 'last_name', 'login', 'email'];
        $user = $this->select('users', $columns)
            ->where("id = ?")
            ->params([$id])
            ->execute()[0];
        $userObject = new User();
        $userObject->setFirstName($user['first_name'])
            ->setLastName($user['last_name'])
            ->setLogin($user['login'])
            ->setEmail($user['email']);
        return $userObject;
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
        $user = $this->select('users', ['id', 'first_name', 'last_name', 'email'])
            ->where('login = ?')
            ->params([$login])
            ->execute()[0];
        $userObject = new User();
        $userObject->setId($user['id'])
            ->setEmail($user['email'])
            ->setFirstName($user['first_name'])
            ->setLastName($user['last_name']);
        return $userObject;
    }

    public function getRole(int $id): int
    {
        return $this->select('users_roles', ['role_id'])
            ->where('user_id = ?')
            ->params([$id])
            ->execute()[0]['role_id'];
    }
}
