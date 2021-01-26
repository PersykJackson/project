<?php
require_once 'autoload.php';

class ProductSearcher
{
    private array $products = [];
    public function __construct(array $products)
    {
        $this->products = $products;
    }
    public function getProduct(int $productId): array
    {
        foreach ($this->products as $product) {
            if ($product['id'] === $productId) {
                return $product;
            }
        }
        throw new ProductFoundtException();
    }
}