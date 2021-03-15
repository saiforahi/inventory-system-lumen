<?php

namespace App\Events;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
// use Illuminate\Broadcasting\InteractsWithSockets;
// use Illuminate\Queue\SerializesModels;
class TwoStepVerificationEvent extends Event
{
    // use InteractsWithSockets, SerializesModels;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $user;
    public function __construct(User $user)
    {
        //
        $this->user=$user;
    }
}
