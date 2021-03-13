<?php
namespace App\Mappers;

use Liloy\App\Mappers\Product;
use Liloy\App\Mappers\ProductMapper;
use Liloy\Framework\Database\Connection;
use UnitTester;

class ProductMapperCest
{
    private ProductMapper $productMapper;

    public function _before(UnitTester $I)
    {
        putenv('APP_ENV=test');
        Connection::getInstance();
        $this->productMapper = new ProductMapper(Connection::getDb());
    }

    // tests
    public function tryToTestGetProductById(UnitTester $I)
    {
        $id = 12;
        $product = $this->productMapper->getProductById($id);
        $I->assertEquals($id, $product->getId());
    }

    public function tryToTestInsertAndRemoveProductById(UnitTester $I)
    {
        $product = new Product();
        $product->setImg('test')
            ->setName('test')
            ->setDescription('test')
            ->setCost(400)
            ->setDiscount(0)
            ->setCategoryId(5);
        $insertResult = $this->productMapper->insertProduct($product);
        $I->assertTrue($insertResult);
        $allProducts = $this->productMapper->getProducts();
        $lastProduct = array_pop($allProducts);
        $removeResult = $this->productMapper->removeProductById($lastProduct->getId());
        $I->assertTrue($removeResult);
    }

    public function tryToTestGetProductsByCategory(UnitTester $I)
    {
        $products = $this->productMapper->getProductsByCategory(5);
        $I->assertTrue(count($products) > 0);

        $count = $this->productMapper->getCountProductByCategory(5);
        $I->assertTrue((bool)$count);
    }

    public function tryToTestGetTopProducts(UnitTester $I)
    {
        $products = $this->productMapper->getTopProducts();
        $I->assertEquals(6, count($products));
    }
}
