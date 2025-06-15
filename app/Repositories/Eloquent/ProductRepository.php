<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    public function getAll(array $filters, int $perPage = 10)
    {
        return Product::when($filters['name'] ?? null, fn($q, $name) => $q->where('name', 'like', "%$name%"))
                      ->when($filters['min_price'] ?? null, fn($q, $min) => $q->where('price', '>=', $min))
                      ->when($filters['max_price'] ?? null, fn($q, $max) => $q->where('price', '<=', $max))
                      ->when($filters['category'] ?? null, fn($q, $cat) => $q->where('category', $cat))
                      ->paginate($perPage);
    }

    public function findById(int $id)
    {
        return Product::findOrFail($id);
    }

    public function create(array $data)
    {
        return Product::create($data);
    }
}
