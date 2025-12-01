<?php

namespace App\Repositories\card;

use App\Models\Card;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Queue\Console\PruneFailedJobsCommand;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class CardModelRepositories implements CardRepositories
{
    protected $itmes;
    public function __construct()
    {
        $this->itmes = collect([]);
    }
    public function get(): Collection
    {
        if (!$this->itmes->count()) {
            $this->itmes = Card::with('product')->get();
        }
        return $this->itmes;
    }

    public function add(Product $product, int $quantity): void
    {
        $item = Card::where('product_id', '=', $product->id)->first();
        if (!$item) {
            Card::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);
        } else {
            $item->increment('quantity', $quantity);
        }
    }

    public function update(Product $product, int $quantity): void
    {
        Card::where('product_id', '=', $product->id)->update([
            'quantity' => $quantity,
        ]);
    }

    public function delete($id): void
    {
        Card::where('id', '=', $id)->delete();
        // $this->itmes = $this->itmes->reject(fn($item) => $item->id == $id);
    }

    public function total(): float
    {

        //return Card::join('products', 'products.id', '=', 'cards.product_id')->selectRaw('sum(products.price * cards.quantity) as total')->value('total');
        return $this->get()->sum('product.price * quantity');
    }

    public function empty(): void
    {
        Card::query()->delete();
    }
}
