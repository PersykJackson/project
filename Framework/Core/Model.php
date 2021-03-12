<?php


namespace Liloy\Framework\Core;

class Model
{
    protected \PDO $db;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }
}
