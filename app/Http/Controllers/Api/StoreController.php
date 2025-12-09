<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;
use App\Http\Resources\StoreResource;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stores = Store::withCount('products')->paginate();
        return response()->json(StoreResource::collection($stores), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:stores,slug',
            'description' => 'nullable|string',
            'logo' => 'nullable|image',
            'cover' => 'nullable|image',
            'status' => 'nullable|string|in:active,inactive',
        ]);

        $store = Store::create($request->all());

        return response()->json(new StoreResource($store), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Store $store)
    {
        $store->loadCount('products');
        return response()->json(new StoreResource($store), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Store $store)
    {
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'slug' => 'sometimes|string|max:255|unique:stores,slug,' . $store->id,
            'description' => 'nullable|string',
            'logo' => 'nullable|image',
            'cover' => 'nullable|image',
            'status' => 'nullable|string|in:active,inactive',
        ]);

        $store->update($request->all());

        return response()->json(new StoreResource($store), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Store $store)
    {
        $store->delete();

        return response()->json(['message' => 'Store deleted successfully'], 200);
    }
}
