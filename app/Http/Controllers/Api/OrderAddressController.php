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
    public function store(Request $request, OrderAddress $addresess)
    {
        $request->validate([]);
        $addresess->create($request->all());
        return response()->json($addresess, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderAddress $orderAddress)
    {
        // $orderAddress = OrderAddress::findOrFail($id);

        return response()->json($orderAddress, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,OrderAddress $orderAddress)
    {
        $request->validate([]);
        // $orderAddress = OrderAddress::findOrFail($id);
        $orderAddress->update($request->all());
        return response()->json($orderAddress, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderAddress $orderAddress)
    {
        $orderAddress->delete();
        return response()->json(['message' => 'orderAddress deleted successfully'], 200);
    }
}
