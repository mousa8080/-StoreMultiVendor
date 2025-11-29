<?php

namespace App\Http\Controllers\Dashpoard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $products = Product::with('category', 'store')->paginate();
        $categories = Category::all();
        return view('dashpoard.products.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        $product = new Product();
        return view('dashpoard.products.create', compact('product', 'categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $tags = $product->tags;
        return view('dashpoard.products.edit', compact('product', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $data=$request->except('tags');
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }
        $tag_id = [];
        $save_tags = Tag::all();
        foreach ($save_tags as $tag) {
            $tag_slug = STR::slug($tag);
            $tag = $save_tags->where('slug', $tag_slug)->first();
            if (!$tag) {
                $tag = Tag::create([
                    'name' => $tag_slug,
                    'slug' => $tag_slug,
                ]);
            }
            $tag_id[] = $tag->id;
        }
        $product->tags()->sync($tag_id);
        $product->update($data);
        return redirect()->route('dashpoard.products.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('dashpoard.products.index')->with('success', 'Product deleted successfully');
    }
}
