<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use App\Models\Stripe_Customer;
use App\Models\Cart;
use App\Models\Cart_order1;
use App\Models\Subscriptions_taken;
use App\Models\chat_paid_users;
use App\Models\Subscription_plans;
use App\Mail\Placed_order_mail;
use Illuminate\Support\Facades\DB;
use PDF;
use Mail;
use Stripe;

class StripeController extends Controller
 {

  // public function payment_page(){

  //   return view('stripe/card_details_page');
  // }

  public function stripe_cart(Request $request){
    $total= $request->total;
    $user_id = Auth::user()->id;
    $stripe = new \Stripe\StripeClient( env('STRIPE_SECRET'));
   
    $customer_check= Stripe_Customer:: where('user_id',$user_id)->get()->toArray();
      
    if(empty($customer_check[0]['customer_id'])){
    return view('stripe/card_details_page_cart')->with('total',$total);
  }
    else{
      $charge= $stripe->charges->create([
        'amount' => $total,
        'currency' => 'USD',
        'customer'=>$customer_check[0]['customer_id'],
        'description' => 'success',
      ]);

      if($charge->description=='success'){

  // //send bill to email
  $user_email =  Auth::user()->email;  
  $user_id= Auth::user()->id;

  $data = Cart::where('user_id',$user_id)->join('products', 'cart.product_id', '=', 'products.id')->get()->toArray();

  $pdf = PDF::loadView('pdf/cart_order_bill',array('data'=>$data));  
  
  \Mail::to($user_email)->send(new \App\Mail\Placed_order_mail($pdf));

      
  // //send bill to email
  $user_email = Auth::user()->email;  
  $user_id= Auth::user()->id;

  $data = Cart::where('user_id',$user_id)->join('products', 'cart.product_id', '=', 'products.id')->get()->toArray();
  $path= time();
  $pdf = PDF::loadView('pdf/cart_order_bill',array('data'=>$data));
  Storage::put('public/pdf/cart/'.$path.'.pdf', $pdf->output());


 //    saving order data to database
  $data =Cart::where('user_id',$user_id)->join('products', 'cart.product_id', '=', 'products.id')->get()->toArray();
      

  foreach ($data as  $order) {
    $arr= array(
    'user_id' =>   $order['user_id'],
    'product_id'=> $order['product_id'],
    'order_quantity'  => $order['cart_quantity'],
    'price'     => $order['price'],
    'pdf_invoice'=> $path.'.pdf',
    'payment_status'=>1,
     'payment_method' =>2 )  ;
     
    Cart_order1::create($arr);
    }
      
  //    payment method as per alphabet

        return redirect()->route('thankyou_page');
    }
      else{
        return redirect()->route('payment_error_page');
      }
   
    }
   
  }

  public function new_customer_payment_cart(Request $request){
    $total= $request->total;
    $validated = $request->validate([
      'card_no' => 'required|size:16',
      'ExpiryMonth' => 'required|size:2',
      'ExpiryYear' => 'required|size:2',
      'cvv' => 'required|size:3',
  ]);


    $user_id = Auth::user()->id;
    $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

    $card= $stripe->tokens->create([
      'card' => [
        'number' => $request->card_no,
        'exp_month' => $request->ExpiryMonth,
        'exp_year' => $request->ExpiryYear,
        'cvc' => $request->cvv,
      ],
    ]);
    

   $customer_data= $stripe->customers->create([
      'name' => Auth::user()->name,
      'email' => Auth::user()->email,
      'source' => $card->id,
    ]);
   
     
    $data= array(
      'user_id'    =>$user_id,
      'customer_id'=> $customer_data->id,
      'customer_data'=> $customer_data
    );
    Stripe_Customer::create($data);
     
    $charge= $stripe->charges->create([
      'amount' => $total *100,
      'currency' => 'USD',
      'customer'=> $customer_data->id,
      'description' => 'success',
    ]);


    if($charge->description=='success'){

      // //send bill to email
      $user_email = Auth::user()->email;  
      $user_id= Auth::user()->id;
    
      $data = Cart::where('user_id',$user_id)->join('products', 'cart.product_id', '=', 'products.id')->get()->toArray();
    
      $pdf = PDF::loadView('pdf/cart_order_bill',array('data'=>$data));  
      
      \Mail::to($user_email)->send(new \App\Mail\Placed_order_mail($pdf));
    
          
      // //send bill to email
      $user_email = Auth::user()->email;  
      $user_id= Auth::user()->id;
    
      $data = Cart::where('user_id',$user_id)->join('products', 'cart.product_id', '=', 'products.id')->get()->toArray();
          $path= time();
      $pdf = PDF::loadView('pdf/cart_order_bill',array('data'=>$data));
      Storage::put('public/pdf/cart/'.$path.'.pdf', $pdf->output());
    
     //    saving order data to database
      $data =Cart::where('user_id',$user_id)->join('products', 'cart.product_id', '=', 'products.id')->get()->toArray();
    
      foreach ($data as  $order) {
        $arr= array(
        'user_id' =>   $order['user_id'],
        'product_id'=> $order['product_id'],
        'order_quantity'  => $order['cart_quantity'],
        'price'     => $order['price'],
        'pdf_invoice'=> $path.'.pdf',
        'payment_status'=>1,
         'payment_method' =>2 )  ;
        }
          
      //    payment method as per alphabet
    
        Cart_order1::create($arr);
            return redirect()->route('thankyou_page');
        }
          else{
            return redirect()->route('payment_error_page');
          }
       
  }

 // chat functionality stripe payment
 
 public function stripe_chat(Request $request){

  $is_subscription= $request->subscription; 
  $total= $request->total;
  $plan_type= $request->plan_type;
  $price_id= $request->price_id;
  $user_id = Auth::user()->id;
  $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

  $customer_check= Stripe_Customer:: where('user_id',$user_id)->get()->toArray();
 
  
  if(empty($customer_check[0]['customer_id'])){

    if($is_subscription=="subscription"){
      $data= compact('total','plan_type','price_id');
      return view('stripe/card_details_page_chat')->with('data',$data);
    }
    else{
      $data= compact('total','plan_type');
      return view('stripe/card_details_page_chat_without_subscription')->with('data',$data);
    }

 
}
  else{
   $subscription= $stripe->subscriptions->create([
      'customer' => $customer_check[0]['customer_id'],
      'items' => [
        ['price' => $price_id],
      ],
      ['metadata' => ['status' => 'success']]
    ]);
  
   
    if($subscription->metadata->status=='success'){      
    //    payment method as per alphabet
      $path= time();
   //user paid for chat functionality
   $paid_chat_functionality = new chat_paid_users;
   $paid_chat_functionality->user_id = Auth::user()->id;
   $paid_chat_functionality->payment_status = 1;
   $paid_chat_functionality->price = $total;
   $paid_chat_functionality->pdf_invoice = $path.'.pdf';
   $paid_chat_functionality->subscription_id = $subscription->id;
   $paid_chat_functionality->subscription_status ='unsubscribe';
   $paid_chat_functionality->payment_method = 2;
   $paid_chat_functionality->save();
 
 //send mail to user of bill invoice
 $user_email = Auth::user()->email;  
 $user_id= Auth::user()->id;
 
 $data = chat_paid_users::where('user_id', $user_id)
 ->get()->sortByDesc('created_at')->first()->toArray();
 $pdf = PDF::loadView('pdf/chat_order_bill',array('data'=>$data)); 
 Storage::put('public/pdf/chat/'.$path.'.pdf', $pdf->output());
 \Mail::to($user_email)->send(new \App\Mail\Placed_order_mail($pdf));

  // user paid for chat functionality
  if($is_subscription=='subscription'){
    $Subscriptions_taken = new  Subscriptions_taken;
    $Subscriptions_taken->subscription_id = $subscription->id;
    $Subscriptions_taken->subscription_item_id = $subscription->items->data[0]->id;
    $Subscriptions_taken->customer_id = $subscription->customer;
    $Subscriptions_taken->price_id = $subscription->items->data[0]->price->id;
    $Subscriptions_taken->product_id = $subscription->items->data[0]->price->product;
    $Subscriptions_taken->data = $subscription;
    $Subscriptions_taken->user_id = Auth::user()->id;
    $Subscriptions_taken->save();
  }

 return redirect()
          ->route('thankyou_page')
          ->with('success', 'Transaction complete.');
  } else {
      return redirect()
          ->route('payment_error_page')
          ->with('error', $response['message'] ?? 'Something went wrong.');
  }

      Cart_order1::create($arr);
      return redirect()->route('thankyou_page');
    
      } 
  
}

public function new_customer_payment_chat(Request $request){

  $price_id= $request->price_id;
  $total= $request->total;
  $plan_type= $request->plan_type;
  $user_id = Auth::user()->id;
  $validated = $request->validate([
    'card_no' => 'required|size:16',
    'ExpiryMonth' => 'required|size:2',
    'ExpiryYear' => 'required|size:2',
    'cvv' => 'required|size:3',
]);



  $user_id = Auth::user()->id;
  $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET') );

  $card= $stripe->tokens->create([
    'card' => [
      'number' => $request->card_no,
      'exp_month' => $request->ExpiryMonth,
      'exp_year' => $request->ExpiryYear,
      'cvc' => $request->cvv,
    ],
  ]);
 
 $customer_data= $stripe->customers->create([
    'name' => Auth::user()->name,
    'email' => Auth::user()->email,
    'source' => $card->id,
    // "address"=> [
    //   "city"=> 'indore',
    //   "country" => 'india',
    //   "line1"=> 'bhawarkua',
    //   "line2"=> 'indore',
    //   "postal_code"=> 458110,
    //   "state"=> 'Madhya Pradesh'
    // ]
  ]);
 
 
  $data= array(
    'user_id'    =>$user_id,
    'customer_id'=> $customer_data->id,
    'customer_data'=> $customer_data
  );
  
  Stripe_Customer::create($data);
 
  $subscription= $stripe->subscriptions->create([
    'customer' => $customer_data->id,
    'items' => [
      ['price' => $price_id],
    ],
    ['metadata' => ['status' => 'success']]
  ]);


  if($subscription->metadata->status=='success'){
 //    payment method as per alphabet
 $path= time();
 //    user paid for chat functionality
 $paid_chat_functionality = new chat_paid_users;
 $paid_chat_functionality->user_id = Auth::user()->id;
 $paid_chat_functionality->payment_status = 1;
 $paid_chat_functionality->price = $total;
 $paid_chat_functionality->pdf_invoice = $path.'.pdf';
 $paid_chat_functionality->payment_method = 2;
 $paid_chat_functionality->subscription_id = $subscription->id;
 $paid_chat_functionality->subscription_status = 'unsubscribe';
 $paid_chat_functionality->save();


  //    payment method as per alphabet
    $path= time();
// user paid for chat functionality
$Subscriptions_taken = new  Subscriptions_taken;
$Subscriptions_taken->subscription_id = $subscription->id;
$Subscriptions_taken->subscription_item_id = $subscription->items->data[0]->id;
$Subscriptions_taken->customer_id = $subscription->customer;
$Subscriptions_taken->price_id = $subscription->items->data[0]->price->id;
$Subscriptions_taken->product_id = $subscription->items->data[0]->price->product;
$Subscriptions_taken->data = $subscription;
$Subscriptions_taken->user_id = Auth::user()->id;
$Subscriptions_taken->save();


     //send mail to user of bill invoice
     $user_email = Auth::user()->email;  
     $user_id= Auth::user()->id;
     
     $data = chat_paid_users::where('user_id', $user_id)
     ->get()->sortByDesc('created_at')->first()->toArray();
     $pdf = PDF::loadView('pdf/chat_order_bill',array('data'=>$data)); 
     Storage::put('public/pdf/chat/'.$path.'.pdf', $pdf->output());
     \Mail::to($user_email)->send(new \App\Mail\Placed_order_mail($pdf));
     
          return redirect()->route('thankyou_page');
      }
        else{
          return redirect()->route('payment_error_page');
        }
     
}

public function create_plan(){
  return view('stripe/stripe_create_product');
}


public function add_plan(Request $request){
  $request->validate([
    'name' => 'required',
    'price' => 'required',
    'duration' => 'required',
  ]);

$usd_price=$request->price *100;
$stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
 $plan= $product= $stripe->products->create([
    'name' => $request->name,
    'default_price_data' => [
      'unit_amount' => $usd_price ,
      'currency' => 'usd',
      'recurring' => ['interval' => $request->duration],
    ],
    'metadata' => [
      'admin_id' => Auth::user()->id
    ],
    'expand' => ['default_price'],
  ]
  );

  $data= array(
         'name'=>$request->name,
         'price'=>$request->price,
         'plan_type'=>$request->duration,
         'plan_id'=>$product->id,
         'price_id'=>$plan['default_price']->id,
         'admin_id' => Auth::user()->id
  );
  Subscription_plans::create($data);
  return redirect('plan_list');


}
public function plan_list(){
  $data= Subscription_plans::all();
  return view('stripe/plan_list')->with('plans',$data);
}

public function delete_plan(Request $request){
  $plan_id= $request->plan_id;

  $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

  $price_id= $stripe->products->update(
    $plan_id,
    ['active' => false],
  );
 
  DB::table('subscription_plans')->where('plan_id', $plan_id)->delete();
  return redirect('plan_list')->with('success','Product deleted successfully');

}

public function edit_plan($id){

  $data=Subscription_plans::where('id',$id)->get();
  return view('stripe/edit_plan')->with('data',$data);
}

public function update_plan(Request $request){
  
   $plan_id= $request->plan_id;
   $usd_price= $request->price *100;
   $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

 $price_id= $stripe->products->update(
    $plan_id,
    [
      'name' => $request->name,
  ],
  );
 
  $stripe->prices->update(
    $price_id->default_price,
     ['unit_amount' => $usd_price],
    
  );
$data = array(
          'name' => $request->name,
          'price' => $request->price,
          'plan_type'=>$request->duration
);
  DB::table('subscription_plans')->where('plan_id', $plan_id)->update($data);

}

public function new_customer_payment_chat_one_time_payment(Request $request){
   
  $total= $request->total;
  $plan_type= $request->plan_type;

  $user_id = Auth::user()->id;
  $validated = $request->validate([
    'card_no' => 'required|size:16',
    'ExpiryMonth' => 'required|size:2',
    'ExpiryYear' => 'required|size:2',
    'cvv' => 'required|size:3',
]);



  $user_id = Auth::user()->id;
  $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

  $card= $stripe->tokens->create([
    'card' => [
      'number' => $request->card_no,
      'exp_month' => $request->ExpiryMonth,
      'exp_year' => $request->ExpiryYear,
      'cvc' => $request->cvv,
   
    ],
  
    
  ]);
 
 $customer_data= $stripe->customers->create([
    'name' => Auth::user()->name,
    'email' => Auth::user()->email,
    'source' => $card->id,
    
    
     
  ]);
 
 
  $data= array(
    'user_id'    =>$user_id,
    'customer_id'=> $customer_data->id,
    'customer_data'=> $customer_data
  );
  
  Stripe_Customer::create($data);
  
  $charge= $stripe->charges->create([
    'amount' => $total*100,
    'currency' => 'USD',
     'customer'=>$customer_data->id,
    'description' => 'success',
  ]);

  if($charge->description=='success'){

 //    payment method as per alphabet
 $path= time();
 //    user paid for chat functionality
 $paid_chat_functionality = new chat_paid_users;
 $paid_chat_functionality->user_id = Auth::user()->id;
 $paid_chat_functionality->payment_status = 1;
 $paid_chat_functionality->price = $total;
 $paid_chat_functionality->subscription_status = null;
 $paid_chat_functionality->pdf_invoice = $path.'.pdf';
 if($plan_type=="month"){
  $paid_chat_functionality->expire_date =date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "+1 month" ) );
 }
 if($plan_type=='year'){
  $paid_chat_functionality->expire_date =date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "+1 year" ) );
 }
 $paid_chat_functionality->payment_method = 2;
 
 $paid_chat_functionality->save();



      
  //    payment method as per alphabet
    $path= time();
     //send mail to user of bill invoice
     $user_email = Auth::user()->email;  
     $user_id= Auth::user()->id;
     
     $data = chat_paid_users::where('user_id', $user_id)
     ->get()->sortByDesc('created_at')->first()->toArray();
     $pdf = PDF::loadView('pdf/chat_order_bill',array('data'=>$data)); 
     Storage::put('public/pdf/chat/'.$path.'.pdf', $pdf->output());
     \Mail::to($user_email)->send(new \App\Mail\Placed_order_mail($pdf));
     
          return redirect()->route('thankyou_page');
      }
        else{
          return redirect()->route('payment_error_page');
        }

}

public function unsubscribed_subscription(Request $request){
    
  \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

   $data= \Stripe\Subscription::update(
    $request->subscription_id,
    [
      'cancel_at_period_end' => true,
    ] 
 
  );
 
  $date= $data->current_period_end;
  $expire_date=date("Y-m-d", $date);

  $data= array(        
    'expire_date'=> $expire_date,
    'subscription_status'=> 're-activate'
    
);

DB::table('chat_paid_users')->where('subscription_id', $request->subscription_id)->update($data);

return redirect()->route('chat_subscription')->with('success','Subscription unsubscribed successfully');
}
public function reactivate_subscription(Request $request){
    
  \Stripe\Stripe::setApiKey(env('STRIPE_SECRET')); 


   $data= \Stripe\Subscription::update(
    $request->subscription_id,
    [
      'cancel_at_period_end' => false,
    ] 
 
  );


  $data= array(        
    'expire_date'=> null,
    'subscription_status'=> 'unsubscribe'
    
);

DB::table('chat_paid_users')->where('subscription_id', $request->subscription_id)->update($data);

return redirect()->route('chat_subscription')->with('success','Subscription reactivated successfully');
}

 }