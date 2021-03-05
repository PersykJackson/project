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

    public function delete($key): void
    {
        $basket = $this->session->get('basket');
        unset($basket[$key]);
        $this->session->set('basket', $basket);
    }

    public function set($key, $value): void
    {
        $basket = $this->session->get('basket');
        $basket[$key] = $value;
        $this->session->set('basket', $basket);
    }

    public function setAmount($key, $amount): void
    {
        $basket = $this->session->get('basket');
        $basket[$key]['amount'] = $amount;
        $this->session->set('basket', $basket);
    }

    public function getAmount($key): int
    {
        return $this->session->get('basket')[$key]['amount'];
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
