<?php


namespace Liloy\Framework\Router;

class Request
{
    private array $request = [];

    public function setPost(): void
    {
        $this->request['post'] = $_POST;
        $this->request['ajax'] = file_get_contents('php://input');
    }

    public function setGet(string $get): void
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
