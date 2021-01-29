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

}