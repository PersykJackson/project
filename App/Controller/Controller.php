<?php

namespace Liloy\App\Controller;

use Liloy\App\Database\Connection;
use Liloy\App\Storage\Category;
use Liloy\App\Storage\CategoryStorage;

abstract class Controller
{
    protected string $path;
    protected array $get;
    public function __construct(string $path, array $get)
    {
        $this->path = $path;
        $this->get = $get;
    }
}
