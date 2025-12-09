<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Card;
use Illuminate\Http\Request;
use App\Http\Resources\CardResource;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cards = Card::all();
        return response()->json(CardResource::collection($cards), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'options' => 'nullable|string',
        ]);

        $card = Card::create([
            'cookie_id' => Card::getCookieId(),
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'options' => $request->options,
        ]);

        return response()->json(new CardResource($card->load('product', 'user')), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Card $card)
    {
        return response()->json(new CardResource($card->load('product', 'user')), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Card $card)
    {
        $request->validate([
            'quantity' => 'sometimes|integer|min:1',
            'options' => 'nullable|string',
        ]);

        $card->update($request->only(['quantity', 'options']));

        return response()->json(new CardResource($card->load('product', 'user')), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Card $card)
    {
        $card->delete();

        return response()->json(['message' => 'Card item deleted successfully'], 200);
    }
}
