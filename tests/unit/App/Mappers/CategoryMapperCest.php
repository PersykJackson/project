<?php
namespace App\Mappers;

use Liloy\App\Mappers\CategoryMapper;
use Liloy\Framework\Database\Connection;
use UnitTester;

class CategoryMapperCest
{
    private CategoryMapper $categoryMapper;

    public function _before(UnitTester $I)
    {
        putenv('APP_ENV=test');
        Connection::getInstance();
        $this->categoryMapper = new CategoryMapper(Connection::getDb());
    }

    // tests
    public function tryToTestGetCategories(UnitTester $I)
    {
        $categories = $this->categoryMapper->getCategories();
        $I->assertEquals(6, count($categories));
    }

    public function tryToTestGetNameById(UnitTester $I)
    {
        $categoryName = $this->categoryMapper->getNameById(6);
        $I->assertEquals('Машинки', $categoryName);
    }
}
php vendor/bin/codecept generate:cest acceptance First