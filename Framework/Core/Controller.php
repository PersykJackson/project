<?php

namespace Liloy\Framework\Core;

abstract class Controller
{
    protected string $path;

    protected array $request;

    public function __construct(string $path, array $request = [])
    {
        $this->path = $path;
        $this->request = $request;
    }
}
