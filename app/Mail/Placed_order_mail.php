<?php
  
namespace App\Mail;
  
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


  
class Placed_order_mail extends Mailable
{
    use Queueable, SerializesModels;
  
    public $pdf;
  
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pdf)
    {
        $this->pdf = $pdf;
    }
  
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       
    return $this->subject('Order Details')
               ->view('emails.chat_order_mail')
               ->attachData($this->pdf->output(), 'order_bill.pdf');

     
    }
}
