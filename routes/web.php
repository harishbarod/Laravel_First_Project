<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User_controller;
use App\Http\Controllers\Product_Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Question_controller;
use App\Http\Controllers\Chat_controller;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\StripeController;
use Illuminate\Support\Facades\Mail;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 
Route::get('/', [Product_Controller::class, 'welcome_page']);

Route::get('/add_login', function () {
    return view('add_login');
});

Route::get('/edit_login', function () {
    return view('edit_login');
});
Route::get('/profile/add-multiple-mobile_no/{id}',[HomeController::class,'add_multiple_mobileno'])->name('profile/add-multiple-mobile_no');

Route::post('/update_mobile_no',[HomeController::class,'update_mobile_no'])->name('update_mobile_no');



Route::get('/home', [Question_controller::class, 'test_welcome_page']);
Route::get('/test-welcome', [Question_controller::class, 'test_welcome_page']);
Auth::routes();
Route::middleware('web')->group(function ()
 {            
        // route for paypal chat functionality
        Route::get('/createpaypal',[PaypalController::class,'createpaypal'])->name('createpaypal');
        Route::post('/processpaypal_chat',[PaypalController::class,'processpaypal_chat'])->name('processpaypal_chat');
        Route::get('/processSuccess_chat/{total}',[PaypalController::class,'processSuccess_chat'])->name('processSuccess_chat');
        Route::get('/processCancel_chat',[PaypalController::class,'processCancel_chat'])->name('processCancel_chat');
        Route::get('/thankyou_page',[PaypalController::class,'thankyou_page'])->name('thankyou_page');
        Route::get('/payment_error_page',[PaypalController::class,'payment_error_page'])->name('payment_error_page');

          // route for paypal cart functionality
          Route::post('/processpaypal_cart',[PaypalController::class,'processpaypal_cart'])->name('processpaypal_cart');
          Route::get('/processSuccess_cart',[PaypalController::class,'processSuccess_cart'])->name('processSuccess_cart');
          Route::get('/processCancel_cart',[PaypalController::class,'processCancel_cart'])->name('processCancel_cart');
       
          // payment status route
          Route::get('/thankyou_page',[PaypalController::class,'thankyou_page'])->name('thankyou_page');
          Route::get('/payment_error_page',[PaypalController::class,'payment_error_page'])->name('payment_error_page');

          // order and chat payment history
          Route::get('/order_history',[Product_Controller::class,'order_history_page'])->name('order_history_page');
          Route::get('/chat_subscription',[Chat_controller::class,'chat_subscription_page'])->name('chat_subscription');

          Route::get('/order_history_admin',[Product_Controller::class,'order_history_page_admin'])->name('order_history_page_admin');
          Route::get('/chat_subscription_admin',[Chat_controller::class,'chat_subscription_page_admin'])->name('chat_subscription_page_admin');




      //  routes for question controller
     
        Route::get('/edit-profile', [HomeController::class, 'edit_profile'])->name('edit_profile');
        Route::get('/gallery', [HomeController::class, 'gallery_page']);
        Route::post('/add_image', [HomeController::class, 'add_image']);
        Route::post('/delete_image', [HomeController::class, 'delete_image']);

        Route::get('/forget-password', [HomeController::class, 'forget_password']);
        Route::post('/update_user', [HomeController::class, 'store']);        
        Route::post('/update_question', [Question_controller::class, 'update']);
        Route::resource('question', Question_controller::class);
        Route::post('/update_question', [Question_controller::class, 'update']);
        Route::get('/image_fetch', [HomeController::class, 'image_get']);
        Route::resource('products', Product_Controller::class);
        Route::get('/Trash', [Product_Controller::class, 'trash'])->name('Trash');
        Route::get('/restore/{id}', [Product_Controller::class, 'restore'])->name('restore');
        Route::post('/permanent_delete', [Product_Controller::class, 'permanent_delete'])->name('permanent_delete');
        Route::get('/see-all-products', [Product_Controller::class, 'see_all_products'])->name('see-all-products');
        Route::post('/add_to_cart', [Product_Controller::class, 'add_to_cart'])->name('add_to_cart');
        Route::get('/Cart-page', [Product_Controller::class, 'cart_page'])->name('Cart-page');
        
        Route::post('/delete_cart_product', [Product_Controller::class, 'delete_cart_product'])->name('delete_cart_product');
        Route::post('/get_cart_data', [Product_Controller::class, 'get_cart_data'])->name('get_cart_data');
        Route::post('/update_quantity', [Product_Controller::class, 'update_quantity'])->name('update_quantity');
        
        Route::get('/chat_page', [Chat_controller::class, 'chat_page'])->name('chat_page')->middleware('chat_access');
        Route::post('/chat_message_send', [Chat_controller::class, 'chat_message_send']);
        Route::post('/chat_data', [Chat_controller::class, 'chat_data']);
        Route::post('/chat_data_sender', [Chat_controller::class, 'chat_data_sender']);
        Route::post('/chat_last_data', [Chat_controller::class, 'chat_last_data']);
        Route::post('/searched_user', [Chat_controller::class,'searched_user']);
        Route::get('/user_last_seen', [Chat_controller::class, 'last_seen1'])->name('user_last_seen')    ;

     });
        // test routes

     Route::get('/question-page', [Question_controller::class, 'question_page']);
     Route::post('/answer_submit', [Question_controller::class, 'answer_submit']);
     Route::get('/result', [Question_controller::class, 'result'])->name('result');

    // paid chat subscription
    Route::get('/paid_user_chat',[Chat_controller::class,'paid_user_chat'])->name('paid_user_chat');
    Route::get('/expire_service_chat',[Chat_controller::class,'expire_service_chat'])->name('expire_service_chat');
    Route::get('/purchase_service_chat',[Chat_controller::class,'purchase_service_chat'])->name('purchase_service_chat');

   //pdf of invoices
   Route::get('/generate_order_bill',[Product_Controller::class,'generate_order_bill'])->name('generate_order_bill');       

