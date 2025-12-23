<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class DeleteExpiredOrders implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Order::where('status', 'pending')->where('created_at', '<', now()->subHours(24))->delete(); //pinding`
        Order::whereDate('created_at', '<', now()->subHours(24))
        ->where('status', 'pending')
        ->delete(); //pinding`
    }
}
