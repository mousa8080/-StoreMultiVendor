<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Repositories\card\CardRepositories;
use Illuminate\Http\Request;
use App\Models\Product;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CardRepositories $card)
    {
        return view('front.card', compact('card'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CardRepositories $card)
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity' => ['nullable', 'numeric', 'min:1'],
        ]);
        $product = Product::find($request->post('product_id'));
        $quantity = $request->post('quantity', 1);
        $card->add($product, $quantity);
        return redirect()->route(route: 'card.index')->with('success', 'Product added to card successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CardRepositories $card, string $id)
    {
        $request->validate([
            'quantity' => ['required', 'numeric', 'min:1'],
        ]);

        $cartItem = \App\Models\Card::findOrFail($id);
        $product = $cartItem->product;
        $quantity = $request->post('quantity', 1);
        $card->update($product, $quantity);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Cart updated successfully']);
        }

        return redirect()->back()->with('success', 'Product updated to card successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CardRepositories $card, string $id)
    {
        $card->delete($id);
        return redirect()->back()->with('success', 'Product deleted from card successfully');
    }
}
