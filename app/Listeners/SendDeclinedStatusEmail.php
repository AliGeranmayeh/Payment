<?php

namespace App\Listeners;

use App\Events\DeclinedStatusEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\DeclinedDemandEmail;

class SendDeclinedStatusEmail implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(DeclinedStatusEvent $event): void
    {
        $user = User::find($event->demand->user_id);
        Mail::to($user->email)->send(new DeclinedDemandEmail($event->demand->description));
    }
}
