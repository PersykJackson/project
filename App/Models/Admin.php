<?php


namespace Liloy\App\Models;

use Liloy\App\Mappers\Product;
use Liloy\App\Mappers\ProductMapper;

class Admin extends \Liloy\Framework\Core\Model
{
    public function saveImage($file)
    {
        move_uploaded_file($file['tmp_name'], $file['name']);
    }

    public function createProduct($request): bool
    {
        foreach ($request as $value) {
            if ($value === null) {
                return false;
            }
        }
        $productMapper = new ProductMapper($this->db);
        $productNumber = $productMapper->getCountProductByCategory($request->categoryId) + 1;
        $fileFormat = explode('.', $request->imageName)[1];
        $productNameHash = md5($productNumber . random_int(99, 999999));
        $fileName = $productNameHash . '.' . $fileFormat;
        $productSrc = 'images/products/' . $request->categoryId . '/' . $fileName;
        if (!file_exists('images/products/' . $request->categoryId)) {
            mkdir('images/products/' . $request->categoryId);
        }
        rename($request->imageName, $productSrc);
        $product = new Product();
        $product
            ->setName($request->name)
            ->setImg('/' . $productSrc)
            ->setCategoryId($request->categoryId)
            ->setDiscount($request->discount)
            ->setCost($request->cost)
            ->setDescription($request->description);
        return $productMapper->insertProduct($product);
    }

    public function removeProduct(int $id): bool
    {
        $productMapper = new ProductMapper($this->db);
        $src = $productMapper->getProductById($id)->getImg();
        unlink(trim($src, '/'));
        return $productMapper->removeProductById($id);
    }
}
