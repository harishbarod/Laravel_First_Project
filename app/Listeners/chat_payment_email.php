<?php

namespace App\Listeners;

use App\Events\chat_subscription_payment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class chat_payment_email
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
     * @param  \App\Events\chat_subscription_payment  $event
     * @return void
     */
    public function handle(chat_subscription_payment $event)
    {
        $user_email = Auth::user()->email;
        $score = $event->result_point;
        $data = compact('user_email','score');
 
         \Mail::to($user_email)->send(new \App\Mail\MyTestMail($data));
    }
}
