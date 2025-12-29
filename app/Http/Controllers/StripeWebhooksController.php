<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StripeWebhooksController extends Controller
{
    public function handle(Request $request)
    {

        $payload = @file_get_contents('php://input');
        $event = null;

        try {
            $event = \Stripe\Event::constructFrom(
                json_decode($payload, true)
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            echo '⚠️  Webhook error while parsing basic request.';
            http_response_code(400);
            exit();
        }
        
        // Process the event
        if ($event) {
            \Illuminate\Support\Facades\Log::debug('Stripe webhook event received', ['event' => $event->type, 'data' => $event->data->object]);
        }
        
        return response()->json(['received' => true]);
    }
}
