<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->where('status', 'active')
            ->orderBy('created_at', 'desc')
            ->limit(8)
            ->get();

        return view('front.home', compact('products'));
    }
}
