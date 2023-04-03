<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Events\Result_Mail;
use Illuminate\Events\chat_subscription_payment;
use Illuminate\Listeners\User_Result_Mail;
use Illuminate\Listeners\chat_payment_email;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'App\Events\Result_Mail' => [
            'App\Listeners\User_Result_Mail',   
        ],
        'App\Events\chat_subscription_payment' => [
            'App\Listeners\chat_payment_email',
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
     
    }
}
