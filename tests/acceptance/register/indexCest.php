<?php

namespace register;

use AcceptanceTester;

class indexCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        $I->amOnPage('/registration/index');
        $I->fillField('firstName', 'testtt');
        $I->fillField('lastName', 'testtt');
        $login = rand(100000, 99999999999).'l';
        $I->fillField('login', $login);
        $I->fillField('email', $login.'@mail.ru');
        $I->fillField('password', '12345678ddddd');
        $I->fillField('confirm', '12345678ddddd');
        $I->click('submit');
        $I->wait(3);
        $I->seeCurrentUrlEquals('/authentication/index');
    }
}
