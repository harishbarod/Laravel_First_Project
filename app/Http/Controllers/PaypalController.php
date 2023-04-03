<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\Cart_order1;
use App\Models\chat_paid_users;
use App\Models\One_time_plan;
use App\Mail\Placed_order_mail;
use PDF;
use Mail;



class PaypalController extends Controller
{
   public function createpaypal()
   {
    return view('paypal_view');
   }


// paypal payment for chat functionality

public function processPaypal_chat(Request $request)
{             
      $type = $request->type;
      $user_id= Auth::user()->id;
      $total = $request->total;

        $user_name= Auth::user()->name;
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('processSuccess_chat', ['t'=>$total]),
                "cancel_url" => route('processCancel_chat'),
            ],  
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $total,
                    ]
                ]
            ]
        ]);
   

       if (isset($response['id']) && $response['id'] != null) {

            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
            return redirect()
                ->route('createpaypal')
                ->with('error', 'Something went wrong.');

        } else {
            return redirect()
                ->route('createpaypal')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
}
public function processSuccess_chat(Request $request)
{
        $total =$_GET['t'];
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $path= time();
           
        //    user paid for chat functionality
        $paid_chat_functionality = new chat_paid_users;
        $paid_chat_functionality->user_id = Auth::user()->id;
        $paid_chat_functionality->payment_status = 1;
        $paid_chat_functionality->price = $total;
        $paid_chat_functionality->pdf_invoice = $path.'.pdf';
        $paid_chat_functionality->expire_date =date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "+1 month" ) );
        $paid_chat_functionality->payment_method = 1;
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
}

 public function processCancel_chat(Request $request)
    {
        return redirect()
            ->route('purchase_service_chat')
            ->with('error', $response['message'] ?? 'You have cancelled the transaction.');
    }

    public function thankyou_page(){
        return view('thankyou_page');
    }
    public function payment_error_page(){
        return view('payment_error_page');
    }




    // paypal payment for cart functionality
    public function processPaypal_cart(Request $request)
    {             
      
           $total = $request->total;
            $user_name= Auth::user()->name;
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $paypalToken = $provider->getAccessToken();
            $response = $provider->createOrder([
                "intent" => "CAPTURE",
                "application_context" => [
                    "return_url" => route('processSuccess_cart'),
                    "cancel_url" => route('processCancel_cart'),
                ],      
                "purchase_units" => [
                    0 => [
                        "amount" => [
                            "currency_code" => "USD",
                            "value" => $total,
                        ]
                    ]
                ]
            ]);
           
            if (isset($response['id']) && $response['id'] != null) {
    
                // redirect to approve href
                foreach ($response['links'] as $links) {
                    if ($links['rel'] == 'approve') {
                        return redirect()->away($links['href']);
                    }
                }
                return redirect()
                    ->route('createpaypal')
                    ->with('error', 'Something went wrong.');
    
            } else {
                return redirect()
                    ->route('createpaypal')
                    ->with('error', $response['message'] ?? 'Something went wrong.');
            }
    }
    public function processSuccess_cart(Request $request)
    {       
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $provider->getAccessToken();
            $response = $provider->capturePaymentOrder($request['token']);
            if (isset($response['status']) && $response['status'] == 'COMPLETED') {
                
                        
                // //send bill to email
                $user_email = 'barodharish27@gmail.com';  
                $user_id= Auth::user()->id;

                $data = Cart::where('user_id',$user_id)->join('products', 'cart.product_id', '=', 'products.id')->get()->toArray();

                $pdf = PDF::loadView('pdf/cart_order_bill',array('data'=>$data));  
                
                \Mail::to($user_email)->send(new \App\Mail\Placed_order_mail($pdf));

                    
                // //send bill to email
                $user_email = Auth::user()->email;  
                $user_id= Auth::user()->id;

                $data = Cart::where('user_id',$user_id)->join('products', 'cart.product_id', '=', 'products.id')->get()->toArray();

                // $pdf = PDF::loadView('pdf/cart_order_bill',array('data'=>$data));  
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
                   'payment_method' =>1 )  ;
                    
                //    payment method as per alphabet

                  Cart_order1::create($arr);
                }
    
         return redirect()
                    ->route('thankyou_page')
                    ->with('success', 'Transaction complete.');
            } else {
                return redirect()
                    ->route('payment_error_page')
                    ->with('error', $response['message'] ?? 'Something went wrong.');
            }
    }
    
     public function processCancel_cart(Request $request)
        {
            return redirect()   
                ->route('purchase_service_chat')
                ->with('error', $response['message'] ?? 'You have cancelled the transaction.');
        }
    

     public function add_one_time_plan(Request $request){
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'duration' => 'required',
          ]);

          $data= array(
            'name'=>$request->name,
            'price'=>$request->price,
            'duration'=>$request->duration, 
            'admin_id' => Auth::user()->id
     );
     One_time_plan::create($data);
     return redirect('plan_list');

     }

     public function list_one_time_plan(){
        $data= One_time_plan::all();
        return view('stripe/one_time_plan_list')->with('plans',$data);
     }

     public function edit_one_time_plan($id){
        $data=One_time_plan::where('id',$id)->get();
        return view('stripe/edit_one_time_plan')->with('data',$data);
      }

      public function update_one_time_plan(Request $request){
  
        $plan_id= $request->plan_id;
      
     $data = array(
               'name' => $request->name,
               'price' => $request->price,
               'duration'=>$request->duration
     );
       DB::table('one_time_plans')->where('id', $plan_id)->update($data);
       return redirect('list_one_time_plan')->with('success','Plan updated successfully');

     }


     
public function delete_one_time_plan(Request $request){
    $plan_id= $request->plan_id;
  
    DB::table('one_time_plans')->where('id', $plan_id)->delete();
    return redirect('list_one_time_plan')->with('success','Plan deleted successfully');
  
  }
     
    

}

