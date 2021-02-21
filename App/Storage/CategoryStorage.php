<?php


namespace Liloy\App\Storage;

use Liloy\Framework\Core\Storage;

class CategoryStorage extends Storage
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
