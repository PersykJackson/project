<?php

namespace Liloy\Framework\Core;

use Liloy\Framework\Database\Connection;

abstract class Controller
{
    protected string $path;

    protected array $request;

    public function __construct(string $path, array $request = [])
    {
        $this->path = $path;
        $this->request = $request;
        Connection::getInstance();
    }
}