//    stripe routes
Route::get('/stripe', [StripeController::class, 'payment_page']);
Route::post('/stripe_chat', [StripeController::class, 'stripe_chat'])->name('stripe_chat');
Route::post('/stripe_cart', [StripeController::class, 'stripe_cart'])->name('stripe_cart');
Route::post('/new_customer_payment_chat', [StripeController::class, 'new_customer_payment_chat'])->name('new_customer_payment_chat');

Route::post('/new_customer_payment_chat_one_time_payment', [StripeController::class, 'new_customer_payment_chat_one_time_payment'])->name('new_customer_payment_chat_one_time_payment');

Route::post('/new_customer_payment_cart', [StripeController::class, 'new_customer_payment_cart'])->name('new_customer_payment_cart');
// Route::get('save_card', [StripePaymentController::class, 'save_card'])->name('save_card');
Route::get('/stripe_checkout', [StripePaymentController::class, 'index'])->name('stripe_checkout');

Route::get('/create_plan', [StripeController::class, 'create_plan'])->name('create_plan');


Route::post('/add_plan', [StripeController::class, 'add_plan'])->name('add_plan');
Route::get('/edit_plan/{id}', [StripeController::class, 'edit_plan'])->name('edit_plan');
Route::post('/delete_plan', [StripeController::class, 'delete_plan'])->name('delete_plan');
Route::post('/update_plan', [StripeController::class, 'update_plan'])->name('update_plan');

Route::get('/plan_list', [StripeController::class, 'plan_list'])->name('plan_list');

Route::post('unsubscribed_subscription', [StripeController::class, 'unsubscribed_subscription'])->name('unsubscribed_subscription');

Route::post('reactivate_subscription', [StripeController::class, 'reactivate_subscription'])->name('reactivate_subscription');

Route::post('/add_one_time_plan', [PaypalController::class, 'add_one_time_plan'])->name('add_one_time_plan');
Route::get('/list_one_time_plan', [PaypalController::class, 'list_one_time_plan'])->name('list_one_time_plan');

Route::get('/edit_one_time_plan/{id}', [PaypalController::class, 'edit_one_time_plan'])->name('edit_one_time_plan');
Route::post('/update_one_time_plan', [PaypalController::class, 'update_one_time_plan'])->name('update_one_time_plan');
Route::post('/delete_one_time_plan', [PaypalController::class, 'delete_one_time_plan'])->name('delete_one_time_plan');



// checkout 
Route::post('/payment_option', [CheckoutController::class, 'payment_option'])->name('payment_option');

Route::get('/timer', [HomeController::class, 'timer'])->name('timer');
Route::get('/timer2', [HomeController::class, 'timer2'])->name('timer2');
Route::post('/add_timer', [HomeController::class, 'add_timer'])->name('add_timer');

//timezone
Route::get('/timezone', [HomeController::class, 'time_zone'])->name('time_zone');
Route::post('/convert', [HomeController::class, 'convertedTime'])->name('convertedTime');

// Test single question 

Route::get('/Test', [Question_controller::class, 'test_page'])->name('Test');
Route::post('/Answer_submit', [Question_controller::class, 'submit_answers'])->name('Answer_submit');
Route::get('/Test_result', [Question_controller::class, 'test_result'])->name('Test_result');
Route::get('/quiz_result', [Question_controller::class, 'quiz_result'])->name('quiz_result');
Route::get('/quiz_result_new', [Question_controller::class, 'quiz_result_new'])->name('quiz_result_new');

    // Test through javascript
Route::get('/New-Test', [Question_controller::class, 'test_page2'])->name('New-Test');
Route::post('/test_questions', [Question_controller::class, 'test_questions'])->name('test_questions');
Route::post('/Submitting_answers', [Question_controller::class, 'Submitting_answers'])->name('Submitting_answers');

Route::post('/submit_form', [Question_controller::class, 'submit_form'])->name('submit_form');




   

