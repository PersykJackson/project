<?php


namespace Liloy\App\Models;

use Liloy\App\Mappers\CategoryMapper;

class Main extends \Liloy\Framework\Core\Model
{
    public function getCategories(): array
    {
        $categoryMapper = new CategoryMapper($this->db);
        $arrayOfObjects = $categoryMapper->getCategories();
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
