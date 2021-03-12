<?php


namespace Liloy\Framework\Helpers\Services;

use Liloy\Framework\Session\Sessioner;

class BasketService
{
    private Sessioner $session;

    public function __construct(Sessioner $session)
    {
        $this->session = $session;
    }

    public function delete($id): void
    {
        $basket = $this->session->get('basket');
        foreach ($basket as $key => $item) {
            if ($item['id'] == $id) {
                unset($basket[$key]);
            }
        }
        $this->session->set('basket', $basket);
    }

    public function set($key, $value): void
    {
        $basket = $this->session->get('basket');
        $basket[$key] = $value;
        $this->session->set('basket', $basket);
    }

    public function setAmount($id, $amount): void
    {
        $basket = $this->session->get('basket');
        foreach ($basket as $key => $item) {
            if ($item['id'] == $id) {
                $basket[$key]['amount'] = $amount;
            }
        }
        $this->session->set('basket', $basket);
    }

    public function getAmount($id): int
    {
        $basket = $this->session->get('basket');
        foreach ($basket as $key => $item) {
            if ($item['id'] == $id) {
                return $basket[$key]['amount'];
            }
        }
        return 0;
    }

    public function get(array $floors)
    {
        $basket = $this->session->get('basket');
        foreach ($floors as $floor) {
            $basket = $basket[$floor];
        }
        return $basket;
    }
}
