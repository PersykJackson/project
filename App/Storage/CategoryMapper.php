<?php


namespace Liloy\App\Storage;

use Liloy\Framework\Core\Mapper;

class CategoryMapper extends Mapper
{
    public function getCategories(): array
    {
        $cols = ['id', 'name', 'img'];
        $categories = $this->select('categories', $cols)->orderBy(['id'])->execute();
        $all = [];
        foreach ($categories as $category) {
            $all[] = new Category($category);
        }
        return $all;
    }
}
