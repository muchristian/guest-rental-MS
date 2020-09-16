<?php

namespace App\Listeners;

use App\Events\ForgetPassword;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Helper\mailHelper;

class SendResetPasswordEmail implements ShouldQueue
{

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
     * @param  ForgetPassword  $event
     * @return void
     */
    public function handle(ForgetPassword $event)
    {
    $this->sendMail('password.forgot_password',
      $event->user->username, 
      $event->user->email,
      'Reset password', 
      'reset_code', 
      $event->reset_code);
    }
}
