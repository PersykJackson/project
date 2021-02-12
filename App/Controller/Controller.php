<?php

namespace Liloy\App\Controller;

use Liloy\App\Database\Connection;
use Liloy\App\Storage\Category;
use Liloy\App\Storage\CategoryStorage;

abstract class Controller
{
    protected string $path;
    public array $categories;
    public function __construct(string $path)
    {
        $this->path = $path;
    }
}
