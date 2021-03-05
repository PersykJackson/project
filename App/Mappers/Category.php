<?php


namespace Liloy\App\Mappers;

class Category
{
    private int $id;

    private string $name;

    private string $img;

    public function __construct(array $category)
    {
        $this->id = $category['id'];
        $this->name = $category['name'];
        $this->img = $category['img'];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getImg(): string
    {
        return $this->img;
    }

    public function setImg(string $img): void
    {
        $this->img = $img;
    }
}
