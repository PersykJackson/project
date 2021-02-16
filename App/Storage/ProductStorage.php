<?php


namespace Liloy\App\Storage;

class ProductStorage extends Storage
{
    private array $cols = ['id', 'name', 'img', 'cost', 'description', 'category_id', 'discount'];

    public function getProductById($id): Product
    {
        $product = $this->select('products', $this->cols)->where("id = $id")->execute();
        return new Product($product);
    }

    public function getProductsByCategory(int $categoryId): array
    {
        $products = $this->select('products', $this->cols)
            ->where("category_id = $categoryId")
            ->execute();
        $all = [];
        foreach ($products as $product) {
            $all[] = new Product($product);
        }
        return $all;
    }

    public function getProducts(): array
    {
        $products = $this->select('products', $this->cols)->orderBy(['id'])->execute();
        $all = [];
        foreach ($products as $product) {
            $all[] = new Product($product);
        }
        return $all;
    }
}
