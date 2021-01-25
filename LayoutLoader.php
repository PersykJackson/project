<?php


class LayoutLoader
{
    private string $template;
    public array $content;
    public string $layout = 'layout.php';
    public function __construct(array $content, string $template)
    {
        $this->content = $content;
        $this->template = $template;
    }
    public function render()
    {
        ob_start();
        require_once 'public/views/register.html';
        $this->content['main'] = ob_get_clean();
        require $this->layout;
    }
}