<?php
namespace App\Listeners;
use App\Events\Result_Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use  Illuminate\Support\Facades\Auth;

use Mail;


class User_Result_Mail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\Result_Mail  $event
     * @return void
     */
    public function handle(Result_Mail $event)
    {       
       $user_email = Auth::user()->email;
       $score = $event->result_point;
       $data = compact('user_email','score');

        // \Mail::to($user_email)->send(new DemoMail($score));
        \Mail::to($user_email)->send(new \App\Mail\MyTestMail($data));

    }
}
