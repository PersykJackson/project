<?php

namespace Liloy\App\Controller;

abstract class Controller
{
    protected string $path;

    protected array $get;

    public function __construct(string $path, array $get = [])
    {
        $this->path = $path;
        $this->get = $get;
    }
}
