<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
 
   public function payment_option(Request $request ){
  
      // $subscription_plan_for  means a month or for year
      $total= $request->total;  
      $payment_for_chat=   $request->chat;
      $plan_type = $request->plan_type;
     $data= compact('payment_for_chat','total','plan_type');
    return view('payment_option')->with('data',$data );
   }
}