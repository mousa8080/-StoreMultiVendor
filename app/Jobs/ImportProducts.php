<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Notifications\Notification;

class ImportProducts implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(protected $count)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Product::factory()->count($this->count)->create();
        //send notification complete done
        
    }
}
