<?php

namespace account;

use AcceptanceTester;

class indexCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTestAccountPage(AcceptanceTester $I)
    {
        $I->amOnPage('/authentication/index');
        $I->fillField('login', 'Admin');
        $I->fillField('password', '25121996tiner10');
        $I->click('submit');
        $I->wait(2);
        $I->click('#account');
        $I->wait(2);
        $I->see('Имя: Admin');
        $I->see('Почта: admin@gmail.ru');
        $I->click('#history');
        $I->wait(2);
        $I->see('Поиск');
        $I->fillField('#search_data', '0990668424');
        $I->click('#submit');
        $I->wait(1);
        $I->see('Кошкина Лапка - 4 шт');
    }
}
