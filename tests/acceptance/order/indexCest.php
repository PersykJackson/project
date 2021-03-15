<?php

namespace order;

use AcceptanceTester;

class indexCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        $I->amOnPage('/authentication/index');
        $I->see('Логин');
        $I->see('Пароль');
        $I->fillField('login', 'Admin');
        $I->fillField('password', '25121996tiner10');
        $I->click('submit');
        $I->wait(2);
        $I->click('#id10');
        $I->click('#product11');
        $I->wait(1);
        $I->click('toBasket');
        $I->amOnPage('/basket/index');
        $I->wait(1);
        $I->see('Кукла Barbie');
        $I->click('#submit');
        $I->wait(1);
        $I->fillField('phone', '0990668424');
        $hash = md5('0990668424'.rand(10, 9999));
        $I->fillField('address', $hash);
        $I->click('#submit');
        $I->wait(2);
        $I->see('Спасибо за ваш заказ!');
        $I->click('#link');
        $I->wait(1);
        $I->click('#account');
        $I->wait(1);
        $I->click('#history');
        $I->fillField('#search_data', $hash);
        $I->selectOption('#search_type', 'address');
        $I->click('#submit');
        $I->see('0990668424');
    }
}
