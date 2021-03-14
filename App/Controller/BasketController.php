<?php


namespace Liloy\App\Controller;

use Liloy\Framework\Core\View;
use Liloy\Framework\Core\Controller;

class BasketController extends Controller
{
    public function index(): void
    {
        $view = new View($this->path);
        $view->content['css'] = 'basket';
        $view->render();
    }

    public function change(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $decodedRequest = json_decode($this->request['ajax']);
            $this->getModel()->changeProductsCountFromBasket($decodedRequest);
        }
    }

    public function getBasket(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            echo json_encode($this->getModel()->getBasket());
        }
    }

    public function getCountProducts(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            echo json_encode($this->getModel()->getCount());
        }
    }

    public function add(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $id = json_decode($this->request['ajax'])->id;
            $this->getModel()->addProductToBasket($id);
        }
    }
}
