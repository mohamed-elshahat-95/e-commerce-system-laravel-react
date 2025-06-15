<?php

namespace App\Repositories\Interfaces;

interface ProductRepositoryInterface
{
    public function getAll(array $filters, int $perPage);
    public function findById(int $id);
    public function create(array $data);
}
