<?php


namespace Liloy\App\Models;

use Liloy\App\Mappers\ProductMapper;

class Products extends \Liloy\Framework\Core\Model
{
    public function getProductsWithPagination($request): array
    {
        $productStorage = new ProductMapper($this->db);
        if ($request->category) {
            $products = $productStorage->getProductsByCategory((int)$request->category);
        } else {
            $products = $productStorage->getProducts();
        }
        $countPages = ceil(count($products) / 12);
        $firstProduct = ($request->page - 1) * 12;
        $lastProduct = $firstProduct + 11;
        $page = [];
        foreach ($products as $key => $product) {
            if ($key >= $firstProduct && $key <= $lastProduct) {
                $page[] = $product;
            }
        }
        $answer['countPages'] = $countPages;
        $answer['page'] = $page;
        return $answer;
    }
}