<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('index','show');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $products = Product::with('category:id,name', 'store:id,name')->filter($request->query())->paginate();
        return response()->json(ProductResource::collection($products), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'store_id' => 'required|exists:stores,id',
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image',
            'price' => 'required|numeric',
            'compare_price' => 'nullable|numeric',
            'options' => 'nullable|string',
            'rating' => 'nullable|numeric',
            'featured' => 'nullable|boolean',
            'status' => 'nullable|string|in:active,inactive',

        ]);
        $product = Product::create($request->all());
        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {

        return response()->json(new ProductResource($product), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'store_id' => 'sometimes|exists:stores,id',
            'category_id' => 'sometimes|exists:categories,id',
            'name' => 'sometimes|string|max:255',
            'slug' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'image' => 'sometimes|image',
            'price' => 'sometimes|numeric',
            'compare_price' => 'nullable|numeric',
            'options' => 'nullable|string',
            'rating' => 'nullable|numeric',
            'featured' => 'nullable|boolean',
            'status' => 'nullable|string|in:active,inactive',
        ]);

        $product->update($request->all());

        return response()->json(new ProductResource($product), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully'], 200);
    }
}
