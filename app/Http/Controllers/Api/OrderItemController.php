<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderItem;
use App\Http\Resources\OrderItemsResource as OrderItemResource;

class OrderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(OrderItem $orderItems)
    {
        $orderItems = OrderItem::all();
        return response()->json($orderItems, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'nullable|exists:products,id',
            'price' => 'required|numeric',
            'quantity' => 'required',
            'options' => 'nullable',
            'order_id',
            'product_name' => 'required|string|max:255',


        ]);
        $orderItem = OrderItem::create($request->all());
        return response()->json($orderItem, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)

    {
        $orderItem = OrderItem::findOrFail($id);

        return response()->json(new OrderItemResource($orderItem), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)

    {
        $request->validate([]);
        $orderItem = OrderItem::findOrFail($id);

        $orderItem->update($request->all());
        return response()->json($orderItem, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $orderItem = OrderItem::findOrFail($id);
        $orderItem->destroy($id);
        return response()->json(['message' => 'OrderItem deleted successfully'], 200);
    }
}
