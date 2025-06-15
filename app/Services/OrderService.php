<?php

namespace App\Services;

use App\Repositories\Interfaces\OrderRepositoryInterface;

class OrderService
{
    protected $orderRepo;

    public function __construct(OrderRepositoryInterface $orderRepo)
    {
        $this->orderRepo = $orderRepo;
    }

    public function placeOrder(array $items, int $userId)
    {
        return $this->orderRepo->createOrder($items, $userId);
    }

    public function getOrder(int $id)
    {
        return $this->orderRepo->getOrderDetails($id);
    }

    public function getOrdersByUser(int $userId)
    {
        return $this->orderRepo->getByUser($userId);
    }
}
