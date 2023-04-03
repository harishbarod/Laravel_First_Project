<?php
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

//  custom functions 
if(!function_exists('prnt')){
    function prnt($data){
        echo '<pre>';
        print_r($data);
        die;
    }


    if(!function_exists('last_seen')){
        function last_seen($user_id){
       
            
            $chat_data = \DB::select("SELECT * FROM chat_messages where user_id=$user_id ORDER BY id DESC LIMIT 1");
           
           if(!$chat_data==null){
            $yesterday=date('Y-m-d',strtotime("yesterday")); 
            $today=date('Y-m-d',strtotime("today")); 
             $time= $chat_data[0]->created_at;
            $last_date =substr($time,0,10);
            
            $last_seen = date('M-y',strtotime($last_date) );
            if($yesterday == $last_date){
              $last_seen ='Yesterday';
            }
            if($today == $last_date){
                $last_time= substr($time ,11,2);
                $AmPm = $last_time>= 12? 'PM':'AM';

                $hour= substr($time,11,2);
                $minute= substr($time,13,3);
               

                $convert_time = $hour>12? $hour -12 : $hour;

                $last_seen =$convert_time.':'.$minute .$AmPm;


            }        
            
           }
           else{
            $last_seen= '1-jan';
           }

            return $last_seen;


        }

    }
}

if(!function_exists('TimezoneConverter')){
    function TimezoneConverter($current_dateTime,$current_timezone ,$convertedTimeZone){
 
  
        $time = new DateTimeImmutable($current_dateTime, new DateTimeZone($current_timezone));
   
        // Create a new instance with the new timezone
        $converted_time1 = $time->setTimezone(new DateTimeZone($convertedTimeZone));
          return $converted_time1;

      
    }
}


