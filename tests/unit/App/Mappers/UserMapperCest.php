<?php
namespace App\Mappers;

use Liloy\App\Mappers\UserMapper;
use Liloy\Framework\Database\Connection;
use UnitTester;

class UserMapperCest
{
    private UserMapper $userMapper;

    public function _before(UnitTester $I)
    {
        putenv('APP_ENV=test');
        Connection::getInstance();
        $this->userMapper = new UserMapper(Connection::getDb());
    }

    // tests
    public function tryToTestGetUserById(UnitTester $I)
    {
        $id = 9;
        $user = $this->userMapper->getUserById($id);
        $I->assertEquals($id, $user->getId());
    }

    public function tryToTestCheckUserExistsByEmail(UnitTester $I)
    {
        $goodEmail = 'w1ndows1@mail.ru';
        $bool = $this->userMapper->userExistsByEmail($goodEmail);
        $I->assertTrue($bool);
        $badEmail = 'w1ndows1';
        $bool = $this->userMapper->userExistsByEmail($badEmail);
        $I->assertFalse($bool);
    }

    public function tryToTestCheckUserExistsByLogin(UnitTester $I)
    {
        $goodLogin = 'w1ndows1';
        $bool = $this->userMapper->userExistsByLogin($goodLogin);
        $I->assertTrue($bool);
        $badLogin = 'w1n';
        $bool = $this->userMapper->userExistsByLogin($badLogin);
        $I->assertFalse($bool);
    }

    public function tryToTestAuthCheck(UnitTester $I)
    {
        $login = 'w1ndows1';
        $password = '25121996tiner10';
        $bool = $this->userMapper->auth($login, $password);
        $I->assertTrue($bool);
    }

    public function tryToTestGetUserByLogin(UnitTester $I)
    {
        $login = 'w1ndows1';
        $user = $this->userMapper->getUserByLogin($login);
        $I->assertTrue(is_string($user->getEmail()));
    }

    public function tryToTestGetRoleById(UnitTester $I)
    {
        $id = 29;
        $role = $this->userMapper->getRole($id);
        $I->assertEquals(2, $role);
    }
}
