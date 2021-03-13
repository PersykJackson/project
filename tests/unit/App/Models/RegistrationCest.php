<?php
namespace App\Models;

use Liloy\App\Models\Registration;
use Liloy\Framework\Database\Connection;
use UnitTester;

class RegistrationCest
{
    public function _before(UnitTester $I)
    {
        Connection::getInstance();
    }

    // tests
    public function tryToTestRegistration(UnitTester $I)
    {
        $user = new Class() {
            public string $login = '';
        };
        $registrationModel = new Registration(Connection::getDb());
        $error = $registrationModel->registerUser($user);
        $I->assertEquals(['Поля не могут быть пустыми!'], $error);
    }
}
