<?php


class MainController extends Controller
{
    public function index(): void
    {
        $view = new View($this->path);
        $view->render();
    }
}