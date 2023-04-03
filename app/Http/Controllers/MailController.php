<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\DemoMail;
  
class MailController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        $mailData = [
            'title' => 'Mail from ItSolutionStuff.com',
            'body' => 'This is for testing email using smtp.'
        ];
         
       // Mail::to('barodharish27@gmail.com')->send(new DemoMail($mailData));
        Mail::send('emails.testmail', $mailData, function($message) {
            $message->to('bhatiharsh321@gmail.com', 'Tutorials Point')->subject('Laravel HTML Testing Mail');
            $message->from('harsh1234@yopmail.com','Virat Gandhi');
         }); 
        echo "Email is sent successfully.";
    }
}