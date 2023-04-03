<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Stripe;
use Session;

class StripePaymentController extends Controller
{
    public function index(){

      \Stripe\Stripe::setApiKey('sk_test_51LgPnhSEJiIapZwoMISo4WFNlDEj83hd4z53rkXcIfrusajJRsg9EmpVxwv0Xekfihm6um53scoxSfFXRhJ7o06l00e9u8FtZk');

      $YOUR_DOMAIN = 'http://127.0.0.1:8000/';

      $checkout_session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
          'line_items' => [[
            'price_data' => [
              'currency' => 'usd',
              'product_data' => [
                'name' => 'Blue-Shoes',
              ],
              'unit_amount' => 3000,
            ],
            'quantity' => 1,
          ]],
        'mode' => 'payment',
        'success_url' => $YOUR_DOMAIN . 'success',
        'cancel_url' => $YOUR_DOMAIN . 'cancel',
      ]);
       return Redirect($checkout_session->url);
    }

    public function success(){
        return view("success");
    }
    public function cancel(){
        return view("cancel");
    }
}