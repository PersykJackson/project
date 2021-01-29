<?php


class AccountController extends Controller
{
    public function register(): void
    {
        $view = new View($this->path);
        $view->render();
    }
}