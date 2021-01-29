<?php


class MainController extends Controller
{
    public function index(): void
    {
        $storage = new ProductStorage('../App/Database/products.txt');
        $product = $storage->getAll();
        $view = new View($this->path, ['Product' => $product]);
        $view->render();
    }
    public function products(): void
    {
        $storage = new ProductStorage('../App/Database/products.txt');
        $product = $storage->getAll();
        $view = new View($this->path, ['Product' => $product]);
        $view->render();
    }
    public function basket(): void
    {
        $view = new View($this->path);
        $view->render();
    }
    public function productPage(): void
    {
        $view = new View($this->path);
        $view->render();
    }

}