<?php
namespace main;

use AcceptanceTester;

class indexCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTestMain(AcceptanceTester $I)
    {
        $I->amOnPage('/main/index');
        $I->see('Популярные товары');
        $I->see('Популярные категории');
    }
}
