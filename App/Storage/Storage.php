<?php


namespace Liloy\App\Storage;

use \PDO;

class Storage
{
    private PDO $db;
    private string $sql;
    private array $params = [];
    public function __construct($db)
    {
        $this->db = $db;
    }
    public function create(string $table, array $fields): bool
    {
        $sql = "INSERT INTO $table(";
        $values = ') VALUES(';
        foreach ($fields as $key => $value) {
            $sql .= $key .', ';
            $values .= '?, ';
        }
        $sql = trim($sql, ', ');
        $values = trim($values, ', ');
        $sql .= $values;
        $sql .= ");";
        $prepared = $this->db->prepare($sql);
        if ($prepared->execute(array_values($fields))) {
            return true;
        }
        return false;
    }
    public function select(string $table, array $cols = []): self
    {
        $sql = "SELECT ";
        $sql .= implode(', ', $cols);
        $this->sql = trim($sql, ', ') . " FROM $table";
        return $this;
    }
    public function where(string $expression): self
    {
        $this->sql .= " WHERE ".$expression;
        return $this;
    }
    public function leftJoin(string $join, string $on): self
    {
        $this->sql .= " LEFT JOIN ".$join." ON ".$on;
        return $this;
    }
    public function groupBy($group): self
    {
        $this->sql .= " GROUP BY".$group;
        return $this;
    }
    public function orderBy(array $cols): self
    {
        $sql = $this->sql .= " ORDER BY ";
        $sql .= implode(', ', $cols);
        $this->sql = trim($sql, ', ');
        return $this;
    }
    public function params(array $params): self
    {
        $this->params = $params;
        return $this;
    }
    public function execute()
    {
        /**
         * @return array|bool
         */
        $prepared = $this->db->prepare($this->sql.';');
        $result = $prepared->execute($this->params);
        if (strpos($this->sql, "SELECT")) {
            return $prepared->fetchAll(\PDO::FETCH_ASSOC);
        }
        return $result;
    }
    public function update(string $table, array $fields): self
    {
        $sql = "UPDATE $table SET ";
        foreach ($fields as $key => $value) {
            $sql .= $key." = ?, ";
        }
        $this->sql = trim($sql, ', ');
        $this->params = array_values($fields);
        return $this;
    }
    public function delete(string $table, array $where): bool
    {
        $key = array_key_first($where);
        $sql = "DELETE FROM $table WHERE " . $key . ' = ?;';
        $prepared = $this->db->prepare($sql);
        if ($prepared->execute(array_values($where))) {
            return true;
        }
        return false;
    }
}