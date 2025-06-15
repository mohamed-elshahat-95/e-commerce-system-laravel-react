<?php

namespace App\Repositories\Interfaces;

interface OrderRepositoryInterface
{
    public function createOrder(array $items, int $userId);
    public function getOrderDetails(int $orderId);
    public function getByUser(int $userId);
}
