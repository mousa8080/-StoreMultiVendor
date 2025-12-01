<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Facades\Card;

class CardMinue extends Component
{
    /**
     * Create a new component instance.
     */
    public $items;
    public $total;

    public function __construct()
    {
        $this->total = Card::total();
        $this->items = Card::get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card-minue', [
            'items' => $this->items,
            'total' => $this->total,
        ]);
    }
}
