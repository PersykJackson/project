<?php


namespace Liloy\App\Storage;

use Liloy\App\Storage\User;

class UserStorage extends Storage
{
    public function getUserById($id): User
    {
        $columns = ['first_name', 'last_name', 'login', 'password', 'email', 'phone'];
        $user = $this->select('users', $columns)->where("id = $id")->execute();
        return new User($user);
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
}
