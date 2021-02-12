<?php


namespace Liloy\App\Storage;

class ProductStorage extends Storage
{
    private array $cols = ['id', 'name', 'img', 'cost', 'description'];
    public function getProductById($id): Product
    {
        $product = $this->select('products', $this->cols)->where("id = $id")->execute();
        return new Product($product);
    }
    public function getProducts(): array
    {
        $products = $this->select('products', $this->cols)->orderBy(['id'])->execute();
        var_dump($products);
        $all = [];
        foreach ($products as $product) {
            $all[] = new Product($product);
        }
        return $all;
    }
}
