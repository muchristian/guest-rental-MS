<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ForgetPassword
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $reset_code;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user, $reset_code)
    {
        $this->user = $user;
        $this->reset_code = $reset_code;
    }

}
