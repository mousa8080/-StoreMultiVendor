<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Repositories\card\CardRepositories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class CheckOutController extends Controller
{
    public function create(CardRepositories $card)
    {
        if ($card->get()->count() == 0) {
            return redirect()->route('home');
        }

        return view('front.checkout', compact('card'));
    }
    public function store(Request $request, CardRepositories $card)
    {
        $request->validate([]);
        $itmes = $card->get()->groupBy('product.store_id')->all();

        DB::beginTransaction();
        try {
            foreach ($itmes as $store_id => $items) {
                $order = Order::create([
                    'store_id' => $store_id,
                    'user_id' => Auth::id(),
                    'payment_method' => $request->payment_method,
                ]);
                foreach ($items as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'product_name' => $item->product->name,
                        'price' => $item->product->price,
                        'quantity' => $item->quantity,
                    ]);
                }

                // Create order addresses
                foreach ($request->post('addr') as $type => $address) {
                    // Skip if shipping address is empty (when same as billing is checked)
                    if ($type === 'shipping') {
                        $requiredFields = ['first_name', 'last_name', 'phone_number', 'street_address', 'city'];
                        $hasData = false;
                        foreach ($requiredFields as $field) {
                            if (!empty($address[$field])) {
                                $hasData = true;
                                break;
                            }
                        }
                        if (!$hasData) {
                            continue;
                        }
                    }

                    $address['type'] = $type;
                    $order->addresses()->create($address);
                }
            }
            $card->empty();
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        return redirect()->route('home');
    }
}
