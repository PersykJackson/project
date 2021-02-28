<?php


namespace Liloy\Framework\Router;

class Request
{
    private array $request = [];

    public function __construct()
    {
        $this->request['post'] = $_POST;
    }

    public function get(string $get): void
    {
        $exploded = explode('&', $get);
        foreach ($exploded as $key => $value) {
            $result = explode('=', $value);
            unset($get);
            $get[$result[0]] = $result[1];
        }
        $this->request['get'] = $get;
    }

    public function getRequest(): array
    {
        return $this->request;
    }
}
