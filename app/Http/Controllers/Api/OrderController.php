<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all();
        return response()->json( OrderResource::collection($orders), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,Order $order)
    {
        $order=Order::create($request->all());
        return response()->json($order,200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return response()->json(new OrderResource($order),200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $order->update($request->all());
        return response()->json(new OrderResource($order),200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json(['message' => 'Category deleted successfully'],200);
    }
}
