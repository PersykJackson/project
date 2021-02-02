<?php

namespace Liloy\App\Model;

class Product
{
    public int $id;
    public string $name;
    public string $img;
    public int $cost;
    public function __construct(int $id, string $name, string $img, int $cost)
    {
        $this->id = $id;
        $this->name = $name;
        $this->img = $img;
        $this->cost = $cost;
    }
}