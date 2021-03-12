<?php


namespace Liloy\App\Models;

use Liloy\App\Mappers\CategoryMapper;

class Main extends \Liloy\Framework\Core\Model
{
    public function getCategories(): array
    {
        $categoryStorage = new CategoryMapper($this->db);
        $arrayOfObjects = $categoryStorage->getCategories();
        $arrayOfCategories = [];
        foreach ($arrayOfObjects as $category) {
            $arrayOfCategories[] = [
                'name' => $category->getName(),
                'id' => $category->getId(),
                'img' => $category->getImg()
            ];
        }
        return $arrayOfCategories;
    }
}