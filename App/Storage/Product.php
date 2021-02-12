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

    /**
     * @return int|mixed
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int|mixed $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed|string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param mixed|string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed|string
     */
    public function getImg(): string
    {
        return $this->img;
    }

    /**
     * @param mixed|string $img
     */
    public function setImg(string $img): void
    {
        $this->img = $img;
    }

    /**
     * @return int|mixed
     */
    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    /**
     * @param int|mixed $categoryId
     */
    public function setCategoryId(int $categoryId): void
    {
        $this->categoryId = $categoryId;
    }

    /**
     * @return int|mixed
     */
    public function getDiscount(): int
    {
        return $this->discount;
    }

    /**
     * @param int|mixed $discount
     */
    public function setDiscount(int $discount): void
    {
        $this->discount = $discount;
    }

    /**
     * @return int|mixed
     */
    public function getCost(): int
    {
        return $this->cost;
    }

    /**
     * @param int|mixed $cost
     */
    public function setCost(int $cost): void
    {
        $this->cost = $cost;
    }

    /**
     * @return mixed|string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param mixed|string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

}
