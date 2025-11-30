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
    public function get(): Collection
    {
        return Card::with('product')->where('cookie_id', '=', $this->getCookieId())->get();
    }

    public function add(Product $product, int $quantity): void
    {
        $item = Card::where('cookie_id', '=', $this->getCookieId())->where('product_id', '=', $product->id)->first();
        if (!$item) {
            Card::create([
                'cookie_id' => $this->getCookieId(),
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
        Card::where('product_id', '=', $product->id)->where('cookie_id', '=', $this->getCookieId())->update([
            'quantity' => $quantity,
        ]);
    }

    public function delete($id): void
    {
        Card::where('id', '=', $id)->where('cookie_id', '=', $this->getCookieId())->delete();
    }

    public function total(): int
    {
        return Card::where('cookie_id', '=', $this->getCookieId())->join('products', 'products.id', '=', 'cards.product_id')->selectRaw('sum(products.price * cards.quantity) as total')->value('total');
    }

    public function empty(): void
    {

        Card::where('cookie_id', '=', $this->getCookieId())->delete();
    }

    protected function getCookieId()
    {
        $cookie_id = Cookie::get('card_id');
        if (!$cookie_id) {
            $cookie_id = Str::uuid();
            Cookie::queue('card_id', $cookie_id, 60 * 60 * 24 * 30);
        }

        return $cookie_id;
    }
}
