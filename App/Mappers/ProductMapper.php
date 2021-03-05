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
        return $this->select('products', $this->cols)
            ->orderBy(['id'])
            ->execute();
    }
}
