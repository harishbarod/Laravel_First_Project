<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\chat_paid_users;



class Chat_access
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        $id= Auth::user()->id;  
        $user_service= chat_paid_users::where('user_id',$id)->where('payment_status',1)->get()->toArray();
        if(!empty($user_service)){
            if (empty($expire_date1)) {
                return $next($request);
            }
        $expire_date1= strtotime($user_service[0]['expire_date']);
      
        $today_date= strtotime(date('Y-m-d'));
      
          
       if($expire_date1>=$today_date){
       }
       else{
        return redirect('purchase_service_chat');
       }
    }
    else{
        return redirect('purchase_service_chat');
       }
       
        return $next($request);
    }
}
