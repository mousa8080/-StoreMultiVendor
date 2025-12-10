<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OrderAddress;
use Illuminate\Http\Request;

class OrderAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adderesess = OrderAddress::all();
        return response()->json($adderesess, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'type' => 'required|string|in:billing,shipping',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'street_address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'country' => 'required|string|max:255',
        ]);
        $address = OrderAddress::create($request->all());
        return response()->json($address, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $orderAddress = OrderAddress::findOrFail($id);

        return response()->json($orderAddress, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'order_id' => 'sometimes|exists:orders,id',
            'type' => 'sometimes|string|in:billing,shipping',
            'first_name' => 'sometimes|string|max:255',
            'last_name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|max:255',
            'phone_number' => 'sometimes|string|max:20',
            'street_address' => 'sometimes|string|max:255',
            'city' => 'sometimes|string|max:255',
            'postal_code' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'country' => 'sometimes|string|max:255',
        ]);
        $orderAddress = OrderAddress::findOrFail($id);
        $orderAddress->update($request->all());
        return response()->json($orderAddress, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $orderAddress = OrderAddress::findOrFail($id);
        $orderAddress->destroy($id);
        return response()->json(['message' => 'orderAddress deleted successfully'], 200);
    }
}
