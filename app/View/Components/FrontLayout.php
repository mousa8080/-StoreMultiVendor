<?php

namespace App\View\Components;

use App\Models\Product;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FrontLayout extends Component
{
    /**
     * Create a new component instance.
     */
    public $title;
    public function __construct($title='')
    {
        $this->title = $title??config('app.name');
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $products=Product::with('category')->active()->latest()->take(8)->get();
        return view('layouts.front',compact('products'));
    }
}
