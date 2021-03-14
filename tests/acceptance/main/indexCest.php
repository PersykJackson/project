<?php
namespace main;

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
        sleep(1);
        $I->see('Логин');
    }
}
