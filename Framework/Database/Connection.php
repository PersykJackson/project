<?php


namespace Liloy\Framework\Database;

class Connection
{
    private static \PDO $db;

    private static self $instance;

    public static function getInstance(): self
    {
        if (!isset(self::$instance)) {
            if (getenv('APP_ENV') === 'test') {
                $config = parse_ini_file(__DIR__ . '/test_config.env');
            } else {
                $config = parse_ini_file(__DIR__ . '/config.env');
            }
            self::$db = new \PDO(
                "mysql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}",
                $config['user'],
                $config['password']
            );
            return self::$instance = new static();
        }
        return self::$instance;
    }

    public static function getDb(): \PDO
    {
        return self::$db;
    }
}
