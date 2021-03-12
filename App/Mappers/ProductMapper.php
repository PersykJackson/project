<?php


namespace Liloy\App\Mappers;

use Liloy\Framework\Core\Mapper;

class ProductMapper extends Mapper
{
    private array $cols = ['id', 'name', 'img', 'cost', 'description', 'category_id', 'discount'];

    public function getProductById($id): Product
    {
        $result = $this->select('products', $this->cols)->where("id = $id")->execute()[0];
        $product = new Product();
        $product->setId($result['id'])
            ->setDescription($result['description'])
            ->setCost($result['cost'])
            ->setImg($result['img'])
            ->setCategoryId($result['category_id'])
            ->setDiscount($result['discount'])
            ->setName($result['name']);
        return $product;
    }

    public function getProductsByCategory(int $categoryId): array
    {
        $result = $this->select('products', $this->cols)
            ->where("category_id = $categoryId")
            ->execute();
        $all = [];
        foreach ($result as $value) {
            $product = new Product();
            $all[] = $product->setId($value['id'])
                ->setDescription($value['description'])
                ->setCost($value['cost'])
                ->setImg($value['img'])
                ->setCategoryId($value['category_id'])
                ->setDiscount($value['discount'])
                ->setName($value['name']);
        }
        return $all;
    }

    public function getTopProducts(): array
    {
        $result = $this->select('products', $this->cols)->orderBy(['id'])->limit(6)->execute();
        $all = [];
        foreach ($result as $value) {
            $product = new Product();
            $all[] = $product->setId($value['id'])
                ->setDescription($value['description'])
                ->setCost($value['cost'])
                ->setImg($value['img'])
                ->setCategoryId($value['category_id'])
                ->setDiscount($value['discount'])
                ->setName($value['name']);
        }
        return $all;
    }

    public function getProducts(): array
    {
        $productsArray = $this->select('products', $this->cols)
            ->orderBy(['id'])
            ->execute();
        $all = [];
        foreach ($productsArray as $value) {
            $product = new Product();
            $all[] = $product->setId($value['id'])
                ->setDescription($value['description'])
                ->setCost($value['cost'])
                ->setImg($value['img'])
                ->setCategoryId($value['category_id'])
                ->setDiscount($value['discount'])
                ->setName($value['name']);
        }
        return $all;
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
