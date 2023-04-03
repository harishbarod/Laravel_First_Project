<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Gallery;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use PHPMailer\PHPMailer;
use DB;
use DateTime;
use DateTimeZone;
use DateTimeImmutable;


use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit_profile()
    {   
        $id = Auth::id();
        $user = User::firstWhere('id', $id);
        return view('edit_login')->with('user',$user);
    }
     
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required',
            'age' => 'required',
            'address' => 'required',
            // 'image' =>  'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            
        ]);


    
        $id= $request->id;
         if($request->file('image')){

        $imageName = time().'.'.$request->image->extension();  
      
        $request->image->move(public_path('images'), $imageName);   
        $data= array(
             'name'=> $request->name,
            'email'=> $request->email,
            'mobile'=> $request->mobile,
            'age'=> $request->age,
            'address'=> $request->address,
            'image' => $imageName
        );
    }
    else{
        $data= array(
            'name'=> $request->name,
           'email'=> $request->email,
           'mobile'=> $request->mobile,
           'address'=> $request->address    ,
           'age'=> $request->age    
        );    
    }
        
        User::where('id', $id)-> update($data);

        return redirect('/edit-profile')->with('success','Profile updated successfully');
 
    }
     public function image_get(){

        $id = Auth::id();
        $img = DB::table('users')->where('id' ,$id)->value('image');
    
        return view('layouts/app')->with('img',$img);
     }
    public function forget_password()
    {
        return view('auth/passwords/forget_password');
    }

   
       public function gallery_page(){
        $id= Auth::user()->id;
       $images= Gallery::where('user_id',$id)->get();
 
        return view('gallery_page')->with('images',$images);
       }


       public function add_image(Request $request){


        $request->validate([
            'images' => 'required',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
      
        
        $images = [];
        if ($request->images){
            foreach($request->images as $key => $image)
            {
                $imageName = time().rand(1,99).'.'.$image->extension();  
                $image->move(public_path('images/gallery'), $imageName);
  
                $images[$key] = $imageName;
            }
        }
       
        foreach ($images as $key => $image) {
           
            $data['user_id']=Auth::user()->id;
            $data['image']= $image;
           
            Gallery::create($data);
        }
      
         return back()->with('success','You have successfully added images.');
                
    }

    public function delete_image(Request $request){
      $id= Auth::user()->id;
      $image_name= $request->image_name;
     $imagePath = public_path('images/gallery/'.$image_name);
        if(file_exists($imagePath)){
           unlink( $imagePath);
        }

         $whereArray = array('user_id' => $id,'image' => $image_name);
         $query = DB::table('gallery');
         foreach($whereArray as $field => $value) {
         $query->where($field, $value);
        }
       $query->delete();
      return redirect('gallery');


    }

    public function add_multiple_mobileno($id)
    {
       $user= User::where('id',$id)->get();
        return view('add_multiple_mobile',compact('user'));
    }

    public function update_mobile_no(Request $request)
    {
        $id= $request->id;
        $mobiles=$request->mobile;
     
        if(!empty($mobiles)){
            $data= implode(',',$mobiles);
            $data= array(
                'mobile'=> $data,   
           );
        }
        else{
            $data =null;
        }
        
        User::where('id', $id)-> update($data);
        $user = User::firstWhere('id', $id);
        return view('edit_login')->with('user',$user);
    }
    // public function timer2(){
    //     return view('timer4');
    // }

    public function timer()
    {
        $user_id=Auth::user()->id;
     $data=   DB::table('timer')->where('user_id',$user_id)->get();
     
        if(count($data)!= 0){
        $fetched_data=$data[0]->time;
        $decoded_data=json_decode($fetched_data);
        return view('timer4')->with('data',$decoded_data);

       }
       else{
        return view('timer4');
      
       }
    }

    public function add_timer(Request $request)
    {   
      
        $user_id=Auth::user()->id;
      
      $check=  DB::table('timer')->where('user_id',$user_id)->get();
     
      $request_data=  $request->except(['_token']);

   
      $data = json_encode($request_data);
      $data1= array(
        'time'=> $data,
        'user_id'=>$user_id
     );

        if(count($check)==0){
            DB::table('timer')->insert($data1);
        }
        else{
                
            DB::table('timer')->where('user_id',$user_id)->update($data1);

        }
       
    return redirect('/timer');
     
        
    }

    public function time_zone()
    {
        return view('time_zone');
    }

   public function convertedTime(Request $request){
 
//     $time = new DateTimeImmutable($request->dateTime, new DateTimeZone($request->timeZone));

//     // Create a new instance with the new timezone
//     $converted_time = $time->setTimezone(new DateTimeZone($request->convertedTimeZone));
  
//     // format the datetime
//     $converted_time->format('Y-m-d H:i:s T');
  
//     $converted_time1 = [$converted_time];
//    return $converted_time1;
    




// $date = new DateTime($current_dateTime, new DateTimeZone($current_timezone));

// $converted_time1=$date->setTimezone(new DateTimeZone($convertedTimeZone ));

$current_dateTime       = $request->dateTime;
$current_timezone = $request->timeZone;
$convertedTimeZone    = $request->convertedTimeZone;

$new_str = new DateTime($current_dateTime, new DateTimeZone(  $current_timezone  ) );

$utc=$new_str->setTimeZone(new DateTimeZone('UTC'));


    // $new_str1 = new DateTime($current_dateTime, new DateTimeZone('UTC') );
    // print_r($new_str1);
$converted_time1=  $new_str->setTimeZone(new DateTimeZone( $convertedTimeZone ));
 return [$converted_time1];
    }

   

 
}