// in that functions we learnt created token ,customer,product,payment
// start

// chat functionality stripe payment
 
public function stripe_chat1(Request $request){

  $total= $request->total;
  $plan_type= $request->plan_type;

  $user_id = Auth::user()->id;
  $stripe = new \Stripe\StripeClient(
    'sk_test_51LhSx9GXG1yxeIq4AY9ZSroDEFBaj5AtYXLujfF73DZyDnJcI58gQmNGQwdqxDMcDMP6m07cqR2mPwzPoQShzCoJ00R357E1jJ'
  );

 
  $customer_check= Stripe_Customer:: where('user_id',$user_id)->get()->toArray();
 
  
  if(empty($customer_check[0]['customer_id'])){
 $data= compact('total','plan_type');
  return view('stripe/card_details_page_chat')->with('data',$data);
 
}
  else{
    $charge= $stripe->charges->create([
      'amount' => $total*100,
      'currency' => 'USD',
       'customer'=>$customer_check[0]['customer_id'],
      'description' => 'success',
    ]);

    if($charge->description=='success'){
        
    //    payment method as per alphabet
      $path= time();
  // user paid for chat functionality
  $paid_chat_functionality = new chat_paid_users;
  $paid_chat_functionality->user_id = Auth::user()->id;
  $paid_chat_functionality->payment_status = 1;
  $paid_chat_functionality->price = $total;
  $paid_chat_functionality->pdf_invoice = $path.'.pdf';


   if($plan_type=="month"){
    $paid_chat_functionality->expire_date =date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "+1 month" ) );
   }
   if($plan_type=='year'){
    $paid_chat_functionality->expire_date =date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "+1 year" ) );
   }
  
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

public function new_customer_payment_chat1(Request $request){
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
  $stripe = new \Stripe\StripeClient(
    'sk_test_51LhSx9GXG1yxeIq4AY9ZSroDEFBaj5AtYXLujfF73DZyDnJcI58gQmNGQwdqxDMcDMP6m07cqR2mPwzPoQShzCoJ00R357E1jJ'
  );

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
    'customer'=> $customer_data->id,
    'description' => 'success',
  ]);

  if($charge->description=='success'){
       //    payment method as per alphabet
       $path= time();
       //user paid for chat functionality
       $paid_chat_functionality = new chat_paid_users;
       $paid_chat_functionality->user_id = Auth::user()->id;
       $paid_chat_functionality->payment_status = 1;
       $paid_chat_functionality->price = 100;
       $paid_chat_functionality->pdf_invoice = $path.'.pdf';
       if($plan_type=="month"){
        $paid_chat_functionality->expire_date =date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "+1 month" ) );
       }
       if($plan_type=='year'){
        $paid_chat_functionality->expire_date =date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "+1 year" ) );
       }
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
     
   
          return redirect()->route('thankyou_page');
      }
        else{
          return redirect()->route('payment_error_page');
        }
     
}

public function create_plan1(){
  return view('stripe/stripe_create_product');
}


public function add_plan1(Request $request){
  $request->validate([
    'name' => 'required',
    'price' => 'required',
    'duration' => 'required',
  ]);

$usd_price=$request->price *100;
  $stripe = new \Stripe\StripeClient(
    'sk_test_51LhSx9GXG1yxeIq4AY9ZSroDEFBaj5AtYXLujfF73DZyDnJcI58gQmNGQwdqxDMcDMP6m07cqR2mPwzPoQShzCoJ00R357E1jJ'
  );
 $product= $stripe->products->create([
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
         'admin_id' => Auth::user()->id
  );
  Subscription_plans::create($data);
  return redirect('plan_list');


}


//end



