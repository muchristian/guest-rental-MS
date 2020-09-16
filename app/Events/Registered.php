<?php

namespace App\Events;


use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class Registered
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $verification_code;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user, $verification_code)
    {
        $this->user = $user;
        $this->verification_code = $verification_code;
    }
}
