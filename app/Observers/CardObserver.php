<?php

namespace App\Observers;

use Illuminate\Support\Str;
use App\Models\Card;

class CardObserver
{
    /**
     * Handle the Card "created" event.
     */
    public function creating(Card $card): void
    {
        $card->id=Str::uuid();
        $card->cookie_id=$card->getCookieId();
    }

    /**
     * Handle the Card "updated" event.
     */
    public function updated(Card $card): void
    {
        //
    }

    /**
     * Handle the Card "deleted" event.
     */
    public function deleted(Card $card): void
    {
        //
    }

    /**
     * Handle the Card "restored" event.
     */
    public function restored(Card $card): void
    {
        //
    }

    /**
     * Handle the Card "force deleted" event.
     */
    public function forceDeleted(Card $card): void
    {
        //
    }
}
