<?php
/**
 * @Deprecated
 */

class LayoutLoader
{
    public array $content = [];
    public string $layout = 'template.php';
    public string $path;
    public function __construct(array $content, string $path)
    {
        $this->path = $path;
        if ($path === '') {
            $this->path = 'index';
        }
        $this->content['products'] = $content;
    }
    public function render()
    {
        $name = __DIR__."/../View/Layouts/".$this->path;

        if (file_exists($name.".html")) {
            ob_start();
            require_once $name.".html";
        } else {
            ob_start();
            require_once $name.".php";
        }
        $this->content['main'] = ob_get_clean();
        require __DIR__.'/../View/Templates/'.$this->layout;
    }
}