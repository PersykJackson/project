<?php


class LayoutLoader
{
    public array $content = [];
    public string $layout = 'layout.php';
    public string $path;
    public function __construct(array $content, string $path)
    {
        $this->path = $path;
        if ($path === '') {
            $this->path = 'index';
        }
        $this->content = $content;
        $this->content['products'] = require_once 'products.php';
    }
    public function render()
    {
        if (file_exists(__DIR__."/public/views/".$this->path.".html")) {
            ob_start();
            require_once "public/views/".$this->path.".html";
        } else {
            ob_start();
            require_once "public/views/".$this->path.".php";
        }
        $this->content['main'] = ob_get_clean();
        require $this->layout;
    }
}