<?php

namespace App\Http\Controllers;

use App\Events\OrderPlaced;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;

use App\Services\OrderService;
use App\Http\Requests\Order\StoreOrderRequest;
use Illuminate\Support\Facades\Auth;


class OrderController extends Controller
{

    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

     public function index(Request $request)
    {
        $orders = $this->orderService->getOrdersByUser($request->user()->id);
        return response()->json(['data' => $orders]);
    }
    
    public function store(StoreOrderRequest $request)
    {
        $order = $this->orderService->placeOrder(
            $request->validated()['items'],
            Auth::id()
        );

        return response()->json(['message' => 'Order placed successfully', 'order' => $order]);
    }

    public function show($id)
    {
        $order = $this->orderService->getOrder($id);
        return response()->json($order);
    }
}
