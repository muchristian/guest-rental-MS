<?php

namespace App\Listeners;

use App\Events\GHStatusRejectedUpdate;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Helper\mailHelper;

class SendRejectedNotification implements ShouldQueue
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
     * @param  GHStatusRejectedUpdate  $event
     * @return void
     */
    public function handle(GHStatusRejectedUpdate $event)
    {
        
        $this->sendMail('guest_house.rejected',
        $event->guestHouse->users[0]->username, 
        $event->guestHouse->users[0]->email, 
        'Announcing email for rejected',
        null, 
        null
        );
         
    }
}
