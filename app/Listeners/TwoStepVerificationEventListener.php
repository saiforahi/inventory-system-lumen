<?php

namespace App\Listeners;

use App\Events\ExampleEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TwoStepVerification;
use App\Events\TwoStepVerificationEvent;
class TwoStepVerificationEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\ExampleEvent  $event
     * @return void
     */
    public function handle(TwoStepVerificationEvent $event)
    {
        //
        Notification::send($event->user, new TwoStepVerification($event->user->id));
    }
}
