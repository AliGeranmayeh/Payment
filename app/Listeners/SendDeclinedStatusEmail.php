<?php

namespace App\Listeners;

use App\Events\DeclinedStatusEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendDeclinedStatusEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(DeclinedStatusEvent $event): void
    {
        //
    }
}
