<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Registered' => [
            'App\Listeners\SendEmailVerificationNotification',
        ],
        'App\Events\ForgetPassword' => [
            'App\Listeners\SendResetPasswordEmail',
        ],
        'App\Events\GHStatusApprovedUpdate' => [
            'App\Listeners\SendApprovedNotification'
        ],
        'App\Events\GHStatusRejectedUpdate' => [
            'App\Listeners\SendRejectedNotification'
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
