<?php

namespace App\Repositories\Eloquent;

use App\Events\OrderPlaced;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    public function createOrder(array $items, int $userId)
    {
        return DB::transaction(function () use ($items, $userId) {
            $order = Order::create(['user_id' => $userId]);
            $total = 0;
            foreach ($items as $item) {
                $product = Product::findOrFail($item['product_id']);
                if ($product->stock < $item['quantity']) {
                    throw new \Exception("Product {$product->name} does not have enough stock.");
                }
                $lineTotal = $product->price * $item['quantity'];
                $total += $lineTotal;
                $order->products()->attach($product->id, [
                    'quantity' => $item['quantity'],
                    'price' => $product->price
                ]);
                $product->decrement('stock', $item['quantity']);
            }
            $order->update(['total_price' => $total]);
            event(new OrderPlaced($order));
            return $order->load('products');
        });
    }

    public function getOrderDetails(int $orderId)
    {
        return Order::with(['products'])->findOrFail($orderId);
    }

    public function getByUser(int $userId)
    {
        return Order::with('products')->where('user_id', $userId)->latest()->get();
    }
}
