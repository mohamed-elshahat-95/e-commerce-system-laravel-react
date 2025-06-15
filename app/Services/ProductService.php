<?php

namespace App\Services;

use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductService
{
    protected $productRepo;

    public function __construct(ProductRepositoryInterface $productRepo)
    {
        $this->productRepo = $productRepo;
    }

    public function list(array $filters, int $perPage = 10)
    {
        return $this->productRepo->getAll($filters, $perPage);
    }

    public function store(array $data)
    {
        return $this->productRepo->create($data);
    }
}
