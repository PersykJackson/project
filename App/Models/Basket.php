<?php


namespace Liloy\App\Models;

use Liloy\App\Mappers\ProductMapper;
use Liloy\Framework\Core\Model;
use Liloy\Framework\Helpers\Services\BasketService;
use Liloy\Framework\Session\Sessioner;

class Basket extends Model
{
    private const UNSET = 'unset';

    private const INCREMENT = 'increment';

    private const DECREMENT = 'decrement';

    public function changeProductsCountFromBasket($request)
    {
        $basket = new BasketService(new Sessioner());
        if ($request->action === self::UNSET) {
            $basket->delete($request->id);
        } elseif ($request->action === self::INCREMENT) {
            $basket->setAmount($request->id, $basket->getAmount($request->id) + 1);
        } elseif ($request->action === self::DECREMENT) {
            $basket->setAmount($request->id, $basket->getAmount($request->id) - 1);
            if ($basket->getAmount($request->id) < 1) {
                $basket->delete($request->id);
            }
        }
    }

    public function getBasket(): array
    {
        $productMapper = new ProductMapper($this->db);
        $products = [];
        $session = new Sessioner();
        if ($session->get('basket')) {
            foreach ($session->get('basket') as $item) {
                $products[] = [
                    'item' => $productMapper->getProductById($item['id']),
                    'amount' => $item['amount']
                ];
            }
        }
        return $products;
    }

    public function addProductToBasket($id): void
    {
        $sessioner = new Sessioner();
        if ($sessioner->contains('basket')) {
            $basket = $sessioner->get('basket');
            foreach ($basket as $key => $item) {
                if ($item['id'] === $id) {
                    $basket[$key]['amount']++;
                    $sessioner->set('basket', $basket);
                    return;
                }
            }
            $basket[] = ['id' => $id, 'amount' => 1];
        } else {
            $basket[] = ['id' => $id, 'amount' => 1];
        }
        $sessioner->set('basket', $basket);
    }
}
