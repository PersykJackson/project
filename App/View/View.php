<?php

namespace Liloy\App\View;

class View
{
    private string $path;
    public array $content = [];
    private string $template = 'template.php';
    public function __construct(string $path, array $data = [])
    {
        $this->path = $path;
        $this->content['data'] = $data;
        $this->prepare();
    }
    public function prepare(): void
    {
        preg_match("/\/([a-z A-Z]*$)/", $this->path, $matches);
        $this->content['css'] = $matches[1];
    }
    public function render(): void
    {

        $name = __DIR__."/Layouts/".$this->path;

        if (file_exists($name.".html")) {
            ob_start();
            require_once $name.".html";
        } else {
            ob_start();
            require_once $name.".php";
        }
        $this->content['main'] = ob_get_clean();
        require __DIR__.'/Templates/'.$this->template;
    }
}