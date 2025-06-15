<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;

use App\Services\ProductService;
use App\Http\Requests\Product\StoreProductRequest;

class ProductController extends Controller
{

    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $filters = $request->only(['name', 'min_price', 'max_price', 'category']);
        $products = $this->productService->list($filters);
        return response()->json($products);
    }

    public function store(StoreProductRequest $request)
    {
        $product = $this->productService->store($request->validated());
        return response()->json(['message' => 'Product created', 'product' => $product]);
    }
}
