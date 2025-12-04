<?php

namespace App\Http\Controllers\Front;

use App\Events\OrderCreate;
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
        $request->validate([
            'payment_method' => 'required',
            'addr' => 'required|array',
            'addr.billing.first_name' => 'required|string|max:255',
            'addr.billing.last_name' => 'required|string|max:255',
            'addr.billing.email' => 'required|email|max:255',
            'addr.billing.phone_number' => 'required|string|max:20',
            'addr.billing.street_address' => 'required|string|max:255',
            'addr.billing.city' => 'required|string|max:100',
            'addr.billing.country' => 'required|string|size:2',
        ]);
        $itmes = $card->get()->groupBy('product.store_id')->all();

        DB::beginTransaction();
        try {
            $orders = [];
            foreach ($itmes as $store_id => $items) {
                // Calculate order totals
                $itemsTotal = 0;
                foreach ($items as $item) {
                    $itemsTotal += $item->product->price * $item->quantity;
                }

                $shipping = 0; // يمكنك حساب الشحن حسب المتطلبات
                $tax = 0; // يمكنك حساب الضريبة حسب المتطلبات
                $discount = 0; // يمكنك حساب الخصم حسب المتطلبات
                $total = $itemsTotal + $shipping + $tax - $discount;

                $order = Order::create([
                    'store_id' => $store_id,
                    'user_id' => Auth::id(),
                    'payment_method' => $request->payment_method,
                    'shipping' => $shipping,
                    'tax' => $tax,
                    'discount' => $discount,
                    'total' => $total,
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

                // إضافة Order للمصفوفة
                $orders[] = $order;
            }
            $card->empty();
            DB::commit();

            // إطلاق Event لكل order
            foreach ($orders as $order) {
                event(new OrderCreate($order));
            }
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        return redirect()->route('home')->with('success', 'Order created successfully');
    }
}
