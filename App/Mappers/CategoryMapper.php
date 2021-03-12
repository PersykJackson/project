<?php


namespace Liloy\App\Mappers;

use Liloy\Framework\Core\Mapper;

class CategoryMapper extends Mapper
{
    public function getCategories(): array
    {
        $columns = ['id', 'name', 'img'];
        $categories = $this->select('categories', $columns)->orderBy(['id'])->execute();
        $all = [];
        foreach ($categories as $category) {
            $all[] = (new Category())
                ->setImg($category['img'])
                ->setName($category['name'])
                ->setId($category['id']);
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
