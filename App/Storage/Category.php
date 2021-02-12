<?php


namespace Liloy\App\Storage;

class Category
{
    private int $id;
    private string $name;
    private string $img;
    private string $path;
    public function __construct(array $category)
    {
        $this->id = $category['id'];
        $this->name = $category['name'];
        $this->img = $category['img'];
        $this->path = $category['path'];
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
     * @return mixed|string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param mixed|string $path
     */
    public function setPath(string $path): void
    {
        $this->path = $path;
    }

}