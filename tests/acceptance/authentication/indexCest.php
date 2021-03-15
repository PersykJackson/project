<?php

namespace authentication;

use AcceptanceTester;

class indexCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTestAuthentication(AcceptanceTester $I)
    {
        $I->amOnPage('/authentication/index');
        $I->see('Логин');
        $I->see('Пароль');
        $I->fillField('login', 'Admin');
        $I->fillField('password', '25121996tiner10');
        $I->click('submit');
        $I->wait(2);
        $I->see('Популярные товары');
        $I->see('Популярные категории');
        $I->click('#exit');
        $I->wait(1);
        $I->see('Популярные товары');
        $I->see('Популярные категории');
        $I->amOnPage('/authentication/index');
        $I->fillField('login', 'Admin');
        $I->fillField('password', '123');
        $I->click('submit');
        $I->see('Неправильный логин или пароль');
    }
}
