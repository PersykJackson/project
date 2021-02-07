<?php

namespace Liloy\App\Controller;

abstract class Controller
{
    protected string $path;
    public function __construct(string $path)
    {
        $this->path = $path;
    }
}
