<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\Order;
use Exception;

class PaymentController extends Controller
{
    public function create(Order $order)
    {
        return view('front.Payment.create', compact('order'));
    }
    public function confirm(Request $request, Order $order)
    {
        $stripe = new \Stripe\StripeClient(config('services.stripe.STRIPE_SECRET_KEY'));

        $paymentIntent = $stripe->paymentIntents->retrieve(
            $request->query('payment_intent'),
            []
        );
        try {
            if ($paymentIntent->status == 'succeeded') {
                $payment = new Payment();
                $payment->forceFill([
                    'order_id' => $order->id,
                    'amount' => $paymentIntent->amount,
                    'status' => 'completed',
                    'payment_method' => 'pending',
                    'method' => 'stripe', 
                    'currency' => $paymentIntent->currency,
                    'transaction_id' => $paymentIntent->id,
                    'transaction_data' => json_encode($paymentIntent),
                ]);
                $payment->save();

                event('order.completed', $payment->id);

                return redirect()->route('home', [
                    'status' => 'succeeded',
                    'message' => 'Payment completed successfully',
                ]);
            }
        } catch (Exception $e) {

            return $e->getMessage();
        }
    }
    public function createStripePaymentIntent(Order $order)
    {
        $amount = $order->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });
        $stripe = new \Stripe\StripeClient(config('services.stripe.STRIPE_SECRET_KEY'));

        $paymentIntent = $stripe->paymentIntents->create([
            'amount' => $amount,
            'currency' => 'usd',
            'automatic_payment_methods' => ['enabled' => true],
        ]);
        return [
            'clientSecret' => $paymentIntent->client_secret,
        ];
    }
}
