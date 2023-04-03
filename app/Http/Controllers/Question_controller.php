<?php

namespace App\Http\Controllers;
use  Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Question_model;
use App\Models\Right_answer;
use App\Models\Product;
use App\Models\User;
use App\Events\Result_Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facade;


class Question_controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $id = Auth::user()->id;
        $loggedin_person_data=User::where('id',$id)->get();
       
     if( $loggedin_person_data[0]->role_id==2)
     {
        return redirect(url('test-welcome'));
     }
        $questions = Question_model::paginate(5);
        return view('Admin/question_list',)
            ->with('questions',$questions );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = Auth::user()->id;
        $loggedin_person_data=User::where('id',$id)->get();
       
     if( $loggedin_person_data[0]->role_id==2){
        return redirect(route('test-welcome'));
     }

        return view('Admin/question_page_form');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'option1' => 'required',
            'option2' => 'required',
            'option3' => 'required',
            'option4' => 'required',
            'ranswer' => 'required',
            'image' =>  'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        if($request->file('image')){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/question'), $imageName);
    
            $data= array(
               'question'=> $request->question,
               'option1'=> $request->option1,
               'option2'=> $request->option2,
               'option3'=> $request->option3,
               'option4' => $request->option4,
               'ranswer' => $request->ranswer,
               'image' => $imageName
               
           );
        }
        else{
            $data= array(
                'question'=> $request->question,
               'option1'=> $request->option1,
               'option2'=> $request->option2,
               'option3'=> $request->option3,
               'option4' => $request->option4,
               'ranswer' => $request->ranswer,
               );
        }
        Question_model::create($data);
           
        return redirect()->route('question.index')
                        ->with('success','question added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $id2 = Auth::user()->id;
   
        $loggedin_person_data=User::where('id',$id2)->get();
       
     if( $loggedin_person_data[0]->role_id==2){
        return redirect(route('test-welcome'));
     }
        $data= Question_model::firstWhere('id', $id);
        return view('Admin/question_edit')->with('data',$data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'option1' => 'required',
            'option2' => 'required',
            'option3' => 'required',
            'option4' => 'required',
            'ranswer' => 'required',
          
        ]);
          $id= $request->id;
          $old_image= $request->old_image;

          
          if ($image = $request->file('image')) {
               
            $imageName = time().'.'.$request->image->extension();
          $request->image->move(public_path('images/question'), $imageName);

          $imagePath = public_path('images/question/'.$old_image);
            if(file_exists($imagePath)){
            unlink( $imagePath);
            }
            else{
                return redirect()->route('question.edit')
                ->with('error','unable to upload file.');
            }
          

        }else{
            $imageName= $old_image;   
        }

          $data= array(
           
            'question' =>$request-> question,
            'option1' => $request->option1 ,
            'option2' => $request->option2 ,
            'option3' => $request-> option3 ,
            'option4' => $request-> option4 ,
            'ranswer' => $request-> ranswer ,
            'image' => $imageName
          );
        DB::table('question')->where('id', $id)->update($data);
      
        return redirect()->route('question.index')
                        ->with('success','Question updated successfully');
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $question = Question_model::where('id',$id)->get();
     
        $imagePath = public_path('images/question/'.$question[0]->image);
        if(is_file($imagePath)){
           unlink( $imagePath);
        }
        DB::table('question')->where('id', $id)->delete();
        return redirect()->route('question.index')
                        ->with('success','Question deleted successfully');
    }

    // test 
    public function test_welcome_page(){
        $id = Auth::user()->id;
        $loggedin_person_data=User::where('id',$id)->get();
       
     if( $loggedin_person_data[0]->role_id==1){
        return redirect('question');
     }
     else{
      $products = Product::latest()->paginate(5);
      return view('test/test_welcome_page',compact('products'))
          ->with('i', (request()->input('page', 1) - 1) * 5);
     }
   }

    

    public function question_page(){
        
        $id = Auth::user()->id;
        $loggedin_person_data=User::where('id',$id)->get();
       
     if( $loggedin_person_data[0]->role_id==1){
        return redirect(route('question.index'));
     }

     $user_exist=Right_answer::where('user_id',$id)->get()->count();
     if($user_exist==0){

        $question =  Question_model::All()->take(10)->toArray();
     }   
     else{
        $questions=Right_answer::where('user_id',$id)->get()->toArray();
        foreach ($questions as $question) {

           $questions22[]= $question['question_id'];
           
           $unique_question_ids= array_unique($questions22);
        }
        $question = Question_model::whereNotIn('id', $unique_question_ids)->get()->take(10)->toArray() ;
       
     }

        return view('test/question_page')->with(compact('question'));
    }
    

    public function answer_submit(Request $request){

        $id = Auth::user()->id;
        $loggedin_person_data=User::where('id',$id)->get();
       
     if( $loggedin_person_data[0]->role_id==1){
        return redirect(route('question'));
     }
    $i= 0;
   $data_answers= $request->all();
   
   foreach ($data_answers as $data_answer) {
      $i++;
   $user_answerdata='answer'.$i;   
   $question_id1='question_id'.$i;
   $user_answer= $request->$user_answerdata;
   $question_id=$request->$question_id1;

   $user_id= $request->id;
   $user_id = Auth::user()->id;
   $data=array();  
   
   $data['user_id']=   $user_id;
   $data['question_id']= $question_id;
   $data['user_answer']= $user_answer ;

   
   $result=Question_model::firstWhere('id', $question_id);
   $right_answer=$result['ranswer'];
       

   if($right_answer===$user_answer){
     $data['points']=10;
     $data['status_answer']= 1;
     
   }
      if(!$question_id==null){
         Right_answer::create($data);
      }
      else{
         break;
      }

}
      $points=Right_answer::where('user_id','=',$user_id)->sum('points');
      $total_points= Right_answer::where('user_id',$user_id)->get()->count();
      $result_point=  compact('points','total_points');

// Mail send to user when submit quiz 

       event(new Result_Mail($result_point));
      // Event::fire(new Result_Mail($result_point));
      return view('test.result')->with('result',$result_point);

    }


   //  New Test Page
    public function test_page(){
        
      $id = Auth::user()->id;
      $loggedin_person_data=User::where('id',$id)->get();
     
   if( $loggedin_person_data[0]->role_id==1){
      return redirect(route('question.index'));
   }

   $question =  Question_model::simplePaginate(1);

   $user_selected_options=Right_answer::where(['user_id'=>$id,'question_id'=>$question[0]->id])->get()  ;
      return view('test/test_page')->with(compact('question','user_selected_options'));
  }
  


  public function submit_answers(Request $request){

   $id = Auth::user()->id;
   $loggedin_person_data=User::where('id',$id)->get();
  
if( $loggedin_person_data[0]->role_id==1){
   return redirect(route('question'));
}
$i= 0;
$user_answer= $request->user_answer;
$question_id=$request->question_id;
$user_id = Auth::user()->id;


$data=array();  

$data['user_id']=   $user_id;
$data['question_id']= $question_id;
$data['user_answer']= $user_answer ;


$result=Question_model::firstWhere('id', $question_id);
$right_answer=$result['ranswer'];


if($right_answer===$user_answer){
$data['points']=10;
$data['status_answer']= 1;
}
 if(!$question_id==null){
  $user_already=  Right_answer::Where([
      ['question_id','=', $question_id],
      ['user_id','=', $user_id], ])->get();
      if(count($user_already)==0){
         Right_answer::create($data);
      }
      else{
         Right_answer::where(['user_id'=>$user_id,'question_id'=>$question_id])->update($data);
      }
 }
return 'success';

}

