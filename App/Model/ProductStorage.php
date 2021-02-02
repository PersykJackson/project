<?php

namespace Liloy\App\Model;

use Liloy\App\Helpers\Exceptions\StorageException;

class ProductStorage
{
    private string $file;
    public function __construct(string $file)
    {
        if (file_exists($file)) {
            $this->file = file_get_contents($file);
        } else {
            throw new StorageException('File not found');
        }
    }
    private function parseToArr(int $id): array
    {
        $file = explode(";", $this->file);
        array_pop($file);
        foreach ($file as $string) {
            $preparedArray[] = trim($string);
        }
        foreach ($preparedArray as $item) {
            preg_match('/id = ([0-9]+)/', $item, $matches);
            if ($id === (int) $matches[1]) {
                $product = explode(",", $item);
                foreach ($product as $value) {
                     $result = explode(' = ', trim($value));
                    $productArray[$result[0]] = $result[1];
                }
                return $productArray;
            }
        }
        throw new StorageException();
    }
    public function getById(int $id): Product
    {
        $array = $this->parseToArr($id);
        return new Product((int) $array['id'], $array['name'], $array['img'], (int) $array['cost']);
    }
    public function getAll():array
    {
        $array = explode(";", $this->file);
        array_pop($array);
        $count = count($array);
        for ($i = 0; $i < $count; $i++) {
            $productArray[] = $this->getById($i);
        }
        return $productArray;
    }
}