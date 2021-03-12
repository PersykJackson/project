<?php


namespace Liloy\App\Mappers;

use Liloy\Framework\Core\Mapper;

class ProductMapper extends Mapper
{
    private array $columns = ['id', 'name', 'img', 'cost', 'description', 'category_id', 'discount'];

    public function getProductById($id): Product
    {
        $product = $this->select('products', $this->columns)->where("id = $id")->execute()[0];
        $productInObject = new Product();
        $productInObject->setId($product['id'])
            ->setDescription($product['description'])
            ->setCost($product['cost'])
            ->setImg($product['img'])
            ->setCategoryId($product['category_id'])
            ->setDiscount($product['discount'])
            ->setName($product['name']);
        return $productInObject;
    }

    public function getProductsByCategory(int $categoryId): array
    {
        $products = $this->select('products', $this->columns)
            ->where("category_id = $categoryId")
            ->execute();
        $arrayOfObjects = [];
        foreach ($products as $value) {
            $product = new Product();
            $arrayOfObjects[] = $product->setId($value['id'])
                ->setDescription($value['description'])
                ->setCost($value['cost'])
                ->setImg($value['img'])
                ->setCategoryId($value['category_id'])
                ->setDiscount($value['discount'])
                ->setName($value['name']);
        }
        return $arrayOfObjects;
    }

    public function getTopProducts(): array
    {
        $topProducts = $this->select('products as p', [
            'p.id',
            'p.name',
            'p.img',
            'p.cost',
            'p.description',
            'p.category_id',
            'p.discount',
            'op.count'
        ])
            ->leftJoin(
                '(select product_id, count(*) as count from orders_products group by product_id) as op',
                'p.id = op.product_id'
            )
            ->orderBy(['op.count DESC'])
            ->limit(6)
            ->execute();
        $arrayOfObjects = [];
        foreach ($topProducts as $value) {
            $product = new Product();
            $arrayOfObjects[] = $product->setId($value['id'])
                ->setDescription($value['description'])
                ->setCost($value['cost'])
                ->setImg($value['img'])
                ->setCategoryId($value['category_id'])
                ->setDiscount($value['discount'])
                ->setName($value['name']);
        }
        return $arrayOfObjects;
    }

    public function getProducts(): array
    {
        $productsArray = $this->select('products', $this->columns)
            ->orderBy(['id'])
            ->execute();
        $arrayOfObjects = [];
        foreach ($productsArray as $value) {
            $product = new Product();
            $arrayOfObjects[] = $product->setId($value['id'])
                ->setDescription($value['description'])
                ->setCost($value['cost'])
                ->setImg($value['img'])
                ->setCategoryId($value['category_id'])
                ->setDiscount($value['discount'])
                ->setName($value['name']);
        }
        return $arrayOfObjects;
    }

    public function getCountProductByCategory(int $id): int
    {
        return $this->select('products', ['count(*)'])
            ->where('category_id = ?')
            ->params([$id])
            ->execute()[0]['count(*)'];
    }

    public function insertProduct(Product $product): bool
    {
        return $this->create('products', [
            'name' => $product->getName(),
            'img' => $product->getImg(),
            'category_id' => $product->getCategoryId(),
            'discount' => $product->getDiscount(),
            'cost' => $product->getCost(),
            'description' => $product->getDescription()
        ]);
    }

    public function removeProductById(int $id): bool
    {
        return $this->delete('products', ['id' => $id]);
    }
}
