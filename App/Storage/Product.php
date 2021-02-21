<?php


namespace Liloy\App\Storage;

class Product
{
    private int $id;

    private string $name;

    private string $img;

    private int $categoryId;

    private int $discount;

    private int $cost;

    private string $description;

    public function __construct(array $product)
    {
        $this->id = $product['id'];
        $this->name = $product['name'];
        $this->img = $product['img'];
        $this->categoryId = $product['category_id'];
        $this->discount = $product['discount'];
        $this->cost = $product['cost'];
        $this->description = $product['description'];
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

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    public function setCategoryId(int $categoryId): void
    {
        $this->categoryId = $categoryId;
    }

    public function getDiscount(): int
    {
        return $this->discount;
    }

    public function setDiscount(int $discount): void
    {
        $this->discount = $discount;
    }

    public function getCost(): int
    {
        return $this->cost;
    }

    public function setCost(int $cost): void
    {
        $this->cost = $cost;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
}