function quiz_result(){
   $user_id = Auth::user()->id;
   $points=Right_answer::where('user_id','=',$user_id)->sum('points');
   $total_points= Right_answer::where('user_id',$user_id)->get()->count();
   $result_point=  compact('points','total_points');
  
   return view('test.result')->with('result',$result_point);
}
function quiz_result_new(){
   $user_id = Auth::user()->id;
   $points=Right_answer::where('user_id','=',$user_id)->sum('points');
   $total_points= Right_answer::where('user_id',$user_id)->get()->count();
   $result_point=  compact('points','total_points');
 
   return view('test.test_result')->with('result',$result_point);
}


public function test_page2(){
return view('test.test_page2');
}

public function test_questions(){

   $id = Auth::user()->id;
   $loggedin_person_data=User::where('id',$id)->get();
  
if( $loggedin_person_data[0]->role_id==1){
   return redirect(route('question.index'));
}

$question =  Question_model::get();

   return $question;

}


public function Submitting_answers(Request $request)
{
  
   $user_id = Auth::user()->id;
        $loggedin_person_data=User::where('id',$user_id)->get();
       
     if( $loggedin_person_data[0]->role_id==1){
        return redirect(route('question'));
     }
    $i= 0;
   $data_answers= $request->submit_data;
   Right_answer::where('user_id',$user_id)->delete();

 if(!empty($data_answers)){

   foreach ($data_answers as $data_answer) {
   $user_answer= $data_answer['user_answer'];
   $question_id=$data_answer['question_id'] ;

   $data=array();  
   

   $result=Question_model::firstWhere('id', $question_id);
   $right_answer=$result['ranswer'];
       

   if($right_answer===$user_answer){
     $data['points']=10;
     $data['status_answer']= 1;
     
   }
  
     $data['user_id']=   $user_id;
     $data['question_id']= $question_id;
     $data['user_answer']= $user_answer ;
   Right_answer::create($data);
    $i++;
 }
}

 return 'success';
}
    

public function submit_form(){
   for ($i=0; $i <100000000 ; $i++) { 
   }
   return 'success';
}
}



