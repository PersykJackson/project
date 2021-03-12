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

    public function getModel()
    {
        preg_match('/Liloy\\\App\\\Controller\\\(.*)Controller/', get_class($this), $matches);
        $modelName = 'Liloy\\App\\Models\\'.$matches[1];
        return new $modelName(Connection::getDb());
    }
}
