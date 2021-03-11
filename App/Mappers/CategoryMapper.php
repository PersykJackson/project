<?php


namespace Liloy\App\Mappers;

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

    public function getNameById(int $id): string
    {
        return $this->select('categories', ['name'])
            ->where('id = ?')
            ->params([$id])
            ->execute()[0]['name'];
    }
}
