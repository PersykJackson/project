<?php


namespace Liloy\App\Storage;

use Liloy\App\Storage\User;

class UserStorage extends Storage
{
    public function getUserById($id): User
    {
        $cols = ['first_name', 'last_name', 'login', 'password', 'email', 'phone'];
        $user = $this->select('users', $cols)->where("id = $id")->execute();
        return new User($user);
    }
}
