<?php

namespace App\Listeners;

use App\Events\GHStatusApprovedUpdate;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Helper\mailHelper;

class SendApprovedNotification implements ShouldQueue
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
     * @param  GHStatusApprovedUpdate  $event
     * @return void
     */
    public function handle(GHStatusApprovedUpdate $event)
    {
        $this->sendMail('guest_house.approved',
                    $event->guestHouse->users[0]->username, 
                    $event->guestHouse->users[0]->email, 
                    'Announcing email for approval',
                    null, 
                    null
                );
    }
}
