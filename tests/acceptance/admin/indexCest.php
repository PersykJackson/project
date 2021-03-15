<?php

namespace admin;

use AcceptanceTester;

class indexCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTestAdminPanel(AcceptanceTester $I)
    {
        $I->amOnPage('/authentication/index');
        $I->see('Логин');
        $I->see('Пароль');
        $I->fillField('login', 'Admin');
        $I->fillField('password', '25121996tiner10');
        $I->click('submit');
        $I->wait(2);
        $I->click('#admin');
        $I->wait(1);
        $I->see('Введите название');
        $I->fillField('name', 'test_product');
        $I->fillField('description', 'test');
        $I->fillField('price', 432);
        $I->selectOption('category', '9');
        $I->attachFile('img', 'cross.png');
        $I->click('#submit');
        $I->wait(1);
        $I->see('Товар успешно добавлен');
        $I->click('#toggle_delete');
        $I->see('Lego Ocean');
        $I->click('#toggle_add');
        $I->see('Введите название');
    }
}
