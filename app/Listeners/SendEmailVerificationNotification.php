<?php

namespace App\Listeners;

use App\Events\Registered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Helper\mailHelper;

class SendEmailVerificationNotification implements ShouldQueue
{
    use InteractsWithQueue;
    use mailHelper;
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
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $this->sendMail('email.verify',
        $event->user->username, 
        $event->user->email, 
        'Verify account',
        'verification_code', 
        $event->verification_code);
    }
}
