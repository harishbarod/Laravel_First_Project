<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Chat_message;
use  Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\chat_paid_users;
use App\Models\Subscription_plans;
use App\Models\One_time_plan;

class Chat_controller extends Controller
{
    public function chat_page(){
         
        $loggedin_id= Auth::user()->id;
         $users = User::where('id','!=', $loggedin_id)->where('role_id',2)->get()->toArray() ;

        return view('chat.chat_page')->with('users',$users);
    }
    public function chat_message_send(Request $request){
     
        $data= array(
            'user_id'=> $request->user_id,
           'sender_id'=> $request->sender_id,
           'message'=> $request->message,

       );
       Chat_message::create($request->all());

        return json_encode(array(
            "statusCode"=>200
        ));
    }

//  fetching  user chat


public function chat_data(Request $request){

$id=$request->input('user_id');
$sender_id= $request->input('sender_id');

$chat_data = \DB::select("SELECT * from `chat_messages` where `user_id` = $id and `sender_id` = $sender_id or (`user_id` = $sender_id and `sender_id` = $id)ORDER BY created_at ASC");

        return json_encode(array('data'=>$chat_data));
    }
    public function chat_last_data(Request $request){
        $id=$request->input('user_id');
        $sender_id= $request->input('sender_id');

        $chat_data = \DB::select("SELECT * FROM chat_messages ORDER BY id DESC LIMIT 1");
        return json_encode(array('data'=>$chat_data));
    }

  //   public function paid_user_chat (Request $request){

  // }
  public function expire_service_chat(){
    return view('chat.chat_subscription');
  }

  public function purchase_service_chat(){
    $subscription_plans= Subscription_plans::all();
    $one_time_plans= One_time_plan::all();
     $plans= compact('subscription_plans','one_time_plans');
    return view('chat.purchase_service_chat')->with('plans',$plans);
  }

  public function chat_subscription_page(Request $request){

    $user_id   = Auth::user()->id;
    $user = User::firstWhere('id', $user_id);
    $search= $request->get('search');

  if($user->role_id==2){
    $data =chat_paid_users::where('user_id',$user_id)->get()->toArray();
    return view('chat_subscription_page')->with('subscriptions',$data);
   
}    
else{
    $data =User::join('chat_paid_users', 'users.id', '=', 'chat_paid_users.user_id')
    ->paginate(5);
    return view('chat_subscription_page_admin')->with('subscriptions',$data);
  
}

   
}
    
}
