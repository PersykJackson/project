<?php


abstract class Controller
{
    protected string $path;
    public function __construct(string $path)
    {
        $this->path = $path;
    }
}